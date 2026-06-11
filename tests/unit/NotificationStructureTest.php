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

    protected function setUp(): void
    {
        $root = dirname(__DIR__, 2);

        $elementPath = $root . '/src/elements/Notification.php';
        $migrationPath = $root . '/src/migrations/m260615_120000_notification_structure.php';
        $pluginPath = $root . '/src/NotifierPlugin.php';

        $this->assertTrue(file_exists($elementPath), "Notification element should exist at: $elementPath");
        $this->assertTrue(file_exists($migrationPath), "Backfill migration should exist at: $migrationPath");
        $this->assertTrue(file_exists($pluginPath), "Plugin class should exist at: $pluginPath");

        $this->elementSource = file_get_contents($elementPath);
        $this->migrationSource = file_get_contents($migrationPath);
        $this->pluginSource = file_get_contents($pluginPath);
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

    public function testReorderGatedBySavePermission(): void
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
        // afterSave adds brand-new notifications to whichever end the setting names.
        $this->assertStringContainsString('prependToRoot', $this->elementSource);
        $this->assertStringContainsString('appendToRoot', $this->elementSource);
    }

    public function testPlacementSkipsDraftsAndRevisions(): void
    {
        // Only canonical, brand-new saves are placed (drafts / revisions are skipped).
        $this->assertMatchesRegularExpression(
            '/_ensureStructurePlacement[\s\S]*?getIsDraft\(\)[\s\S]*?getIsRevision\(\)/',
            $this->elementSource
        );
    }

    // ========================================================================= //
    // Backfill migration
    // ========================================================================= //

    public function testBackfillAppendsInCreationOrder(): void
    {
        // Existing notifications are appended oldest-first so today's order is preserved.
        $this->assertMatchesRegularExpression(
            "/orderBy\(\['id' => SORT_ASC\]\)/",
            $this->migrationSource
        );
        $this->assertStringContainsString('appendToRoot', $this->migrationSource);
    }

    public function testBackfillSkipsAlreadyPlaced(): void
    {
        // Re-running must not double-place an element already in the structure.
        $this->assertMatchesRegularExpression(
            '/isset\(\$placed\[[\s\S]*?continue/',
            $this->migrationSource
        );
    }

    // ========================================================================= //
    // Schema version
    // ========================================================================= //

    public function testSchemaVersionMatchesInflightRelease(): void
    {
        // The backfill migration ships under the current in-flight schema version,
        // not a new minor bump (it shares the unreleased 3.1.0 schema).
        $this->assertStringContainsString("\$schemaVersion = '3.1.0'", $this->pluginSource);
    }
}
