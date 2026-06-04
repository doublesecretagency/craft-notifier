<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\db\Migration;
use doublesecretagency\notifier\migrations\m260604_130000_rename_trackscheduled_to_trackdates;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the tracking-table rename migration.
 *
 * Renames the released date-reached tracking table to a distinct-domain name:
 * notifier_trackscheduled -> notifier_trackdates. (The report-schedule table is
 * created with its final name directly in m260604_120000, so it needs no
 * rename here.) The rename is guarded so the migration is safe on fresh installs
 * (where the final name already exists).
 */
class RenameTrackscheduledMigrationTest extends TestCase
{
    private string $migrationSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/migrations/m260604_130000_rename_trackscheduled_to_trackdates.php';
        $this->assertTrue(file_exists($path), "Migration should exist at: $path");
        $this->migrationSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(m260604_130000_rename_trackscheduled_to_trackdates::class);
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

    public function testRenamesScheduledToDates(): void
    {
        $this->assertMatchesRegularExpression(
            "/renameTable\('\{\{%notifier_trackscheduled\}\}', '\{\{%notifier_trackdates\}\}'\)/",
            $this->migrationSource
        );
    }

    public function testRenameIsGuardedByTableExistence(): void
    {
        // The rename only fires when the source exists and the target does not,
        // so the migration is idempotent against fresh installs and partial states.
        $this->assertMatchesRegularExpression(
            "/tableExists\('\{\{%notifier_trackscheduled\}\}'\)\s*&&\s*!\\\$this->db->tableExists\('\{\{%notifier_trackdates\}\}'\)/",
            $this->migrationSource
        );
    }

    public function testSafeDownReversesTheRename(): void
    {
        $this->assertMatchesRegularExpression(
            "/safeDown[\s\S]*?renameTable\('\{\{%notifier_trackdates\}\}', '\{\{%notifier_trackscheduled\}\}'\)/",
            $this->migrationSource
        );
    }

    public function testDoesNotRenameTheUnreleasedReportTable(): void
    {
        // The report-schedule table was never released under an interim name, so
        // this migration must not rename it (it's created final in m260604_120000).
        // Guard on the renameTable call specifically; the docblock may mention the
        // table by name when explaining what it deliberately does NOT do.
        $this->assertDoesNotMatchRegularExpression(
            "/renameTable\([^)]*track(recurring|reports)/",
            $this->migrationSource
        );
    }
}
