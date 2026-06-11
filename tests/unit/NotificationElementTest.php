<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Element;
use craft\elements\conditions\ElementConditionInterface;
use doublesecretagency\notifier\elements\conditions\NotificationCondition;
use doublesecretagency\notifier\elements\db\NotificationQuery;
use doublesecretagency\notifier\elements\Notification;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionNamedType;

/**
 * Structural tests for the Notification element type.
 *
 * Notification is a Craft element backed by the `notifier_notifications`
 * extension table. Its public surface is large (every Element override)
 * but the parts that matter for the plugin's behavior are: the
 * persisted attributes, the query / condition wiring, the permission
 * gates, and the task-recipient / dynamic-recipients validation.
 */
class NotificationElementTest extends TestCase
{
    private string $notificationSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/elements/Notification.php';
        $this->assertTrue(file_exists($path), "Notification.php should exist at: $path");
        $this->notificationSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(Notification::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsCraftElement(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Element::class));
    }

    public function testRefHandle(): void
    {
        // `notification` is the reference handle used in Twig
        // (e.g. {notification:42:title}).
        $this->assertSame('notification', Notification::refHandle());
    }

    public function testHasContent(): void
    {
        $this->assertTrue(Notification::hasContent());
    }

    public function testHasTitles(): void
    {
        $this->assertTrue(Notification::hasTitles());
    }

    public function testHasStatuses(): void
    {
        $this->assertTrue(Notification::hasStatuses());
    }

    // ========================================================================= //
    // Report event type predicate
    // ========================================================================= //

    public function testIsReportTypeIsPublicAndReturnsBool(): void
    {
        // Single source of truth for "is this a System Snapshot / Dynamic Data
        // notification" - the CP send button, the dispatch filter, the table
        // attribute renderer, and the recurring-tracking seed all call it.
        $this->assertTrue($this->reflection->hasMethod('isReportType'));
        $method = $this->reflection->getMethod('isReportType');
        $this->assertTrue($method->isPublic());
        $this->assertSame('bool', (string) $method->getReturnType());
    }

    /**
     * @return array<string, array{0: string|null, 1: bool}>
     */
    public static function reportTypeProvider(): array
    {
        return [
            'system-snapshot' => ['system-snapshot', true],
            'dynamic-data'    => ['dynamic-data', true],
            'entries'         => ['entries', false],
            'feed'            => ['feed', false],
            'null'            => [null, false],
        ];
    }

    /**
     * @dataProvider reportTypeProvider
     */
    public function testIsReportType(?string $eventType, bool $expected): void
    {
        // Exercise the predicate directly. init() instantiates a NotificationLog
        // (which dereferences Craft::$app), so build the element without its
        // constructor and set the public eventType property by hand.
        $notification = $this->reflection->newInstanceWithoutConstructor();
        $notification->eventType = $eventType;
        $this->assertSame($expected, $notification->isReportType());
    }

    // ========================================================================= //
    // Field layout
    // ========================================================================= //

    public function testGetFieldLayoutSetsType(): void
    {
        // Card View rendering calls $fieldLayout->type::cardAttributes(),
        // which triggers "Class name must be a valid object or a string"
        // when type is null. Regression test for issue #25.
        $this->assertMatchesRegularExpression(
            '/getFieldLayout\(\)[\s\S]*?\$fieldLayout->type\s*=\s*(static|self|Notification)::class/',
            $this->notificationSource
        );
    }

    // ========================================================================= //
    // Persisted attributes
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function persistedAttributeProvider(): array
    {
        return [
            ['description'],
            ['eventType'],
            ['event'],
            ['eventConfig'],
            ['messageType'],
            ['messageConfig'],
            ['recipientsType'],
            ['recipientsConfig'],
            ['queue'],
        ];
    }

    /**
     * @dataProvider persistedAttributeProvider
     */
    public function testPersistedAttributeIsPublicProperty(string $attribute): void
    {
        // Each attribute mapped from the `notifier_notifications` table row
        // must be a public property on the element so afterSave() can copy it.
        $this->assertTrue(
            $this->reflection->hasProperty($attribute),
            "Notification element should expose `$attribute` as a public property"
        );
        $this->assertTrue($this->reflection->getProperty($attribute)->isPublic());
    }

    // ========================================================================= //
    // Query / Condition wiring
    // ========================================================================= //

    public function testFindReturnsNotificationQuery(): void
    {
        // The custom query class is what enables Notification::find() to
        // expose the notification-specific filters.
        $this->assertStringContainsString(
            'NotificationQuery::class',
            $this->notificationSource
        );
        // and the import is wired up
        $this->assertStringContainsString(
            'use ' . NotificationQuery::class,
            $this->notificationSource
        );
    }

    public function testQuerySelectsQueueColumn(): void
    {
        // The element only hydrates columns the query explicitly selects.
        // Without this, the `queue` value silently never loads.
        $querySource = file_get_contents(dirname(__DIR__, 2).'/src/elements/db/NotificationQuery.php');
        $this->assertStringContainsString(
            'notifier_notifications.queue',
            $querySource
        );
    }

    public function testCreateConditionReturnsNotificationCondition(): void
    {
        $this->assertStringContainsString(
            'NotificationCondition::class',
            $this->notificationSource
        );
        $this->assertStringContainsString(
            'use ' . NotificationCondition::class,
            $this->notificationSource
        );
    }

    // ========================================================================= //
    // Permission gating
    // ========================================================================= //

    public function testCanViewChecksViewPermission(): void
    {
        // Non-admins must hold notifier-viewNotifications.
        $this->assertMatchesRegularExpression(
            "/canView[\s\S]*?'notifier-viewNotifications'/",
            $this->notificationSource
        );
    }

    public function testCanSaveChecksSavePermission(): void
    {
        $this->assertMatchesRegularExpression(
            "/canSave[\s\S]*?'notifier-saveNotifications'/",
            $this->notificationSource
        );
    }

    public function testCanDeleteChecksDeletePermission(): void
    {
        $this->assertMatchesRegularExpression(
            "/canDelete[\s\S]*?'notifier-deleteNotifications'/",
            $this->notificationSource
        );
    }

    public function testCanDuplicateChecksSavePermission(): void
    {
        // Duplicating creates a new notification; same permission as save.
        $this->assertMatchesRegularExpression(
            "/canDuplicate[\s\S]*?'notifier-saveNotifications'/",
            $this->notificationSource
        );
    }

    public function testCanCreateDraftsRequiresSavePermission(): void
    {
        // Creating a draft is an edit affordance, historically returned true
        // unconditionally, which let view-only users author drafts. Drafts
        // must now require notifier-saveNotifications, same as a fresh save.
        $this->assertMatchesRegularExpression(
            "/canCreateDrafts[\s\S]*?'notifier-saveNotifications'/",
            $this->notificationSource
        );
    }

    // ========================================================================= //
    // Dynamic Recipients server-side gate
    // ========================================================================= //

    public function testValidateDynamicRecipientsPermissionExists(): void
    {
        // Server-side gate on the Dynamic Recipients dropdown, the CP
        // template hides the option, but a crafted POST could bypass that.
        $this->assertTrue(
            $this->reflection->hasMethod('validateDynamicRecipientsPermission')
        );
        $this->assertTrue(
            $this->reflection->getMethod('validateDynamicRecipientsPermission')->isPublic()
        );
    }

    public function testValidateRulesIncludeDynamicRecipientsPermissionCheck(): void
    {
        // The validator must be wired into defineRules() so it actually runs.
        $this->assertStringContainsString(
            "'validateDynamicRecipientsPermission'",
            $this->notificationSource
        );
    }

    public function testValidateDynamicRecipientsBypassedForConsoleAndQueue(): void
    {
        // Console / queue / programmatic saves are trusted (no user identity
        // to check against). The validator must short-circuit when not in CP.
        $this->assertStringContainsString(
            'getIsCpRequest()',
            $this->notificationSource
        );
    }

    public function testValidateDynamicRecipientsChecksTheCorrectPermission(): void
    {
        // The permission name must exactly match what's registered in
        // NotifierPlugin::_registerUserPermissions().
        $this->assertStringContainsString(
            "'notifier-editDynamicRecipients'",
            $this->notificationSource
        );
    }

    // ========================================================================= //
    // Email message editor mode (Code / Rich Text toggle)
    // ========================================================================= //

    public function testValidateEmailMessageModeExists(): void
    {
        // Validator backs the rule that gates messageConfig[emailMessageMode]
        // to 'code' or 'rich' and normalizes missing values to 'code' for
        // backward compatibility with notifications saved before the toggle.
        $this->assertTrue(
            $this->reflection->hasMethod('validateEmailMessageMode')
        );
        $this->assertTrue(
            $this->reflection->getMethod('validateEmailMessageMode')->isPublic()
        );
    }

    public function testValidateRulesIncludeEmailMessageModeCheck(): void
    {
        // The validator must be wired into defineRules() so it actually runs.
        $this->assertStringContainsString(
            "'validateEmailMessageMode'",
            $this->notificationSource
        );
    }

    public function testValidateEmailMessageModeAllowsCodeAndRichOnly(): void
    {
        // Only 'code' (Monaco source) and 'rich' (Trix WYSIWYG) are valid;
        // anything else attaches a validation error.
        $this->assertMatchesRegularExpression(
            "/validateEmailMessageMode[\s\S]*?\['code',\s*'rich'\]/",
            $this->notificationSource
        );
    }

    public function testValidateEmailMessageModeNormalizesMissingToRich(): void
    {
        // Rich Text is the default for new notifications. Programmatic saves
        // that omit the key are normalized to 'rich' on validate().
        $this->assertMatchesRegularExpression(
            "/validateEmailMessageMode[\s\S]*?\?\?\s*'rich'/",
            $this->notificationSource
        );
    }

    // ========================================================================= //
    // afterSave persistence
    // ========================================================================= //

    public function testAfterSavePersistsAllAttributes(): void
    {
        // Each persisted attribute must be copied from POST or the element
        // onto the NotificationRecord so a refresh sees the latest state.
        foreach (self::persistedAttributeProvider() as [$attr]) {
            $this->assertStringContainsString(
                "\$record->$attr",
                $this->notificationSource,
                "afterSave should persist `$attr` to NotificationRecord"
            );
        }
    }

    public function testAfterSaveGuardsBodyParamsAgainstConsoleRequests(): void
    {
        // getBodyParam() only exists on a web request. afterSave() must guard
        // the POST reads behind a console-request check so console and
        // programmatic saves persist the element's own property values
        // instead of fataling on the missing method.
        $this->assertMatchesRegularExpression(
            '/getIsConsoleRequest\(\)[\s\S]*?getBodyParam\(/',
            $this->notificationSource,
            'afterSave must guard getBodyParam() behind a console-request check'
        );
    }

    // ========================================================================= //
    // Task recipient labels
    // ========================================================================= //

    public function testGetTaskRecipientCoversAllSixTypes(): void
    {
        // Used as the queue-job label for "Sending {messageType} to {recipient}".
        // Each of the six recipientsType values must yield a human-readable label.
        $this->assertMatchesRegularExpression("/case\s+'current-user'/", $this->notificationSource);
        $this->assertMatchesRegularExpression("/case\s+'all-users'/", $this->notificationSource);
        $this->assertMatchesRegularExpression("/case\s+'all-admins'/", $this->notificationSource);
        $this->assertMatchesRegularExpression("/case\s+'selected-groups'/", $this->notificationSource);
        $this->assertMatchesRegularExpression("/case\s+'selected-users'/", $this->notificationSource);
        $this->assertMatchesRegularExpression("/case\s+'dynamic-recipients'/", $this->notificationSource);
    }

    // ========================================================================= //
    // Plugin-facing send() entry point
    // ========================================================================= //

    public function testSendDelegatesToMessagesService(): void
    {
        // $notification->send($event) is the conventional in-Twig way to
        // re-fire a notification; it must hand off to the Messages service.
        $this->assertStringContainsString(
            '->messages->send($this, $event)',
            $this->notificationSource
        );
    }

    // ========================================================================= //
    // Craft element-condition slot
    // ========================================================================= //

    public function testHasGetEventConditionMethod(): void
    {
        // The condition slot is the entry point used by both the builder
        // template (CP rendering) and Dispatch (dispatch-time match check).
        // Renaming or removing it would break both surfaces.
        $this->assertTrue($this->reflection->hasMethod('getEventCondition'));
        $this->assertTrue($this->reflection->getMethod('getEventCondition')->isPublic());
    }

    public function testGetEventConditionReturnsNullableElementCondition(): void
    {
        // Returns ?ElementConditionInterface so callers can short-circuit when
        // the event type has no first-party condition support.
        $returnType = $this->reflection->getMethod('getEventCondition')->getReturnType();
        $this->assertInstanceOf(ReflectionNamedType::class, $returnType);
        $this->assertSame(ElementConditionInterface::class, $returnType->getName());
        $this->assertTrue($returnType->allowsNull());
    }

    public function testGetEventConditionAcceptsOptionalForEventTypeParam(): void
    {
        // The notification edit screen renders a builder per event-type tab,
        // so getEventCondition() must accept an explicit event-type override.
        // Dispatch-time callers omit the arg and fall back to $this->eventType.
        $params = $this->reflection->getMethod('getEventCondition')->getParameters();
        $this->assertCount(1, $params);
        $this->assertSame('forEventType', $params[0]->getName());
        $this->assertTrue($params[0]->isOptional());
        $this->assertNull($params[0]->getDefaultValue());

        // Type must be ?string (nullable string)
        $type = $params[0]->getType();
        $this->assertInstanceOf(ReflectionNamedType::class, $type);
        $this->assertSame('string', $type->getName());
        $this->assertTrue($type->allowsNull());
    }

    public function testGetEventConditionRebindsClassFromResolver(): void
    {
        // The hydrated config must always re-bind 'class' to whatever the
        // events service resolves, so a stale persisted config (e.g. swapped
        // condition class between releases) doesn't blow up at hydrate time.
        $this->assertStringContainsString(
            "\$config['class'] = \$class;",
            $this->notificationSource
        );
    }

    public function testGetEventConditionUsesConditionsService(): void
    {
        // Single hydration call, Craft's Conditions service knows how to
        // unwrap the {config: "<json>"} shape produced by the builder POST
        // and reconstruct the rule list.
        $this->assertStringContainsString(
            'getConditions()->createCondition(',
            $this->notificationSource
        );
    }

    public function testGetEventConditionSeedsElementType(): void
    {
        // Without an `elementType` on the config, ElementCondition's rule
        // loop short-circuits at line 180, every per-field rule and every
        // element-type-aware base rule (Status, Title, Uri, HasUrl) drops
        // out, leaving only the misleadingly-named nested-entry "Field" rule
        // and a handful of generic rules. Hydration must call into the
        // events service's element-class resolver and assign the result
        // before passing the config to Conditions::createCondition().
        $this->assertMatchesRegularExpression(
            "/getElementClassForEventType\([\s\S]*?\\\$config\['elementType'\]\s*=/",
            $this->notificationSource
        );
    }

    public function testGetEventConditionPinsPerTypeBuilderInputName(): void
    {
        // Per-event-type form name and DOM id let all four event-type tabs
        // render their builders simultaneously without colliding. The active
        // tab's POST is relocated into $eventConfig['condition'] in afterSave().
        // Plain (non-bracketed) names are still required because the builder's
        // htmx selectors break when bracketed names get encoded into CSS targets.
        $this->assertStringContainsString(
            "\$condition->name = \"eventCondition_{\$forEventType}\"",
            $this->notificationSource
        );
        $this->assertStringContainsString(
            "\$condition->id = \"event-condition-{\$forEventType}\"",
            $this->notificationSource
        );
    }

    public function testGetEventConditionOnlySeedsPersistedConfigForActiveEventType(): void
    {
        // When a builder is rendered for an event type other than the saved
        // one, the persisted eventConfig['condition'] (whose rule classes
        // belong to a different ElementCondition class) must be ignored, or
        // hydration will throw. Inactive tabs always start fresh.
        $this->assertMatchesRegularExpression(
            "/\\\$forEventType\s*===\s*\\(string\\)\s*\\\$this->eventType[\s\S]*?\\\$this->eventConfig\\['condition'\\][\s\S]*?'class'\s*=>\s*\\\$class/",
            $this->notificationSource
        );
    }

    public function testGetEventConditionUsesDivMainTag(): void
    {
        // BaseCondition defaults mainTag to <form>, but the notification edit
        // screen is already a <form>. Nested forms silently break the htmx
        // rule-swap behavior (the request fires but never re-renders). Pinning
        // mainTag to 'div' matches Craft's inline usage in FieldLayoutComponent.
        $this->assertStringContainsString(
            "\$condition->mainTag = 'div'",
            $this->notificationSource
        );
    }

    public function testAfterSaveMergesEventConditionIntoEventConfig(): void
    {
        // Each event-type tab posts its condition under a per-type key
        // (eventCondition_entries, eventCondition_assets, etc.). afterSave
        // must read only the one matching the selected event type, then
        // relocate it into $eventConfig['condition'] so persistence and
        // hydration land at the canonical key.
        $this->assertMatchesRegularExpression(
            '/getBodyParam\\("eventCondition_\\{\\$selectedEventType\\}"\\)[\s\S]*?\\$eventConfig\\[\'condition\'\\]\s*=\s*\\$eventCondition/',
            $this->notificationSource
        );
    }

    // ========================================================================= //
    // Manual trigger label
    // ========================================================================= //

    public function testHasGetManualTriggerLabelMethod(): void
    {
        $this->assertTrue($this->reflection->hasMethod('getManualTriggerLabel'));
        $this->assertTrue($this->reflection->getMethod('getManualTriggerLabel')->isPublic());
    }

    public function testGetManualTriggerLabelReturnsString(): void
    {
        // The label is always a string; an empty config value falls back to
        // a default rather than returning null.
        $this->assertSame(
            'string',
            (string) $this->reflection->getMethod('getManualTriggerLabel')->getReturnType()
        );
    }

    public function testGetManualTriggerLabelFallsBackToDefault(): void
    {
        // An unconfigured or empty label resolves to the "Send Notification" default.
        $this->assertMatchesRegularExpression(
            "/getManualTriggerLabel[\s\S]*?eventConfig\\['manualTriggerLabel'\\][\s\S]*?'Send Notification'/",
            $this->notificationSource
        );
    }

    public function testAfterSaveMergesManualTriggerLabelIntoEventConfig(): void
    {
        // Each event-type tab posts its label under a per-type key
        // (manualTriggerLabel_entries, etc.). afterSave reads only the one
        // matching the selected event type, then relocates it into
        // $eventConfig['manualTriggerLabel'] for canonical persistence.
        $this->assertMatchesRegularExpression(
            '/getBodyParam\\("manualTriggerLabel_\\{\\$selectedEventType\\}"\\)[\s\S]*?\\$eventConfig\\[\'manualTriggerLabel\'\\]\s*=\s*\\$manualTriggerLabel/',
            $this->notificationSource
        );
    }

    public function testHasGetMessageTypeIconMethod(): void
    {
        $this->assertTrue($this->reflection->hasMethod('getMessageTypeIcon'));
        $this->assertTrue($this->reflection->getMethod('getMessageTypeIcon')->isPublic());
    }

    public function testGetMessageTypeIconReturnsString(): void
    {
        // The icon is always a string; an unknown message type falls back to
        // a generic icon rather than returning null.
        $this->assertSame(
            'string',
            (string) $this->reflection->getMethod('getMessageTypeIcon')->getReturnType()
        );
    }

    public function testResolveConditionFieldLayoutsIsScopedToEntries(): void
    {
        // v1 only attaches field layouts for entry events. Asset / user
        // event types fall back to the condition's default getFieldLayouts().
        // Now keyed off the per-type override so the scope check applies to
        // whichever tab is being rendered, not just the saved event type.
        $this->assertMatchesRegularExpression(
            "/_resolveConditionFieldLayouts[\s\S]*?'entries'\s*!==\s*\\\$forEventType/",
            $this->notificationSource
        );
    }

    public function testResolveConditionFieldLayoutsAcceptsOptionalForEventTypeParam(): void
    {
        // Same per-type override pattern as getEventCondition(): an explicit
        // event-type override for builder rendering, falling back to the
        // saved event type for evaluation-time callers.
        $params = $this->reflection->getMethod('_resolveConditionFieldLayouts')->getParameters();
        $this->assertCount(1, $params);
        $this->assertSame('forEventType', $params[0]->getName());
        $this->assertTrue($params[0]->isOptional());
        $this->assertNull($params[0]->getDefaultValue());

        $type = $params[0]->getType();
        $this->assertInstanceOf(ReflectionNamedType::class, $type);
        $this->assertSame('string', $type->getName());
        $this->assertTrue($type->allowsNull());
    }

    public function testResolveConditionFieldLayoutsBranchesOnCraftVersion(): void
    {
        // Craft 5 uses getEntries(); Craft 4 uses getSections(). The Compat
        // helper toggles the call site so the helper compiles on both.
        $this->assertMatchesRegularExpression(
            '/Compat::isCraft5\(\)[\s\S]*?getEntries\(\)[\s\S]*?getSections\(\)/',
            $this->notificationSource
        );
    }
}
