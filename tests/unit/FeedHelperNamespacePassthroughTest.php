<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\Feed;
use PHPUnit\Framework\TestCase;

/**
 * Pure unit tests for the generic XML namespace passthrough on the Feed
 * helper. Any `<ns:tag>` child of the channel / feed root / item / entry
 * is exposed at `feed.<ns>.<tag>` or `item.<ns>.<tag>` with no
 * per-namespace allowlist.
 *
 * iTunes coverage lives in FeedHelperItunesParseTest; this file focuses
 * on shape and on namespaces other than iTunes (dc, media, podcast,
 * custom prefixes) to prove the mechanism is generic.
 */
class FeedHelperNamespacePassthroughTest extends TestCase
{

    // ========================================================================= //
    // Non-iTunes namespaces
    // ========================================================================= //

    public function testDublinCoreCreatorOnItemSurfacesAtItemDcCreator(): void
    {
        // <dc:creator> is the most-common non-iTunes RSS extension; almost
        // every blog feed in the wild emits it. The passthrough should
        // expose it as `item.dc.creator` without any per-tag code.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
    <channel>
        <title>Blog</title>
        <link>https://example.com</link>
        <description>D</description>
        <item>
            <title>Post One</title>
            <link>https://example.com/1</link>
            <guid>p1</guid>
            <dc:creator>Jane Author</dc:creator>
        </item>
    </channel>
</rss>
XML;
        $item = Feed::parse($xml)['items'][0];

        $this->assertSame('Jane Author', $item['dc']['creator']);
    }

    public function testMediaThumbnailReturnsHashWithAttributes(): void
    {
        // <media:thumbnail> uses an attribute payload (url, width, height).
        // An attribute-only element returns a hash keyed by attribute name.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/">
    <channel>
        <title>News</title>
        <link>https://example.com</link>
        <description>D</description>
        <item>
            <title>Story</title>
            <link>https://example.com/1</link>
            <guid>s1</guid>
            <media:thumbnail url="https://example.com/thumb.jpg" width="320" height="240"/>
        </item>
    </channel>
</rss>
XML;
        $item = Feed::parse($xml)['items'][0];

        $this->assertSame(
            ['url' => 'https://example.com/thumb.jpg', 'width' => '320', 'height' => '240'],
            $item['media']['thumbnail']
        );
    }

    public function testCustomPublisherNamespaceFlowsThroughUnchanged(): void
    {
        // A feed declaring a fully made-up namespace under a custom prefix
        // should still flow through. The passthrough has no opinion about
        // which namespaces are "valid."
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:zapier="https://example.com/zapier/">
    <channel>
        <title>Zap</title>
        <link>https://example.com</link>
        <description>D</description>
        <item>
            <title>Triggered</title>
            <link>https://example.com/zap/1</link>
            <guid>z1</guid>
            <zapier:source>Webhook</zapier:source>
            <zapier:runId>abc123</zapier:runId>
        </item>
    </channel>
</rss>
XML;
        $item = Feed::parse($xml)['items'][0];

        $this->assertSame('Webhook', $item['zapier']['source']);
        $this->assertSame('abc123', $item['zapier']['runId']);
    }

    public function testPodcastingTwoPointZeroNamespaceWorksWithoutCode(): void
    {
        // <podcast:transcript> from the Podcasting 2.0 spec uses both
        // attributes (url, type, language) and is the canonical example
        // of a namespace this plugin does not know about by name.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:podcast="https://podcastindex.org/namespace/1.0">
    <channel>
        <title>Pod</title>
        <link>https://example.com</link>
        <description>D</description>
        <item>
            <title>Episode</title>
            <link>https://example.com/ep</link>
            <guid>ep1</guid>
            <podcast:transcript url="https://example.com/ep.vtt" type="text/vtt" language="en"/>
        </item>
    </channel>
</rss>
XML;
        $item = Feed::parse($xml)['items'][0];

        $this->assertSame(
            ['url' => 'https://example.com/ep.vtt', 'type' => 'text/vtt', 'language' => 'en'],
            $item['podcast']['transcript']
        );
    }

    // ========================================================================= //
    // Channel- / feed-level passthrough
    // ========================================================================= //

    public function testRssChannelLevelNamespaceFieldsSurfaceOnFeed(): void
    {
        // Channel-level namespaced tags (like <itunes:summary> or
        // <sy:updateFrequency>) should land on the feed metadata at
        // `feed.<prefix>.<tag>`, not on individual items.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/">
    <channel>
        <title>Updates</title>
        <link>https://example.com</link>
        <description>D</description>
        <sy:updatePeriod>hourly</sy:updatePeriod>
        <sy:updateFrequency>2</sy:updateFrequency>
    </channel>
</rss>
XML;
        $feed = Feed::parse($xml)['feed'];

        $this->assertSame('hourly', $feed['sy']['updatePeriod']);
        $this->assertSame('2', $feed['sy']['updateFrequency']);
    }

