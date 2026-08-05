<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\web\Controller;
use doublesecretagency\notifier\controllers\ScheduledController;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the scheduled-run web controller.
 *
 * ScheduledController exposes `/actions/notifier/scheduled/run`, the web
 * surface a cron job or daemon pings when no CLI is available. Because the
 * endpoint runs anonymously, its access guards are load-bearing: it must
 * require POST and validate a shared-secret token.
 */
class ScheduledWebControllerTest extends TestCase
{
    private string $controllerSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/controllers/ScheduledController.php';
        $this->assertTrue(file_exists($path), "ScheduledController.php should exist at: $path");
        $this->controllerSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(ScheduledController::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsWebController(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Controller::class));
    }

    public function testHasRunAction(): void
    {
        $this->assertTrue($this->reflection->hasMethod('actionRun'));
        $this->assertTrue($this->reflection->getMethod('actionRun')->isPublic());
    }

    // ========================================================================= //
    // Access guards
    // ========================================================================= //

    public function testAllowsAnonymousRunAction(): void
    {
        // The cron caller is not logged in, so `run` must be anonymous.
        $this->assertMatchesRegularExpression(
            "/allowAnonymous\s*=\s*\[\s*'run'\s*\]/",
            $this->controllerSource
        );
    }

    public function testDisablesCsrfValidation(): void
    {
        // An external cron caller carries no CSRF token.
        $this->assertMatchesRegularExpression(
            '/enableCsrfValidation\s*=\s*false/',
            $this->controllerSource
        );
    }

    public function testRequiresPostRequest(): void
    {
        // A POST guard defends against accidental browser visits firing a run.
        $this->assertStringContainsString('requirePostRequest(', $this->controllerSource);
    }

    public function testValidatesSharedSecretFromSettings(): void
    {
        // The endpoint requires a shared secret read from the plugin
        // settings. App::parseEnv() resolves $ENV_VAR references; getSettings()
        // applies any override from config/notifier.php.
        $this->assertStringContainsString('->scheduledToken', $this->controllerSource);
        $this->assertStringContainsString('App::parseEnv(', $this->controllerSource);
    }

    public function testComparesTokenInConstantTime(): void
    {
        // hash_equals() avoids leaking the secret through a timing side channel.
        $this->assertStringContainsString('hash_equals(', $this->controllerSource);
    }

    public function testReturnsServiceUnavailableWhenUnconfigured(): void
    {
        // A missing token means the operator has not finished setup.
        $this->assertStringContainsString('ServiceUnavailableHttpException', $this->controllerSource);
    }

    public function testDeniesAccessWhenTokenIsWrong(): void
    {
        // A wrong or missing token is a hard 403.
        $this->assertStringContainsString('ForbiddenHttpException', $this->controllerSource);
    }

    // ========================================================================= //
    // Behavior (source-level)
    // ========================================================================= //

    public function testRunDelegatesToRunner(): void
    {
        // The endpoint is a thin surface; the run itself lives in the schedule runner.
        $this->assertStringContainsString('scheduleRunner->run(', $this->controllerSource);
    }
}
