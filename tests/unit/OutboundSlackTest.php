<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\BaseEnvelope;
use doublesecretagency\notifier\models\OutboundSlack;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit + source-level tests for the OutboundSlack envelope, which posts
 * to Slack's chat.postMessage Web API endpoint with per-message icon, emoji,
 * username, and link-unfurl overrides.
 */
class OutboundSlackTest extends TestCase
{
    private string $slackSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/OutboundSlack.php';
        $this->assertTrue(file_exists($path), "OutboundSlack.php should exist at: $path");
        $this->slackSource = file_get_contents($path);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsBaseEnvelope(): void
    {
        $reflection = new ReflectionClass(OutboundSlack::class);
        $this->assertTrue($reflection->isSubclassOf(BaseEnvelope::class));
    }

    public function testHasSendMethod(): void
    {
        $reflection = new ReflectionClass(OutboundSlack::class);
        $this->assertTrue($reflection->hasMethod('send'));
        $this->assertTrue($reflection->getMethod('send')->isPublic());
    }

    public function testDefaultProperties(): void
    {
        $env = new OutboundSlack();

        $this->assertNull($env->botToken);
        $this->assertNull($env->channelId);
        $this->assertNull($env->label);
        $this->assertSame('', $env->body);
        $this->assertSame('', $env->iconUrl);
        $this->assertSame('', $env->iconEmoji);
        $this->assertSame('', $env->username);
        $this->assertTrue($env->unfurlLinks);
    }

    public function testConstructorHydratesAllProperties(): void
    {
        $env = new OutboundSlack([
            'botToken'    => 'xoxb-fake-token',
            'channelId'   => 'C01234ABCD',
            'label'       => '#engineering',
            'body'        => '*hello*',
            'iconUrl'     => 'https://example.com/icon.png',
            'iconEmoji'   => ':rocket:',
            'username'    => 'Notifier',
            'unfurlLinks' => false,
        ]);

        $this->assertSame('xoxb-fake-token', $env->botToken);
        $this->assertSame('C01234ABCD', $env->channelId);
        $this->assertSame('#engineering', $env->label);
        $this->assertSame('*hello*', $env->body);
        $this->assertSame('https://example.com/icon.png', $env->iconUrl);
        $this->assertSame(':rocket:', $env->iconEmoji);
        $this->assertSame('Notifier', $env->username);
        $this->assertFalse($env->unfurlLinks);
    }

    // ========================================================================= //
    // Bot token validation (pure unit)
    // ========================================================================= //

    public function testValidBotTokenAccepted(): void
    {
        $this->assertTrue(OutboundSlack::isValidBotToken('xoxb-1234567890-abcdefg'));
    }

    public function testBotTokenValidationRejectsOtherPrefixes(): void
    {
        $this->assertFalse(OutboundSlack::isValidBotToken('xoxp-not-a-bot-token'));
        $this->assertFalse(OutboundSlack::isValidBotToken('xapp-app-token'));
        $this->assertFalse(OutboundSlack::isValidBotToken('https://hooks.slack.com/services/x'));
    }

    public function testBotTokenValidationRejectsEmpty(): void
    {
        $this->assertFalse(OutboundSlack::isValidBotToken(null));
        $this->assertFalse(OutboundSlack::isValidBotToken(''));
    }

    // ========================================================================= //
    // Channel ID validation (pure unit)
    // ========================================================================= //

    public function testValidChannelIdAccepted(): void
    {
        $this->assertTrue(OutboundSlack::isValidChannelId('C01234ABCD'));
        $this->assertTrue(OutboundSlack::isValidChannelId('C9KJK3D26'));
        // D = DM, G = group
        $this->assertTrue(OutboundSlack::isValidChannelId('D01234ABCD'));
        $this->assertTrue(OutboundSlack::isValidChannelId('G01234ABCD'));
    }

    public function testChannelIdValidationRejectsBadPrefixesAndShapes(): void
    {
        $this->assertFalse(OutboundSlack::isValidChannelId('A01234ABCD'));   // wrong prefix
        $this->assertFalse(OutboundSlack::isValidChannelId('#engineering')); // a label, not an ID
        $this->assertFalse(OutboundSlack::isValidChannelId('C012-34-ABCD')); // hyphens not allowed
        $this->assertFalse(OutboundSlack::isValidChannelId('c01234ABCD'));   // lowercase prefix
    }

    public function testChannelIdValidationRejectsEmpty(): void
    {
        $this->assertFalse(OutboundSlack::isValidChannelId(null));
        $this->assertFalse(OutboundSlack::isValidChannelId(''));
    }

    // ========================================================================= //
    // Source-level guards
    // ========================================================================= //

    public function testSendUsesCraftGuzzleClient(): void
    {
        $this->assertStringContainsString('Craft::createGuzzleClient()', $this->slackSource);
    }

    public function testSendPostsToChatPostMessageEndpoint(): void
    {
        $this->assertStringContainsString("'https://slack.com/api/chat.postMessage'", $this->slackSource);
    }

