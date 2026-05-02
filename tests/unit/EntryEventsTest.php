<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\elements\Entry;
use craft\events\DraftEvent;
use craft\events\ElementEvent;
use craft\events\ModelEvent;
use doublesecretagency\notifier\helpers\events\EntryEvents;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the EntryEvents helper.
 *
 * The helper bridges Yii event listeners on the Entry element to Notifier's
 * Notification dispatch pipeline. afterSaveElement was added in 3.0.0 to fix
 * https://github.com/doublesecretagency/craft-notifier/issues/7 by listening on
 * Elements::EVENT_AFTER_SAVE_ELEMENT (post-commit, post-revision-creation)
 * instead of Entry::EVENT_AFTER_PROPAGATE (inside the parent transaction).
 * The bridge has to drop per-site recursive firings and translate the
 * ElementEvent shape into a ModelEvent so the rest of the dispatch pipeline
 * keeps working.
 */
class EntryEventsTest extends TestCase
{
    private string $helperSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/helpers/events/EntryEvents.php';
        $this->assertTrue(file_exists($path), "EntryEvents helper should exist at: $path");
        $this->helperSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(EntryEvents::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testLivesInHelpersEventsNamespace(): void
    {
        // Sibling of AssetEvents / UserEvents / CommerceOrderEvents under the
        // same namespace — keeps the on-disk shape uniform.
        $this->assertSame(
            'doublesecretagency\notifier\helpers\events',
            $this->reflection->getNamespaceName()
        );
    }

    public function testImportsEntryAndEventTypes(): void
    {
        // Entry for the instanceof guards; the three Event types for the parameter
        // signatures Notifier handles (ModelEvent for class-level entry events,
        // ElementEvent for the service-level save event, DraftEvent for apply-draft).
        $this->assertStringContainsString('use ' . Entry::class, $this->helperSource);
        $this->assertStringContainsString('use ' . ElementEvent::class, $this->helperSource);
        $this->assertStringContainsString('use ' . ModelEvent::class, $this->helperSource);
        $this->assertStringContainsString('use ' . DraftEvent::class, $this->helperSource);
    }

    // ========================================================================= //
    // Public method surface
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function entryEventMethodProvider(): array
    {
        return [
            ['beforeSave',       ModelEvent::class],
            ['afterSave',        ModelEvent::class],
            ['afterSaveElement', ElementEvent::class],
            ['afterApplyDraft',  DraftEvent::class],
            ['afterPropagate',   ModelEvent::class],
        ];
    }

    /**
     * @dataProvider entryEventMethodProvider
     */
    public function testMethodIsPublicStaticVoid(string $method): void
    {
        // All four helpers are static so Yii's Event::on can reference them as
        // [Class, 'method'] callables, and they return void since dispatch is
        // fire-and-forget.
        $this->assertTrue($this->reflection->hasMethod($method));
        $reflectionMethod = $this->reflection->getMethod($method);
        $this->assertTrue($reflectionMethod->isPublic());
        $this->assertTrue($reflectionMethod->isStatic());
        $this->assertSame('void', (string) $reflectionMethod->getReturnType());
    }

    /**
     * @dataProvider entryEventMethodProvider
     */
    public function testMethodAcceptsExpectedEventType(string $method, string $eventClass): void
    {
        // The parameter type must match the Yii event Notifier registers
        // against — afterSaveElement consumes an ElementEvent because that's
        // what Elements::EVENT_AFTER_SAVE_ELEMENT fires; the others consume
        // ModelEvent.
        $params = $this->reflection->getMethod($method)->getParameters();
        $this->assertCount(1, $params);
        $this->assertSame('event', $params[0]->getName());
        $this->assertSame($eventClass, (string) $params[0]->getType());
    }

    // ========================================================================= //
    // afterSaveElement bridge logic (issue #7)
    // ========================================================================= //

    public function testAfterSaveElementGuardsEntryInstance(): void
    {
        // Elements::EVENT_AFTER_SAVE_ELEMENT fires for every element type, not
        // just entries — the bridge must short-circuit on non-Entry payloads.
        $this->assertMatchesRegularExpression(
            '/afterSaveElement[\s\S]*?\$event->element\s+instanceof\s+Entry/',
            $this->helperSource
        );
    }

    public function testAfterSaveElementSkipsPropagatingFirings(): void
    {
        // Elements::EVENT_AFTER_SAVE_ELEMENT also fires once per site during
        // multi-site propagation. The propagating flag distinguishes the
        // top-level invocation; without this guard the trigger would fan out
        // to one notification per site, breaking the "send one message"
        // contract.
        $this->assertMatchesRegularExpression(
            '/afterSaveElement[\s\S]*?\$event->element->propagating/',
            $this->helperSource
        );
    }

    public function testAfterSaveElementBridgesToModelEvent(): void
    {
        // Downstream code (Dispatch::_filterEntries, Dispatch::_parseTwig)
        // reads $event->sender; the bridge must translate the ElementEvent
        // shape into a ModelEvent with sender set to the entry so the rest of
        // the pipeline keeps working unchanged.
        $this->assertMatchesRegularExpression(
            '/new ModelEvent\(\)[\s\S]*?->sender\s*=\s*\$event->element/',
            $this->helperSource
        );
    }

    public function testAfterSaveElementForwardsToAfterPropagate(): void
    {
        // The bridge must hand the synthesized ModelEvent off to the existing
        // afterPropagate handler — that's the single source of truth for the
        // "saved and propagated" dispatch path.
        $this->assertMatchesRegularExpression(
            '/afterSaveElement[\s\S]*?(?:static|self)::afterPropagate\(/',
            $this->helperSource
        );
    }

    public function testAfterSaveElementSkipsMidApplyDraftCase(): void
    {
        // When Craft is mid-applyDraft, the canonical clone has duplicateOf set
        // to the original draft. At our event-firing point, createRevision()
        // hasn't run yet (duplicateElement defers afterPropagate), so currentRevision
        // would resolve to null. afterApplyDraft handles this case downstream.
        $this->assertMatchesRegularExpression(
            '/afterSaveElement[\s\S]*?duplicateOf[\s\S]*?->getIsDraft\(\)/',
            $this->helperSource
        );
    }

    // ========================================================================= //
    // afterApplyDraft bridge logic (issue #7 follow-up)
    // ========================================================================= //

    public function testAfterApplyDraftGuardsCanonicalIsEntry(): void
    {
        // DraftEvent::canonical can be any element class. The bridge must
        // short-circuit on non-Entry payloads.
        $this->assertMatchesRegularExpression(
            '/afterApplyDraft[\s\S]*?\$event->canonical\s+instanceof\s+Entry/',
            $this->helperSource
        );
    }

    public function testAfterApplyDraftBridgesToModelEvent(): void
    {
        // Same translation pattern as afterSaveElement, but reading the new
        // canonical from $event->canonical (DraftEvent) rather than $event->element.
        $this->assertMatchesRegularExpression(
            '/afterApplyDraft[\s\S]*?new ModelEvent\(\)[\s\S]*?->sender\s*=\s*\$event->canonical/',
            $this->helperSource
        );
    }

    public function testAfterApplyDraftForwardsToAfterPropagate(): void
    {
        $this->assertMatchesRegularExpression(
            '/afterApplyDraft[\s\S]*?(?:static|self)::afterPropagate\(/',
            $this->helperSource
        );
    }

    // ========================================================================= //
    // Notification query event filters (per-handler)
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function notificationEventValueProvider(): array
    {
        return [
            ['afterSave',      'after-save'],
            ['afterPropagate', 'after-propagate'],
        ];
    }

    /**
     * @dataProvider notificationEventValueProvider
     */
    public function testHandlerQueriesNotificationsByEventValue(string $method, string $eventValue): void
    {
        // Each handler queries Notification rows whose `event` column matches
        // the dropdown value the user picked in the CP. These string values
        // are persisted to the database, so renaming them is a breaking
        // change.
        $this->assertMatchesRegularExpression(
            sprintf(
                '/%s[\s\S]*?\'event\'\s*=>\s*\'%s\'/',
                preg_quote($method, '/'),
                preg_quote($eventValue, '/')
            ),
            $this->helperSource
        );
    }
}
