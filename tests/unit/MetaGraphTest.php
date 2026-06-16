<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\MetaGraph;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit + source-level tests for the MetaGraph helper.
 *
 * The pure half covers the version-pinned endpoint builder and the request
 * payload builders, which are deterministic and need no network. The HTTP
 * methods (postPageFeed, resolveIgUserId, etc.) hit Guzzle and are checked at
 * the source level only.
 */
class MetaGraphTest extends TestCase
{
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/helpers/MetaGraph.php';
        $this->assertTrue(file_exists($path), "MetaGraph.php should exist at: $path");
        $this->source = file_get_contents($path);
    }

    // ========================================================================= //
    // Version pin + endpoint builder
    // ========================================================================= //

    public function testGraphVersionIsPinned(): void
    {
        $this->assertSame('v25.0', MetaGraph::GRAPH_VERSION);
    }

    public function testEndpointBuildsAVersionPinnedUrl(): void
    {
        $this->assertSame(
            'https://graph.facebook.com/v25.0/me/accounts',
            MetaGraph::endpoint('me/accounts')
        );
    }

    public function testEndpointTrimsALeadingSlash(): void
    {
        $this->assertSame(
            'https://graph.facebook.com/v25.0/123/feed',
            MetaGraph::endpoint('/123/feed')
        );
    }

    // ========================================================================= //
    // Payload builders
    // ========================================================================= //

    public function testFeedPayloadIncludesMessageAndToken(): void
    {
        $payload = MetaGraph::feedPayload('Hello', null, 'tok');

        $this->assertSame('Hello', $payload['message']);
        $this->assertSame('tok', $payload['access_token']);
        $this->assertArrayNotHasKey('link', $payload);
    }

    public function testFeedPayloadAttachesLinkWhenPresent(): void
    {
        $payload = MetaGraph::feedPayload('Hello', 'https://example.com', 'tok');

        $this->assertSame('https://example.com', $payload['link']);
    }

    public function testPhotoPayloadCarriesUrlCaptionAndToken(): void
    {
        $payload = MetaGraph::photoPayload('https://img.test/a.jpg', 'A caption', 'tok');

        $this->assertSame('https://img.test/a.jpg', $payload['url']);
        $this->assertSame('A caption', $payload['caption']);
        $this->assertSame('tok', $payload['access_token']);
    }

    public function testImageContainerPayloadCarriesImageUrlCaptionAndToken(): void
    {
        $payload = MetaGraph::imageContainerPayload('https://img.test/a.jpg', 'Caption', 'tok');

        $this->assertSame('https://img.test/a.jpg', $payload['image_url']);
        $this->assertSame('Caption', $payload['caption']);
        $this->assertSame('tok', $payload['access_token']);
    }

    public function testPublishPayloadCarriesCreationIdAndToken(): void
    {
        $payload = MetaGraph::publishPayload('17999', 'tok');

        $this->assertSame('17999', $payload['creation_id']);
        $this->assertSame('tok', $payload['access_token']);
    }

    // ========================================================================= //
    // HTTP method shape (source-level)
    // ========================================================================= //

    public function testExposesTheExpectedHttpMethods(): void
    {
        $reflection = new ReflectionClass(MetaGraph::class);
        foreach (['postPageFeed', 'postPagePhoto', 'postPagePhotoBytes', 'resolveIgUserId', 'createImageContainer', 'getContainerStatus', 'publishContainer'] as $method) {
            $this->assertTrue($reflection->hasMethod($method), "MetaGraph should expose {$method}()");
        }
    }

    public function testResolveIgUserIdRequestsTheLinkedAccountFields(): void
    {
        $this->assertStringContainsString('instagram_business_account{id,username}', $this->source);
    }

    public function testRequestNeverThrows(): void
    {
        // The Guzzle boundary swallows both Guzzle and generic throwables.
        $this->assertStringContainsString('GuzzleException|Throwable', $this->source);
    }

    public function testRequestSuppressesHttpErrors(): void
    {
        $this->assertMatchesRegularExpression("/'http_errors'\s*=>\s*false/", $this->source);
    }
}
