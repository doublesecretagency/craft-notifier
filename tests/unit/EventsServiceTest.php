<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Component;
use craft\commerce\elements\Order;
use craft\commerce\elements\conditions\orders\OrderCondition;
use craft\elements\Asset;
use craft\elements\Entry;
use craft\elements\User;
use craft\elements\conditions\assets\AssetCondition;
use craft\elements\conditions\users\UserCondition;
use craft\services\Drafts;
use craft\services\Elements;
use doublesecretagency\notifier\conditions\NotifierEntryCondition;
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
 * Entry / Asset / User element classes, these listeners are the only
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
        // class, otherwise the propagate event would fire twice, once at the
        // pre-commit per-element layer and again at the post-commit service
        // layer.
        $this->assertDoesNotMatchRegularExpression(
            '/Entry::class[\s\S]*?Entry::EVENT_AFTER_PROPAGATE/',
            $this->eventsSource
        );
    }

    public function testRegistersEntryAfterDelete(): void
    {
        // Tier 1 expansion. The handler must be wired to Entry::EVENT_AFTER_DELETE
        // and dispatched through the EntryEvents helper.
        $this->assertMatchesRegularExpression(
            '/Entry::class[\s\S]*?Entry::EVENT_AFTER_DELETE[\s\S]*?EntryEvents::class[\s\S]*?afterDelete/',
            $this->eventsSource
        );
    }

    public function testRegistersEntryAfterRestore(): void
    {
        $this->assertMatchesRegularExpression(
            '/Entry::class[\s\S]*?Entry::EVENT_AFTER_RESTORE[\s\S]*?EntryEvents::class[\s\S]*?afterRestore/',
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

    public function testRegistersAssetAfterMove(): void
    {
        // Move and propagate share EVENT_AFTER_PROPAGATE; the handler-level
        // firstSave plus folder/volume diff splits them. The service-level
        // wiring must point a distinct listener at the same constant.
        $this->assertStringContainsString(
            "[AssetEvents::class, 'afterMove']",
            $this->eventsSource
        );
    }

    public function testRegistersAssetAfterUpdate(): void
    {
        // afterUpdate is the third listener on EVENT_AFTER_PROPAGATE; the
        // handler-level guards (!firstSave, no folder/volume diff) keep it
        // mutually exclusive with afterPropagate and afterMove.
        $this->assertStringContainsString(
            "[AssetEvents::class, 'afterUpdate']",
            $this->eventsSource
        );
    }

    public function testRegistersAssetAfterDelete(): void
    {
        $this->assertMatchesRegularExpression(
            '/Asset::class[\s\S]*?Asset::EVENT_AFTER_DELETE[\s\S]*?AssetEvents::class[\s\S]*?afterDelete/',
            $this->eventsSource
        );
    }

    public function testRegistersAssetAfterRestore(): void
    {
        $this->assertMatchesRegularExpression(
            '/Asset::class[\s\S]*?Asset::EVENT_AFTER_RESTORE[\s\S]*?AssetEvents::class[\s\S]*?afterRestore/',
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

    public function testRegistersUserAfterUpdate(): void
    {
        // Update and propagate share EVENT_AFTER_PROPAGATE; the handler-level
        // firstSave guard splits them. The service-level wiring must point a
        // distinct listener at the same constant.
        $this->assertStringContainsString(
            "[UserEvents::class, 'afterUpdate']",
            $this->eventsSource
        );
    }

    public function testRegistersUserAfterDelete(): void
    {
        $this->assertMatchesRegularExpression(
            '/User::class[\s\S]*?User::EVENT_AFTER_DELETE[\s\S]*?UserEvents::class[\s\S]*?afterDelete/',
            $this->eventsSource
        );
    }

    public function testRegistersUserAfterRestore(): void
    {
        $this->assertMatchesRegularExpression(
            '/User::class[\s\S]*?User::EVENT_AFTER_RESTORE[\s\S]*?UserEvents::class[\s\S]*?afterRestore/',
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
        // CommerceOrderEvents helper rather than inlining handler logic.
        // Keeps the service shape uniform with Entry/Asset/User.
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
        // Active filter classes, the disabled ones (NewElementFilter,
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

    // ========================================================================= //
    // Element-condition class resolution
    // ========================================================================= //

    public function testHasGetConditionClassForEventTypeMethod(): void
    {
        // Notifier exposes Craft's element-conditions framework on a per-event-type
        // basis. The resolver maps an event type string to the matching condition
        // class so Notification::getEventCondition() can hydrate the right shape.
        $this->assertTrue($this->reflection->hasMethod('getConditionClassForEventType'));
        $this->assertTrue(
            $this->reflection->getMethod('getConditionClassForEventType')->isPublic()
        );
    }

    public function testGetConditionClassForEventTypeReturnsNotifierEntryConditionForEntries(): void
    {
        // Pure unit: the resolver is a string-to-string match with no Craft
        // boot required. The 'entries' branch must wire to NotifierEntryCondition,
        // a Notifier-scoped subclass of Craft's EntryCondition. Returning the
        // base EntryCondition would leak Notifier-only condition rules into
        // every other consumer (CP entries-index filter, etc.).
        $service = new Events();
        $this->assertSame(
            NotifierEntryCondition::class,
            $service->getConditionClassForEventType('entries')
        );
    }

    public function testGetConditionClassForEventTypeReturnsAssetConditionForAssets(): void
    {
        $service = new Events();
        $this->assertSame(
            AssetCondition::class,
            $service->getConditionClassForEventType('assets')
        );
    }

    public function testGetConditionClassForEventTypeReturnsUserConditionForUsers(): void
    {
        $service = new Events();
        $this->assertSame(
            UserCondition::class,
            $service->getConditionClassForEventType('users')
        );
    }

    public function testGetConditionClassForEventTypeReturnsOrderConditionWhenCommerceInstalled(): void
    {
        // Commerce is optional. In this sandbox it's installed, so the resolver
        // must return OrderCondition. Installs without Commerce would see null,
        // that branch is regression-protected by the class_exists guard below.
        $service = new Events();
        $this->assertSame(
            OrderCondition::class,
            $service->getConditionClassForEventType('craft-commerce-orders')
        );
    }

    public function testGetConditionClassForEventTypeGuardsCommerceMappingOnClassExists(): void
    {
        // The craft-commerce-orders branch must be guarded so installs without
        // Commerce do not trigger an autoload error when the resolver runs.
        $this->assertMatchesRegularExpression(
            "/'craft-commerce-orders'[\s\S]*?class_exists\(OrderCondition::class\)/",
            $this->eventsSource
        );
    }

    public function testGetConditionClassForEventTypeReturnsNullForUnknownTypes(): void
    {
        // Defensive default, every other string falls through to null so
        // callers can cleanly short-circuit when no condition is configured.
        $service = new Events();
        $this->assertNull($service->getConditionClassForEventType('not-a-real-type'));
        $this->assertNull($service->getConditionClassForEventType(''));
    }

    public function testImportsNotifierEntryConditionClass(): void
    {
        // The 'entries' branch wires to a Notifier-scoped subclass; the source
        // must import that subclass instead of Craft's base EntryCondition.
        $this->assertStringContainsString(
            'use ' . NotifierEntryCondition::class,
            $this->eventsSource
        );
    }

    public function testImportsAssetConditionClass(): void
    {
        $this->assertStringContainsString('use ' . AssetCondition::class, $this->eventsSource);
    }

    public function testImportsUserConditionClass(): void
    {
        $this->assertStringContainsString('use ' . UserCondition::class, $this->eventsSource);
    }

    public function testImportsOrderConditionClass(): void
    {
        // Commerce is optional, but PHP autoload only resolves the class on
        // demand, so unguarded use statements are safe.
        $this->assertStringContainsString('use ' . OrderCondition::class, $this->eventsSource);
    }

    // ========================================================================= //
    // Element class resolution (seeds ElementCondition::$elementType)
    // ========================================================================= //

    public function testHasGetElementClassForEventTypeMethod(): void
    {
        // The condition slot must seed `elementType` on the hydrated condition,
        // otherwise `ElementCondition::selectableConditionRules()` skips both
        // the per-field rule loop and the element-type-aware base rules
        // (Status, Title, Uri, HasUrl). The resolver lives next to its
        // condition-class sibling on the Events service.
        $this->assertTrue($this->reflection->hasMethod('getElementClassForEventType'));
        $this->assertTrue(
            $this->reflection->getMethod('getElementClassForEventType')->isPublic()
        );
    }

    public function testGetElementClassForEventTypeReturnsEntryForEntries(): void
    {
        $service = new Events();
        $this->assertSame(
            Entry::class,
            $service->getElementClassForEventType('entries')
        );
    }

    public function testGetElementClassForEventTypeReturnsAssetForAssets(): void
    {
        $service = new Events();
        $this->assertSame(
            Asset::class,
            $service->getElementClassForEventType('assets')
        );
    }

    public function testGetElementClassForEventTypeReturnsUserForUsers(): void
    {
        $service = new Events();
        $this->assertSame(
            User::class,
            $service->getElementClassForEventType('users')
        );
    }

    public function testGetElementClassForEventTypeReturnsOrderWhenCommerceInstalled(): void
    {
        // Commerce is optional. In this sandbox it's installed, so the resolver
        // must return Order. Installs without Commerce would see null, that
        // branch is regression-protected by the class_exists guard below.
        $service = new Events();
        $this->assertSame(
            Order::class,
            $service->getElementClassForEventType('craft-commerce-orders')
        );
    }

    public function testGetElementClassForEventTypeGuardsCommerceMappingOnClassExists(): void
    {
        // The craft-commerce-orders branch must be guarded so installs without
        // Commerce do not trigger an autoload error when the resolver runs.
        $this->assertMatchesRegularExpression(
            "/'craft-commerce-orders'[\s\S]*?class_exists\(Order::class\)/",
            $this->eventsSource
        );
    }

    public function testGetElementClassForEventTypeReturnsNullForUnknownTypes(): void
    {
        // Defensive default, every other string falls through to null so
        // callers can cleanly short-circuit when no element type is configured.
        $service = new Events();
        $this->assertNull($service->getElementClassForEventType('not-a-real-type'));
        $this->assertNull($service->getElementClassForEventType(''));
    }

    // ========================================================================= //
    // Tier 2 private registrars
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function tier2RegistrarProvider(): array
    {
        return [
            ['_registerCommerceProductEvents'],
            ['_registerDigitalProductEvents'],
            ['_registerDigitalProductLicenseEvents'],
            ['_registerCalendarEventEvents'],
        ];
    }

    /**
     * @dataProvider tier2RegistrarProvider
     */
    public function testHasPrivateTier2Registrar(string $method): void
    {
        // Each Tier 2 category gets its own private registrar so plugin-bridge
        // categories can be guarded individually in registerNotificationEvents.
        $this->assertTrue($this->reflection->hasMethod($method));
        $this->assertTrue($this->reflection->getMethod($method)->isPrivate());
    }

    // ========================================================================= //
    // Tier 2 plugin-bridge class_exists guards
    // ========================================================================= //

    public function testGuardsCommerceProductRegistrationOnClassExists(): void
    {
        // Commerce Products live in the same plugin as Orders but are a
        // separate Element class. Guard on the Product class specifically
        // so the registrar bails if Commerce is somehow installed without
        // the Product surface.
        $this->assertMatchesRegularExpression(
            '/class_exists\(CommerceProduct::class\)[\s\S]*?_registerCommerceProductEvents/',
            $this->eventsSource
        );
    }

    public function testGuardsDigitalProductRegistrationOnClassExists(): void
    {
        // Digital Products is a separate plugin. Guard on its Product class
        // so installs without the plugin do not fatal at boot.
        $this->assertMatchesRegularExpression(
            '/class_exists\(DigitalProduct::class\)[\s\S]*?_registerDigitalProductEvents/',
            $this->eventsSource
        );
    }

    public function testGuardsCalendarEventRegistrationOnClassExists(): void
    {
        // Solspace Calendar is a separate plugin. Guard on its Event element
        // class so installs without the plugin do not fatal at boot.
        $this->assertMatchesRegularExpression(
            '/class_exists\(CalendarEvent::class\)[\s\S]*?_registerCalendarEventEvents/',
            $this->eventsSource
        );
    }

    // ========================================================================= //
    // Tier 2 event registrations (source-level)
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function tier2EventRegistrationProvider(): array
    {
        return [
            // [classToken, eventConstant, helperClass, handlerMethod]
            ['Order',             'EVENT_BEFORE_SAVE',   'CommerceOrderEvents',           'beforeSave'],
            ['CommerceProduct',   'EVENT_BEFORE_SAVE',   'CommerceProductEvents',         'beforeSave'],
            ['CommerceProduct',   'EVENT_AFTER_PROPAGATE',    'CommerceProductEvents',         'afterPropagate'],
            ['CommerceProduct',   'EVENT_AFTER_DELETE',  'CommerceProductEvents',         'afterDelete'],
            ['CommerceProduct',   'EVENT_AFTER_RESTORE', 'CommerceProductEvents',         'afterRestore'],
            ['DigitalProduct',    'EVENT_BEFORE_SAVE',   'DigitalProductEvents',          'beforeSave'],
            ['DigitalProduct',    'EVENT_AFTER_PROPAGATE',    'DigitalProductEvents',          'afterPropagate'],
            ['DigitalProduct',    'EVENT_AFTER_DELETE',  'DigitalProductEvents',          'afterDelete'],
            ['DigitalProduct',    'EVENT_AFTER_RESTORE', 'DigitalProductEvents',          'afterRestore'],
            ['License',           'EVENT_BEFORE_SAVE',   'DigitalProductLicenseEvents',   'beforeSave'],
            ['License',           'EVENT_AFTER_PROPAGATE',    'DigitalProductLicenseEvents',   'afterPropagate'],
            ['License',           'EVENT_AFTER_DELETE',  'DigitalProductLicenseEvents',   'afterDelete'],
            ['License',           'EVENT_AFTER_RESTORE', 'DigitalProductLicenseEvents',   'afterRestore'],
            ['CalendarEvent',     'EVENT_BEFORE_SAVE',   'CalendarEventEvents',           'beforeSave'],
            ['CalendarEvent',     'EVENT_AFTER_PROPAGATE',    'CalendarEventEvents',           'afterPropagate'],
            ['CalendarEvent',     'EVENT_AFTER_DELETE',  'CalendarEventEvents',           'afterDelete'],
            ['CalendarEvent',     'EVENT_AFTER_RESTORE', 'CalendarEventEvents',           'afterRestore'],
        ];
    }

    /**
     * @dataProvider tier2EventRegistrationProvider
     */
    public function testRegistersTier2Event(string $classToken, string $eventConstant, string $helperClass, string $handlerMethod): void
    {
        // Each Tier 2 element class gets save / delete / restore wired to
        // the matching helper method, mirroring the Tier 1 pattern.
        $this->assertMatchesRegularExpression(
            sprintf(
                '/%s::class[\s\S]*?%s::%s[\s\S]*?%s::class[\s\S]*?%s/',
                preg_quote($classToken, '/'),
                preg_quote($classToken, '/'),
                preg_quote($eventConstant, '/'),
                preg_quote($helperClass, '/'),
                preg_quote($handlerMethod, '/')
            ),
            $this->eventsSource
        );
    }

    public function testRegistersUserAfterAssignToGroups(): void
    {
        // The new assignment event rides the Users service, not the User element.
        // Matches the existing afterActivateUser registration shape.
        $this->assertMatchesRegularExpression(
            '/Users::class[\s\S]*?Users::EVENT_AFTER_ASSIGN_USER_TO_GROUPS[\s\S]*?UserEvents::class[\s\S]*?afterAssignToGroups/',
            $this->eventsSource
        );
    }

    // ========================================================================= //
    // Tier 2 condition-class resolution
    // ========================================================================= //

    /**
     * @return array<int, array{string, string|null}>
     */
    public static function tier2ConditionMappingProvider(): array
    {
        return [
            ['craft-commerce-products',         'CommerceProductCondition'],
            ['digital-products-products', null],
            ['digital-products-licenses',  null],
            ['solspace-calendar-events',           'CalendarEventCondition'],
        ];
    }

    /**
     * @dataProvider tier2ConditionMappingProvider
     */
    public function testTier2ConditionMappingShape(string $eventType, ?string $conditionToken): void
    {
        if ($conditionToken === null) {
            // Digital Products elements don't ship dedicated condition classes;
            // the resolver returns null and the Field Conditions slot renders empty.
            $this->assertMatchesRegularExpression(
                sprintf("/'%s'\\s*=>\\s*null/", preg_quote($eventType, '/')),
                $this->eventsSource
            );
            return;
        }

        // Categories with a backing condition class must guard on class_exists
        // so installs without the source plugin don't blow up the resolver.
        $this->assertMatchesRegularExpression(
            sprintf(
                "/'%s'[\\s\\S]*?class_exists\\(%s::class\\)/",
                preg_quote($eventType, '/'),
                preg_quote($conditionToken, '/')
            ),
            $this->eventsSource
        );
    }

    // ========================================================================= //
    // Tier 2 element-class resolution
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function tier2ElementMappingProvider(): array
    {
        return [
            ['craft-commerce-products',         'CommerceProduct'],
            ['digital-products-products', 'DigitalProduct'],
            ['digital-products-licenses',  'License'],
            ['solspace-calendar-events',           'CalendarEvent'],
        ];
    }

    /**
     * @dataProvider tier2ElementMappingProvider
     */
    public function testTier2ElementMappingGuardsOnClassExists(string $eventType, string $elementToken): void
    {
        // Each Tier 2 element-class mapping must guard on class_exists so
        // installs without the source plugin do not autoload-error.
        $this->assertMatchesRegularExpression(
            sprintf(
                "/'%s'[\\s\\S]*?class_exists\\(%s::class\\)/",
                preg_quote($eventType, '/'),
                preg_quote($elementToken, '/')
            ),
            $this->eventsSource
        );
    }

    // ========================================================================= //
    // Tier 2 imports
    // ========================================================================= //

    public function testImportsTier2HelperClasses(): void
    {
        // The four new helper classes must be imported so the listener
        // callbacks compile.
        $this->assertStringContainsString(
            'use doublesecretagency\\notifier\\helpers\\events\\CommerceProductEvents',
            $this->eventsSource
        );
        $this->assertStringContainsString(
            'use doublesecretagency\\notifier\\helpers\\events\\DigitalProductEvents',
            $this->eventsSource
        );
        $this->assertStringContainsString(
            'use doublesecretagency\\notifier\\helpers\\events\\DigitalProductLicenseEvents',
            $this->eventsSource
        );
        $this->assertStringContainsString(
            'use doublesecretagency\\notifier\\helpers\\events\\CalendarEventEvents',
            $this->eventsSource
        );
    }

    public function testImportsTier2ElementClasses(): void
    {
        // Element-class use statements are safe even when the plugin is absent;
        // PHP autoload only resolves them on demand.
        $this->assertStringContainsString(
            'use craft\\commerce\\elements\\Product as CommerceProduct',
            $this->eventsSource
        );
        $this->assertStringContainsString(
            'use craft\\digitalproducts\\elements\\Product as DigitalProduct',
            $this->eventsSource
        );
        $this->assertStringContainsString(
            'use craft\\digitalproducts\\elements\\License',
            $this->eventsSource
        );
        $this->assertStringContainsString(
            'use Solspace\\Calendar\\Elements\\Event as CalendarEvent',
            $this->eventsSource
        );
    }
}
