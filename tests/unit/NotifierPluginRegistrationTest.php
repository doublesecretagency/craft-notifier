<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Plugin;
use doublesecretagency\notifier\NotifierPlugin;
use doublesecretagency\notifier\services\Events;
use doublesecretagency\notifier\services\Messages;
use doublesecretagency\notifier\services\Recipients;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the plugin's boot-time registrations.
 *
 * NotifierPlugin::init() is the wiring switchboard for the entire
 * plugin: services, element types, permissions, CP routes, utilities,
 * and the Twig extension. These tests verify the wiring is intact at
 * the source level so silent re-shuffling of registrations doesn't ship
 * a half-broken plugin.
 */
class NotifierPluginRegistrationTest extends TestCase
{
    private string $pluginSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/NotifierPlugin.php';
        $this->assertTrue(file_exists($path), "NotifierPlugin.php should exist at: $path");
        $this->pluginSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(NotifierPlugin::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsPlugin(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Plugin::class));
    }

    public function testHasInitMethod(): void
    {
        $this->assertTrue($this->reflection->hasMethod('init'));
        $this->assertTrue($this->reflection->getMethod('init')->isPublic());
    }

    public function testHasCpSettings(): void
    {
        // Settings page registers under Settings → Plugins
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertTrue($defaults['hasCpSettings']);
    }

    public function testHasCpSection(): void
    {
        // Top-level CP nav item ("Notifications")
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertTrue($defaults['hasCpSection']);
    }

    public function testSchemaVersionIsSet(): void
    {
        // Schema version drives migrations; it must be a non-empty string.
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertNotEmpty($defaults['schemaVersion']);
    }

    // ========================================================================= //
    // Component registration
    // ========================================================================= //

    public function testRegistersThreeServices(): void
    {
        // Plugin services that the rest of the plugin reads via $plugin->events,
        // ->messages, ->recipients. All three must be wired in setComponents().
        $this->assertMatchesRegularExpression(
            "/'events'\s*=>\s*Events::class/",
            $this->pluginSource
        );
        $this->assertMatchesRegularExpression(
            "/'messages'\s*=>\s*Messages::class/",
            $this->pluginSource
        );
        $this->assertMatchesRegularExpression(
            "/'recipients'\s*=>\s*Recipients::class/",
            $this->pluginSource
        );
    }

    public function testServiceClassesAreImported(): void
    {
        // Make sure the use statements actually point at the right classes.
        $this->assertStringContainsString('use ' . Events::class, $this->pluginSource);
        $this->assertStringContainsString('use ' . Messages::class, $this->pluginSource);
        $this->assertStringContainsString('use ' . Recipients::class, $this->pluginSource);
    }

    public function testRegistersFieldLayoutsComponent(): void
    {
        // The FieldLayouts service backs the notification field layout designer.
        $this->assertMatchesRegularExpression(
            "/'fieldLayouts'\s*=>\s*FieldLayouts::class/",
            $this->pluginSource
        );
    }

    public function testRegistersProjectConfigHandlersForFieldLayout(): void
    {
        // The layout lives in project config, so the add/update/remove handlers
        // must be registered so console applies rebuild it across environments.
        $this->assertMatchesRegularExpression(
            '/onAdd\(FieldLayouts::PATH[\s\S]*?onUpdate\(FieldLayouts::PATH[\s\S]*?onRemove\(FieldLayouts::PATH/',
            $this->pluginSource
        );
        // The handler registration must run unconditionally (not CP-gated) so
        // console project-config applies rebuild the layout.
        $this->assertMatchesRegularExpression(
            '/_registerProjectConfigEventHandlers\(\)[\s\S]*?getIsCpRequest\(\)/',
            $this->pluginSource
        );
    }

    public function testRegistersFieldsSettingsRoute(): void
    {
        // The Notification Fields designer page has its own GET route.
        $this->assertStringContainsString(
            "'notifier/settings-fields/fields'",
            $this->pluginSource
        );
    }

    // ========================================================================= //
    // Permission tree
    // ========================================================================= //

    public function testTopLevelViewPermissionExists(): void
    {
        // notifier-viewNotifications is the root permission; everything else
        // nests under it.
        $this->assertStringContainsString(
            "'notifier-viewNotifications'",
            $this->pluginSource
        );
    }

    public function testSavePermissionIsNestedUnderView(): void
    {
        // Save and Delete must sit beneath View so that revoking View also
        // revokes the children.
        $this->assertMatchesRegularExpression(
            "/notifier-viewNotifications.*?nested.*?notifier-saveNotifications/s",
            $this->pluginSource
        );
    }

    public function testDeletePermissionIsNestedUnderView(): void
    {
        $this->assertMatchesRegularExpression(
            "/notifier-viewNotifications.*?nested.*?notifier-deleteNotifications/s",
            $this->pluginSource
        );
    }

    public function testTestPermissionIsNestedUnderView(): void
    {
        // The dedicated permission for the "Send a test message" button is a
        // sibling of save and delete under viewNotifications.
        $this->assertMatchesRegularExpression(
            "/notifier-viewNotifications.*?nested.*?notifier-testNotifications/s",
            $this->pluginSource
        );
    }

    public function testTestPermissionSitsBetweenSaveAndDelete(): void
    {
        // Curated ordering: save -> test -> delete
        $this->assertMatchesRegularExpression(
            "/notifier-saveNotifications[\s\S]*?notifier-testNotifications[\s\S]*?notifier-deleteNotifications/",
            $this->pluginSource
        );
    }

    public function testDynamicRecipientsPermissionIsNestedUnderSave(): void
    {
        // Authoring Twig snippets is a privileged action, it should require
        // the save permission AND its own dedicated nested permission.
        $this->assertMatchesRegularExpression(
            "/notifier-saveNotifications.*?nested.*?notifier-editDynamicRecipients/s",
            $this->pluginSource
        );
    }

    public function testWiringTabPermissionsAreNestedUnderSave(): void
    {
        // The three wiring-tab permissions gate editing the Event / Message /
        // Recipients tabs; they nest under saveNotifications so the Meta tab stays
        // always-editable for anyone who can save.
        foreach (['notifier-editEventTab', 'notifier-editMessageTab', 'notifier-editRecipientsTab'] as $perm) {
            $this->assertMatchesRegularExpression(
                "/notifier-saveNotifications.*?nested.*?{$perm}/s",
                $this->pluginSource
            );
        }
    }

    public function testDynamicDataRehomedUnderEventTab(): void
    {
        // The Dynamic Data sub-permission re-homes under the Event tab permission.
        $this->assertMatchesRegularExpression(
            "/notifier-editEventTab.*?nested.*?notifier-editDynamicData/s",
            $this->pluginSource
        );
    }

    public function testDynamicRecipientsRehomedUnderRecipientsTab(): void
    {
        // The Dynamic Recipients sub-permission re-homes under the Recipients tab permission.
        $this->assertMatchesRegularExpression(
            "/notifier-editRecipientsTab.*?nested.*?notifier-editDynamicRecipients/s",
            $this->pluginSource
        );
    }

    /**
     * @dataProvider dynamicPermissionProvider
     */
    public function testDynamicPermissionsCarryAWarning(string $permission): void
    {
        // Both Dynamic types run arbitrary Twig at send time, so each carries Craft's
        // native 'warning' key. It renders an alert icon in the CP permissions tree
        // (supported in both Craft 4 and Craft 5 via _includes/permissions.twig).
        $this->assertMatchesRegularExpression(
            "/{$permission}' => \[\s*'label' =>[^\n]*\n\s*'warning' => \\\$twigWarning,/",
            $this->pluginSource
        );
    }

    public function testDynamicPermissionWarningTextIsTranslated(): void
    {
        // Both Dynamic permissions share one translation key, hoisted to a local so a
        // reword can't fork the two literals apart.
        $this->assertStringContainsString(
            "\$twigWarning = Craft::t('notifier', 'Runs custom Twig code when a message is sent. Only grant this to highly trusted users!');",
            $this->pluginSource
        );
    }

    public static function dynamicPermissionProvider(): array
    {
        return [
            'dynamic data' => ['notifier-editDynamicData'],
            'dynamic recipients' => ['notifier-editDynamicRecipients'],
        ];
    }

    /**
     * @dataProvider viewPermissionInfoProvider
     */
    public function testViewPermissionsCarryAnInfo(string $permission, string $info): void
    {
        // Each root View permission explains which CP surface it unlocks, via Craft's
        // native 'info' key (supported in both Craft 4 and Craft 5). The copy uses double
        // quotes rather than markdown, because permissions.twig prints {{ props.info }}
        // through Twig's autoescaping with no markdown filter.
        $this->assertMatchesRegularExpression(
            "/{$permission}' => \[\s*'label' =>[^\n]*\n\s*'info' => Craft::t\('notifier', '" . preg_quote($info, '/') . "'\),/",
            $this->pluginSource
        );
    }

    public static function viewPermissionInfoProvider(): array
    {
        return [
            'view notifications' => [
                'notifier-viewNotifications',
                'Adds "Notifications" to the control panel navigation.',
            ],
            'view notification log' => [
                'notifier-viewNotificationLog',
                'Adds "Notification Log" to the control panel Utilities.',
            ],
        ];
    }

    public function testViewNotificationLogIsRootPermission(): void
    {
        // The Log subtree is intentionally a sibling of the Notifications
        // subtree, not a child, auditors can be granted log access without
        // also gaining the ability to view notification configuration.
        $this->assertStringContainsString(
            "'notifier-viewNotificationLog'",
            $this->pluginSource
        );
    }

    public function testDeleteNotificationLogIsNestedUnderViewLog(): void
    {
        // Deleting log envelopes requires viewing them.
        $this->assertMatchesRegularExpression(
            "/notifier-viewNotificationLog.*?nested.*?notifier-deleteNotificationLog/s",
            $this->pluginSource
        );
    }

    public function testLogPermissionsAreSiblingsOfNotificationsSubtree(): void
    {
        // Log permissions sit at the top level of the heading's permissions
        // array, same indentation depth as notifier-viewNotifications.
        // Whatever indentation viewNotifications uses, viewNotificationLog
        // must use exactly the same prefix.
        $this->assertMatchesRegularExpression(
            '/(\n {16,40})\'notifier-viewNotifications\' =>[\s\S]*?\1\'notifier-viewNotificationLog\' =>/',
            $this->pluginSource,
            'notifier-viewNotificationLog must appear at the same indent depth as notifier-viewNotifications, not nested under it'
        );
    }

    // ========================================================================= //
    // CP route registration
    // ========================================================================= //

    public function testIndexRouteIsRegistered(): void
    {
        // /admin/notifications → the index template
        $this->assertStringContainsString(
            "\$event->rules['notifications']",
            $this->pluginSource
        );
    }

    public function testNewNotificationRouteIsRegistered(): void
    {
        // /admin/notifications/new → controller create action
        $this->assertStringContainsString(
            "\$event->rules['notifications/new']",
            $this->pluginSource
        );
        $this->assertStringContainsString(
            "'notifier/notifications/create'",
            $this->pluginSource
        );
    }

    public function testEditNotificationRouteIsRegistered(): void
    {
        // /admin/notifications/<id> → controller edit action
        $this->assertMatchesRegularExpression(
            '/notifications\/<notificationId:\\\\d\+>/',
            $this->pluginSource
        );
        $this->assertStringContainsString(
            "'notifier/notifications/edit'",
            $this->pluginSource
        );
    }

    // ========================================================================= //
    // Element type registration
    // ========================================================================= //

    public function testRegistersNotificationElementType(): void
    {
        $this->assertStringContainsString(
            'EVENT_REGISTER_ELEMENT_TYPES',
            $this->pluginSource
        );
        $this->assertStringContainsString('Notification::class', $this->pluginSource);
    }

    // ========================================================================= //
    // Utility registration
    // ========================================================================= //

    public function testRegistersNotificationLogUtility(): void
    {
        // The NotificationLog utility surfaces the audit trail in the CP.
        // Event name is resolved via Compat::utilitiesEventName() to support
        // both Craft 5's EVENT_REGISTER_UTILITIES and Craft 4's
        // EVENT_REGISTER_UTILITY_TYPES from a single codebase.
        $this->assertStringContainsString(
            'Compat::utilitiesEventName()',
            $this->pluginSource
        );
        $this->assertStringContainsString('NotificationLog::class', $this->pluginSource);
    }

    public function testNotificationLogUtilityIsGatedByViewLogPermission(): void
    {
        // Within _registerUtilities(), the registration must be guarded by a
        // notifier-viewNotificationLog permission check. Without this, any
        // user with utilities access could see the log through Craft's
        // built-in `utility:notification-log` permission.
        $this->assertMatchesRegularExpression(
            '/_registerUtilities[\s\S]*?notifier-viewNotificationLog[\s\S]*?NotificationLog::class/',
            $this->pluginSource
        );
    }

    public function testNotificationLogUtilityHiddenWhenLoggingDisabled(): void
    {
        // _registerUtilities() must short-circuit before the permission check
        // when loggingEnabled is false. Without this, disabling logging would
        // leave the utility visible (and empty) for anyone with the view
        // permission, contradicting the public docs which promise the
        // utility "will be unavailable" when logging is disabled.
        $this->assertMatchesRegularExpression(
            '/_registerUtilities[\s\S]*?loggingEnabled[\s\S]*?notifier-viewNotificationLog[\s\S]*?NotificationLog::class/',
            $this->pluginSource
        );
    }

    // ========================================================================= //
    // Twig extension
    // ========================================================================= //

    public function testRegistersTwigExtension(): void
    {
        $this->assertStringContainsString(
            'registerTwigExtension(new Extension())',
            $this->pluginSource
        );
    }

    // ========================================================================= //
    // Notification-event bootstrap
    // ========================================================================= //

    public function testInvokesRegisterNotificationEvents(): void
    {
        // The init() method must actually call registerNotificationEvents()
        // on the events service or no Yii listeners will ever attach.
        $this->assertStringContainsString(
            'events->registerNotificationEvents()',
            $this->pluginSource
        );
    }

    // ========================================================================= //
    // CP-only guards
    // ========================================================================= //

    public function testCpOnlyRegistrationsAreGated(): void
    {
        // Routes / utilities / table attributes are CP-only, they should be
        // wrapped in a getIsCpRequest() check so console / queue requests
        // don't pay the registration cost.
        $this->assertMatchesRegularExpression(
            '/getIsCpRequest\(\)[\s\S]*?_registerCpRoutes/',
            $this->pluginSource
        );
    }

    // ========================================================================= //
    // Element-condition rule registration
    // ========================================================================= //

    public function testHasPrivateRegisterConditionRulesMethod(): void
    {
        // The condition-rules registrar must exist and be private. Only init()
        // invokes it; nothing else should reach for it.
        $this->assertTrue($this->reflection->hasMethod('_registerConditionRules'));
        $this->assertTrue($this->reflection->getMethod('_registerConditionRules')->isPrivate());
    }

    public function testInitInvokesRegisterConditionRulesAfterRegisterNotificationEvents(): void
    {
        // The order matters loosely (services must be set first), but the
        // explicit assertion is that registerConditionRules() runs as part of
        // init(). Asserting "after registerNotificationEvents()" pins it to
        // the established slot so future refactors do not silently drop it.
        $this->assertMatchesRegularExpression(
            '/events->registerNotificationEvents\(\)[\s\S]*?_registerConditionRules\(\)/',
            $this->pluginSource
        );
    }

    public function testRegisterConditionRulesScopesToNotifierEntryCondition(): void
    {
        // The handler body must listen on NotifierEntryCondition (not Craft's
        // base EntryCondition), so the swap only fires inside Notifier's UI
        // and never leaks the has_changed operator into Craft's CP entries-index
        // filter or any other EntryCondition consumer. The event name is resolved
        // through Compat::conditionRulesEventName() for Craft 4/5 parity (Craft 4
        // calls it EVENT_REGISTER_CONDITION_RULE_TYPES, Craft 5 EVENT_REGISTER_CONDITION_RULES).
        $this->assertMatchesRegularExpression(
            '/_registerConditionRules[\s\S]*?NotifierEntryCondition::class[\s\S]*?Compat::conditionRulesEventName\(\)/',
            $this->pluginSource
        );
    }

    /**
     * @return array<string, array{0: string, 1: string}>
     */
    public static function fieldRuleSwapProvider(): array
    {
        // Every Craft built-in per-field + native attribute rule we replace
        // with a Notifier subclass; data-provided so a forgotten swap fails
        // its own test.
        return [
            // Per-field rules
            'Text'         => ['TextFieldConditionRule',        'NotifierTextFieldConditionRule'],
            'Lightswitch'  => ['LightswitchFieldConditionRule', 'NotifierLightswitchFieldConditionRule'],
            'Number'       => ['NumberFieldConditionRule',      'NotifierNumberFieldConditionRule'],
            'Money'        => ['MoneyFieldConditionRule',       'NotifierMoneyFieldConditionRule'],
            'Date'         => ['DateFieldConditionRule',        'NotifierDateFieldConditionRule'],
            'Options'      => ['OptionsFieldConditionRule',     'NotifierOptionsFieldConditionRule'],
            'Country'      => ['CountryFieldConditionRule',     'NotifierCountryFieldConditionRule'],
            'Link'         => ['LinkFieldConditionRule',        'NotifierLinkFieldConditionRule'],
            'Relational'   => ['RelationalFieldConditionRule',  'NotifierRelationalFieldConditionRule'],
            'Empty'        => ['EmptyFieldConditionRule',       'NotifierEmptyFieldConditionRule'],
            'Generated'    => ['GeneratedFieldConditionRule',   'NotifierGeneratedFieldConditionRule'],
            // Native attribute rules
            'Title'        => ['TitleConditionRule',            'NotifierTitleConditionRule'],
            'Slug'         => ['SlugConditionRule',             'NotifierSlugConditionRule'],
            'Uri'          => ['UriConditionRule',              'NotifierUriConditionRule'],
            'Status'       => ['StatusConditionRule',           'NotifierStatusConditionRule'],
            'Level'        => ['LevelConditionRule',            'NotifierLevelConditionRule'],
            'Language'     => ['LanguageConditionRule',         'NotifierLanguageConditionRule'],
            'PostDate'     => ['PostDateConditionRule',         'NotifierPostDateConditionRule'],
            'ExpiryDate'   => ['ExpiryDateConditionRule',       'NotifierExpiryDateConditionRule'],
            'Section'      => ['SectionConditionRule',          'NotifierSectionConditionRule'],
            'Type'         => ['TypeConditionRule',             'NotifierTypeConditionRule'],
        ];
    }

    /**
     * @dataProvider fieldRuleSwapProvider
     */
    public function testRegisterConditionRulesSwapsCraftRuleForNotifierSubclass(string $craftClass, string $notifierClass): void
    {
        // The swap map must pair the Craft source class with its Notifier
        // replacement. Without both, the field rule passes through unchanged and
        // "has changed" never appears. Accept either the array-literal form
        // (`Craft::class => Notifier::class`) or the assignment form used for the
        // Craft-5-only rules appended inside the Compat::isCraft5() guard
        // (`$swaps[Craft::class] = Notifier::class`).
        $this->assertMatchesRegularExpression(
            '/' . preg_quote($craftClass, '/') . '::class\s*(?:=>|\]\s*=)\s*' . preg_quote($notifierClass, '/') . '::class/',
            $this->pluginSource
        );
    }

    public function testImportsConditionRuleClasses(): void
    {
        $this->assertStringContainsString(
            'use doublesecretagency\\notifier\\conditions\\NotifierEntryCondition',
            $this->pluginSource
        );
        // Compat resolves the event name and rules-property name for Craft 4/5
        // parity, so it must be imported. (The old craft\base\conditions\BaseCondition
        // import was dropped when the literal EVENT_REGISTER_CONDITION_RULES constant
        // gave way to Compat::conditionRulesEventName().)
        $this->assertStringContainsString(
            'use doublesecretagency\\notifier\\helpers\\Compat',
            $this->pluginSource
        );
        // All 11 Notifier per-field subclasses must be imported, since the
        // swap map references each by short name
        $this->assertStringContainsString(
            'use doublesecretagency\\notifier\\conditions\\fields\\NotifierTextFieldConditionRule',
            $this->pluginSource
        );
        $this->assertStringContainsString(
            'use doublesecretagency\\notifier\\conditions\\fields\\NotifierDateFieldConditionRule',
            $this->pluginSource
        );
    }

    // ========================================================================= //
    // Manual-trigger registrations
    // ========================================================================= //

    public function testSendManualPermissionIsNestedUnderView(): void
    {
        // The manual-send permission is a sibling of test / delete, nested
        // under viewNotifications.
        $this->assertMatchesRegularExpression(
            "/notifier-viewNotifications.*?nested.*?notifier-sendManualNotifications/s",
            $this->pluginSource
        );
    }

    public function testHasPrivateRegisterElementActionsMethod(): void
    {
        // The bulk-action registrar must exist and be private.
        $this->assertTrue($this->reflection->hasMethod('_registerElementActions'));
        $this->assertTrue($this->reflection->getMethod('_registerElementActions')->isPrivate());
    }

    public function testHasPrivateRegisterActionMenuItemsMethod(): void
    {
        // The edit-screen action-menu registrar must exist and be private.
        $this->assertTrue($this->reflection->hasMethod('_registerActionMenuItems'));
        $this->assertTrue($this->reflection->getMethod('_registerActionMenuItems')->isPrivate());
    }

    public function testRegistersSendNotificationBulkAction(): void
    {
        // The "Send Notification" bulk action attaches via EVENT_REGISTER_ACTIONS.
        $this->assertMatchesRegularExpression(
            '/_registerElementActions[\s\S]*?EVENT_REGISTER_ACTIONS[\s\S]*?SendNotification::class/',
            $this->pluginSource
        );
    }

    public function testActionMenuRegistrationIsCraft5Only(): void
    {
        // The disclosure action menu does not exist in Craft 4, so its
        // registration must be guarded behind Compat::isCraft5().
        $this->assertMatchesRegularExpression(
            '/Compat::isCraft5\(\)[\s\S]*?_registerActionMenuItems/',
            $this->pluginSource
        );
        $this->assertStringContainsString('EVENT_DEFINE_ACTION_MENU_ITEMS', $this->pluginSource);
    }

    public function testActionMenuItemUsesManualTriggerLabel(): void
    {
        // Each edit-screen menu item is labeled by the notification's manual
        // trigger label, so multiple manual triggers can be told apart.
        $this->assertStringContainsString('getManualTriggerLabel()', $this->pluginSource);
    }

    public function testActionMenuItemHasMessageTypeIcon(): void
    {
        // Each edit-screen menu item carries an icon derived from the
        // notification's message type.
        $this->assertStringContainsString('getMessageTypeIcon()', $this->pluginSource);
    }

    public function testHasPrivateRegisterAdditionalButtonsMethod(): void
    {
        // The Craft 4 edit-screen button registrar must exist and be private.
        $this->assertTrue($this->reflection->hasMethod('_registerAdditionalButtons'));
        $this->assertTrue($this->reflection->getMethod('_registerAdditionalButtons')->isPrivate());
    }

    public function testAdditionalButtonsRegistrationIsCraft4Only(): void
    {
        // Craft 4 has no disclosure action menu but does fire
        // EVENT_DEFINE_ADDITIONAL_BUTTONS, so the button fallback registers in
        // the else branch of the Compat::isCraft5() guard.
        $this->assertMatchesRegularExpression(
            '/Compat::isCraft5\(\)[\s\S]*?else[\s\S]*?_registerAdditionalButtons/',
            $this->pluginSource
        );
        $this->assertStringContainsString('EVENT_DEFINE_ADDITIONAL_BUTTONS', $this->pluginSource);
    }

    public function testAdditionalButtonsReuseManualSendPlumbing(): void
    {
        // The Craft 4 button reuses the same manual-send plumbing as the Craft 5
        // menu item: the applicable-notifications lookup and the send-manual action.
        $this->assertMatchesRegularExpression(
            '/private function _registerAdditionalButtons\(\)[\s\S]*?getManualNotifications[\s\S]*?notifier\/notifications\/send-manual/',
            $this->pluginSource
        );
    }

}
