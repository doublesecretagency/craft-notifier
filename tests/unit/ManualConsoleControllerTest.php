<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\console\Controller;
use doublesecretagency\notifier\console\controllers\ManualController;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the manual-trigger console controller.
 *
 * ManualController exposes `notifier/manual/send`, the CLI surface for
 * firing a manually-triggered Notification against a specific element.
 * Craft auto-resolves the console controller namespace, so there is no
 * boot-time registration to verify; the action surface is checked here.
 */
class ManualConsoleControllerTest extends TestCase
{
    private string $controllerSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/console/controllers/ManualController.php';
        $this->assertTrue(file_exists($path), "ManualController.php should exist at: $path");
        $this->controllerSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(ManualController::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsConsoleController(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Controller::class));
    }

    // ========================================================================= //
    // Action surface
    // ========================================================================= //

    public function testHasSendAction(): void
    {
        $this->assertTrue($this->reflection->hasMethod('actionSend'));
        $this->assertTrue($this->reflection->getMethod('actionSend')->isPublic());
    }

    public function testSendActionSignature(): void
    {
        // actionSend(int $notificationId, int $elementId): int
        $method = $this->reflection->getMethod('actionSend');
        $params = $method->getParameters();
        $this->assertCount(2, $params);
        $this->assertSame('notificationId', $params[0]->getName());
        $this->assertSame('elementId', $params[1]->getName());
        $this->assertSame('int', (string) $params[0]->getType());
        $this->assertSame('int', (string) $params[1]->getType());
        $this->assertSame('int', (string) $method->getReturnType());
    }

    // ========================================================================= //
    // Behavior (source-level)
    // ========================================================================= //

    public function testSendDispatchesViaMessagesSend(): void
    {
        // Don't reimplement the dispatch path; defer to Messages::send().
        $this->assertStringContainsString('messages->send(', $this->controllerSource);
    }

    public function testSendGuardsOnManuallyTriggeredEvent(): void
    {
        // A Notification wired to a real Craft event must not be fireable
        // from the CLI manual-send command.
        $this->assertStringContainsString("'manually-triggered'", $this->controllerSource);
    }

    public function testSendRevalidatesMembership(): void
    {
        // The CLI must re-check that the Notification applies to the
        // element before dispatching.
        $this->assertStringContainsString('getManualNotifications(', $this->controllerSource);
    }

    public function testSendCapturesEnvelopeCountFromMessagesSend(): void
    {
        // The return value of Messages::send() must drive the success / failure
        // exit, not get discarded.
        $this->assertMatchesRegularExpression(
            '/\$count\s*=\s*[^;]*messages->send\(/',
            $this->controllerSource
        );
    }

    public function testSendReportsFailureWhenZeroEnvelopesSent(): void
    {
        // A zero-envelope outcome writes a stderr warning and returns a non-OK
        // exit code so scripts and humans both notice the silent skip.
        $this->assertMatchesRegularExpression(
            '/if \(0 === \$count\)[\s\S]*?stderr\([\s\S]*?ExitCode::UNSPECIFIED_ERROR/',
            $this->controllerSource
        );
    }

    public function testSendFailureMessagePointsAtTheNotificationLog(): void
    {
        // The failure text names the Notification Log so the operator knows
        // where to dig.
        $this->assertStringContainsString(
            'Notification was not sent. Check the Notification Log for details.',
            $this->controllerSource
        );
    }
}
