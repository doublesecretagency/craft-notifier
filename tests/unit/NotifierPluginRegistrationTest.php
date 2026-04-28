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

    public function testDynamicRecipientsPermissionIsNestedUnderSave(): void
    {
        // Authoring Twig snippets is a privileged action — it should require
        // the save permission AND its own dedicated nested permission.
        $this->assertMatchesRegularExpression(
            "/notifier-saveNotifications.*?nested.*?notifier-editDynamicRecipients/s",
            $this->pluginSource
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
        $this->assertStringContainsString(
            'EVENT_REGISTER_UTILITIES',
            $this->pluginSource
        );
        $this->assertStringContainsString('NotificationLog::class', $this->pluginSource);
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
        // Routes / utilities / table attributes are CP-only — they should be
        // wrapped in a getIsCpRequest() check so console / queue requests
        // don't pay the registration cost.
        $this->assertMatchesRegularExpression(
            '/getIsCpRequest\(\)[\s\S]*?_registerCpRoutes/',
            $this->pluginSource
        );
    }
}
