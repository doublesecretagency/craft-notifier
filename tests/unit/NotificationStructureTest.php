<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\NotificationStructure;
use doublesecretagency\notifier\models\Settings;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for Structure-backed manual notification ordering.
 *
 * Notifications behave like a Craft Structure section (flat, maxLevels=1):
 * the CP index is drag-to-reorder, backed by Craft's structures tables.
 * These tests pin the source-level shape of that wiring without booting
 * Craft - no real Structure is created, no DB is touched. End-to-end
 * reorder behavior is verified manually in the sandbox.
 */
class NotificationStructureTest extends TestCase
{
    private string $elementSource;
    private string $migrationSource;
    private string $pluginSource;
    private string $helperSource;

    protected function setUp(): void
    {
        $root = dirname(__DIR__, 2);

        $elementPath = $root . '/src/elements/Notification.php';
        $migrationPath = $root . '/src/migrations/m260615_120000_notification_structure.php';
        $pluginPath = $root . '/src/NotifierPlugin.php';
        $helperPath = $root . '/src/helpers/NotificationStructure.php';

        $this->assertTrue(file_exists($elementPath), "Notification element should exist at: $elementPath");
        $this->assertTrue(file_exists($migrationPath), "Backfill migration should exist at: $migrationPath");
        $this->assertTrue(file_exists($pluginPath), "Plugin class should exist at: $pluginPath");
        $this->assertTrue(file_exists($helperPath), "Structure helper should exist at: $helperPath");

        $this->elementSource = file_get_contents($elementPath);
        $this->migrationSource = file_get_contents($migrationPath);
        $this->pluginSource = file_get_contents($pluginPath);
        $this->helperSource = file_get_contents($helperPath);
    }

    // ========================================================================= //
    // Settings: placement constants + properties
    // ========================================================================= //

    public function testSettingsHasPlacementConstants(): void
    {
        // The two placement values mirror Craft's Section::DEFAULT_PLACEMENT_*.
        $reflection = new ReflectionClass(Settings::class);
        $this->assertSame('beginning', $reflection->getConstant('DEFAULT_PLACEMENT_BEGINNING'));
        $this->assertSame('end', $reflection->getConstant('DEFAULT_PLACEMENT_END'));
    }

    public function testDefaultPlacementDefaultsToEnd(): void
    {
        // New notifications append to the bottom unless the setting says otherwise.
        $defaults = (new ReflectionClass(Settings::class))->getDefaultProperties();
        $this->assertSame('end', $defaults['defaultPlacement']);
    }

    public function testSettingsHasStructureUidProperty(): void
    {
        // The Structure UID persists in settings (project-config-safe), resolved
        // to a concrete structureId per environment.
        $defaults = (new ReflectionClass(Settings::class))->getDefaultProperties();
        $this->assertArrayHasKey('structureUid', $defaults);
        $this->assertNull($defaults['structureUid']);
    }

    // ========================================================================= //
    // Resolver helper
    // ========================================================================= //

    public function testStructureHelperExposesGetStructureId(): void
    {
        // The resolver owns the single global Structure and is the one place
        // that creates / looks it up.
        $this->assertTrue(class_exists(NotificationStructure::class));
        $reflection = new ReflectionClass(NotificationStructure::class);
        $this->assertTrue($reflection->hasMethod('getStructureId'));
        $this->assertTrue($reflection->getMethod('getStructureId')->isStatic());
    }

    // ========================================================================= //
    // Element index source
    // ========================================================================= //

    public function testDefineSourcesDeclaresStructure(): void
    {
        // The structured source carries the three keys Craft reads to render
        // the drag-to-reorder UI and authorize edits.
        $this->assertStringContainsString("'structureId' => \$structureId", $this->elementSource);
        $this->assertStringContainsString("'defaultSort' => ['structure', 'asc']", $this->elementSource);
        $this->assertStringContainsString("'structureEditable' =>", $this->elementSource);
    }

    public function testReorderRequiresSavePermission(): void
    {
        // Reordering is an edit affordance: admins, or holders of the save permission.
        $this->assertMatchesRegularExpression(
            '/_canReorder[\s\S]*?notifier-saveNotifications/',
            $this->elementSource
        );
    }

    // ========================================================================= //
    // Placement on save
    // ========================================================================= //

    public function testNewNotificationsPlacedByConfiguredEnd(): void
    {
        // afterSave adds the notification to whichever end the setting names.
        $this->assertStringContainsString('prependToRoot', $this->elementSource);
        $this->assertStringContainsString('appendToRoot', $this->elementSource);
    }

