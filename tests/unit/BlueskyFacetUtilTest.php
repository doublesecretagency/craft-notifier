<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\BlueskyFacets;
use PHPUnit\Framework\TestCase;

/**
 * Pure-unit tests for the Bluesky facet builder.
 *
 * Verifies URL, mention and hashtag detection, byte-offset computation, and
 * the trailing-punctuation trim for URLs and hashtags.
 */
class BlueskyFacetUtilTest extends TestCase
{
    // ========================================================================= //
    // URL detection
    // ========================================================================= //

    public function testDetectsSingleUrl(): void
    {
        $text = 'Check out https://example.com today.';
        $facets = BlueskyFacets::detectLinks($text);

        $this->assertCount(1, $facets);
        $facet = $facets[0];
        $this->assertSame('app.bsky.richtext.facet#link', $facet['features'][0]['$type']);
        $this->assertSame('https://example.com', $facet['features'][0]['uri']);
    }

    public function testDetectsUrlAtStartOfText(): void
    {
        $text = 'https://example.com is the place.';
        $facets = BlueskyFacets::detectLinks($text);

        $this->assertCount(1, $facets);
        $this->assertSame(0, $facets[0]['index']['byteStart']);
        $this->assertSame(strlen('https://example.com'), $facets[0]['index']['byteEnd']);
    }

    public function testDetectsMultipleUrls(): void
    {
        $text = 'Two links: https://a.test and https://b.test';
        $facets = BlueskyFacets::detectLinks($text);

        $this->assertCount(2, $facets);
        $this->assertSame('https://a.test', $facets[0]['features'][0]['uri']);
        $this->assertSame('https://b.test', $facets[1]['features'][0]['uri']);
    }

    public function testStripsTrailingPunctuationFromUrl(): void
    {
        // Sentence punctuation shouldn't be part of the link
        $text = 'See https://example.com.';
        $facets = BlueskyFacets::detectLinks($text);

        $this->assertCount(1, $facets);
        $this->assertSame('https://example.com', $facets[0]['features'][0]['uri']);
        $this->assertSame(strlen('See https://example.com'), $facets[0]['index']['byteEnd']);
    }

    public function testEmptyTextProducesNoUrlFacets(): void
    {
        $this->assertSame([], BlueskyFacets::detectLinks(''));
        $this->assertSame([], BlueskyFacets::detectLinks('No URLs here.'));
    }

    public function testStripsVariousTrailingPunctuationFromUrls(): void
    {
        // Each of these sentence-punctuation characters must be trimmed off the captured URL
        foreach (['!', '?', ',', ';', ':'] as $punct) {
            $facets = BlueskyFacets::detectLinks("Visit https://example.com{$punct} now");

            $this->assertCount(1, $facets, "trailing '{$punct}' should still yield one facet");
            $this->assertSame(
                'https://example.com',
                $facets[0]['features'][0]['uri'],
                "trailing '{$punct}' should be trimmed from the link URI"
            );
        }
    }

    public function testByteOffsetCorrectForMultiByteText(): void
    {
        // The Cyrillic prefix is multi-byte; byteStart must be in bytes, not chars
        $text = 'Привет https://example.com';
        $facets = BlueskyFacets::detectLinks($text);

        $this->assertCount(1, $facets);
        $expectedStart = strlen('Привет '); // strlen returns byte count in PHP
        $this->assertSame($expectedStart, $facets[0]['index']['byteStart']);
    }

    // ========================================================================= //
    // Mention detection
    // ========================================================================= //

    public function testDetectsMentionWhenResolverResolves(): void
    {
        $text = 'Hello @example.bsky.social.';
        $resolver = static function (string $handle): ?string {
            return ('example.bsky.social' === $handle) ? 'did:plc:abc123' : null;
        };

        $facets = BlueskyFacets::detectMentions($text, $resolver);

        $this->assertCount(1, $facets);
        $this->assertSame('app.bsky.richtext.facet#mention', $facets[0]['features'][0]['$type']);
        $this->assertSame('did:plc:abc123', $facets[0]['features'][0]['did']);
    }

    public function testSkipsMentionWhenResolverReturnsNull(): void
    {
        $text = 'Hello @team.example.com.';
        $resolver = static fn(string $handle): ?string => null;

        $facets = BlueskyFacets::detectMentions($text, $resolver);

        $this->assertSame([], $facets);
    }

    public function testSkipsMentionWhenNoResolverProvided(): void
    {
        $text = 'Hello @example.bsky.social.';

        $facets = BlueskyFacets::detectMentions($text, null);

        $this->assertSame([], $facets);
    }

