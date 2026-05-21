<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\Feed;
use PHPUnit\Framework\TestCase;

/**
 * Pure unit tests for the iTunes podcast namespace flowing through the
 * generic XML namespace passthrough in the Feed helper.
 *
 * Podcast feeds are RSS 2.0 with an extra `xmlns:itunes` namespace. The
 * helper does not special-case iTunes; instead, any namespaced child
 * element is exposed at `item.<prefix>.<tag>` (or `feed.<prefix>.<tag>`).
 * iTunes is the most-common podcast namespace, so these tests pin
 * podcast-feed expectations against the generic mechanism.
 *
 * Values are raw passthrough strings (or hashes when the element
 * carries attributes). Template authors handle any coercion in Twig
 * (`{{ item.itunes.episode | number_format }}`, etc.).
 */
class FeedHelperItunesParseTest extends TestCase
{

    public function testEveryItunesItemFieldSurfacesUnderTheItunesBucket(): void
    {
        // A complete podcast item exposes every supplied iTunes child element
        // under the `itunes` bucket on the normalized item.
        $xml = $this->_itunesFeed([
            '<itunes:duration>30:00</itunes:duration>',
            '<itunes:episode>42</itunes:episode>',
            '<itunes:season>2</itunes:season>',
            '<itunes:explicit>yes</itunes:explicit>',
            '<itunes:image href="https://example.com/img.jpg"/>',
            '<itunes:author>Podcast Author</itunes:author>',
            '<itunes:subtitle>An episode subtitle</itunes:subtitle>',
        ]);
        $item = Feed::parse($xml)['items'][0];

        // Text-only iTunes tags become scalar strings on `item.itunes.*`.
        $this->assertSame('30:00', $item['itunes']['duration']);
        $this->assertSame('42', $item['itunes']['episode']);
        $this->assertSame('2', $item['itunes']['season']);
        $this->assertSame('yes', $item['itunes']['explicit']);
        $this->assertSame('Podcast Author', $item['itunes']['author']);
        $this->assertSame('An episode subtitle', $item['itunes']['subtitle']);

        // Attribute-bearing iTunes tags become hashes keyed by attribute name.
        $this->assertSame(['href' => 'https://example.com/img.jpg'], $item['itunes']['image']);
    }

    public function testItemWithoutItunesNamespaceLacksTheItunesBucket(): void
    {
        // A non-podcast RSS item must not invent an iTunes bucket. The standard
        // `<item>` here declares no namespaced children at all.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
    <channel>
        <title>T</title>
        <link>https://example.com</link>
        <description>D</description>
        <item>
            <title>Plain post</title>
            <link>https://example.com/1</link>
            <guid>g1</guid>
        </item>
    </channel>
</rss>
XML;
        $item = Feed::parse($xml)['items'][0];

        $this->assertArrayNotHasKey('itunes', $item);
    }

    public function testItunesExplicitIsPassedThroughAsString(): void
    {
        // Coercion happens in Twig templates, not in the parser. Whatever string
        // the feed shipped is what shows up at `item.itunes.explicit`.
        foreach (['yes', 'true', 'clean', 'no', 'false'] as $rawValue) {
            $xml = $this->_itunesFeed(["<itunes:explicit>{$rawValue}</itunes:explicit>"]);
            $this->assertSame(
                $rawValue,
                Feed::parse($xml)['items'][0]['itunes']['explicit'],
                "Expected `{$rawValue}` to pass through unchanged."
            );
        }
    }

    public function testItunesEpisodeIsPassedThroughAsString(): void
    {
        // A non-numeric episode value is passed through as-is. Template authors
        // who need an int can coerce in Twig (`{{ item.itunes.episode | abs }}`).
        $xml = $this->_itunesFeed(['<itunes:episode>S01E42</itunes:episode>']);
        $this->assertSame('S01E42', Feed::parse($xml)['items'][0]['itunes']['episode']);
    }

