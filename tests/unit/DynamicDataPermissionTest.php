<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\elements\Notification;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the Dynamic Data permission gate.
 *
 * Editing a Dynamic Data notification's snippet requires the
 * `notifier-editDynamicData` permission. The validator is the server-side
 * gate; the CP template disables the field. Both halves plus the permission
 * registration are pinned here so a string mismatch can't silently open the gate.
 */
class DynamicDataPermissionTest extends TestCase
{
    private ReflectionClass $reflection;
    private string $notificationSource;
    private string $pluginSource;

    protected function setUp(): void
    {
        $root = dirname(__DIR__, 2);
        $notificationPath = $root . '/src/elements/Notification.php';
        $pluginPath = $root . '/src/NotifierPlugin.php';
        $this->assertTrue(file_exists($notificationPath), "Notification.php should exist at: $notificationPath");
        $this->assertTrue(file_exists($pluginPath), "NotifierPlugin.php should exist at: $pluginPath");
        $this->notificationSource = file_get_contents($notificationPath);
        $this->pluginSource = file_get_contents($pluginPath);
        $this->reflection = new ReflectionClass(Notification::class);
    }

    public function testValidatorMethodExists(): void
    {
        $this->assertTrue($this->reflection->hasMethod('validateDynamicDataPermission'));
        $this->assertTrue($this->reflection->getMethod('validateDynamicDataPermission')->isPublic());
    }

    public function testValidatorIsWiredIntoDefineRules(): void
    {
        // The rule must be registered or the gate never runs.
        $this->assertMatchesRegularExpression(
            "/\['eventConfig', 'validateDynamicDataPermission'\]/",
            $this->notificationSource
        );
    }

    public function testValidatorChecksTheCorrectPermissionKey(): void
    {
        // The exact permission key must match the registration, or the gate
        // checks a permission that doesn't exist (and always fails or passes).
        $this->assertMatchesRegularExpression(
            "/validateDynamicDataPermission[\s\S]*?'notifier-editDynamicData'/",
            $this->notificationSource
        );
    }

    public function testValidatorGatesOnDynamicDataEventType(): void
    {
        // The gate only applies to dynamic-data notifications.
        $this->assertMatchesRegularExpression(
            "/validateDynamicDataPermission[\s\S]*?'dynamic-data' !== \\\$this->eventType/",
            $this->notificationSource
        );
    }

    public function testPermissionIsRegistered(): void
    {
        // The permission must be registered under the Notifier heading.
        $this->assertStringContainsString("'notifier-editDynamicData' => [", $this->pluginSource);
    }
}