    public function testSendUsesAuthorizationBearerHeader(): void
    {
        // Authorization: Bearer {botToken} after env-var resolution
        $this->assertMatchesRegularExpression(
            "/'Authorization'\s*=>\s*'Bearer\s*'\s*\.\s*\\\$botToken/",
            $this->slackSource
        );
    }

    public function testSendPayloadIncludesChannelAndMrkdwn(): void
    {
        // The base payload always includes the (resolved) channel, text, and mrkdwn.
        $this->assertMatchesRegularExpression(
            "/\\\$payload\s*=\s*\[\s*'channel'\s*=>\s*\\\$channelId,\s*'text'\s*=>\s*\\\$this->body,\s*'mrkdwn'\s*=>\s*true,?\s*\]/",
            $this->slackSource
        );
    }

    public function testSendSuccessChecksOkTrue(): void
    {
        // Slack returns {"ok": true, ...} on success
        $this->assertMatchesRegularExpression(
            "/true\s*!==\s*\(\\\$decoded\['ok'\]\s*\?\?\s*false\)/",
            $this->slackSource
        );
    }

    public function testSendLogsSlackErrorOnFailure(): void
    {
        // On failure, surface decoded.error in the notification log
        $this->assertStringContainsString('[REJECTED BY SLACK]', $this->slackSource);
    }

    public function testSendLogsSuccessAndError(): void
    {
        $this->assertStringContainsString('$notification->log->success(', $this->slackSource);
        $this->assertMatchesRegularExpression(
            '/\$notification->log->error\([^;]*\$this->envelopeId\)/',
            $this->slackSource
        );
    }

    public function testSendDoesNotLogTheBotToken(): void
    {
        // Defense-in-depth: the bot token must never appear in a log message.
        $this->assertStringNotContainsString('$this->botToken}', $this->slackSource);
    }

    public function testSendBailsWhenBotTokenMissing(): void
    {
        // send() must bail when the resolved bot token is empty
        $this->assertMatchesRegularExpression('/if\s*\(\s*!\$botToken\s*\)/', $this->slackSource);
    }

    public function testSendBailsWhenChannelIdMissing(): void
    {
        // The bail is on the resolved local, so a $ENV_VAR that resolves to empty also bails.
        $this->assertMatchesRegularExpression('/if\s*\(\s*!\$channelId\s*\)/', $this->slackSource);
    }

    public function testSendResolvesBotTokenViaEnvParse(): void
    {
        // Bot token is resolved through App::parseEnv() so a $ENV_VAR reference works
        $this->assertStringContainsString('App::parseEnv($this->botToken)', $this->slackSource);
    }

    public function testSendResolvesChannelIdViaEnvParse(): void
    {
        // Channel ID is also resolved through App::parseEnv() so a $ENV_VAR reference works
        $this->assertStringContainsString('App::parseEnv($this->channelId)', $this->slackSource);
    }

    public function testSendBailsWhenBodyEmpty(): void
    {
        $this->assertStringContainsString("'' === trim(\$this->body)", $this->slackSource);
    }

    // ========================================================================= //
    // Conditional payload fields
    // ========================================================================= //

    public function testIconUrlIsIncludedInPayloadWhenSet(): void
    {
        $this->assertMatchesRegularExpression(
            "/if\s*\(\s*''\s*!==\s*\\\$this->iconUrl\s*\)\s*\{[\s\S]*?\\\$payload\['icon_url'\]\s*=\s*\\\$this->iconUrl[\s\S]*?\}/",
            $this->slackSource
        );
    }

    public function testIconEmojiIsIncludedInPayloadWhenSet(): void
    {
        $this->assertMatchesRegularExpression(
            "/if\s*\(\s*''\s*!==\s*\\\$this->iconEmoji\s*\)\s*\{[\s\S]*?\\\$payload\['icon_emoji'\]\s*=\s*\\\$this->iconEmoji[\s\S]*?\}/",
            $this->slackSource
        );
    }

    public function testUsernameIsIncludedInPayloadWhenSet(): void
    {
        $this->assertMatchesRegularExpression(
            "/if\s*\(\s*''\s*!==\s*\\\$this->username\s*\)\s*\{[\s\S]*?\\\$payload\['username'\]\s*=\s*\\\$this->username[\s\S]*?\}/",
            $this->slackSource
        );
    }

    public function testUnfurlsAreSuppressedWhenLightswitchIsOff(): void
    {
        // When unfurlLinks is false, the payload turns off BOTH unfurl_links and unfurl_media.
        $this->assertMatchesRegularExpression(
            "/if\s*\(\s*!\\\$this->unfurlLinks\s*\)\s*\{[\s\S]*?\\\$payload\['unfurl_links'\]\s*=\s*false[\s\S]*?\\\$payload\['unfurl_media'\]\s*=\s*false[\s\S]*?\}/",
            $this->slackSource
        );
    }
}
