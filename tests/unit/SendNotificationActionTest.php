<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\ElementAction;
use doublesecretagency\notifier\elements\actions\SendNotification;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the SendNotification element action.
 *
 * SendNotification is the index bulk action behind the manual-trigger
 * feature. It registers once per supported element type, renders a
 * notification picker, and fires the chosen Notification for every
 * selected element via Messages::send().
 */
class SendNotificationActionTest extends TestCase
{
    private string $actionSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/elements/actions/SendNotification.php';
        $this->assertTrue(file_exists($path), "SendNotification.php should exist at: $path");
        $this->actionSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(SendNotification::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsElementAction(): void
    {
        // The bulk action must extend Craft's ElementAction base so the
        // element index can register and perform it.
        $this->assertTrue($this->reflection->isSubclassOf(ElementAction::class));
    }

    public function testDeclaresNotificationIdProperty(): void
    {
        // notificationId carries the picker selection (set via the
        // formsubmit data-param) through to performAction().
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertArrayHasKey('notificationId', $defaults);
        $this->assertNull($defaults['notificationId']);
    }

    public function testDeclaresNotifierEventTypeProperty(): void
    {
        // notifierEventType is seeded by the registration handler so the
        // trigger picker can list the right Notifications.
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertArrayHasKey('notifierEventType', $defaults);
        $this->assertNull($defaults['notifierEventType']);
    }

    // ========================================================================= //
    // Public surface
    // ========================================================================= //

    public function testHasTriggerLabel(): void
    {
        $this->assertTrue($this->reflection->hasMethod('getTriggerLabel'));
        $this->assertTrue($this->reflection->getMethod('getTriggerLabel')->isPublic());
    }

    public function testHasTriggerHtml(): void
    {
        // The trigger HTML renders the notification picker menu.
        $this->assertTrue($this->reflection->hasMethod('getTriggerHtml'));
        $this->assertTrue($this->reflection->getMethod('getTriggerHtml')->isPublic());
    }

    public function testPerformActionSignature(): void
    {
        // performAction(ElementQueryInterface $query): bool
        $this->assertTrue($this->reflection->hasMethod('performAction'));
        $method = $this->reflection->getMethod('performAction');
        $this->assertTrue($method->isPublic());
        $params = $method->getParameters();
        $this->assertCount(1, $params);
        $this->assertSame('query', $params[0]->getName());
    }

    // ========================================================================= //
    // Behavior (source-level)
    // ========================================================================= //

    public function testPerformActionDispatchesViaMessagesSend(): void
    {
        // Don't reimplement the dispatch path; defer to Messages::send().
        $this->assertStringContainsString('messages->send(', $this->actionSource);
    }

    public function testOnlyFiresManuallyTriggeredNotifications(): void
    {
        // performAction and the picker query both gate on the
        // `manually-triggered` event value.
        $this->assertStringContainsString("'manually-triggered'", $this->actionSource);
    }

    public function testPerformActionRechecksPermission(): void
    {
        // Defense in depth: a crafted perform-action POST must still hit
        // the notifier-sendManualNotifications permission gate.
        $this->assertStringContainsString("'notifier-sendManualNotifications'", $this->actionSource);
    }

    public function testTriggerOffersConfirmation(): void
    {
        // Each picker row carries a data-confirm so a click can't dispatch
        // a real notification by accident.
        $this->assertStringContainsString('data-confirm=', $this->actionSource);
    }

    public function testPickerRowsUseManualTriggerLabel(): void
    {
        // Each picker row shows the notification's configured manual trigger
        // label, so multiple manual triggers can be told apart.
        $this->assertStringContainsString('getManualTriggerLabel()', $this->actionSource);
    }

    public function testSingleNotificationRendersPlainButton(): void
    {
        // A lone applicable notification fires from a direct button, not a
        // one-item dropdown menu.
        $this->assertStringContainsString('1 === count($notifications)', $this->actionSource);
    }

    // ========================================================================= //
    // Zero-envelope feedback
    // ========================================================================= //

    public function testPerformActionAccumulatesEnvelopeCount(): void
    {
        // Each Messages::send() returns the envelope count; the action sums
        // them so the success/failure flash reflects what actually went out.
        $this->assertMatchesRegularExpression(
            '/\$totalSent\s*\+=\s*\$messages->send\(/',
            $this->actionSource
        );
    }

    public function testPerformActionReturnsFalseWhenZeroEnvelopesSent(): void
    {
        // A zero-envelope outcome must surface as a failure flash so the
        // operator notices instead of trusting a misleading "sent" message.
        $this->assertMatchesRegularExpression(
            '/if \(0 === \$totalSent\)[\s\S]*?return false;/',
            $this->actionSource
        );
    }

    public function testZeroEnvelopeFlashPointsAtTheNotificationLog(): void
    {
        // The failure flash names the Notification Log so the operator knows
        // where to dig for the actual skip reason.
        $this->assertStringContainsString(
            'Notification was not sent. Check the Notification Log for details.',
            $this->actionSource
        );
    }
}
