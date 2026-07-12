<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\web\Controller;
use doublesecretagency\notifier\controllers\SettingsFieldsController;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the notification field layout settings controller.
 *
 * SettingsFieldsController renders the field layout designer and saves the
 * assembled layout through the FieldLayouts service. It is admin-only and
 * guards the project-config write on read-only environments.
 */
class SettingsFieldsControllerTest extends TestCase
{
    private string $source;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/controllers/SettingsFieldsController.php';
        $this->assertTrue(file_exists($path), "SettingsFieldsController.php should exist at: $path");
        $this->source = file_get_contents($path);
        $this->reflection = new ReflectionClass(SettingsFieldsController::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsWebController(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Controller::class));
    }

    public function testRequiresAdmin(): void
    {
        // Managing the notification field layout is admin-only.
        $this->assertMatchesRegularExpression(
            '/beforeAction[\s\S]*?requireAdmin\(\)/',
            $this->source
        );
    }

    // ========================================================================= //
    // Render action
    // ========================================================================= //

    public function testHasFieldsAction(): void
    {
        $this->assertTrue($this->reflection->hasMethod('actionFields'));
        $this->assertTrue($this->reflection->getMethod('actionFields')->isPublic());
    }

    public function testFieldsActionRendersLayoutWithDesigner(): void
    {
        // Renders the shared settings layout with the persisted field layout.
        $this->assertMatchesRegularExpression(
            "/actionFields[\s\S]*?notifier\/_settings\/_layout[\s\S]*?'fieldLayout'\s*=>[\s\S]*?fieldLayouts->getLayout\(\)/",
            $this->source
        );
    }

    // ========================================================================= //
    // Save action
    // ========================================================================= //

    public function testHasSaveFieldLayoutAction(): void
    {
        $this->assertTrue($this->reflection->hasMethod('actionSaveFieldLayout'));
        $this->assertTrue($this->reflection->getMethod('actionSaveFieldLayout')->isPublic());
    }

    public function testSaveGuardsReadOnlyProjectConfig(): void
    {
        // On a read-only environment the layout can't be saved from the CP; the
        // action rejects it rather than letting the project-config write throw.
        $this->assertMatchesRegularExpression(
            '/actionSaveFieldLayout[\s\S]*?getProjectConfig\(\)->readOnly[\s\S]*?throw new ForbiddenHttpException/',
            $this->source
        );
    }

    public function testSaveAssemblesLayoutAndReservesHandles(): void
    {
        // The layout is assembled from POST, bound to the element type, and the
        // notification's own attribute handles are reserved so a custom field
        // can't shadow them.
        $this->assertMatchesRegularExpression(
            '/assembleLayoutFromPost\(\)[\s\S]*?\$layout->type\s*=\s*Notification::class[\s\S]*?\$layout->reservedFieldHandles\s*=\s*Notification::reservedFieldHandles\(\)/',
            $this->source
        );
    }

    public function testSaveDelegatesToFieldLayoutsService(): void
    {
        // Persistence goes through the plugin's FieldLayouts service.
        $this->assertMatchesRegularExpression(
            '/fieldLayouts->saveLayout\(\$layout\)/',
            $this->source
        );
    }
}
