<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\exceptions\FeedParseException;
use doublesecretagency\notifier\helpers\Feed;
use PHPUnit\Framework\TestCase;

/**
 * Pure unit tests for the Rss helper.
 *
 * The helper takes a raw feed payload and returns a normalized
 * `{feed, items}` array. It supports RSS 2.0 (with `<channel><item>`)
 * and Atom 1.0 (with `<feed><entry>`), and falls back to `<link>` when
 * the canonical identifier (`<guid>` / `<id>`) is missing. Items with
 * no derivable item ID are dropped so the runner never tries to
 * dispatch something it cannot track.
 */
class FeedHelperParseTest extends TestCase
{

    // ========================================================================= //
    // Edge cases
    // ========================================================================= //

    public function testEmptyPayloadThrows(): void
    {
        // A blank payload is a parse failure, so the helper throws.
        $this->expectException(FeedParseException::class);
        Feed::parse('');
    }

    public function testGarbagePayloadThrows(): void
    {
        // Non-XML input cannot be parsed, so the helper throws.
        $this->expectException(FeedParseException::class);
        Feed::parse('this is not xml');
    }

    public function testUnknownRootElementThrows(): void
    {
        // Anything that isn't <rss> or <feed> cannot be parsed as a feed.
        $this->expectException(FeedParseException::class);
        Feed::parse('<?xml version="1.0"?><html><body/></html>');
    }

    // ========================================================================= //
    // RSS 2.0 parsing
    // ========================================================================= //

    public function testRssChannelMetadataIsExtracted(): void
    {
        // Channel title, link, description must surface on the feed result.
        $xml = $this->_rssFeed([
            'title' => 'Demo Channel',
            'link' => 'https://example.com',
            'description' => 'A demo feed',
            'items' => [],
        ]);
        $result = Feed::parse($xml);
        $this->assertSame('Demo Channel', $result['feed']['title']);
        $this->assertSame('https://example.com', $result['feed']['link']);
        $this->assertSame('A demo feed', $result['feed']['description']);
    }

    public function testRssItemFieldsAreExtracted(): void
    {
        // Every item field expected by the runner round-trips through parse.
        $xml = $this->_rssFeed([
            'items' => [
                [
                    'title' => 'First post',
                    'link' => 'https://example.com/1',
                    'guid' => 'urn:example:1',
                    'description' => 'Hello world',
                    'pubDate' => 'Mon, 19 May 2025 10:00:00 +0000',
                    'author' => 'editor@example.com',
                    'categories' => ['News', 'Updates'],
                ],
            ],
        ]);
        $result = Feed::parse($xml);
        $this->assertCount(1, $result['items']);

        $item = $result['items'][0];
        $this->assertSame('First post', $item['title']);
        $this->assertSame('https://example.com/1', $item['link']);
        $this->assertSame('urn:example:1', $item['guid']);
        $this->assertSame('Hello world', $item['description']);
        $this->assertSame('editor@example.com', $item['author']);
        $this->assertSame(['News', 'Updates'], $item['categories']);
        $this->assertSame('2025-05-19 10:00:00', $item['pubDate']->format('Y-m-d H:i:s'));
    }

    public function testRssItemFallsBackToLinkWhenGuidIsMissing(): void
    {
        // The runner uses guid as the item ID; with no guid, link must take over.
        $xml = $this->_rssFeed([
            'items' => [
                ['title' => 'Linked only', 'link' => 'https://example.com/2'],
            ],
        ]);
        $result = Feed::parse($xml);
        $this->assertSame('https://example.com/2', $result['items'][0]['guid']);
    }

    public function testRssItemIsSkippedWhenGuidAndLinkAreBothMissing(): void
    {
        // No derivable item ID means the runner cannot uniquely identify it,
        // so the helper drops the item rather than passing it through.
        $xml = $this->_rssFeed([
            'items' => [
                ['title' => 'Anonymous item', 'description' => 'No URL, no guid'],
                ['title' => 'Real item', 'link' => 'https://example.com/3'],
            ],
        ]);
        $result = Feed::parse($xml);
        $this->assertCount(1, $result['items']);
        $this->assertSame('Real item', $result['items'][0]['title']);
    }

    public function testRssItemWithUnparseablePubDateLeavesItNull(): void
    {
        // Bad date strings degrade to null rather than throwing.
        $xml = $this->_rssFeed([
            'items' => [
                ['title' => 'T', 'link' => 'https://example.com/4', 'pubDate' => 'not-a-date'],
            ],
        ]);
        $result = Feed::parse($xml);
        $this->assertNull($result['items'][0]['pubDate']);
    }

