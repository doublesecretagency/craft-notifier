<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\Feed;
use PHPUnit\Framework\TestCase;

/**
 * Pure unit tests for enclosure / attachment extraction across all three
 * feed formats. Items expose `item.enclosure` as `{url, type, length}`
 * when an enclosure is present, or null when absent. Only the first
 * enclosure per item is surfaced.
 */
class FeedHelperEnclosureTest extends TestCase
{

    // ========================================================================= //
    // RSS 2.0
    // ========================================================================= //

    public function testRssEnclosureFullySpecified(): void
    {
        // Standard RSS 2.0 enclosure with all three required attributes.
        $xml = <<<'XML'
<?xml version="1.0"?>
<rss version="2.0">
    <channel>
        <title>Demo</title>
        <link>https://example.com</link>
        <description>D</description>
        <item>
            <title>One</title>
            <link>https://example.com/1</link>
            <guid>r1</guid>
            <enclosure url="https://example.com/icon.png" length="1234" type="image/png" />
        </item>
    </channel>
</rss>
XML;
        $item = Feed::parse($xml)['items'][0];
        $this->assertSame('https://example.com/icon.png', $item['enclosure']['url']);
        $this->assertSame('image/png', $item['enclosure']['type']);
        $this->assertSame(1234, $item['enclosure']['length']);
    }

    public function testRssEnclosureWithMissingLength(): void
    {
        // length="" should normalize to null, not 0.
        $xml = <<<'XML'
<?xml version="1.0"?>
<rss version="2.0">
    <channel>
        <title>D</title>
        <link>https://e.com</link>
        <description>D</description>
        <item>
            <title>One</title>
            <link>https://e.com/1</link>
            <guid>r1</guid>
            <enclosure url="https://e.com/icon.png" length="" type="image/png" />
        </item>
    </channel>
</rss>
XML;
        $item = Feed::parse($xml)['items'][0];
        $this->assertSame('https://e.com/icon.png', $item['enclosure']['url']);
        $this->assertNull($item['enclosure']['length']);
    }

    public function testRssEnclosureWithoutTypeOrLength(): void
    {
        // type and length are spec-required but real feeds drop them.
        $xml = <<<'XML'
<?xml version="1.0"?>
<rss version="2.0">
    <channel>
        <title>D</title>
        <link>https://e.com</link>
        <description>D</description>
        <item>
            <title>One</title>
            <link>https://e.com/1</link>
            <guid>r1</guid>
            <enclosure url="https://e.com/icon.png" />
        </item>
    </channel>
</rss>
XML;
        $item = Feed::parse($xml)['items'][0];
        $this->assertSame('https://e.com/icon.png', $item['enclosure']['url']);
        $this->assertSame('', $item['enclosure']['type']);
        $this->assertNull($item['enclosure']['length']);
    }

    public function testRssEnclosureMissingUrlIsSkipped(): void
    {
        // An enclosure without a URL is unusable; skip and try the next one.
        $xml = <<<'XML'
<?xml version="1.0"?>
<rss version="2.0">
    <channel>
        <title>D</title>
        <link>https://e.com</link>
        <description>D</description>
        <item>
            <title>One</title>
            <link>https://e.com/1</link>
            <guid>r1</guid>
            <enclosure length="123" type="image/png" />
            <enclosure url="https://e.com/icon.png" type="image/png" />
        </item>
    </channel>
</rss>
XML;
        $item = Feed::parse($xml)['items'][0];
        $this->assertSame('https://e.com/icon.png', $item['enclosure']['url']);
    }

    public function testRssWithNoEnclosureReturnsNull(): void
    {
        $xml = <<<'XML'
<?xml version="1.0"?>
<rss version="2.0">
    <channel>
        <title>D</title>
        <link>https://e.com</link>
        <description>D</description>
        <item>
            <title>One</title>
            <link>https://e.com/1</link>
            <guid>r1</guid>
        </item>
    </channel>
</rss>
XML;
        $item = Feed::parse($xml)['items'][0];
        $this->assertNull($item['enclosure']);
    }

