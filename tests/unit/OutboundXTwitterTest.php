<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\BaseEnvelope;
use doublesecretagency\notifier\models\OutboundXTwitter;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit + source-level tests for the OutboundXTwitter envelope, which
 * posts to X (Twitter) via an OAuth 1.0a-signed POST to /2/tweets.
 *
 * The live API call cannot be exercised here (no Craft bootstrap, no real
 * billed X account), so the send mechanics are verified at the source level.
 * The pure-unit half covers property defaults, constants, and hydration.
 */
class OutboundXTwitterTest extends TestCase
{
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/OutboundXTwitter.php';
        $this->assertTrue(file_exists($path), "OutboundXTwitter.php should exist at: $path");
        $this->source = file_get_contents($path);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsBaseEnvelope(): void
    {
        $reflection = new ReflectionClass(OutboundXTwitter::class);
        $this->assertTrue($reflection->isSubclassOf(BaseEnvelope::class));
    }

    public function testHasPublicSendMethod(): void
    {
        $reflection = new ReflectionClass(OutboundXTwitter::class);
        $this->assertTrue($reflection->hasMethod('send'));
        $this->assertTrue($reflection->getMethod('send')->isPublic());
    }

    public function testCharacterAndImageLimits(): void
    {
        // X caps a post body at 280 characters and an attachment set at 4 images.
        $this->assertSame(280, OutboundXTwitter::MAX_LENGTH);
        $this->assertSame(4, OutboundXTwitter::MAX_IMAGES);
    }

    public function testDefaultProperties(): void
    {
        $defaults = (new ReflectionClass(OutboundXTwitter::class))->getDefaultProperties();

        $this->assertNull($defaults['consumerKey']);
        $this->assertNull($defaults['consumerKeySecret']);
        $this->assertNull($defaults['accessToken']);
        $this->assertNull($defaults['accessTokenSecret']);
        $this->assertNull($defaults['label']);
        $this->assertSame('', $defaults['body']);
        $this->assertSame([], $defaults['media']);
    }

    public function testConstructorHydratesAllProperties(): void
    {
        $env = new OutboundXTwitter([
            'consumerKey'       => 'ak',
            'consumerKeySecret' => 'as',
            'accessToken'       => 'at',
            'accessTokenSecret' => 'ats',
            'label'             => '@company',
            'body'              => 'Hello, world!',
        ]);

        $this->assertSame('ak', $env->consumerKey);
        $this->assertSame('as', $env->consumerKeySecret);
        $this->assertSame('at', $env->accessToken);
        $this->assertSame('ats', $env->accessTokenSecret);
        $this->assertSame('@company', $env->label);
        $this->assertSame('Hello, world!', $env->body);
    }

    // ========================================================================= //
    // Source-level guards
    // ========================================================================= //

    public function testSignsWithOAuth1Signer(): void
    {
        $this->assertStringContainsString('OAuth1Signer::authorizationHeader(', $this->source);
    }

    public function testPostsToTweetsEndpoint(): void
    {
        $this->assertStringContainsString('https://api.x.com/2/tweets', $this->source);
    }

    public function testUploadsMediaToTheUploadEndpoint(): void
    {
        $this->assertStringContainsString('https://upload.twitter.com/1.1/media/upload.json', $this->source);
    }

    public function testResolvesAllFourCredentialsViaEnvParse(): void
    {
        $this->assertStringContainsString('App::parseEnv($this->consumerKey)', $this->source);
        $this->assertStringContainsString('App::parseEnv($this->consumerKeySecret)', $this->source);
        $this->assertStringContainsString('App::parseEnv($this->accessToken)', $this->source);
        $this->assertStringContainsString('App::parseEnv($this->accessTokenSecret)', $this->source);
    }

    public function testTruncatesBodyToMaxLength(): void
    {
        // Over-length bodies are cut with mb_substr to the 280-char limit.
        $this->assertMatchesRegularExpression(
            '/mb_strlen\(\$body\)\s*>\s*static::MAX_LENGTH/',
            $this->source
        );
        $this->assertStringContainsString('mb_substr($body, 0, static::MAX_LENGTH)', $this->source);
    }

    public function testBailsWhenBodyEmptyAndNoMedia(): void
    {
        // A post must carry text or at least one uploaded image.
        $this->assertMatchesRegularExpression(
            "/'' === trim\(\\\$body\)\s*&&\s*!\\\$mediaIds/",
            $this->source
        );
    }

    public function testVideoAttachmentsAreSkippedAsUnsupported(): void
    {
        $this->assertStringContainsString('Videos are not yet supported on {channel}.', $this->source);
    }

    public function testLogsSuccessAndError(): void
    {
        $this->assertStringContainsString('$notification->log->success(', $this->source);
        $this->assertMatchesRegularExpression(
            '/\$notification->log->error\([^;]*\$this->envelopeId\)/',
            $this->source
        );
    }
}
