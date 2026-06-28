<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\db\Migration;
use doublesecretagency\notifier\migrations\m260627_120000_section_entry_type_pairs;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the section + entry type pairs migration.
 *
 * Entry notifications used to store two flat, independent lists:
 * `sections` and `entryTypes`. An entry matched if its section was in
 * the first list AND its type was in the second (a cross-product). That
 * made it impossible to say "News in Section A but not News in Section B",
 * and the same entry type shared across sections collided on a single id.
 *
 * The new model stores `sectionEntryTypes` as a flat list of
 * "{sectionId}-{typeId}" pairs, so each section/entry-type combination is
 * independent. This migration converts existing notifications: it expands
 * the old cross-product into explicit pairs (and, when a section had no
 * entry types selected, pairs it with all of the section's current types
 * to preserve the old "all types in this section" behavior), then drops
 * the old `entryTypes` key.
 *
 * The migration must be idempotent (re-running is a no-op) and must only
 * touch rows whose eventType is 'entries'.
 */
class SectionEntryTypePairsMigrationTest extends TestCase
{
    private string $migrationSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/migrations/m260627_120000_section_entry_type_pairs.php';
        $this->assertTrue(file_exists($path), "Migration should exist at: $path");
        $this->migrationSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(m260627_120000_section_entry_type_pairs::class);
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

    public function testSafeDownDeclinesToRevert(): void
    {
        // The conversion is not reverted; the down path is intentionally a no-op.
        $this->assertMatchesRegularExpression(
            '/safeDown\(\)[\s\S]*?return\s+false/',
            $this->migrationSource
        );
    }

    // ========================================================================= //
    // Targeting
    // ========================================================================= //

    public function testOnlyTargetsEntriesEventType(): void
    {
        // The query must scope to eventType = 'entries' so we never touch
        // assets / users / commerce rows.
        $this->assertMatchesRegularExpression(
            "/'eventType'\s*=>\s*'entries'/",
            $this->migrationSource
        );
    }

    public function testReadsFromNotificationsTable(): void
    {
        $this->assertStringContainsString(
            '{{%notifier_notifications}}',
            $this->migrationSource
        );
    }

    // ========================================================================= //
    // Conversion
    // ========================================================================= //

    public function testReadsTheOldFlatKeys(): void
    {
        // Reads both old flat lists to build the pairs.
        $this->assertMatchesRegularExpression("/\\\$eventConfig\\['sections'\\]/", $this->migrationSource);
        $this->assertMatchesRegularExpression("/\\\$eventConfig\\['entryTypes'\\]/", $this->migrationSource);
    }

    public function testWritesSectionEntryTypesKey(): void
    {
        // The conversion writes into eventConfig['sectionEntryTypes'].
        $this->assertMatchesRegularExpression(
            "/\\\$eventConfig\\['sectionEntryTypes'\\]\s*=/",
            $this->migrationSource
        );
    }

    public function testDropsOldEntryTypesKey(): void
    {
        // The flat entryTypes key is removed once converted.
        $this->assertMatchesRegularExpression(
            "/unset\(\\\$eventConfig\\['entryTypes'\\]\)/",
            $this->migrationSource
        );
    }

    public function testBuildsHyphenatedSectionTypePairs(): void
    {
        // Pairs are stored as "{sectionId}-{typeId}" strings.
        $this->assertStringContainsString('"{$sectionId}-{$typeId}"', $this->migrationSource);
    }

    public function testExpandsSectionWithNoTypesToAllOfItsTypes(): void
    {
        // When a section had no entry types selected, pair it with all of the
        // section's current types (preserves the old "all types" behavior).
        $this->assertStringContainsString('getEntryTypes()', $this->migrationSource);
    }

    public function testResolvesEntriesServiceAcrossCraftMajors(): void
    {
        // Craft 5 exposes getEntries(); Craft 4 exposes getSections().
        $this->assertStringContainsString('Compat::isCraft5()', $this->migrationSource);
        $this->assertStringContainsString('getEntries()', $this->migrationSource);
        $this->assertStringContainsString('getSections()', $this->migrationSource);
    }

    // ========================================================================= //
    // Idempotency
    // ========================================================================= //

    public function testSkipsRowsAlreadyConverted(): void
    {
        // If a notification already carries a `sectionEntryTypes` key, the
        // migration must skip it so re-running never clobbers a user's
        // narrowed per-section selection.
        $this->assertMatchesRegularExpression(
            "/isset\(\\\$eventConfig\\['sectionEntryTypes'\\]\)[\s\S]*?continue/",
            $this->migrationSource
        );
    }

    public function testShortCircuitsWhenNoEntryNotificationsExist(): void
    {
        // With zero entry notifications, the migration returns early.
        $this->assertMatchesRegularExpression(
            '/!\$rows[\s\S]*?return\s+true/',
            $this->migrationSource
        );
    }
}