    public function testPlacementSkipsDraftsAndRevisions(): void
    {
        // Only canonical saves are placed (drafts / revisions are skipped).
        $this->assertMatchesRegularExpression(
            '/_ensureStructurePlacement[\s\S]*?getIsDraft\(\)[\s\S]*?getIsRevision\(\)/',
            $this->elementSource
        );
    }

    public function testPlacementRunsOnEveryCanonicalSaveNotJustNew(): void
    {
        // The afterSave call must NOT pass $isNew. Notifications are created
        // through the draft/apply-draft flow, so the canonical element already
        // exists when the draft is applied (isNew is false there). A new-only
        // guard would never place it, leaving it orphaned out of the structure.
        $this->assertStringContainsString(
            '$this->_ensureStructurePlacement();',
            $this->elementSource
        );

        // The old new-only guard must be gone from the placement method.
        $this->assertDoesNotMatchRegularExpression(
            '/private function _ensureStructurePlacement\([\s\S]*?if \(!\$isNew\)/',
            $this->elementSource
        );
    }

    public function testPlacementSkipsNotificationsAlreadyInStructure(): void
    {
        // Being in the structure is what decides placement now: a notification already in the
        // structure keeps its position, so re-saves (and apply-draft on an
        // existing canonical) are a no-op rather than a reset.
        $this->assertStringContainsString('_isInStructure', $this->elementSource);
        $this->assertMatchesRegularExpression(
            '/if \(\$this->_isInStructure\(\$structureId\)\) \{\s*return;/',
            $this->elementSource
        );

        // The check reads the structure elements table for this element.
        $this->assertMatchesRegularExpression(
            '/_isInStructure[\s\S]*?Table::STRUCTUREELEMENTS[\s\S]*?->exists\(\)/',
            $this->elementSource
        );
    }

    // ========================================================================= //
    // Self-healing backfill (helper)
    // ========================================================================= //

    public function testHelperExposesBackfillUnplaced(): void
    {
        // The shared, idempotent backfill lives on the structure helper.
        $reflection = new ReflectionClass(NotificationStructure::class);
        $this->assertTrue($reflection->hasMethod('backfillUnplaced'));
        $this->assertTrue($reflection->getMethod('backfillUnplaced')->isStatic());
    }

    public function testBackfillAppendsInCreationOrder(): void
    {
        // Existing notifications are appended oldest-first so today's order is preserved.
        $this->assertMatchesRegularExpression(
            "/orderBy\(\['elements\.id' => SORT_ASC\]\)/",
            $this->helperSource
        );
        $this->assertStringContainsString('appendToRoot', $this->helperSource);
    }

    public function testBackfillUsesInsertModeLikeSaveTimePlacement(): void
    {
        // Uses Structures::MODE_INSERT, matching the save-time _ensureStructurePlacement().
        $this->assertStringContainsString('Structures::MODE_INSERT', $this->helperSource);
    }

    public function testBackfillSkipsAlreadyPlaced(): void
    {
        // Re-running must not double-place; the query excludes elements already in the structure.
        $this->assertMatchesRegularExpression(
            "/STRUCTUREELEMENTS[\s\S]*?\['not', \['elements\.id' => array_map/",
            $this->helperSource
        );
    }

    public function testBackfillSerializedByMutex(): void
    {
        // Concurrent index loads must not both backfill; a mutex serializes the work.
        $this->assertMatchesRegularExpression(
            '/getMutex\(\)[\s\S]*?->acquire\(/',
            $this->helperSource
        );
    }

    public function testIndexSelfHealsByBackfilling(): void
    {
        // defineSources() places any unplaced notifications on index render, so an
        // upgraded site repairs itself even if the one-shot migration couldn't run.
        $this->assertMatchesRegularExpression(
            '/defineSources[\s\S]*?NotificationStructure::backfillUnplaced\(/',
            $this->elementSource
        );
    }

    public function testMigrationDelegatesToHelperBackfill(): void
    {
        // The one-shot upgrade migration delegates to the shared backfill helper.
        $this->assertStringContainsString('NotificationStructure::backfillUnplaced(', $this->migrationSource);
    }

    // ========================================================================= //
    // Schema version
    // ========================================================================= //

    public function testSchemaVersionMatchesInflightRelease(): void
    {
        // v3.2.0 adds two dated migrations (the Description conversion and the
        // wiring-tab permission grant), so the schema version bumps to match.
        $this->assertStringContainsString("\$schemaVersion = '3.2.0'", $this->pluginSource);
    }
}