    public function testItunesImageReturnsHashWithHrefAttribute(): void
    {
        // The image element carries the URL in an attribute, not text content,
        // so the generic passthrough returns a hash keyed by attribute name.
        $xml = $this->_itunesFeed(['<itunes:image href="https://example.com/art.jpg"/>']);
        $this->assertSame(
            ['href' => 'https://example.com/art.jpg'],
            Feed::parse($xml)['items'][0]['itunes']['image']
        );
    }

    public function testItunesAuthorDoesNotOverrideStandardAuthor(): void
    {
        // Standard `<author>` is reflected strictly at `item.author`. The
        // iTunes value lives separately at `item.itunes.author`. Template
        // authors compose whichever they want.
        $xml = $this->_itunesFeed(
            ['<itunes:author>Real Name</itunes:author>'],
            'editor@example.com'
        );
        $item = Feed::parse($xml)['items'][0];

        $this->assertSame('editor@example.com', $item['author']);
        $this->assertSame('Real Name', $item['itunes']['author']);
    }

    public function testItunesAuthorIsPresentEvenWhenStandardAuthorIsAbsent(): void
    {
        // No standard <author> in the item; the iTunes author still appears
        // under its own bucket. The standard `item.author` is null.
        $xml = $this->_itunesFeed(['<itunes:author>Solo Voice</itunes:author>']);
        $item = Feed::parse($xml)['items'][0];

        $this->assertNull($item['author']);
        $this->assertSame('Solo Voice', $item['itunes']['author']);
    }

    public function testChannelLevelItunesFieldsSurfaceOnFeed(): void
    {
        // iTunes is also a channel-level namespace in podcast feeds. Tags like
        // <itunes:summary> and <itunes:type> appear directly on <channel> and
        // should flow through to the feed metadata at `feed.itunes.*`.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd">
    <channel>
        <title>Podcast</title>
        <link>https://example.com</link>
        <description>D</description>
        <itunes:summary>A long-running podcast about Craft CMS.</itunes:summary>
        <itunes:type>episodic</itunes:type>
        <itunes:explicit>no</itunes:explicit>
    </channel>
</rss>
XML;
        $feed = Feed::parse($xml)['feed'];

        $this->assertSame('A long-running podcast about Craft CMS.', $feed['itunes']['summary']);
        $this->assertSame('episodic', $feed['itunes']['type']);
        $this->assertSame('no', $feed['itunes']['explicit']);
    }

    public function testNestedItunesElementsReturnNestedHash(): void
    {
        // <itunes:owner> typically wraps <itunes:name> and <itunes:email>.
        // The same-namespace recursion exposes them as `feed.itunes.owner.name`
        // and `feed.itunes.owner.email`.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd">
    <channel>
        <title>Podcast</title>
        <link>https://example.com</link>
        <description>D</description>
        <itunes:owner>
            <itunes:name>Show Host</itunes:name>
            <itunes:email>host@example.com</itunes:email>
        </itunes:owner>
    </channel>
</rss>
XML;
        $feed = Feed::parse($xml)['feed'];

        $this->assertSame('Show Host', $feed['itunes']['owner']['name']);
        $this->assertSame('host@example.com', $feed['itunes']['owner']['email']);
    }

    // ========================================================================= //
    // Helpers
    // ========================================================================= //

    /**
     * Build an RSS 2.0 feed declaring the iTunes namespace, with one item
     * carrying the supplied iTunes child elements.
     *
     * @param string[] $itunesChildren XML fragments inside the <item>.
     * @param string|null $rssAuthor Optional value for the standard <author>.
     * @return string
     */
    private function _itunesFeed(array $itunesChildren, ?string $rssAuthor = null): string
    {
        $authorXml = ($rssAuthor === null ? '' : "<author>{$rssAuthor}</author>");
        $itunesXml = implode("\n            ", $itunesChildren);

        return <<<XML
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd">
    <channel>
        <title>Podcast</title>
        <link>https://example.com</link>
        <description>D</description>
        <item>
            <title>Episode</title>
            <link>https://example.com/ep</link>
            <guid>ep1</guid>
            {$authorXml}
            {$itunesXml}
        </item>
    </channel>
</rss>
XML;
    }
}
