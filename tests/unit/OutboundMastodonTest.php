<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\BaseEnvelope;
use doublesecretagency\notifier\models\OutboundMastodon;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit + source-level tests for the OutboundMastodon envelope, which
 * publishes a status to a Mastodon instance via a bearer-authenticated POST.
 *
 * The live API call cannot be exercised here (no Craft bootstrap, no instance),
 * so the send mechanics are verified at the source level. The pure-unit half
 * covers property defaults and constructor hydration.
 */
class OutboundMastodonTest extends TestCase
{
    private string $mastodonSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/OutboundMastodon.php';
        $this->assertTrue(file_exists($path), "OutboundMastodon.php should exist at: $path");
        $this->mastodonSource = file_get_contents($path);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsBaseEnvelope(): void
    {
        $reflection = new ReflectionClass(OutboundMastodon::class);
        $this->assertTrue($reflection->isSubclassOf(BaseEnvelope::class));
    }

    public function testHasSendMethod(): void
    {
        $reflection = new ReflectionClass(OutboundMastodon::class);
        $this->assertTrue($reflection->hasMethod('send'));
        $this->assertTrue($reflection->getMethod('send')->isPublic());
    }

    public function testDefaultProperties(): void
    {
        $env = new OutboundMastodon();

        $this->assertNull($env->instanceUrl);
        $this->assertNull($env->accessToken);
        $this->assertNull($env->label);
        $this->assertSame('', $env->body);
        $this->assertSame('public', $env->visibility);
    }

    public function testConstructorHydratesAllProperties(): void
    {
        $env = new OutboundMastodon([
            'instanceUrl' => 'https://mastodon.social',
            'accessToken' => 'token-123',
            'label'       => '@team@mastodon.social',
            'body'        => 'Hello, fediverse!',
            'visibility'  => 'unlisted',
        ]);

        $this->assertSame('https://mastodon.social', $env->instanceUrl);
        $this->assertSame('token-123', $env->accessToken);
        $this->assertSame('@team@mastodon.social', $env->label);
        $this->assertSame('Hello, fediverse!', $env->body);
        $this->assertSame('unlisted', $env->visibility);
    }

    // ========================================================================= //
    // Source-level guards
    // ========================================================================= //

    public function testSendUsesCraftGuzzleClient(): void
    {
        $this->assertStringContainsString('Craft::createGuzzleClient()', $this->mastodonSource);
    }

    public function testSendPostsToStatusesEndpoint(): void
    {
        $this->assertStringContainsString("/api/v1/statuses", $this->mastodonSource);
    }

    public function testSendResolvesCredentialsViaEnvParse(): void
    {
        $this->assertStringContainsString('App::parseEnv($this->instanceUrl)', $this->mastodonSource);
        $this->assertStringContainsString('App::parseEnv($this->accessToken)', $this->mastodonSource);
    }

    public function testSendUsesAuthorizationBearerHeader(): void
    {
        $this->assertMatchesRegularExpression(
            "/'Authorization'\s*=>\s*'Bearer\s*'\s*\.\s*\\\$accessToken/",
            $this->mastodonSource
        );
    }

    public function testSendPayloadIncludesStatusAndVisibility(): void
    {
        $this->assertMatchesRegularExpression(
            "/'status'\s*=>\s*\\\$this->body,\s*'visibility'\s*=>\s*\\\$this->visibility/",
            $this->mastodonSource
        );
    }

    public function testSendBailsWhenInstanceUrlMissing(): void
    {
        $this->assertMatchesRegularExpression('/if\s*\(\s*!\$instanceUrl\s*\)/', $this->mastodonSource);
    }

    public function testSendBailsWhenAccessTokenMissing(): void
    {
        $this->assertMatchesRegularExpression('/if\s*\(\s*!\$accessToken\s*\)/', $this->mastodonSource);
    }

    public function testSendBailsWhenBodyEmpty(): void
    {
        $this->assertStringContainsString("'' === trim(\$this->body)", $this->mastodonSource);
    }

    public function testSendChecksForIdOnSuccess(): void
    {
        // A successful post returns an object with an `id`; its absence is a failure.
        $this->assertStringContainsString("isset(\$decoded['id'])", $this->mastodonSource);
    }

    public function testSendLogsSuccessAndError(): void
    {
        $this->assertStringContainsString('$notification->log->success(', $this->mastodonSource);
        $this->assertMatchesRegularExpression(
            '/\$notification->log->error\([^;]*\$this->envelopeId\)/',
            $this->mastodonSource
        );
    }

    public function testSendDoesNotLogTheAccessToken(): void
    {
        // Defense-in-depth: the access token is a secret and must never appear in a log message.
        $this->assertStringNotContainsString('$this->accessToken}', $this->mastodonSource);
    }

    // ========================================================================= //
    // Image upload (media)
    // ========================================================================= //

    public function testUploadsMediaToTheV2MediaEndpoint(): void
    {
        // Images are uploaded to Mastodon's v2 media endpoint.
        $this->assertStringContainsString('/api/v2/media', $this->mastodonSource);
    }

    public function testAttachesUploadedMediaIdsToTheStatus(): void
    {
        // Successfully uploaded media IDs are attached to the status payload.
        $this->assertStringContainsString("\$payload['media_ids'] = \$mediaIds", $this->mastodonSource);
    }

    public function testA403MediaUploadHintsAtTheWriteMediaScope(): void
    {
        // A 403 means the token can post statuses but cannot upload media, so the
        // error points the user at the missing write:media scope (the common cause).
        $this->assertStringContainsString('403 === $status', $this->mastodonSource);
        $this->assertStringContainsString('write:media', $this->mastodonSource);
    }
}
