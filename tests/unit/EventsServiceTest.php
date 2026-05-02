<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Component;
use craft\commerce\elements\Order;
use craft\elements\Asset;
use craft\elements\Entry;
use craft\elements\User;
use craft\services\Drafts;
use craft\services\Elements;
use doublesecretagency\notifier\filters\DraftFilter;
use doublesecretagency\notifier\filters\ElementEnabledFilter;
use doublesecretagency\notifier\filters\FirstSaveFilter;
use doublesecretagency\notifier\filters\ProvisionalDraftFilter;
use doublesecretagency\notifier\filters\RevisionFilter;
use doublesecretagency\notifier\services\Events;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the Events service.
 *
 * Events::registerNotificationEvents() attaches Yii listeners to the
 * Entry / Asset / User element classes — these listeners are the only
 * way notifications get triggered, so silently dropping one is a
 * release-blocking regression. These tests verify the event-attachment
 * map at the source level.
 */
class EventsServiceTest extends TestCase
{
    private string $eventsSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/services/Events.php';
        $this->assertTrue(file_exists($path), "Events.php should exist at: $path");
        $this->eventsSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(Events::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsComponent(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Component::class));
    }

    public function testRegisterFilterTypesEventConstantExists(): void
    {
        // Third-party plugins extend Notifier by listening for this event.
        // Renaming or removing it is a breaking change.
        $this->assertSame(
            'registerFilterTypes',
            Events::EVENT_REGISTER_FILTER_TYPES
        );
    }

    // ========================================================================= //
    // Public surface
    // ========================================================================= //

    public function testHasRegisterNotificationEventsMethod(): void
    {
        $this->assertTrue($this->reflection->hasMethod('registerNotificationEvents'));
        $this->assertTrue(
            $this->reflection->getMethod('registerNotificationEvents')->isPublic()
        );
    }

    public function testHasGetAllFiltersMethod(): void
    {
        $this->assertTrue($this->reflection->hasMethod('getAllFilters'));
        $this->assertTrue(
            $this->reflection->getMethod('getAllFilters')->isPublic()
        );
    }

    // ========================================================================= //
    // Per-element-type registration helpers
    // ========================================================================= //

    public function testHasPrivateEntryEventRegistrar(): void
    {
        $this->assertTrue($this->reflection->hasMethod('_registerEntryEvents'));
        $this->assertTrue($this->reflection->getMethod('_registerEntryEvents')->isPrivate());
    }

    public function testHasPrivateAssetEventRegistrar(): void
    {
        $this->assertTrue($this->reflection->hasMethod('_registerAssetEvents'));
        $this->assertTrue($this->reflection->getMethod('_registerAssetEvents')->isPrivate());
    }

    public function testHasPrivateUserEventRegistrar(): void
    {
        $this->assertTrue($this->reflection->hasMethod('_registerUserEvents'));
        $this->assertTrue($this->reflection->getMethod('_registerUserEvents')->isPrivate());
    }

    public function testHasPrivateCommerceOrderEventRegistrar(): void
    {
        // PR #33 introduced the helper for Commerce orders; it must be
        // present and private (only registerNotificationEvents() invokes it).
        $this->assertTrue($this->reflection->hasMethod('_registerCommerceOrderEvents'));
        $this->assertTrue($this->reflection->getMethod('_registerCommerceOrderEvents')->isPrivate());
    }

    // ========================================================================= //
    // Entry event coverage (source-level)
    // ========================================================================= //

    public function testRegistersEntryBeforeSave(): void
    {
        $this->assertMatchesRegularExpression(
            '/Entry::class[\s\S]*?Entry::EVENT_BEFORE_SAVE/',
            $this->eventsSource
        );
    }

    public function testRegistersEntryAfterSave(): void
    {
        $this->assertMatchesRegularExpression(
            '/Entry::class[\s\S]*?Entry::EVENT_AFTER_SAVE/',
            $this->eventsSource
        );
    }

    public function testRegistersEntryAfterSaveElement(): void
    {
        // The "saved and propagated" trigger listens on the service-level
        // EVENT_AFTER_SAVE_ELEMENT (post-commit, post-revision-creation) so that
        // notification templates can resolve {{ entry.currentRevision }}. Issue #7.
        $this->assertMatchesRegularExpression(
            '/Elements::class[\s\S]*?Elements::EVENT_AFTER_SAVE_ELEMENT/',
            $this->eventsSource
        );
    }

    public function testEntryAfterSaveElementDelegatesToBridgeHelper(): void
    {
        // Must dispatch through the EntryEvents::afterSaveElement bridge so the
        // propagating-flag guard runs and the ElementEvent gets translated to
        // the ModelEvent shape expected by the rest of the dispatch pipeline.
        $this->assertStringContainsString(
            "[EntryEvents::class, 'afterSaveElement']",
            $this->eventsSource
        );
    }

    public function testEntryAfterSaveElementNoLongerListensOnEntryClass(): void
    {
        // The replaced listener must not still be registered on the Entry
        // class, otherwise the propagate event would fire twice — once at the
        // pre-commit per-element layer and again at the post-commit service
        // layer.
        $this->assertDoesNotMatchRegularExpression(
            '/Entry::class[\s\S]*?Entry::EVENT_AFTER_PROPAGATE/',
            $this->eventsSource
        );
    }

    public function testRegistersDraftsAfterApplyDraft(): void
    {
        // Apply-draft fires EVENT_AFTER_SAVE_ELEMENT *before* createRevision()
        // has run on the duplicated canonical (Craft defers afterPropagate via
        // the duplicateOf guard). The afterSaveElement handler skips that case
        // and defers to this listener, which fires after applyDraft completes
        // and the revision is queryable.
        $this->assertMatchesRegularExpression(
            '/Drafts::class[\s\S]*?Drafts::EVENT_AFTER_APPLY_DRAFT/',
            $this->eventsSource
        );
    }

    public function testDraftsAfterApplyDraftDelegatesToBridgeHelper(): void
    {
        $this->assertStringContainsString(
            "[EntryEvents::class, 'afterApplyDraft']",
            $this->eventsSource
        );
    }

    public function testImportsDraftsService(): void
    {
        $this->assertStringContainsString('use ' . Drafts::class, $this->eventsSource);
    }

    // ========================================================================= //
    // Asset event coverage
    // ========================================================================= //

    public function testRegistersAssetBeforeSave(): void
    {
        $this->assertMatchesRegularExpression(
            '/Asset::class[\s\S]*?Asset::EVENT_BEFORE_SAVE/',
            $this->eventsSource
        );
    }

    public function testRegistersAssetAfterPropagate(): void
    {
        $this->assertMatchesRegularExpression(
            '/Asset::class[\s\S]*?Asset::EVENT_AFTER_PROPAGATE/',
            $this->eventsSource
        );
    }

    // ========================================================================= //
    // User event coverage
    // ========================================================================= //

    public function testRegistersUserBeforeSave(): void
    {
        $this->assertMatchesRegularExpression(
            '/User::class[\s\S]*?User::EVENT_BEFORE_SAVE/',
            $this->eventsSource
        );
    }

    public function testRegistersUserAfterPropagate(): void
    {
        $this->assertMatchesRegularExpression(
            '/User::class[\s\S]*?User::EVENT_AFTER_PROPAGATE/',
            $this->eventsSource
        );
    }

    public function testRegistersUserAfterActivate(): void
    {
        // Activation is fired by the Users service, not the User element.
        $this->assertMatchesRegularExpression(
            '/Users::class[\s\S]*?Users::EVENT_AFTER_ACTIVATE_USER/',
            $this->eventsSource
        );
    }

    // ========================================================================= //
    // Commerce order event coverage (PR #33)
    // ========================================================================= //

    public function testGuardsCommerceRegistrationOnOrderClassExists(): void
    {
        // Commerce is optional; the registrar must only fire when the Order
        // element class is present, otherwise installs without Commerce
        // would fatal at boot.
        $this->assertMatchesRegularExpression(
            '/class_exists\(Order::class\)[\s\S]*?_registerCommerceOrderEvents/',
            $this->eventsSource
        );
    }

    public function testRegistersCommerceAfterCompleteOrder(): void
    {
        $this->assertMatchesRegularExpression(
            '/Order::class[\s\S]*?Order::EVENT_AFTER_COMPLETE_ORDER/',
            $this->eventsSource
        );
    }

    public function testRegistersCommerceAfterOrderPaid(): void
    {
        $this->assertMatchesRegularExpression(
            '/Order::class[\s\S]*?Order::EVENT_AFTER_ORDER_PAID/',
            $this->eventsSource
        );
    }

    public function testCommerceEventsDelegateToHelper(): void
    {
        // Both Commerce listeners must dispatch through the
        // CommerceOrderEvents helper rather than inlining handler logic
        // — keeps the service shape uniform with Entry/Asset/User.
        $this->assertStringContainsString(
            "[CommerceOrderEvents::class, 'afterCompleteOrder']",
            $this->eventsSource
        );
        $this->assertStringContainsString(
            "[CommerceOrderEvents::class, 'afterOrderPaid']",
            $this->eventsSource
        );
    }

    // ========================================================================= //
    // Filter list integrity
    // ========================================================================= //

    public function testGetAllFiltersIncludesAllFiveActiveFilters(): void
    {
        // Active filter classes — the disabled ones (NewElementFilter,
        // DuplicatingFilter, PropagatingFilter, ResavingFilter) remain in
        // the source as commented-out entries; deliberate exclusions.
        // The source uses the short class name (imported via use statements).
        $this->assertStringContainsString('ElementEnabledFilter::class', $this->eventsSource);
        $this->assertStringContainsString('FirstSaveFilter::class', $this->eventsSource);
        $this->assertStringContainsString('DraftFilter::class', $this->eventsSource);
        $this->assertStringContainsString('ProvisionalDraftFilter::class', $this->eventsSource);
        $this->assertStringContainsString('RevisionFilter::class', $this->eventsSource);
    }

    public function testGetAllFiltersFiresExtensionEvent(): void
    {
        // Third-party plugins must be able to inject custom filter types via
        // the EVENT_REGISTER_FILTER_TYPES extension point.
        $this->assertStringContainsString(
            '$this->trigger(self::EVENT_REGISTER_FILTER_TYPES',
            $this->eventsSource
        );
    }

    // ========================================================================= //
    // Imported element classes
    // ========================================================================= //

    public function testImportsEntryAssetAndUser(): void
    {
        $this->assertStringContainsString('use ' . Entry::class, $this->eventsSource);
        $this->assertStringContainsString('use ' . Asset::class, $this->eventsSource);
        $this->assertStringContainsString('use ' . User::class, $this->eventsSource);
    }

    public function testImportsElementsService(): void
    {
        // The Elements service is needed for the Elements::EVENT_AFTER_SAVE_ELEMENT
        // listener that drives the "saved and propagated" trigger.
        $this->assertStringContainsString('use ' . Elements::class, $this->eventsSource);
    }

    public function testImportsOrderAndCommerceHelper(): void
    {
        // The Commerce element class is referenced unguarded in the use
        // statement (PHP autoload only resolves the class on demand), and
        // the helper must be imported so the listener callback compiles.
        $this->assertStringContainsString('use ' . Order::class, $this->eventsSource);
        $this->assertStringContainsString(
            'use doublesecretagency\\notifier\\helpers\\events\\CommerceOrderEvents',
            $this->eventsSource
        );
    }
}