    public function testAtomFeedRootNamespaceFieldsSurfaceOnFeed(): void
    {
        // The same passthrough applies to Atom feeds. A namespaced tag on
        // the <feed> root lands on the feed metadata.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
    <title>An Atom Feed</title>
    <dc:rights>Copyright Example Corp</dc:rights>
    <entry>
        <title>Hello</title>
        <link rel="alternate" href="https://example.com/1"/>
        <id>tag:e,1</id>
    </entry>
</feed>
XML;
        $feed = Feed::parse($xml)['feed'];

        $this->assertSame('Copyright Example Corp', $feed['dc']['rights']);
    }

    public function testAtomEntryNamespaceFieldsSurfaceOnItem(): void
    {
        // And on individual <entry> elements too.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom" xmlns:dc="http://purl.org/dc/elements/1.1/">
    <title>Atom</title>
    <entry>
        <title>Hello</title>
        <link rel="alternate" href="https://example.com/1"/>
        <id>tag:e,1</id>
        <dc:creator>Atom Author</dc:creator>
    </entry>
</feed>
XML;
        $item = Feed::parse($xml)['items'][0];

        $this->assertSame('Atom Author', $item['dc']['creator']);
    }

    // ========================================================================= //
    // Element shape: repeated siblings, _text, recursion
    // ========================================================================= //

    public function testRepeatedSiblingTagsCollapseToIndexedList(): void
    {
        // Two <dc:subject> elements at the same level should collapse to a
        // numerically-indexed array under the `subject` key, not silently
        // drop or pick one.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
    <channel>
        <title>Tag soup</title>
        <link>https://example.com</link>
        <description>D</description>
        <item>
            <title>Multi-tag</title>
            <link>https://example.com/1</link>
            <guid>m1</guid>
            <dc:subject>craft</dc:subject>
            <dc:subject>cms</dc:subject>
            <dc:subject>php</dc:subject>
        </item>
    </channel>
</rss>
XML;
        $item = Feed::parse($xml)['items'][0];

        $this->assertSame(['craft', 'cms', 'php'], $item['dc']['subject']);
    }

    public function testSingleSiblingTagStaysScalarNotWrapped(): void
    {
        // A namespace with one occurrence stays scalar. We only wrap in a
        // list when we see two-plus.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
    <channel>
        <title>Single</title>
        <link>https://example.com</link>
        <description>D</description>
        <item>
            <title>Solo</title>
            <link>https://example.com/1</link>
            <guid>s1</guid>
            <dc:subject>just-one</dc:subject>
        </item>
    </channel>
</rss>
XML;
        $item = Feed::parse($xml)['items'][0];

        $this->assertSame('just-one', $item['dc']['subject']);
    }

    public function testElementWithAttributesAndTextExposesUnderscoreText(): void
    {
        // The rare case: an element carries both attributes AND inline text.
        // Attributes get their own keys; the inline text lands under the
        // reserved `_text` key so neither side is lost.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:custom="https://example.com/custom/">
    <channel>
        <title>Mixed</title>
        <link>https://example.com</link>
        <description>D</description>
        <item>
            <title>Hybrid</title>
            <link>https://example.com/1</link>
            <guid>h1</guid>
            <custom:badge color="green">Approved</custom:badge>
        </item>
    </channel>
</rss>
XML;
        $item = Feed::parse($xml)['items'][0];

        $this->assertSame(
            ['color' => 'green', '_text' => 'Approved'],
            $item['custom']['badge']
        );
    }

    public function testElementWithChildrenInDifferentNamespacesOnlyExposesSameNamespace(): void
    {
        // Namespace recursion follows the parent's namespace. A child in a
        // different namespace is NOT exposed under the parent bucket; it
        // would surface (if at all) under its own namespace at a higher
        // level. This keeps the per-namespace subtree predictable.
        $xml = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0"
     xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd"
     xmlns:dc="http://purl.org/dc/elements/1.1/">
    <channel>
        <title>Mixed</title>
        <link>https://example.com</link>
        <description>D</description>
        <item>
            <title>Episode</title>
            <link>https://example.com/ep</link>
            <guid>ep1</guid>
            <itunes:owner>
                <itunes:name>The Host</itunes:name>
                <dc:contributor>Random Other Person</dc:contributor>
            </itunes:owner>
        </item>
    </channel>
</rss>
XML;
        $item = Feed::parse($xml)['items'][0];

        // The same-namespace child surfaces under owner.
        $this->assertSame('The Host', $item['itunes']['owner']['name']);
        // The cross-namespace child does NOT bleed into the iTunes owner bucket.
        $this->assertArrayNotHasKey('contributor', $item['itunes']['owner']);
    }
}
