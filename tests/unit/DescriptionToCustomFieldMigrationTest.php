<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\db\Migration;
use doublesecretagency\notifier\migrations\m260711_120000_description_to_custom_field as DescriptionMigration;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the Description-to-custom-field migration.
 *
 * This is the highest-risk migration in the plugin: it converts a native
 * column into a project-config-backed custom field across two Craft majors and
 * the dev-vs-production deploy split. These tests pin the safety guards at the
 * source level (Element API, not raw content writes; config-presence
 * discriminator, not readOnly; field-existence gate; fault-isolated backfill).
 */
class DescriptionToCustomFieldMigrationTest extends TestCase
{
    private string $source;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/migrations/m260711_120000_description_to_custom_field.php';
        $this->assertTrue(file_exists($path), "Migration should exist at: $path");
        $this->source = file_get_contents($path);
        $this->reflection = new ReflectionClass(DescriptionMigration::class);
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
    // Dual-major content write
    // ========================================================================= //

    public function testBackfillUsesElementApiNotRawWrites(): void
    {
        // setFieldValue + saveElement routes content to the correct backend on
        // each major (C4 content table, C5 elements_sites.content JSON). A raw
        // elements_sites / content-table write would only work on one major.
        $this->assertMatchesRegularExpression(
            '/setFieldValue\(self::FIELD_HANDLE[\s\S]*?saveElement\(/',
            $this->source
        );
        $this->assertStringNotContainsString('elements_sites', $this->source);
        $this->assertStringNotContainsString('BaseContentRefactorMigration', $this->source);
    }

    public function testBackfillIsFaultIsolated(): void
    {
        // One bad element must not abort the migration (a thrown migration
        // triggers restore-on-failure, which can wipe the database).
        $this->assertMatchesRegularExpression(
            '/_backfillDescriptions[\s\S]*?try\s*\{[\s\S]*?catch\s*\(Throwable/',
            $this->source
        );
    }

    // ========================================================================= //
    // Dual-major field creation
    // ========================================================================= //

    public function testEnsureFieldBranchesGroupIdOnCraftMajor(): void
    {
        // Craft 4 requires a groupId for a global field; Craft 5 removed groups.
        // The Craft-major check routes through the Compat helper, not a raw version_compare.
        $this->assertMatchesRegularExpression(
            '/_ensureDescriptionField[\s\S]*?Compat::isCraft4\(\)[\s\S]*?groupId/',
            $this->source
        );
    }

    public function testEnsureFieldIsNonSearchable(): void
    {
        // Matches the native column (never indexed), so no reindex is needed.
        $this->assertStringContainsString('$field->searchable = false', $this->source);
    }

    // ========================================================================= //
    // Deploy-path safety: discriminate on config presence, not readOnly
    // ========================================================================= //
    //
    // The original migration branched on Craft::$app->getProjectConfig()->readOnly to
    // decide create-vs-apply. That is wrong: MigrateController sets readOnly = false for
    // the whole migration run whenever config changes are pending, which is exactly the
    // deploy case. So on a real production deploy the readOnly branch never fired, the
    // migration created a DUPLICATE field with a fresh uid, the readiness check failed,
    // and the description backfill silently skipped. Verified end-to-end in the
    // migration-test sandbox on 2026-07-20. The correct discriminator is whether the
    // field already exists in the deployed (external) project config.

    public function testDiscriminatesOnConfigPresenceNotReadOnly(): void
    {
        // Must decide create-vs-apply from the incoming external config, not readOnly.
        $this->assertMatchesRegularExpression(
            "/get\('fields',\s*true\)/",
            $this->source
        );
    }

    public function testEnsureFieldDoesNotBranchOnReadOnly(): void
    {
        // The readOnly flag is unreliable during migrations (Craft lifts it when config
        // is pending), so it must not gate the create-vs-apply decision.
        $this->assertDoesNotMatchRegularExpression(
            '/_ensureDescriptionField[\s\S]*?->readOnly/',
            $this->source
        );
    }

    public function testAppliesDeployedFieldInsteadOfCreatingDuplicate(): void
    {
        // When the field is already in config, apply it via processConfigChanges rather
        // than saveField (which would mint a second field).
        $this->assertMatchesRegularExpression(
            '/null !== \$incomingUid[\s\S]*?processConfigChanges\(.fields\./',
            $this->source
        );
    }

    public function testCraft4AppliesFieldGroupBeforeField(): void
    {
        // On Craft 4 the field references a fieldGroup by uid; apply the group first so
        // the field lands with a groupId rather than null.
        $this->assertMatchesRegularExpression(
            '/Compat::isCraft4\(\)[\s\S]*?processConfigChanges\(.fieldGroups\.[\s\S]*?processConfigChanges\(.fields\./',
            $this->source
        );
    }

    public function testForceAppliesLayoutNotEnsureAllFieldsProcessed(): void
    {
        // ensureAllFieldsProcessed() silently no-ops during migrate/all; only
        // processConfigChanges(path, force: true) applies config mid-migration.
        $this->assertMatchesRegularExpression(
            "/processConfigChanges\(FieldLayouts::PATH,\s*true\)/",
            $this->source
        );
    }

    public function testFieldExistenceGateBeforeDestructiveSteps(): void
    {
        // If the field still isn't present, skip the backfill + column drop and
        // return (never throw), so no Description data is stranded.
        $this->assertMatchesRegularExpression(
            '/getFieldByHandle\(self::FIELD_HANDLE\)[\s\S]*?Craft::warning[\s\S]*?return true/',
            $this->source
        );
    }

    public function testColumnDropIsGuarded(): void
    {
        // The native column is only dropped when it still exists (and after the
        // field-existence gate passed).
        $this->assertMatchesRegularExpression(
            "/columnExists\(self::TABLE,\s*'description'\)[\s\S]*?dropColumn\(self::TABLE,\s*'description'\)/",
            $this->source
        );
    }
}
