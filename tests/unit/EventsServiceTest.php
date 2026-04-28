<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Component;
use craft\elements\Asset;
use craft\elements\Entry;
use craft\elements\User;
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

    public function testRegistersEntryAfterPropagate(): void
    {
        $this->assertMatchesRegularExpression(
            '/Entry::class[\s\S]*?Entry::EVENT_AFTER_PROPAGATE/',
            $this->eventsSource
        );
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
}
