<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\BlueskyFacets;
use PHPUnit\Framework\TestCase;

/**
 * Pure-unit tests for the Bluesky facet builder.
 *
 * Verifies URL detection, mention detection, byte-offset computation, and
 * the trailing-punctuation trim for URLs.
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
    // build() combines both
    // ========================================================================= //

    public function testBuildReturnsLinksAndMentionsTogether(): void
    {
        $text = 'Visit https://example.com or follow @example.bsky.social';
        $resolver = static fn(string $handle): ?string => 'did:plc:abc';

        $facets = BlueskyFacets::build($text, $resolver);

        $this->assertCount(2, $facets);
    }
}
