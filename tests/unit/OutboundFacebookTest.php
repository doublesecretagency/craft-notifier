<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\models\BaseEnvelope;
use doublesecretagency\notifier\models\OutboundFacebook;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit + source-level tests for the OutboundFacebook envelope, which
 * posts to a Facebook Page through the Meta Graph API.
 *
 * The live Graph call cannot be exercised here (no Craft bootstrap, no real
 * Page token), so the send mechanics are verified at the source level. The
 * pure-unit half covers property defaults and hydration.
 */
class OutboundFacebookTest extends TestCase
{
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/OutboundFacebook.php';
        $this->assertTrue(file_exists($path), "OutboundFacebook.php should exist at: $path");
        $this->source = file_get_contents($path);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsBaseEnvelope(): void
    {
        $reflection = new ReflectionClass(OutboundFacebook::class);
        $this->assertTrue($reflection->isSubclassOf(BaseEnvelope::class));
    }

    public function testHasPublicSendMethod(): void
    {
        $reflection = new ReflectionClass(OutboundFacebook::class);
        $this->assertTrue($reflection->hasMethod('send'));
        $this->assertTrue($reflection->getMethod('send')->isPublic());
    }

    public function testDefaultProperties(): void
    {
        $defaults = (new ReflectionClass(OutboundFacebook::class))->getDefaultProperties();

        $this->assertNull($defaults['pageId']);
        $this->assertNull($defaults['pageAccessToken']);
        $this->assertNull($defaults['label']);
        $this->assertSame('', $defaults['body']);
        $this->assertSame('', $defaults['link']);
        $this->assertSame([], $defaults['media']);
    }

    public function testConstructorHydratesAllProperties(): void
    {
        $env = new OutboundFacebook([
            'pageId'          => '123',
            'pageAccessToken' => 'token',
            'label'           => 'Company Page',
            'body'            => 'Hello!',
            'link'            => 'https://example.com',
        ]);

        $this->assertSame('123', $env->pageId);
        $this->assertSame('token', $env->pageAccessToken);
        $this->assertSame('Company Page', $env->label);
        $this->assertSame('Hello!', $env->body);
        $this->assertSame('https://example.com', $env->link);
    }

    // ========================================================================= //
    // Source-level guards
    // ========================================================================= //

    public function testPostsViaMetaGraphHelper(): void
    {
        // Feed posts and photo posts both route through the shared MetaGraph helper.
        $this->assertStringContainsString('MetaGraph::postPageFeed(', $this->source);
        $this->assertStringContainsString('MetaGraph::postPagePhoto(', $this->source);
    }

    public function testResolvesTokenViaEnvParse(): void
    {
        $this->assertStringContainsString('App::parseEnv($this->pageAccessToken)', $this->source);
    }

    public function testResolvesPageIdViaEnvParse(): void
    {
        // The Page ID supports $ENV references just like the token, so it must be parsed at send time.
        $this->assertStringContainsString('App::parseEnv($this->pageId)', $this->source);
    }

    public function testBailsWhenCredentialsMissing(): void
    {
        $this->assertMatchesRegularExpression('/if\s*\(\s*!\$token\s*\|\|\s*!\$pageId\s*\)/', $this->source);
    }

    public function testFallsBackToBytesUploadWhenNoPublicUrl(): void
    {
        // An image without a public URL is uploaded from raw bytes.
        $this->assertStringContainsString('MetaGraph::postPagePhotoBytes(', $this->source);
    }

    public function testRetriesPhotoAsBytesWhenUrlPostFails(): void
    {
        // The URL post is attempted first; on failure (e.g. a local or private-volume
        // URL that Facebook rejects with #100) it falls back to a byte upload.
        $this->assertStringContainsString('$urlResult = MetaGraph::postPagePhoto(', $this->source);
        $this->assertStringContainsString("\$urlResult['ok']", $this->source);
    }

    public function testInspectsTheNormalizedResult(): void
    {
        $this->assertStringContainsString("\$result['ok']", $this->source);
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
