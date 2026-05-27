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

    public function testHasTestAction(): void
    {
        // Operator-triggered "Send Test" dispatch
        $this->assertTrue($this->reflection->hasMethod('actionTest'));
        $this->assertTrue($this->reflection->getMethod('actionTest')->isPublic());
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

    public function testEditActionConsultsCanSave(): void
    {
        // Edit action must call canSave() on the elements service so it can
        // decide whether to render write-side affordances.
        $this->assertMatchesRegularExpression(
            '/actionEdit[\s\S]*?canSave\(\$notification\)/',
            $this->controllerSource
        );
    }

    public function testEditActionDoesNotThrowOnViewOnlyAccess(): void
    {
        // The legacy implementation threw ForbiddenHttpException when canSave
        // returned false. The current behavior is read-only rendering. Verify
        // the action does not raise Forbidden purely on the basis of !canSave;
        // the only Forbidden path is when the user can neither view nor save.
        $this->assertMatchesRegularExpression(
            '/actionEdit[\s\S]*?!\$canSave\s*&&\s*!\$elementsService->canView/',
            $this->controllerSource
        );
    }

    public function testEditActionRendersReadOnlyForViewOnlyUsers(): void
    {
        // The action must compute a $readOnly flag and pass it into the
        // content template so the form can render inside a disabled fieldset.
        $this->assertMatchesRegularExpression(
            '/actionEdit[\s\S]*?\$readOnly\s*=\s*!\$canSave/',
            $this->controllerSource
        );
        $this->assertMatchesRegularExpression(
            "/contentTemplate[\s\S]*?'readOnly'\s*=>\s*\\\$readOnly/",
            $this->controllerSource
        );
    }

    public function testEditActionHidesSubmitAndAltActionsWhenReadOnly(): void
    {
        // The submitButtonLabel and the save-and-X alt actions should only
        // attach when the user has save permission.
        $this->assertMatchesRegularExpression(
            '/if\s*\(!\$readOnly\)[\s\S]*?submitButtonLabel/',
            $this->controllerSource
        );
        $this->assertMatchesRegularExpression(
            "/if\s*\(!\\\$readOnly\)[\s\S]*?addAltAction\(Craft::t\('app', 'Save and continue editing'/",
            $this->controllerSource
        );
    }

    public function testEditActionHidesDeleteAltActionWhenUserCannotDelete(): void
    {
        // The destructive Delete {type} alt-action must only attach when the
        // user holds notifier-deleteNotifications.
        $this->assertMatchesRegularExpression(
            "/if\s*\(\\\$canDelete\)[\s\S]*?addAltAction\(Craft::t\('app', 'Delete \{type\}'/",
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

    public function testTestActionRequiresPostRequest(): void
    {
        $this->assertMatchesRegularExpression(
            '/actionTest[\s\S]*?requirePostRequest\(\)/',
            $this->controllerSource
        );
    }

    public function testTestActionRequiresJson(): void
    {
        // Test endpoint is AJAX-only; reject non-JSON POSTs
        $this->assertMatchesRegularExpression(
            '/actionTest[\s\S]*?requireAcceptsJson\(\)/',
            $this->controllerSource
        );
    }

    public function testTestActionRequiresTestPermission(): void
    {
        // Dedicated permission, sibling to save / delete under viewNotifications
        $this->assertMatchesRegularExpression(
            "/actionTest[\s\S]*?requirePermission\('notifier-testNotifications'\)/",
            $this->controllerSource
        );
    }

    public function testTestActionDelegatesToMessagesSendTest(): void
    {
        // Don't reimplement the dispatch path; defer to Messages::sendTest
        $this->assertMatchesRegularExpression(
            '/actionTest[\s\S]*?messages->sendTest\(\$notification\)/',
            $this->controllerSource
        );
    }

    public function testTestActionImportsTestPreflightException(): void
    {
        // The catch clause references the typed exception; the import must be present
        $this->assertStringContainsString(
            'use doublesecretagency\\notifier\\exceptions\\TestPreflightException;',
            $this->controllerSource
        );
    }

    public function testTestActionCatchesTestPreflightException(): void
    {
        // sendTest() may throw when no viable Twig context can be resolved;
        // the controller must surface the message as a JSON failure rather
        // than letting the exception bubble to a 500
        $this->assertMatchesRegularExpression(
            '/actionTest[\s\S]*?try\s*\{[\s\S]*?messages->sendTest[\s\S]*?\}\s*catch\s*\(\s*TestPreflightException\s+\$e\s*\)/',
            $this->controllerSource
        );
    }

    public function testTestActionReturnsExceptionMessageInJson(): void
    {
        // The frontend JS reads response.message; the preflight branch must
        // surface the exception's translated message verbatim
        $this->assertMatchesRegularExpression(
            "/actionTest[\s\S]*?catch[\s\S]*?'message'\s*=>\s*\\\$e->getMessage\(\)/",
            $this->controllerSource
        );
    }

    // ========================================================================= //
    // Manual-send action
    // ========================================================================= //

    public function testHasSendManualAction(): void
    {
        // Operator-triggered manual dispatch from the element edit screen
        $this->assertTrue($this->reflection->hasMethod('actionSendManual'));
        $this->assertTrue($this->reflection->getMethod('actionSendManual')->isPublic());
    }

    public function testSendManualActionRequiresPostRequest(): void
    {
        $this->assertMatchesRegularExpression(
            '/actionSendManual[\s\S]*?requirePostRequest\(\)/',
            $this->controllerSource
        );
    }

    public function testSendManualActionRequiresJson(): void
    {
        // Manual-send endpoint is AJAX-only; reject non-JSON POSTs
        $this->assertMatchesRegularExpression(
            '/actionSendManual[\s\S]*?requireAcceptsJson\(\)/',
            $this->controllerSource
        );
    }

    public function testSendManualActionRequiresSendPermission(): void
    {
        // Dedicated permission, sibling to test / delete under viewNotifications
        $this->assertMatchesRegularExpression(
            "/actionSendManual[\s\S]*?requirePermission\('notifier-sendManualNotifications'\)/",
            $this->controllerSource
        );
    }

    public function testSendManualActionDelegatesToMessagesSend(): void
    {
        // Don't reimplement the dispatch path; defer to Messages::send
        $this->assertMatchesRegularExpression(
            '/actionSendManual[\s\S]*?messages->send\(/',
            $this->controllerSource
        );
    }

    public function testSendManualActionRevalidatesMembership(): void
    {
        // A stale page or crafted POST must not dispatch a Notification the
        // element no longer matches.
        $this->assertMatchesRegularExpression(
            '/actionSendManual[\s\S]*?getManualNotifications\(/',
            $this->controllerSource
        );
    }

    public function testSendManualActionCapturesEnvelopeCountFromMessagesSend(): void
    {
        // The return value of Messages::send() must drive the response, not get
        // discarded behind an unconditional success payload.
        $this->assertMatchesRegularExpression(
            '/actionSendManual[\s\S]*?\$count\s*=\s*[^;]*messages->send\(/',
            $this->controllerSource
        );
    }

    public function testSendManualActionReportsFailureWhenZeroEnvelopesSent(): void
    {
        // A zero-envelope outcome must respond with success:false so the JS
        // surfaces an error toast instead of the misleading "sent" toast.
        $this->assertMatchesRegularExpression(
            "/actionSendManual[\s\S]*?if \(0 === \\\$count\)[\s\S]*?'success' => false/",
            $this->controllerSource
        );
    }

    public function testSendManualActionFailureMessagePointsAtTheNotificationLog(): void
    {
        // The failure text names the Notification Log so the operator knows
        // where to dig.
        $this->assertStringContainsString(
            'Notification was not sent. Check the Notification Log for details.',
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
