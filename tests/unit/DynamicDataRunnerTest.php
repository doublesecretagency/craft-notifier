<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\services\DynamicDataRunner;
use doublesecretagency\notifier\services\ReportRunner;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the Dynamic Data report runner.
 *
 * DynamicDataRunner is a thin subclass of ReportRunner: it declares the
 * 'dynamic-data' event type and fires with empty data (the Dispatch parses the
 * user's snippet internally).
 */
class DynamicDataRunnerTest extends TestCase
{
    private ReflectionClass $reflection;
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/services/DynamicDataRunner.php';
        $this->assertTrue(file_exists($path), "DynamicDataRunner.php should exist at: $path");
        $this->source = file_get_contents($path);
        $this->reflection = new ReflectionClass(DynamicDataRunner::class);
    }

    public function testExtendsReportRunner(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(ReportRunner::class));
    }

    public function testDeclaresDynamicDataEventType(): void
    {
        $this->assertMatchesRegularExpression(
            "/function eventType\(\)[\s\S]*?return 'dynamic-data';/",
            $this->source
        );
    }

    public function testDispatchSendsWithEmptyData(): void
    {
        // The snippet runs inside the Dispatch, so the runner sends empty data.
        $this->assertMatchesRegularExpression("/->send\(\\\$notification, \\\$event, \[\]\)/", $this->source);
    }

    public function testNotificationsReadFromTheMessagesService(): void
    {
        $this->assertStringContainsString('getDynamicDataNotifications()', $this->source);
    }
}
