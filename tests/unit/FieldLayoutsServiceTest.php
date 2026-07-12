<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Component;
use doublesecretagency\notifier\services\FieldLayouts;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the FieldLayouts service.
 *
 * FieldLayouts owns the single, project-config-backed field layout for the
 * Notification element type. It mirrors Craft's own User-field-layout pattern
 * (save into project config, rebuild via the apply handler), so these tests
 * pin the public surface and the project-config wiring at the source level.
 */
class FieldLayoutsServiceTest extends TestCase
{
    private string $source;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/services/FieldLayouts.php';
        $this->assertTrue(file_exists($path), "FieldLayouts.php should exist at: $path");
        $this->source = file_get_contents($path);
        $this->reflection = new ReflectionClass(FieldLayouts::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsComponent(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Component::class));
    }

    public function testProjectConfigPathConstant(): void
    {
        // The bare (non-{uid}) path mirrors Craft's users.fieldLayouts pattern,
        // so processConfigChanges(PATH, force) can force-apply it during a migration.
        $this->assertSame('notifier.fieldLayout', FieldLayouts::PATH);
    }

    // ========================================================================= //
    // Public surface
    // ========================================================================= //

    public function testHasGetLayoutMethod(): void
    {
        $this->assertTrue($this->reflection->hasMethod('getLayout'));
        $this->assertTrue($this->reflection->getMethod('getLayout')->isPublic());
    }

    public function testGetLayoutResolvesByType(): void
    {
        // Resolves the persisted layout via getLayoutByType(), which returns a
        // non-null, type-bound layout even when nothing is saved.
        $this->assertMatchesRegularExpression(
            '/getLayout\(\)[\s\S]*?getLayoutByType\(Notification::class\)/',
            $this->source
        );
    }

    public function testSaveLayoutBindsTypeAndWritesProjectConfig(): void
    {
        // The layout must be bound to the element type and written to project
        // config keyed by uid (mirrors Users::saveLayout).
        $this->assertMatchesRegularExpression(
            '/saveLayout[\s\S]*?\$layout->type\s*=\s*Notification::class/',
            $this->source
        );
        $this->assertMatchesRegularExpression(
            '/saveLayout[\s\S]*?getProjectConfig\(\)->set\(self::PATH/',
            $this->source
        );
    }

    public function testSaveLayoutValidatesByDefault(): void
    {
        // Validation runs by default so reservedFieldHandles / duplicate-handle
        // errors block the save.
        $this->assertMatchesRegularExpression(
            '/saveLayout[\s\S]*?\$runValidation\s*&&\s*!\$layout->validate\(\)/',
            $this->source
        );
    }

    public function testHandleChangedLayoutDeletesWhenEmpty(): void
    {
        // Removing the config deletes the layout for the element type.
        $this->assertMatchesRegularExpression(
            '/handleChangedLayout[\s\S]*?empty\(\$data\)[\s\S]*?deleteLayoutsByType\(Notification::class\)/',
            $this->source
        );
    }

    public function testHandleChangedLayoutRebuildsFromConfig(): void
    {
        // Otherwise it rebuilds from the incoming config, mirroring Craft's
        // handleChangedUserFieldLayout (createFromConfig + id/type/uid + saveLayout).
        $this->assertMatchesRegularExpression(
            '/handleChangedLayout[\s\S]*?ensureAllFieldsProcessed\(\)[\s\S]*?createFromConfig\([\s\S]*?saveLayout\(\$layout,\s*false\)/',
            $this->source
        );
    }
}
