<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\console\Controller;
use doublesecretagency\notifier\console\controllers\ScheduledController;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the scheduled-run console controller.
 *
 * ScheduledController exposes `notifier/scheduled/run`, the CLI surface a
 * cron job pings to run time-based triggers. Craft auto-resolves the
 * console controller namespace, so there is no boot-time registration to
 * verify; the action surface is checked here.
 */
class ScheduledConsoleControllerTest extends TestCase
{
    private string $controllerSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/console/controllers/ScheduledController.php';
        $this->assertTrue(file_exists($path), "ScheduledController.php should exist at: $path");
        $this->controllerSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(ScheduledController::class);
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

    public function testHasRunAction(): void
    {
        $this->assertTrue($this->reflection->hasMethod('actionRun'));
        $this->assertTrue($this->reflection->getMethod('actionRun')->isPublic());
    }

    public function testRunActionReturnsInt(): void
    {
        // actionRun(): int - a console exit code.
        $this->assertSame('int', (string) $this->reflection->getMethod('actionRun')->getReturnType());
    }

    // ========================================================================= //
    // Behavior (source-level)
    // ========================================================================= //

    public function testRunDelegatesToRunner(): void
    {
        // The CLI is a thin surface; the run itself lives in the schedule runner.
        $this->assertStringContainsString('scheduleRunner->run(', $this->controllerSource);
    }
}
