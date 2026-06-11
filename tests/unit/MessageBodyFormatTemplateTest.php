<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Source-level checks that the Slack and Discord "Render Message Body as HTML"
 * lightswitches post the value the rest of the system expects.
 *
 * Craft's lightswitch defaults its on-value to "1" when no `value` is set.
 * Everything downstream of these toggles compares against the string 'html':
 * the template's own reload check (`(... ?? 'markdown') == 'html'`) and the
 * dispatch gate (`'html' === (... ?? 'markdown')` in Dispatch.php). With the
 * default "1", toggling on stores "1", which never equals 'html', so the
 * switch silently reverts to off on every save and HTML rendering never fires.
 *
 * The fix is an explicit `value: 'html'` on each lightswitchField. These tests
 * pin that on-value so the default-"1" regression can't quietly come back.
 *
 * No Craft bootstrap. Reads the Twig templates as text and asserts the wiring
 * by regex, since rendering them would require the full Notifier runtime.
 */
class MessageBodyFormatTemplateTest extends TestCase
{
    /**
     * Each row is [provider, template path relative to src, messageConfig field].
     *
     * @return array<string, array{0: string, 1: string, 2: string}>
     */
    public static function bodyFormatToggleProvider(): array
    {
        return [
            'discord' => ['Discord', 'discord.twig', 'discordBodyFormat'],
            'slack'   => ['Slack', 'slack.twig', 'slackBodyFormat'],
        ];
    }

    private function source(string $template): string
    {
        $path = dirname(__DIR__, 2) . "/src/templates/notifications/_edit/message/{$template}";
        $this->assertTrue(file_exists($path), "{$template} should exist at: $path");
        return file_get_contents($path);
    }

    // ========================================================================= //
    // On-value
    // ========================================================================= //

    /**
     * @dataProvider bodyFormatToggleProvider
     */
    public function testLightswitchPostsHtmlAsItsOnValue(string $provider, string $template, string $field): void
    {
        // The lightswitch must declare value: 'html' right alongside its name,
        // otherwise it falls back to Craft's default on-value of "1"
        $this->assertMatchesRegularExpression(
            "/name:\s*'messageConfig\[{$field}\]',\s*value:\s*'html',/",
            $this->source($template),
            "{$provider} body-format lightswitch must post 'html' as its on-value"
        );
    }

    // ========================================================================= //
    // Reload coupling
    // ========================================================================= //

    /**
     * @dataProvider bodyFormatToggleProvider
     */
    public function testReloadStateComparesAgainstHtml(string $provider, string $template, string $field): void
    {
        // The on: state reads back by comparing the saved value to 'html',
        // so the posted on-value and this comparison must stay in lockstep
        $this->assertMatchesRegularExpression(
            "/\(notification\.messageConfig\.{$field} \?\? 'markdown'\) == 'html'/",
            $this->source($template),
            "{$provider} reload check must compare the saved value against 'html'"
        );
    }
}
