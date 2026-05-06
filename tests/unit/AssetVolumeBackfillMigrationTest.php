<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\db\Migration;
use doublesecretagency\notifier\migrations\m260506_120000_backfill_asset_volume_filters;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the asset volume backfill migration.
 *
 * Pre-existing Asset notifications saved before the Volume Filter UI
 * shipped have no `volumes` key in their eventConfig JSON. Without
 * the backfill they would silently stop firing on upgrade, since
 * the new `volumes` gate is mandatory.
 *
 * The migration must be idempotent (re-running is a no-op) and must
 * only touch rows whose eventType is 'assets'.
 */
class AssetVolumeBackfillMigrationTest extends TestCase
{
    private string $migrationSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/migrations/m260506_120000_backfill_asset_volume_filters.php';
        $this->assertTrue(file_exists($path), "Migration should exist at: $path");
        $this->migrationSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(m260506_120000_backfill_asset_volume_filters::class);
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

    public function testSafeDownDeclinesToRevert(): void
    {
        // Backfill writes are not reverted; the down path is intentionally a no-op.
        $this->assertMatchesRegularExpression(
            '/safeDown\(\)[\s\S]*?return\s+false/',
            $this->migrationSource
        );
    }

    // ========================================================================= //
    // Targeting
    // ========================================================================= //

    public function testOnlyTargetsAssetEventType(): void
    {
        // The query must scope to eventType = 'assets' so we never touch
        // entries / users / commerce-orders rows.
        $this->assertMatchesRegularExpression(
            "/'eventType'\s*=>\s*'assets'/",
            $this->migrationSource
        );
    }

    public function testReadsFromNotificationsTable(): void
    {
        // Reads the eventConfig JSON column on the notifications table.
        $this->assertStringContainsString(
            '{{%notifier_notifications}}',
            $this->migrationSource
        );
    }

    public function testCollectsCurrentVolumeIds(): void
    {
        // Backfill writes the full set of current volume IDs into eventConfig.
        $this->assertStringContainsString(
            'getVolumes()->getAllVolumes()',
            $this->migrationSource
        );
    }

    public function testWritesVolumesKeyIntoEventConfig(): void
    {
        // The backfill writes into eventConfig['volumes'].
        $this->assertMatchesRegularExpression(
            "/\\\$eventConfig\\['volumes'\\]\s*=/",
            $this->migrationSource
        );
    }

    // ========================================================================= //
    // Idempotency
    // ========================================================================= //

    public function testSkipsRowsAlreadyBackfilled(): void
    {
        // If a notification already carries a `volumes` key, the migration
        // must skip it. Without this guard, re-running would clobber any
        // user's narrowed selection back to "all volumes".
        $this->assertMatchesRegularExpression(
            "/isset\(\\\$eventConfig\\['volumes'\\]\)[\s\S]*?continue/",
            $this->migrationSource
        );
    }

    public function testShortCircuitsWhenNoVolumesExist(): void
    {
        // If the install has zero volumes, there is nothing to backfill.
        // The migration must return early rather than write empty arrays.
        $this->assertMatchesRegularExpression(
            '/!\$allVolumeIds[\s\S]*?return\s+true/',
            $this->migrationSource
        );
    }
}