    public function testRssMultipleEnclosuresOnlyFirstIsSurfaced(): void
    {
        // Spec allows multiple; we expose only the first for simple icon use cases.
        $xml = <<<'XML'
<?xml version="1.0"?>
<rss version="2.0">
    <channel>
        <title>D</title>
        <link>https://e.com</link>
        <description>D</description>
        <item>
            <title>One</title>
            <link>https://e.com/1</link>
            <guid>r1</guid>
            <enclosure url="https://e.com/first.png" type="image/png" />
            <enclosure url="https://e.com/second.png" type="image/png" />
        </item>
    </channel>
</rss>
XML;
        $item = Feed::parse($xml)['items'][0];
        $this->assertSame('https://e.com/first.png', $item['enclosure']['url']);
    }

    // ========================================================================= //
    // Atom 1.0
    // ========================================================================= //

    public function testAtomEnclosureLink(): void
    {
        // Atom uses <link rel="enclosure" href="..." />.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <title>Demo</title>
    <entry>
        <title>One</title>
        <link rel="alternate" href="https://example.com/1" />
        <link rel="enclosure" href="https://example.com/icon.png" length="999" type="image/png" />
        <id>tag:e,1</id>
    </entry>
</feed>
XML;
        $item = Feed::parse($xml)['items'][0];
        $this->assertSame('https://example.com/icon.png', $item['enclosure']['url']);
        $this->assertSame('image/png', $item['enclosure']['type']);
        $this->assertSame(999, $item['enclosure']['length']);
    }

    public function testAtomEnclosureLinkIgnoresAlternates(): void
    {
        // The <link rel="alternate"> must not be picked up as an enclosure.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <title>D</title>
    <entry>
        <title>One</title>
        <link rel="alternate" href="https://e.com/1" />
        <id>tag:e,1</id>
    </entry>
</feed>
XML;
        $item = Feed::parse($xml)['items'][0];
        $this->assertNull($item['enclosure']);
    }

    // ========================================================================= //
    // JSON Feed 1.1
    // ========================================================================= //

    public function testJsonFeedAttachmentsFirstIsSurfaced(): void
    {
        // JSON Feed attachments use url + mime_type + size_in_bytes; we normalize to url + type + length.
        $json = json_encode([
            'version' => 'https://jsonfeed.org/version/1.1',
            'items' => [
                [
                    'id' => '1',
                    'url' => 'https://example.com/1',
                    'attachments' => [
                        [
                            'url' => 'https://example.com/icon.png',
                            'mime_type' => 'image/png',
                            'size_in_bytes' => '4321',
                        ],
                    ],
                ],
            ],
        ]);
        $item = Feed::parseJson($json)['items'][0];
        $this->assertSame('https://example.com/icon.png', $item['enclosure']['url']);
        $this->assertSame('image/png', $item['enclosure']['type']);
        $this->assertSame(4321, $item['enclosure']['length']);
    }

    public function testJsonFeedAttachmentsMissingFieldsNormalize(): void
    {
        // Missing mime_type / size_in_bytes normalize to '' and null respectively.
        $json = json_encode([
            'items' => [
                [
                    'id' => '1',
                    'url' => 'https://e.com/1',
                    'attachments' => [
                        ['url' => 'https://e.com/icon.png'],
                    ],
                ],
            ],
        ]);
        $item = Feed::parseJson($json)['items'][0];
        $this->assertSame('https://e.com/icon.png', $item['enclosure']['url']);
        $this->assertSame('', $item['enclosure']['type']);
        $this->assertNull($item['enclosure']['length']);
    }

    public function testJsonFeedWithoutAttachmentsReturnsNull(): void
    {
        $json = json_encode([
            'items' => [
                ['id' => '1', 'url' => 'https://e.com/1'],
            ],
        ]);
        $item = Feed::parseJson($json)['items'][0];
        $this->assertNull($item['enclosure']);
    }
}
