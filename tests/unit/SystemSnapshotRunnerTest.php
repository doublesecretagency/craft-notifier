<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\services\ReportRunner;
use doublesecretagency\notifier\services\SystemSnapshotRunner;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the System Snapshot report runner.
 *
 * SystemSnapshotRunner is a thin subclass of ReportRunner: it declares the
 * 'system-snapshot' event type and compiles a report on each fire.
 */
class SystemSnapshotRunnerTest extends TestCase
{
    private ReflectionClass $reflection;
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/services/SystemSnapshotRunner.php';
        $this->assertTrue(file_exists($path), "SystemSnapshotRunner.php should exist at: $path");
        $this->source = file_get_contents($path);
        $this->reflection = new ReflectionClass(SystemSnapshotRunner::class);
    }

    public function testExtendsReportRunner(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(ReportRunner::class));
    }

    public function testDeclaresSystemSnapshotEventType(): void
    {
        // The runner only handles 'system-snapshot' notifications.
        $this->assertMatchesRegularExpression(
            "/function eventType\(\)[\s\S]*?return 'system-snapshot';/",
            $this->source
        );
    }

    public function testDispatchCompilesAndSendsTheReport(): void
    {
        // Each fire compiles a fresh snapshot and threads it through as 'report'.
        $this->assertStringContainsString('SystemSnapshot::compile()', $this->source);
        $this->assertMatchesRegularExpression("/->send\([\s\S]*?'report' => \\\$report/", $this->source);
    }

    public function testNotificationsReadFromTheMessagesService(): void
    {
        $this->assertStringContainsString('getSystemSnapshotNotifications()', $this->source);
    }
}
