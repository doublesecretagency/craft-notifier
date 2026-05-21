<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\db\Migration;
use doublesecretagency\notifier\migrations\m260519_120000_trackscheduled;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the schedule tracking migration.
 *
 * The `notifier_trackscheduled` table holds the per-notification window
 * timestamp (`lastRunAt`) the runner advances on every run. The unique
 * index keeps it one-row-per-notification, and the foreign key cleans the
 * cursor up when its notification is hard-deleted.
 */
class ScheduleTrackingMigrationTest extends TestCase
{
    private string $migrationSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/migrations/m260519_120000_trackscheduled.php';
        $this->assertTrue(file_exists($path), "Migration should exist at: $path");
        $this->migrationSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(m260519_120000_trackscheduled::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsMigration(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Migration::class));
    }

    public function testHasSafeUpAndSafeDown(): void
    {
        $this->assertTrue($this->reflection->hasMethod('safeUp'));
        $this->assertTrue($this->reflection->hasMethod('safeDown'));
    }

    // ========================================================================= //
    // Table schema
    // ========================================================================= //

    public function testCreatesScheduleTrackingTable(): void
    {
        $this->assertStringContainsString(
            '{{%notifier_trackscheduled}}',
            $this->migrationSource
        );
    }

    public function testDeclaresNotificationIdColumn(): void
    {
        // The cursor is keyed to a single notification.
        $this->assertMatchesRegularExpression(
            "/'notificationId'\s*=>\s*\\\$this->integer\(\)->notNull\(\)/",
            $this->migrationSource
        );
    }

    public function testDeclaresLastRunAtColumn(): void
    {
        // lastRunAt is the run timestamp itself; it must never be null.
        $this->assertMatchesRegularExpression(
            "/'lastRunAt'\s*=>\s*\\\$this->dateTime\(\)->notNull\(\)/",
            $this->migrationSource
        );
    }

    // ========================================================================= //
    // Index and foreign key
    // ========================================================================= //

    public function testCreatesUniqueIndexOnNotificationId(): void
    {
        // One row per notification; the trailing `true` makes the index
        // unique, which is also what the runner's first-run insert races
        // against.
        $this->assertMatchesRegularExpression(
            "/createIndex\([\s\S]*?notificationId[\s\S]*?true\)/",
            $this->migrationSource
        );
    }

    public function testForeignKeyCascadesToNotifications(): void
    {
        // A hard-deleted notification takes its cursor row with it.
        $this->assertMatchesRegularExpression(
            "/addForeignKey\([\s\S]*?notifier_notifications[\s\S]*?'CASCADE'\)/",
            $this->migrationSource
        );
    }
}