    public function testMentionOffsetIncludesAtSign(): void
    {
        $text = '@example.bsky.social hi';
        $resolver = static fn(string $handle): ?string => 'did:plc:abc';

        $facets = BlueskyFacets::detectMentions($text, $resolver);

        $this->assertCount(1, $facets);
        $this->assertSame(0, $facets[0]['index']['byteStart']);
        $this->assertSame(strlen('@example.bsky.social'), $facets[0]['index']['byteEnd']);
    }

    // ========================================================================= //
    // Hashtag detection
    // ========================================================================= //

    public function testDetectsHashtagWithOffsetsIncludingTheHash(): void
    {
        // The shape of a real post: title, tag, then the link on its own line
        $text = "Craft Developer (Remote) #CraftCMS\nhttps://example.com/jobs/1";
        $facets = BlueskyFacets::detectTags($text);

        $this->assertCount(1, $facets);
        $this->assertSame('app.bsky.richtext.facet#tag', $facets[0]['features'][0]['$type']);
        $this->assertSame('CraftCMS', $facets[0]['features'][0]['tag']);

        $start = strpos($text, '#CraftCMS');
        $this->assertSame($start, $facets[0]['index']['byteStart']);
        $this->assertSame($start + strlen('#CraftCMS'), $facets[0]['index']['byteEnd']);
    }

    public function testDetectsHashtagAtStartOfText(): void
    {
        $facets = BlueskyFacets::detectTags('#craftcms is great');

        $this->assertCount(1, $facets);
        $this->assertSame(0, $facets[0]['index']['byteStart']);
    }

    public function testDetectsMultipleHashtags(): void
    {
        $facets = BlueskyFacets::detectTags('Hiring! #CraftCMS #PHP #webdev');

        $this->assertSame(['CraftCMS', 'PHP', 'webdev'], array_map(static fn($f) => $f['features'][0]['tag'], $facets));
    }

    public function testStripsTrailingPunctuationFromHashtag(): void
    {
        $text = 'We love #CraftCMS!';
        $facets = BlueskyFacets::detectTags($text);

        $this->assertCount(1, $facets);
        $this->assertSame('CraftCMS', $facets[0]['features'][0]['tag']);
        $this->assertSame(strlen('We love #CraftCMS'), $facets[0]['index']['byteEnd']);
    }

    public function testIgnoresHashInsideUrlOrWord(): void
    {
        // A URL fragment and a mid-word # are not tags
        $this->assertSame([], BlueskyFacets::detectTags('See https://example.com/page#section'));
        $this->assertSame([], BlueskyFacets::detectTags('Issue C#123 and F#'));
    }

    public function testIgnoresNumericOnlyAndBareHash(): void
    {
        $this->assertSame([], BlueskyFacets::detectTags('We are #1 # and #!'));
    }

    public function testIgnoresTagLongerThanBlueskyAllows(): void
    {
        $this->assertSame([], BlueskyFacets::detectTags('#'.str_repeat('a', 65)));
        $this->assertCount(1, BlueskyFacets::detectTags('#'.str_repeat('a', 64)));
    }

    public function testHashtagByteOffsetCorrectForMultiByteText(): void
    {
        $text = 'Café ☕ #caféculture';
        $facets = BlueskyFacets::detectTags($text);

        $this->assertCount(1, $facets);
        $this->assertSame('caféculture', $facets[0]['features'][0]['tag']);
        $this->assertSame('#caféculture', substr($text, $facets[0]['index']['byteStart'], $facets[0]['index']['byteEnd'] - $facets[0]['index']['byteStart']));
    }

    // ========================================================================= //
    // build() combines all three
    // ========================================================================= //

    public function testBuildReturnsLinksAndMentionsTogether(): void
    {
        $text = 'Visit https://example.com or follow @example.bsky.social';
        $resolver = static fn(string $handle): ?string => 'did:plc:abc';

        $facets = BlueskyFacets::build($text, $resolver);

        $this->assertCount(2, $facets);
    }

    public function testBuildIncludesHashtags(): void
    {
        $text = "Craft Developer #CraftCMS\nhttps://example.com/jobs/1";
        $types = array_map(static fn($f) => $f['features'][0]['$type'], BlueskyFacets::build($text));

        $this->assertContains('app.bsky.richtext.facet#link', $types);
        $this->assertContains('app.bsky.richtext.facet#tag', $types);
    }
}
