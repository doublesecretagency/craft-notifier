<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\BaseEnvelope;
use doublesecretagency\notifier\models\OutboundSlack;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit + source-level tests for the OutboundSlack envelope.
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

        $this->assertNull($env->webhookUrl);
        $this->assertNull($env->label);
        $this->assertSame('', $env->body);
    }

    public function testConstructorHydratesAllProperties(): void
    {
        $env = new OutboundSlack([
            'webhookUrl' => 'https://hooks.slack.com/services/T0/B0/X0',
            'label'      => 'engineering',
            'body'       => '*hello*',
        ]);

        $this->assertSame('https://hooks.slack.com/services/T0/B0/X0', $env->webhookUrl);
        $this->assertSame('engineering', $env->label);
        $this->assertSame('*hello*', $env->body);
    }

    // ========================================================================= //
    // Webhook URL validation (pure unit)
    // ========================================================================= //

    public function testValidWebhookUrlAccepted(): void
    {
        $this->assertTrue(OutboundSlack::isValidWebhookUrl('https://hooks.slack.com/services/T0/B0/X0'));
    }

    public function testValidationRejectsNonSlackHost(): void
    {
        $this->assertFalse(OutboundSlack::isValidWebhookUrl('https://hooks.evil.com/services/x'));
        $this->assertFalse(OutboundSlack::isValidWebhookUrl('https://slack.com/foo'));
    }

    public function testValidationRejectsHttp(): void
    {
        $this->assertFalse(OutboundSlack::isValidWebhookUrl('http://hooks.slack.com/services/T0/B0/X0'));
    }

    public function testValidationRejectsEmpty(): void
    {
        $this->assertFalse(OutboundSlack::isValidWebhookUrl(null));
        $this->assertFalse(OutboundSlack::isValidWebhookUrl(''));
    }

    // ========================================================================= //
    // Source-level guards
    // ========================================================================= //

    public function testSendUsesCraftGuzzleClient(): void
    {
        $this->assertStringContainsString('Craft::createGuzzleClient()', $this->slackSource);
    }

    public function testSendPostsJsonWithMrkdwn(): void
    {
        $this->assertStringContainsString("'mrkdwn' => true", $this->slackSource);
        $this->assertStringContainsString("'text'", $this->slackSource);
    }

    public function testSendValidatesWebhookHost(): void
    {
        // Must invoke isValidWebhookUrl before posting
        $this->assertStringContainsString('isValidWebhookUrl(', $this->slackSource);
    }

    public function testSendChecksStatusAndOkBody(): void
    {
        // Slack returns 200 + "ok"
        $this->assertMatchesRegularExpression('/200\s*!==\s*\$status\s*\|\|\s*[\'"]ok[\'"]\s*!==\s*\$rawBody/', $this->slackSource);
    }

    public function testSendLogsSuccessAndError(): void
    {
        $this->assertStringContainsString('$notification->log->success(', $this->slackSource);
        $this->assertMatchesRegularExpression(
            '/\$notification->log->error\([^;]*\$this->envelopeId\)/',
            $this->slackSource
        );
    }

    public function testSendDoesNotLogTheWebhookUrl(): void
    {
        // Defense-in-depth: the URL should never end up in a log message.
        // Verify log message strings don't reference the webhook URL directly.
        $this->assertStringNotContainsString('$this->webhookUrl}', $this->slackSource);
    }

    public function testSendBailsWhenWebhookUrlMissing(): void
    {
        // send() must bail (and log) before posting when the resolved webhook URL is empty
        $this->assertMatchesRegularExpression('/if\s*\(\s*!\$webhookUrl\s*\)/', $this->slackSource);
    }

    public function testSendResolvesWebhookUrlViaEnvParse(): void
    {
        // The webhook URL is resolved through App::parseEnv() so a $ENV_VAR reference works
        $this->assertStringContainsString('App::parseEnv($this->webhookUrl)', $this->slackSource);
    }

    public function testSendBailsWhenBodyEmpty(): void
    {
        // A whitespace-only body must short-circuit before the POST
        $this->assertStringContainsString("'' === trim(\$this->body)", $this->slackSource);
    }
}
