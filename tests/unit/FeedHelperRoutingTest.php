<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\exceptions\FeedParseException;
use doublesecretagency\notifier\helpers\Feed;
use PHPUnit\Framework\TestCase;

/**
 * Pure unit tests for the Content-Type / first-byte router in Feed.
 *
 * `parseAuto()` is the single entry point the runner calls. It picks the
 * JSON path when the server says so, the JSON path when the body looks
 * like JSON regardless of what the server says, and the XML path the
 * rest of the time. Misrouting either way produces zero items and an
 * apparently-empty feed, which would silently break dispatches.
 */
class FeedHelperRoutingTest extends TestCase
{

    private const RSS_PAYLOAD = '<?xml version="1.0"?><rss version="2.0"><channel><title>R</title><link>https://example.com</link><description>D</description><item><title>One</title><guid>r1</guid><link>https://example.com/1</link></item></channel></rss>';
    private const JSON_PAYLOAD = '{"version":"https://jsonfeed.org/version/1.1","title":"J","items":[{"id":"j1","url":"https://example.com/j","title":"JItem"}]}';

    // ========================================================================= //
    // Content-Type wins
    // ========================================================================= //

    public function testJsonContentTypeRoutesToJsonParser(): void
    {
        // `application/feed+json` is the spec'd JSON Feed type.
        $result = Feed::parseAuto(self::JSON_PAYLOAD, 'application/feed+json');
        $this->assertSame('J', $result['feed']['title']);
        $this->assertSame('JItem', $result['items'][0]['title']);
    }

    public function testGenericJsonContentTypeStillRoutesToJsonParser(): void
    {
        // Many servers serve JSON Feed as `application/json`; the matcher
        // does a substring check so both work.
        $result = Feed::parseAuto(self::JSON_PAYLOAD, 'application/json; charset=utf-8');
        $this->assertSame('JItem', $result['items'][0]['title']);
    }

    public function testXmlContentTypeRoutesToXmlParser(): void
    {
        // Any non-json content-type defaults through to the XML parser.
        $result = Feed::parseAuto(self::RSS_PAYLOAD, 'application/rss+xml');
        $this->assertSame('R', $result['feed']['title']);
        $this->assertSame('One', $result['items'][0]['title']);
    }

    // ========================================================================= //
    // First-byte fallback
    // ========================================================================= //

    public function testJsonFirstByteRoutesToJsonParserWhenContentTypeIsEmpty(): void
    {
        // Some servers send `text/html` or no Content-Type at all for a
        // valid JSON feed. The first-byte sniff catches it.
        $result = Feed::parseAuto(self::JSON_PAYLOAD, '');
        $this->assertSame('JItem', $result['items'][0]['title']);
    }

    public function testJsonFirstByteWinsEvenWhenContentTypeLies(): void
    {
        // The Content-Type check runs first; if it says JSON, we use JSON.
        // But when the CT says something non-JSON and the body starts with
        // `{`, we still route to JSON. This catches misconfigured servers
        // that send `application/octet-stream` for a JSON feed.
        $result = Feed::parseAuto(self::JSON_PAYLOAD, 'application/octet-stream');
        $this->assertSame('JItem', $result['items'][0]['title']);
    }

    public function testLeadingWhitespaceDoesNotBreakJsonDetection(): void
    {
        // Some servers prefix the body with whitespace; the sniff ignores it.
        $padded = "\n  \t" . self::JSON_PAYLOAD;
        $result = Feed::parseAuto($padded, '');
        $this->assertSame('JItem', $result['items'][0]['title']);
    }

    // ========================================================================= //
    // XML default
    // ========================================================================= //

    public function testXmlIsTheDefaultRouteWhenNothingMatchesJson(): void
    {
        // Body starts with '<', no JSON Content-Type → XML parser.
        $result = Feed::parseAuto(self::RSS_PAYLOAD, '');
        $this->assertSame('One', $result['items'][0]['title']);
    }

    public function testEmptyBodyThrowsThroughTheXmlPath(): void
    {
        // An empty body routes to the XML parser, which treats it as a parse failure.
        $this->expectException(FeedParseException::class);
        Feed::parseAuto('', '');
    }
}
