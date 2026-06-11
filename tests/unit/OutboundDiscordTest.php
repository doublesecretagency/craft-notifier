<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\BaseEnvelope;
use doublesecretagency\notifier\models\OutboundDiscord;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit + source-level tests for the OutboundDiscord envelope, which posts
 * to a per-channel Discord webhook with optional username, avatar, and
 * suppress-embeds overrides.
 *
 * The live webhook POST cannot be exercised here (no Craft bootstrap, no real
 * webhook), so the send mechanics are verified at the source level. The
 * pure-unit half covers property defaults and the isValidWebhookUrl() validator.
 */
class OutboundDiscordTest extends TestCase
{
    private string $discordSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/OutboundDiscord.php';
        $this->assertTrue(file_exists($path), "OutboundDiscord.php should exist at: $path");
        $this->discordSource = file_get_contents($path);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsBaseEnvelope(): void
    {
        $reflection = new ReflectionClass(OutboundDiscord::class);
        $this->assertTrue($reflection->isSubclassOf(BaseEnvelope::class));
    }

    public function testHasSendMethod(): void
    {
        $reflection = new ReflectionClass(OutboundDiscord::class);
        $this->assertTrue($reflection->hasMethod('send'));
        $this->assertTrue($reflection->getMethod('send')->isPublic());
    }

    public function testDefaultProperties(): void
    {
        $env = new OutboundDiscord();

        $this->assertNull($env->webhookUrl);
        $this->assertNull($env->label);
        $this->assertSame('', $env->body);
        $this->assertSame('', $env->username);
        $this->assertSame('', $env->avatarUrl);
        $this->assertTrue($env->unfurlLinks);
    }

    public function testConstructorHydratesAllProperties(): void
    {
        $env = new OutboundDiscord([
            'webhookUrl'  => 'https://discord.com/api/webhooks/123/abc',
            'label'       => '#general',
            'body'        => '**hello**',
            'username'    => 'Notifier',
            'avatarUrl'   => 'https://example.com/avatar.png',
            'unfurlLinks' => false,
        ]);

        $this->assertSame('https://discord.com/api/webhooks/123/abc', $env->webhookUrl);
        $this->assertSame('#general', $env->label);
        $this->assertSame('**hello**', $env->body);
        $this->assertSame('Notifier', $env->username);
        $this->assertSame('https://example.com/avatar.png', $env->avatarUrl);
        $this->assertFalse($env->unfurlLinks);
    }

    // ========================================================================= //
    // Webhook URL validation (pure unit)
    // ========================================================================= //

    /**
     * @return array<string, array{?string, bool}>
     */
    public static function webhookUrlProvider(): array
    {
        return [
            'discord.com'        => ['https://discord.com/api/webhooks/123456789/AbC-dEf_123', true],
            'discordapp.com'     => ['https://discordapp.com/api/webhooks/123456789/AbC-dEf_123', true],
            'canary subdomain'   => ['https://canary.discord.com/api/webhooks/123/abc', true],
            'ptb subdomain'      => ['https://ptb.discord.com/api/webhooks/123/abc', true],
            'http not https'     => ['http://discord.com/api/webhooks/123/abc', false],
            'missing token'      => ['https://discord.com/api/webhooks/123', false],
            'slack webhook'      => ['https://hooks.slack.com/services/T/B/X', false],
            'random url'         => ['https://example.com/webhook', false],
            'empty string'       => ['', false],
            'null'               => [null, false],
        ];
    }

    /**
     * @dataProvider webhookUrlProvider
     */
    public function testIsValidWebhookUrl(?string $url, bool $expected): void
    {
        $this->assertSame($expected, OutboundDiscord::isValidWebhookUrl($url));
    }

    // ========================================================================= //
    // Source-level guards
    // ========================================================================= //

    public function testSendUsesCraftGuzzleClient(): void
    {
        $this->assertStringContainsString('Craft::createGuzzleClient()', $this->discordSource);
    }

    public function testSendResolvesWebhookUrlViaEnvParse(): void
    {
        // Webhook URL is resolved through App::parseEnv() so a $ENV_VAR reference works
        $this->assertStringContainsString('App::parseEnv($this->webhookUrl)', $this->discordSource);
    }

    public function testSendBailsWhenWebhookUrlMissing(): void
    {
        $this->assertMatchesRegularExpression('/if\s*\(\s*!\$webhookUrl\s*\)/', $this->discordSource);
    }

    public function testSendBailsWhenBodyEmpty(): void
    {
        $this->assertStringContainsString("'' === trim(\$this->body)", $this->discordSource);
    }

    public function testSendPreChecksTheTwoThousandCharacterLimit(): void
    {
        // Discord caps content at 2000 chars; the envelope must bail before sending
        $this->assertStringContainsString('mb_strlen($this->body) > 2000', $this->discordSource);
    }

    public function testSendUsesWaitTrueForConfirmableSuccess(): void
    {
        $this->assertStringContainsString("?wait=true", $this->discordSource);
    }

    public function testSendBasePayloadIsTheContent(): void
    {
        $this->assertMatchesRegularExpression(
            "/\\\$payload\s*=\s*\['content'\s*=>\s*\\\$this->body\]/",
            $this->discordSource
        );
    }

    public function testUsernameIsIncludedInPayloadWhenSet(): void
    {
        $this->assertMatchesRegularExpression(
            "/if\s*\(\s*''\s*!==\s*\\\$this->username\s*\)\s*\{[\s\S]*?\\\$payload\['username'\]\s*=\s*\\\$this->username[\s\S]*?\}/",
            $this->discordSource
        );
    }

    public function testAvatarUrlIsIncludedInPayloadWhenSet(): void
    {
        $this->assertMatchesRegularExpression(
            "/if\s*\(\s*''\s*!==\s*\\\$this->avatarUrl\s*\)\s*\{[\s\S]*?\\\$payload\['avatar_url'\]\s*=\s*\\\$this->avatarUrl[\s\S]*?\}/",
            $this->discordSource
        );
    }

    public function testEmbedsAreSuppressedWhenLightswitchIsOff(): void
    {
        // When unfurlLinks is false, the payload sets flags = 4 (SUPPRESS_EMBEDS)
        $this->assertMatchesRegularExpression(
            "/if\s*\(\s*!\\\$this->unfurlLinks\s*\)\s*\{[\s\S]*?\\\$payload\['flags'\]\s*=\s*4[\s\S]*?\}/",
            $this->discordSource
        );
    }

    public function testSendLogsSuccessAndError(): void
    {
        $this->assertStringContainsString('$notification->log->success(', $this->discordSource);
        $this->assertMatchesRegularExpression(
            '/\$notification->log->error\([^;]*\$this->envelopeId\)/',
            $this->discordSource
        );
    }

    public function testSendDoesNotLogTheWebhookUrl(): void
    {
        // Defense-in-depth: the webhook URL is a secret and must never appear in a log message.
        $this->assertStringNotContainsString('$this->webhookUrl}', $this->discordSource);
    }
}
