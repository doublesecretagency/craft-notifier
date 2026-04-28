<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\web\Controller;
use doublesecretagency\notifier\controllers\LogController;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the LogController.
 *
 * The log controller serves the AJAX endpoints behind the NotificationLog
 * CP utility. Each action returns JSON and must guard against missing
 * IDs / dates so the utility never gets ambiguous server responses.
 */
class LogControllerTest extends TestCase
{
    private string $controllerSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/controllers/LogController.php';
        $this->assertTrue(file_exists($path), "LogController.php should exist at: $path");
        $this->controllerSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(LogController::class);
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

    public function testHasGetNotificationAction(): void
    {
        $this->assertTrue($this->reflection->hasMethod('actionGetNotification'));
        $this->assertTrue(
            $this->reflection->getMethod('actionGetNotification')->isPublic()
        );
    }

    public function testHasDeleteAction(): void
    {
        $this->assertTrue($this->reflection->hasMethod('actionDelete'));
        $this->assertTrue($this->reflection->getMethod('actionDelete')->isPublic());
    }

    public function testHasDeleteDayAction(): void
    {
        $this->assertTrue($this->reflection->hasMethod('actionDeleteDay'));
        $this->assertTrue(
            $this->reflection->getMethod('actionDeleteDay')->isPublic()
        );
    }

    // ========================================================================= //
    // Request guards
    // ========================================================================= //

    public function testGetNotificationRequiresPostAndJson(): void
    {
        // CSRF protection + clear API contract — both POST + accept-JSON guards
        // must be present.
        $this->assertMatchesRegularExpression(
            '/actionGetNotification[\s\S]*?requirePostRequest/',
            $this->controllerSource
        );
        $this->assertMatchesRegularExpression(
            '/actionGetNotification[\s\S]*?requireAcceptsJson/',
            $this->controllerSource
        );
    }

    public function testDeleteRequiresPostAndJson(): void
    {
        $this->assertMatchesRegularExpression(
            '/actionDelete\(\)[\s\S]*?requirePostRequest/',
            $this->controllerSource
        );
        $this->assertMatchesRegularExpression(
            '/actionDelete\(\)[\s\S]*?requireAcceptsJson/',
            $this->controllerSource
        );
    }

    public function testDeleteDayRequiresPostAndJson(): void
    {
        $this->assertMatchesRegularExpression(
            '/actionDeleteDay[\s\S]*?requirePostRequest/',
            $this->controllerSource
        );
        $this->assertMatchesRegularExpression(
            '/actionDeleteDay[\s\S]*?requireAcceptsJson/',
            $this->controllerSource
        );
    }

    // ========================================================================= //
    // Input validation
    // ========================================================================= //

    public function testGetNotificationValidatesIdIsNumeric(): void
    {
        // Guard against non-numeric input — Notification IDs are always ints.
        $this->assertMatchesRegularExpression(
            '/actionGetNotification[\s\S]*?is_numeric\(\$notificationId\)/',
            $this->controllerSource
        );
    }

    public function testDeleteValidatesEnvelopeIdIsNumeric(): void
    {
        $this->assertMatchesRegularExpression(
            '/actionDelete\(\)[\s\S]*?is_numeric\(\$envelopeId\)/',
            $this->controllerSource
        );
    }

    // ========================================================================= //
    // Delete-day timezone safety
    // ========================================================================= //

    public function testDeleteDayConvertsTimeZone(): void
    {
        // The delete-day action must compare dates in the project's timezone
        // — dateCreated is stored in UTC, so we CONVERT_TZ before matching.
        $this->assertStringContainsString(
            'CONVERT_TZ',
            $this->controllerSource
        );
        $this->assertStringContainsString(
            'Craft::$app->timeZone',
            $this->controllerSource
        );
    }

    // ========================================================================= //
    // Response shape
    // ========================================================================= //

    public function testActionsReturnJsonResponses(): void
    {
        // The utility's frontend reads $.message and $.success consistently.
        $this->assertMatchesRegularExpression(
            "/'message'\s*=>/",
            $this->controllerSource
        );
        $this->assertMatchesRegularExpression(
            "/'success'\s*=>/",
            $this->controllerSource
        );
    }
}
