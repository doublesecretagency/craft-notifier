<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Reflection + source-level tests for the SettingsProvidersController.
 *
 * Confirms each render / save / test action exists and gates by admin.
 */
class SettingsProvidersControllerTest extends TestCase
{
    private string $controllerSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/controllers/SettingsProvidersController.php';
        $this->assertTrue(file_exists($path), "SettingsProvidersController.php should exist at: $path");
        $this->controllerSource = file_get_contents($path);
        $this->reflection = new ReflectionClass('doublesecretagency\\notifier\\controllers\\SettingsProvidersController');
    }

    // ========================================================================= //
    // Render actions
    // ========================================================================= //

    /**
     * @dataProvider providerRenderActions
     */
    public function testHasRenderAction(string $action): void
    {
        $this->assertTrue($this->reflection->hasMethod($action), "Missing render action: $action");
        $this->assertTrue($this->reflection->getMethod($action)->isPublic());
    }

    public static function providerRenderActions(): array
    {
        return [
            ['actionGeneral'],
            ['actionTwilio'],
            ['actionPushover'],
            ['actionNtfy'],
            ['actionSlack'],
            ['actionBluesky'],
        ];
    }

    // ========================================================================= //
    // Save + test actions
    // ========================================================================= //

    public function testHasSaveAction(): void
    {
        $this->assertTrue($this->reflection->hasMethod('actionSave'));
    }

    /**
     * @dataProvider providerTestActions
     */
    public function testHasTestAction(string $action): void
    {
        $this->assertTrue($this->reflection->hasMethod($action), "Missing test action: $action");
        $this->assertTrue($this->reflection->getMethod($action)->isPublic());
    }

    public static function providerTestActions(): array
    {
        return [
            ['actionTestNtfy'],
            ['actionTestSlack'],
            ['actionTestBluesky'],
        ];
    }

    // ========================================================================= //
    // Gating + security
    // ========================================================================= //

    public function testBeforeActionRequiresAdmin(): void
    {
        $this->assertStringContainsString('$this->requireAdmin();', $this->controllerSource);
    }

    public function testSaveActionRequiresPost(): void
    {
        // The save action gates on POST
        $this->assertMatchesRegularExpression(
            "/function\s+actionSave\s*\([^)]*\)[\s\S]*?\\\$this->requirePostRequest\\(\\);/",
            $this->controllerSource
        );
    }

    public function testSaveActionWhitelistsSection(): void
    {
        $this->assertStringContainsString("['general', 'twilio', 'pushover', 'ntfy', 'slack', 'bluesky']", $this->controllerSource);
    }

    public function testSaveActionAssignsUidsToNamedListRows(): void
    {
        $this->assertStringContainsString('_assignUids(', $this->controllerSource);
        $this->assertStringContainsString('StringHelper::UUID()', $this->controllerSource);
    }

    public function testTestSlackAcceptsJsonAndPost(): void
    {
        $this->assertMatchesRegularExpression(
            "/function\s+actionTestSlack[\s\S]*?requirePostRequest\\(\\)[\s\S]*?requireAcceptsJson\\(\\)/",
            $this->controllerSource
        );
    }

    public function testTestSlackValidatesWebhookHost(): void
    {
        $this->assertStringContainsString('OutboundSlack::isValidWebhookUrl(', $this->controllerSource);
    }

    public function testTestBlueskyUsesCreateSession(): void
    {
        $this->assertStringContainsString('BlueskySession::createSession(', $this->controllerSource);
    }

    public function testTestNtfyUsesGuzzleClient(): void
    {
        $this->assertStringContainsString('Craft::createGuzzleClient()', $this->controllerSource);
    }

    // ========================================================================= //
    // Credential handling
    // ========================================================================= //

    public function testSaveActionDoesNotEncryptCredentials(): void
    {
        // Credentials are persisted as-is (typically as $ENV_VAR references);
        // there is no at-rest encryption layer.
        $this->assertStringNotContainsString('encryptValue', $this->controllerSource);
        $this->assertStringNotContainsString('SENSITIVE_FIELDS', $this->controllerSource);
    }

    public function testTestActionsResolveEnvReferences(): void
    {
        // The Slack and Bluesky test actions resolve a $ENV_VAR reference before use
        $this->assertMatchesRegularExpression(
            "/function\s+actionTestSlack[\s\S]*?App::parseEnv\(/",
            $this->controllerSource
        );
        $this->assertMatchesRegularExpression(
            "/function\s+actionTestBluesky[\s\S]*?App::parseEnv\(/",
            $this->controllerSource
        );
    }
}
