<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\db\Migration;
use doublesecretagency\notifier\migrations\m260520_120000_trackfeeds;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the feed tracking migration.
 *
 * The `notifier_trackfeeds` table holds the per-item tracking rows the runner
 * uses to fire exactly once per new feed item. The unique index on
 * (notificationId, itemId) is the concurrency guarantee, and the
 * foreign key cleans every row up when its notification is hard-deleted.
 */
class FeedTrackingMigrationTest extends TestCase
{
    private string $migrationSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/migrations/m260520_120000_trackfeeds.php';
        $this->assertTrue(file_exists($path), "Migration should exist at: $path");
        $this->migrationSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(m260520_120000_trackfeeds::class);
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

    public function testCreatesFeedTrackingTable(): void
    {
        $this->assertStringContainsString(
            '{{%notifier_trackfeeds}}',
            $this->migrationSource
        );
    }

    public function testDeclaresNotificationIdColumn(): void
    {
        // Each row belongs to exactly one notification.
        $this->assertMatchesRegularExpression(
            "/'notificationId'\s*=>\s*\\\$this->integer\(\)->notNull\(\)/",
            $this->migrationSource
        );
    }

    public function testDeclaresTrackingKeyColumn(): void
    {
        // itemId holds the item GUID (or fallback link, or seed marker)
        // and must be a non-null string of bounded length.
        $this->assertMatchesRegularExpression(
            "/'itemId'\s*=>\s*\\\$this->string\(255\)->notNull\(\)/",
            $this->migrationSource
        );
    }

    public function testDoesNotCarryAuditColumns(): void
    {
        // Tracking rows are append-only internal bookkeeping; no dateCreated /
        // dateUpdated / uid because they would never be read and the table
        // can stay narrow. Mirrors the notifier_trackscheduled shape.
        $this->assertDoesNotMatchRegularExpression(
            "/'dateCreated'\s*=>/",
            $this->migrationSource
        );
        $this->assertDoesNotMatchRegularExpression(
            "/'dateUpdated'\s*=>/",
            $this->migrationSource
        );
        $this->assertDoesNotMatchRegularExpression(
            "/'uid'\s*=>/",
            $this->migrationSource
        );
    }

    // ========================================================================= //
    // Index and foreign key
    // ========================================================================= //

    public function testCreatesUniqueIndexOnNotificationIdAndTrackingKey(): void
    {
        // The unique index is the concurrency guard: a racing INSERT loses
        // cleanly, so "dispatch only if I claimed this row" works under
        // overlapping cron ticks.
        $this->assertMatchesRegularExpression(
            "/createIndex\([\s\S]*?notificationId[\s\S]*?itemId[\s\S]*?true\)/",
            $this->migrationSource
        );
    }

    public function testForeignKeyCascadesToNotifications(): void
    {
        // A hard-deleted notification takes its tracking history with it.
        $this->assertMatchesRegularExpression(
            "/addForeignKey\([\s\S]*?notifier_notifications[\s\S]*?'CASCADE'\)/",
            $this->migrationSource
        );
    }
}
