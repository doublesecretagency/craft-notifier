<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\web\Controller;
use doublesecretagency\notifier\controllers\NotificationsController;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the NotificationsController.
 *
 * The controller serves the CP CRUD endpoints for Notification elements.
 * Boot-time wiring (CP routes) is checked separately in
 * NotifierPluginRegistrationTest; these tests verify the controller's
 * own action surface and the permission/auth guards each action enforces.
 */
class NotificationsControllerTest extends TestCase
{
    private string $controllerSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/controllers/NotificationsController.php';
        $this->assertTrue(file_exists($path), "NotificationsController.php should exist at: $path");
        $this->controllerSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(NotificationsController::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsCraftWebController(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Controller::class));
    }

    // ========================================================================= //
    // Action surface
    // ========================================================================= //

    public function testHasCreateAction(): void
    {
        $this->assertTrue($this->reflection->hasMethod('actionCreate'));
        $this->assertTrue($this->reflection->getMethod('actionCreate')->isPublic());
    }

    public function testHasEditAction(): void
    {
        $this->assertTrue($this->reflection->hasMethod('actionEdit'));
        $this->assertTrue($this->reflection->getMethod('actionEdit')->isPublic());
    }

    public function testEditActionAcceptsBothNotificationAndId(): void
    {
        // Craft re-binds the URL parameter to a Notification model when
        // available (via $notification), but allows fallback by ID.
        $params = $this->reflection->getMethod('actionEdit')->getParameters();
        $this->assertCount(2, $params);
        $this->assertSame('notification', $params[0]->getName());
        $this->assertSame('notificationId', $params[1]->getName());
    }

    public function testHasDeleteAction(): void
    {
        $this->assertTrue($this->reflection->hasMethod('actionDelete'));
        $this->assertTrue($this->reflection->getMethod('actionDelete')->isPublic());
    }

    // ========================================================================= //
    // Auth / permission guards
    // ========================================================================= //

    public function testCreateActionEnforcesCanSave(): void
    {
        // Same gate as the canSave permission on the element.
        $this->assertMatchesRegularExpression(
            '/actionCreate[\s\S]*?canSave\(\$notification\)/',
            $this->controllerSource
        );
    }

    public function testCreateActionThrowsForbiddenWhenDenied(): void
    {
        $this->assertMatchesRegularExpression(
            '/actionCreate[\s\S]*?ForbiddenHttpException/',
            $this->controllerSource
        );
    }

    public function testEditActionEnforcesCanSave(): void
    {
        $this->assertMatchesRegularExpression(
            '/actionEdit[\s\S]*?canSave\(\$notification\)/',
            $this->controllerSource
        );
    }

    public function testDeleteActionEnforcesCanDelete(): void
    {
        $this->assertMatchesRegularExpression(
            '/actionDelete[\s\S]*?canDelete\(\$notification\)/',
            $this->controllerSource
        );
    }

    public function testDeleteActionRequiresPostRequest(): void
    {
        $this->assertMatchesRegularExpression(
            '/actionDelete[\s\S]*?requirePostRequest\(\)/',
            $this->controllerSource
        );
    }

    // ========================================================================= //
    // Helper methods
    // ========================================================================= //

    public function testHasPrivateNotificationModelHelper(): void
    {
        // Look up notification by ID + 404 if not found.
        $this->assertTrue($this->reflection->hasMethod('_getNotificationModel'));
        $this->assertTrue(
            $this->reflection->getMethod('_getNotificationModel')->isPrivate()
        );
    }

    public function testHasPrivateSlugGenerator(): void
    {
        // Hooks the CP slug auto-generator JS for new notifications.
        $this->assertTrue($this->reflection->hasMethod('_slugGenerator'));
        $this->assertTrue(
            $this->reflection->getMethod('_slugGenerator')->isPrivate()
        );
    }

    // ========================================================================= //
    // Draft scenario for new notifications
    // ========================================================================= //

    public function testCreateActionUsesEssentialsScenario(): void
    {
        // Create flows save the notification as a draft with the
        // ESSENTIALS validation scenario, deferring full validation
        // until the user clicks Save.
        $this->assertStringContainsString(
            'SCENARIO_ESSENTIALS',
            $this->controllerSource
        );
        $this->assertStringContainsString(
            'saveElementAsDraft',
            $this->controllerSource
        );
    }
}
