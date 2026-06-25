<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\BaseEnvelope;
use doublesecretagency\notifier\models\OutboundLinkedin;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit + source-level tests for the OutboundLinkedin envelope, which
 * publishes a post to a member feed or organization page via LinkedIn's
 * Posts API.
 *
 * The live API call cannot be exercised here (no Craft bootstrap, no token),
 * so the send mechanics are verified at the source level. The pure-unit half
 * covers property defaults and constructor hydration. The token itself is
 * fetched at send time from the connections service, so this envelope carries
 * only the connection UID and author URN, never a raw access token.
 */
class OutboundLinkedinTest extends TestCase
{
    private string $linkedinSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/OutboundLinkedin.php';
        $this->assertTrue(file_exists($path), "OutboundLinkedin.php should exist at: $path");
        $this->linkedinSource = file_get_contents($path);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsBaseEnvelope(): void
    {
        $reflection = new ReflectionClass(OutboundLinkedin::class);
        $this->assertTrue($reflection->isSubclassOf(BaseEnvelope::class));
    }

    public function testHasSendMethod(): void
    {
        $reflection = new ReflectionClass(OutboundLinkedin::class);
        $this->assertTrue($reflection->hasMethod('send'));
        $this->assertTrue($reflection->getMethod('send')->isPublic());
    }

    public function testDefaultProperties(): void
    {
        $env = new OutboundLinkedin();

        $this->assertNull($env->connectionUid);
        $this->assertNull($env->authorUrn);
        $this->assertNull($env->label);
        $this->assertSame('', $env->body);
        $this->assertSame('', $env->link);
    }

    public function testConstructorHydratesAllProperties(): void
    {
        $env = new OutboundLinkedin([
            'connectionUid' => 'abc-123',
            'authorUrn'     => 'urn:li:person:XYZ',
            'label'         => 'My LinkedIn Profile',
            'body'          => 'Hello, LinkedIn!',
            'link'          => 'https://example.com/article',
        ]);

        $this->assertSame('abc-123', $env->connectionUid);
        $this->assertSame('urn:li:person:XYZ', $env->authorUrn);
        $this->assertSame('My LinkedIn Profile', $env->label);
        $this->assertSame('Hello, LinkedIn!', $env->body);
        $this->assertSame('https://example.com/article', $env->link);
    }

    // ========================================================================= //
    // Source-level guards
    // ========================================================================= //

    public function testSendFetchesTokenFromTheConnectionsService(): void
    {
        // The access token is never stored on the envelope. It is fetched fresh
        // (and refreshed if needed) from the connections service at send time.
        $this->assertStringContainsString('linkedinConnections->getSendableToken(', $this->linkedinSource);
    }

    public function testSendPostsViaTheLinkedinClient(): void
    {
        $this->assertStringContainsString('LinkedinClient::post(', $this->linkedinSource);
    }

    public function testSendBailsWhenConnectionMissing(): void
    {
        $this->assertMatchesRegularExpression('/if\s*\(\s*!\$this->connectionUid\s*\|\|\s*!\$this->authorUrn\s*\)/', $this->linkedinSource);
    }

    public function testSendBailsWhenBodyEmpty(): void
    {
        $this->assertStringContainsString("'' === trim(\$this->body)", $this->linkedinSource);
    }

    public function testSendLogsReconnectRequiredWhenNoToken(): void
    {
        // A missing or unrefreshable token surfaces as a clear "reconnect" error.
        $this->assertStringContainsString('[RECONNECT REQUIRED]', $this->linkedinSource);
    }

    public function testSendLogsSuccessAndError(): void
    {
        $this->assertStringContainsString('$notification->log->success(', $this->linkedinSource);
        $this->assertMatchesRegularExpression(
            '/\$notification->log->error\([^;]*\$this->envelopeId\)/',
            $this->linkedinSource
        );
    }

    public function testSendNeverStoresAnAccessTokenProperty(): void
    {
        // Defense-in-depth: the envelope carries no access token property at all,
        // so a raw token can never be serialized into a queued job payload.
        $reflection = new ReflectionClass(OutboundLinkedin::class);
        $this->assertFalse($reflection->hasProperty('accessToken'));
    }
}
