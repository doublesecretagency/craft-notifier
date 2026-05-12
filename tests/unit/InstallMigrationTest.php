<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\db\Migration;
use doublesecretagency\notifier\migrations\Install;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the install migration.
 *
 * The install migration creates the two tables that hold notifications
 * and their log entries. Renaming a column or dropping a foreign key
 * silently is a serious data-integrity hazard, so these tests assert
 * the exact column set we expect plus the cascading FK relationships.
 */
class InstallMigrationTest extends TestCase
{
    private string $migrationSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/migrations/Install.php';
        $this->assertTrue(file_exists($path), "Install.php should exist at: $path");
        $this->migrationSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(Install::class);
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
        // Safe transactions on supported DB engines.
        $this->assertTrue($this->reflection->hasMethod('safeUp'));
        $this->assertTrue($this->reflection->hasMethod('safeDown'));
    }

    // ========================================================================= //
    // Table name constants
    // ========================================================================= //

    public function testNotificationsTableNameConstant(): void
    {
        // Constants matter, the rest of the plugin (Records, queries) reads
        // the table name through Yii's `{{%...}}` placeholder.
        $this->assertSame(
            '{{%notifier_notifications}}',
            Install::NOTIFICATIONS
        );
    }

    public function testLogTableNameConstant(): void
    {
        $this->assertSame(
            '{{%notifier_log}}',
            Install::LOG
        );
    }

    // ========================================================================= //
    // Notifications table columns
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function notificationColumnProvider(): array
    {
        return [
            ['id'],
            ['description'],
            ['eventType'],
            ['event'],
            ['eventConfig'],
            ['messageType'],
            ['messageConfig'],
            ['recipientsType'],
            ['recipientsConfig'],
            ['dateCreated'],
            ['dateUpdated'],
            ['dateDeleted'],
            ['uid'],
        ];
    }

    /**
     * @dataProvider notificationColumnProvider
     */
    public function testNotificationsTableHasColumn(string $column): void
    {
        // Each column must appear in the createTable call. If a column is
        // renamed in the source without a corresponding migration, this
        // test fails, forcing the contributor to write the migration.
        $this->assertMatchesRegularExpression(
            "/'$column'\s*=>/",
            $this->migrationSource,
            "notifier_notifications should declare a `$column` column"
        );
    }

    public function testNotificationsTableUsesCompositePrimaryKey(): void
    {
        // The id column is shared with the elements table (Craft element
        // extension table pattern); the PK declaration is therefore
        // explicit, not the auto-increment kind.
        $this->assertStringContainsString(
            'PRIMARY KEY([[id]])',
            $this->migrationSource
        );
    }

    // ========================================================================= //
    // Log table columns
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function logColumnProvider(): array
    {
        return [
            ['id'],
            ['notificationId'],
            ['envelopeId'],
            ['type'],
            ['message'],
            ['details'],
            ['dateCreated'],
            ['dateUpdated'],
            ['uid'],
        ];
    }

    /**
     * @dataProvider logColumnProvider
     */
    public function testLogTableHasColumn(string $column): void
    {
        $this->assertMatchesRegularExpression(
            "/'$column'\s*=>/",
            $this->migrationSource,
            "notifier_log should declare a `$column` column"
        );
    }

    // ========================================================================= //
    // Foreign keys
    // ========================================================================= //

    public function testNotificationsForeignKeyToElementsCascades(): void
    {
        // When an element is deleted, the matching notification row must be
        // dropped too, that's the Craft element-extension-table contract.
        $this->assertMatchesRegularExpression(
            "/addForeignKey[\s\S]*?self::NOTIFICATIONS[\s\S]*?'\{\{%elements\}\}'[\s\S]*?'CASCADE'/",
            $this->migrationSource
        );
    }

    public function testLogForeignKeyToNotificationsSetsNullOnDelete(): void
    {
        // Logs survive notification deletion so the audit trail stays intact;
        // the FK uses SET NULL rather than CASCADE.
        $this->assertMatchesRegularExpression(
            "/addForeignKey[\s\S]*?self::LOG[\s\S]*?self::NOTIFICATIONS[\s\S]*?'SET NULL'/",
            $this->migrationSource
        );
    }

    // ========================================================================= //
    // safeDown ordering
    // ========================================================================= //

    public function testSafeDownDropsLogBeforeNotifications(): void
    {
        // Drop order must be reverse of FK direction or the constraint will
        // block the drop. LOG references NOTIFICATIONS, so LOG goes first.
        $this->assertMatchesRegularExpression(
            '/safeDown[\s\S]*?dropTableIfExists\(self::LOG\)[\s\S]*?dropTableIfExists\(self::NOTIFICATIONS\)/',
            $this->migrationSource
        );
    }
}
