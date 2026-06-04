<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\db\Migration;
use doublesecretagency\notifier\migrations\m260604_120000_trackreports;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the report-schedule tracking migration.
 *
 * The `notifier_trackreports` table holds one row per report notification
 * (System Snapshot, Dynamic Data) with a recurring schedule, recording when it
 * last fired and when it is due to fire next. The unique index on notificationId
 * keeps it one-to-one, and the foreign key cleans the row up when its
 * notification is hard-deleted. (This unreleased table is created with its final
 * name directly here, rather than created-then-renamed.)
 */
class ReportTrackingMigrationTest extends TestCase
{
    private string $migrationSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/migrations/m260604_120000_trackreports.php';
        $this->assertTrue(file_exists($path), "Migration should exist at: $path");
        $this->migrationSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(m260604_120000_trackreports::class);
    }

    public function testExtendsMigration(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Migration::class));
    }

    public function testHasSafeUpAndSafeDown(): void
    {
        $this->assertTrue($this->reflection->hasMethod('safeUp'));
        $this->assertTrue($this->reflection->hasMethod('safeDown'));
    }

    public function testCreatesReportTrackingTable(): void
    {
        $this->assertStringContainsString('{{%notifier_trackreports}}', $this->migrationSource);
    }

    public function testDeclaresNotificationIdColumn(): void
    {
        $this->assertMatchesRegularExpression(
            "/'notificationId'\s*=>\s*\\\$this->integer\(\)->notNull\(\)/",
            $this->migrationSource
        );
    }

    public function testDeclaresNullableLastRunAtColumn(): void
    {
        // lastRunAt is null until the first fire.
        $this->assertMatchesRegularExpression(
            "/'lastRunAt'\s*=>\s*\\\$this->dateTime\(\)->null\(\)/",
            $this->migrationSource
        );
    }

    public function testDeclaresNotNullNextRunAtColumn(): void
    {
        // nextRunAt is always seeded, so it is non-null.
        $this->assertMatchesRegularExpression(
            "/'nextRunAt'\s*=>\s*\\\$this->dateTime\(\)->notNull\(\)/",
            $this->migrationSource
        );
    }

    public function testCreatesUniqueIndexOnNotificationId(): void
    {
        // One row per notification; the unique index is also the upsert guard.
        $this->assertMatchesRegularExpression(
            "/createIndex\([\s\S]*?notificationId[\s\S]*?true\)/",
            $this->migrationSource
        );
    }

    public function testForeignKeyCascadesToNotifications(): void
    {
        $this->assertMatchesRegularExpression(
            "/addForeignKey\([\s\S]*?notifier_notifications[\s\S]*?'CASCADE'\)/",
            $this->migrationSource
        );
    }
}