    public function testRssDescriptionInsideCdataSurvives(): void
    {
        // Feeds routinely wrap descriptions in CDATA; LIBXML_NOCDATA pulls it out.
        $xml = $this->_rssFeed([
            'items' => [
                [
                    'title' => 'C',
                    'link' => 'https://example.com/5',
                    'description' => '<![CDATA[<p>Hello <em>world</em></p>]]>',
                ],
            ],
        ]);
        $result = Feed::parse($xml);
        $this->assertSame('<p>Hello <em>world</em></p>', $result['items'][0]['description']);
    }

    // ========================================================================= //
    // Atom 1.0 parsing
    // ========================================================================= //

    public function testAtomFeedMetadataIsExtracted(): void
    {
        // Title, link (rel=alternate preferred), and subtitle map to feed shape.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <title>Atom Demo</title>
    <subtitle>An Atom feed</subtitle>
    <link rel="self" href="https://example.com/feed.xml"/>
    <link rel="alternate" href="https://example.com"/>
</feed>
XML;
        $result = Feed::parse($xml);
        $this->assertSame('Atom Demo', $result['feed']['title']);
        $this->assertSame('An Atom feed', $result['feed']['description']);
        $this->assertSame('https://example.com', $result['feed']['link']);
    }

    public function testAtomEntryFieldsAreExtracted(): void
    {
        // Atom entries use <id> for GUID, <published>/<updated> for the date,
        // and a wrapper <author><name> for the author.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <title>Atom Demo</title>
    <entry>
        <title>Atom post</title>
        <link rel="alternate" href="https://example.com/a/1"/>
        <id>tag:example.com,2025:atom-1</id>
        <published>2025-05-19T10:00:00Z</published>
        <summary>Summary text</summary>
        <author><name>Atom Author</name></author>
        <category term="Atom"/>
    </entry>
</feed>
XML;
        $result = Feed::parse($xml);
        $this->assertCount(1, $result['items']);
        $item = $result['items'][0];
        $this->assertSame('Atom post', $item['title']);
        $this->assertSame('https://example.com/a/1', $item['link']);
        $this->assertSame('tag:example.com,2025:atom-1', $item['guid']);
        $this->assertSame('Summary text', $item['description']);
        $this->assertSame('Atom Author', $item['author']);
        $this->assertSame(['Atom'], $item['categories']);
        $this->assertSame('2025-05-19 10:00:00', $item['pubDate']->format('Y-m-d H:i:s'));
    }

    public function testAtomEntryFallsBackToContentWhenSummaryIsMissing(): void
    {
        // Many feeds ship <content> instead of <summary>; both should surface.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <entry>
        <title>T</title>
        <id>e1</id>
        <link href="https://example.com/c1"/>
        <content>Body text</content>
    </entry>
</feed>
XML;
        $result = Feed::parse($xml);
        $this->assertSame('Body text', $result['items'][0]['description']);
    }

    public function testAtomEntryFallsBackToUpdatedWhenPublishedIsMissing(): void
    {
        // Feeds without <published> still expose <updated>; the helper takes it.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <entry>
        <title>T</title>
        <id>e2</id>
        <link href="https://example.com/u1"/>
        <updated>2025-05-20T11:00:00Z</updated>
    </entry>
</feed>
XML;
        $result = Feed::parse($xml);
        $this->assertSame('2025-05-20 11:00:00', $result['items'][0]['pubDate']->format('Y-m-d H:i:s'));
    }

    // ========================================================================= //
    // Helpers
    // ========================================================================= //

    /**
     * Build a tiny RSS 2.0 XML payload for testing.
     *
     * @param array $config Partial channel config: title, link, description, items.
     * @return string
     */
    private function _rssFeed(array $config): string
    {
        // Build channel-level fields
        $title = $config['title'] ?? 'T';
        $link = $config['link'] ?? 'https://example.com';
        $description = $config['description'] ?? 'D';
        $items = $config['items'] ?? [];

        // Compose each item
        $itemXml = '';
        foreach ($items as $item) {
            $itemXml .= '<item>';
            foreach (['title', 'link', 'guid', 'description', 'pubDate', 'author'] as $field) {
                if (isset($item[$field])) {
                    $itemXml .= "<{$field}>{$item[$field]}</{$field}>";
                }
            }
            foreach (($item['categories'] ?? []) as $category) {
                $itemXml .= "<category>{$category}</category>";
            }
            $itemXml .= '</item>';
        }

        return <<<XML
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
    <channel>
        <title>{$title}</title>
        <link>{$link}</link>
        <description>{$description}</description>
        {$itemXml}
    </channel>
</rss>
XML;
    }
}
