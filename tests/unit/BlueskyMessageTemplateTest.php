<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Structural tests for the Bluesky-notification edit template.
 *
 * The template posts the post body, the optional language tag, the
 * per-message queue lightswitch, and the link-preview toggle. Drift in
 * any of the form-field names silently breaks the server-side save path
 * (`_compileBluesky()` reads each key back off `messageConfig`).
 */
class BlueskyMessageTemplateTest extends TestCase
{
    private string $templateSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/templates/notifications/_edit/message/bluesky.twig';
        $this->assertTrue(file_exists($path), "bluesky.twig should exist at: $path");
        $this->templateSource = file_get_contents($path);
    }

    // ========================================================================= //
    // Canonical posted fields
    // ========================================================================= //

    public function testPostsBodyAsMessageConfigBlueskyBody(): void
    {
        $this->assertStringContainsString(
            "name: 'messageConfig[blueskyBody]'",
            $this->templateSource
        );
    }

    // ========================================================================= //
    // Link-preview toggle
    // ========================================================================= //

    public function testDefinesLinkCardLightswitch(): void
    {
        // The toggle posts as messageConfig[blueskyLinkCard]
        $this->assertStringContainsString(
            "name: 'messageConfig[blueskyLinkCard]'",
            $this->templateSource
        );
    }

    public function testLinkCardLightswitchDefaultsOn(): void
    {
        // A notification with no saved value defaults the toggle to on
        $this->assertMatchesRegularExpression(
            "/notification\.messageConfig\.blueskyLinkCard\s*\?\?\s*true/",
            $this->templateSource
        );
    }
}
