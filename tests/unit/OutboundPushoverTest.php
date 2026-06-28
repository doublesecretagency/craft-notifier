<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\BaseEnvelope;
use doublesecretagency\notifier\models\OutboundPushover;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit + source-level tests for the OutboundPushover envelope.
 */
class OutboundPushoverTest extends TestCase
{
    private string $pushoverSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/OutboundPushover.php';
        $this->assertTrue(file_exists($path), "OutboundPushover.php should exist at: $path");
        $this->pushoverSource = file_get_contents($path);
    }

    public function testExtendsBaseEnvelope(): void
    {
        $reflection = new ReflectionClass(OutboundPushover::class);
        $this->assertTrue($reflection->isSubclassOf(BaseEnvelope::class));
    }

    public function testHasSendMethod(): void
    {
        $reflection = new ReflectionClass(OutboundPushover::class);
        $this->assertTrue($reflection->hasMethod('send'));
        $this->assertTrue($reflection->getMethod('send')->isPublic());
    }

    public function testDefaultProperties(): void
    {
        $env = new OutboundPushover();

        $this->assertNull($env->userKey);
        $this->assertNull($env->recipientName);
        $this->assertSame('', $env->title);
        $this->assertSame('', $env->body);
    }

    public function testEndpointConstant(): void
    {
        $this->assertSame('https://api.pushover.net/1/messages.json', OutboundPushover::ENDPOINT);
    }

    // ========================================================================= //
    // Source-level guards
    // ========================================================================= //

    public function testSendUsesCraftGuzzleClient(): void
    {
        $this->assertStringContainsString('Craft::createGuzzleClient()', $this->pushoverSource);
    }

    public function testSendPostsFormEncoded(): void
    {
        // Pushover's API takes form-encoded fields, not JSON
        $this->assertStringContainsString("'form_params'", $this->pushoverSource);
        $this->assertStringContainsString("'token'", $this->pushoverSource);
        $this->assertStringContainsString("'user'", $this->pushoverSource);
        $this->assertStringContainsString("'message'", $this->pushoverSource);
    }

    public function testSendUsesEnvParseForAppToken(): void
    {
        $this->assertStringContainsString('App::parseEnv($settings->pushoverApplicationToken)', $this->pushoverSource);
    }

    public function testSendChecksPushoverStatusField(): void
    {
        // Pushover returns {"status": 1} on success
        $this->assertMatchesRegularExpression('/\$pushoverStatus\s*=\s*\(/', $this->pushoverSource);
        $this->assertStringContainsString("'status'", $this->pushoverSource);
    }

    public function testSendBailsWhenUserKeyMissing(): void
    {
        $this->assertMatchesRegularExpression('/if\s*\(\s*!\$this->userKey\s*\)/', $this->pushoverSource);
    }

    public function testSendLogsSuccessAndError(): void
    {
        $this->assertStringContainsString('$notification->log->success(', $this->pushoverSource);
        $this->assertMatchesRegularExpression(
            '/\$notification->log->error\([^;]*\$this->envelopeId\)/',
            $this->pushoverSource
        );
    }

    public function testSendDoesNotLogTheUserKey(): void
    {
        $this->assertStringNotContainsString('$this->userKey}', $this->pushoverSource);
    }

    public function testSendBailsWhenAppTokenMissing(): void
    {
        // A missing app token must bail before the POST, with a docs-linked error
        $this->assertStringContainsString('if (!$appToken)', $this->pushoverSource);
        $this->assertStringContainsString('getting-started/integrations/pushover', $this->pushoverSource);
    }

    public function testSendSurfacesPushoverErrorArray(): void
    {
        // Pushover returns an `errors` array on failure; the log reason is joined from it
        $this->assertStringContainsString("\$payload['errors']", $this->pushoverSource);
        $this->assertStringContainsString("implode(', ', \$errors)", $this->pushoverSource);
    }

    public function testSuccessMessageNamesRecipient(): void
    {
        // The success log names the recipient via the {name} placeholder,
        // populated from the recipientName property the compiler sets.
        $this->assertStringContainsString('Successfully sent a Pushover notification to {name}.', $this->pushoverSource);
        $this->assertStringContainsString("'name' => \$this->recipientName", $this->pushoverSource);
    }
}
