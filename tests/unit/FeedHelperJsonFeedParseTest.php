<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\exceptions\FeedParseException;
use doublesecretagency\notifier\helpers\Feed;
use PHPUnit\Framework\TestCase;

/**
 * Pure unit tests for the JSON Feed branch of the Feed helper.
 *
 * The helper takes a raw JSON Feed payload (1.0 or 1.1) and returns the
 * same normalized `{feed, items}` shape as the RSS / Atom path. Items
 * map id → guid, url → link, date_published → pubDate, and the content
 * fields (content_html / content_text / summary) feed a single
 * description. Items with no derivable item ID are dropped so the
 * runner cannot try to dispatch something it cannot track.
 */
class FeedHelperJsonFeedParseTest extends TestCase
{

    // ========================================================================= //
    // Edge cases
    // ========================================================================= //

    public function testEmptyPayloadThrows(): void
    {
        // A blank payload is a parse failure, so the helper throws.
        $this->expectException(FeedParseException::class);
        Feed::parseJson('');
    }

    public function testInvalidJsonThrows(): void
    {
        // Malformed JSON cannot be parsed, so the helper throws.
        $this->expectException(FeedParseException::class);
        Feed::parseJson('{not json at all');
    }

    public function testNonObjectJsonThrows(): void
    {
        // A JSON array (not an object) cannot be a feed, so the helper throws.
        $this->expectException(FeedParseException::class);
        Feed::parseJson('[1, 2, 3]');
    }

    // ========================================================================= //
    // Feed-level metadata
    // ========================================================================= //

    public function testFeedMetadataIsExtracted(): void
    {
        // Top-level title, home_page_url, description map to the feed result.
        $json = json_encode([
            'version' => 'https://jsonfeed.org/version/1.1',
            'title' => 'Demo JSON Feed',
            'home_page_url' => 'https://example.com',
            'description' => 'A demo feed',
            'items' => [],
        ]);
        $result = Feed::parseJson($json);
        $this->assertSame('Demo JSON Feed', $result['feed']['title']);
        $this->assertSame('https://example.com', $result['feed']['link']);
        $this->assertSame('A demo feed', $result['feed']['description']);
    }

    // ========================================================================= //
    // Item-level extraction
    // ========================================================================= //

    public function testItemFieldsAreExtracted(): void
    {
        // Every field expected by the runner round-trips through parseJson.
        $json = json_encode([
            'version' => 'https://jsonfeed.org/version/1.1',
            'title' => 'Demo',
            'items' => [
                [
                    'id' => 'https://example.com/post/1',
                    'url' => 'https://example.com/post/1',
                    'title' => 'First post',
                    'content_html' => '<p>Hello</p>',
                    'date_published' => '2025-05-19T10:00:00Z',
                    'authors' => [['name' => 'JSON Author']],
                    'tags' => ['news', 'updates'],
                ],
            ],
        ]);
        $result = Feed::parseJson($json);
        $this->assertCount(1, $result['items']);

        $item = $result['items'][0];
        $this->assertSame('First post', $item['title']);
        $this->assertSame('https://example.com/post/1', $item['link']);
        $this->assertSame('https://example.com/post/1', $item['guid']);
        $this->assertSame('<p>Hello</p>', $item['description']);
        $this->assertSame('JSON Author', $item['author']);
        $this->assertSame(['news', 'updates'], $item['categories']);
        $this->assertSame('2025-05-19 10:00:00', $item['pubDate']->format('Y-m-d H:i:s'));
    }

    public function testJsonFeed10SingularAuthorIsSupported(): void
    {
        // 1.0 spec used singular `author`; 1.1 deprecated it for plural
        // `authors`. Both must surface as item.author.
        $json = json_encode([
            'items' => [
                ['id' => 'a', 'url' => 'https://example.com/a', 'author' => ['name' => 'Singular Author']],
            ],
        ]);
        $result = Feed::parseJson($json);
        $this->assertSame('Singular Author', $result['items'][0]['author']);
    }

    public function testPluralAuthorsTakesPriorityOverSingular(): void
    {
        // When a feed (deprecated practice) ships both, the 1.1 plural wins.
        $json = json_encode([
            'items' => [
                [
                    'id' => 'a', 'url' => 'https://example.com/a',
                    'author' => ['name' => 'Old'],
                    'authors' => [['name' => 'New']],
                ],
            ],
        ]);
        $result = Feed::parseJson($json);
        $this->assertSame('New', $result['items'][0]['author']);
    }

    // ========================================================================= //
    // Description fallback chain
    // ========================================================================= //

    public function testDescriptionPrefersContentHtmlThenTextThenSummary(): void
    {
        // content_html wins
        $json = json_encode(['items' => [[
            'id' => 'a', 'url' => 'https://example.com/a',
            'content_html' => '<p>html</p>',
            'content_text' => 'text',
            'summary' => 'sum',
        ]]]);
        $this->assertSame('<p>html</p>', Feed::parseJson($json)['items'][0]['description']);

        // content_text wins when content_html is absent
        $json = json_encode(['items' => [[
            'id' => 'b', 'url' => 'https://example.com/b',
            'content_text' => 'text',
            'summary' => 'sum',
        ]]]);
        $this->assertSame('text', Feed::parseJson($json)['items'][0]['description']);

        // summary wins when both content_* are absent
        $json = json_encode(['items' => [[
            'id' => 'c', 'url' => 'https://example.com/c',
            'summary' => 'sum',
        ]]]);
        $this->assertSame('sum', Feed::parseJson($json)['items'][0]['description']);
    }

    // ========================================================================= //
    // Link / GUID fallback chain
    // ========================================================================= //

    public function testLinkFallsBackToExternalUrlThenIdWhenIdIsUrl(): void
    {
        // url present → wins
        $json = json_encode(['items' => [[
            'id' => 'urn:internal:1',
            'url' => 'https://example.com/u',
            'external_url' => 'https://other.com/x',
        ]]]);
        $this->assertSame('https://example.com/u', Feed::parseJson($json)['items'][0]['link']);

        // url absent, external_url present → external_url wins
        $json = json_encode(['items' => [[
            'id' => 'urn:internal:2',
            'external_url' => 'https://other.com/x',
        ]]]);
        $this->assertSame('https://other.com/x', Feed::parseJson($json)['items'][0]['link']);

        // url and external_url absent, id is a URL → id wins
        $json = json_encode(['items' => [[
            'id' => 'https://example.com/i',
        ]]]);
        $this->assertSame('https://example.com/i', Feed::parseJson($json)['items'][0]['link']);
    }

    public function testItemWithoutAnyTrackingKeyIsSkipped(): void
    {
        // No id at all means no guid; the helper drops the item.
        $json = json_encode(['items' => [
            ['title' => 'Orphan'],
            ['id' => 'real', 'url' => 'https://example.com/r', 'title' => 'Real'],
        ]]);
        $result = Feed::parseJson($json);
        $this->assertCount(1, $result['items']);
        $this->assertSame('Real', $result['items'][0]['title']);
    }
}
