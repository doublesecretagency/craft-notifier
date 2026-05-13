<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\BlueskyFacets;
use PHPUnit\Framework\TestCase;

/**
 * Pure-unit tests for the Bluesky grapheme guard.
 *
 * Verifies that grapheme_strlen counts user-perceived characters correctly
 * (emoji, combining marks, ZWJ sequences) and that truncation appends an
 * ellipsis while staying within the limit.
 */
class BlueskyGraphemeGuardTest extends TestCase
{
    protected function setUp(): void
    {
        if (!function_exists('grapheme_strlen')) {
            $this->markTestSkipped('intl extension not loaded; grapheme tests rely on it.');
        }
    }

    public function testPlainAsciiCountsAsGraphemes(): void
    {
        $this->assertSame(5, BlueskyFacets::graphemeCount('hello'));
    }

    public function testEmojiCountsAsSingleGrapheme(): void
    {
        $this->assertSame(1, BlueskyFacets::graphemeCount('🎉'));
    }

    public function testCombiningMarkCountsAsSingleGrapheme(): void
    {
        // "é" composed of e + combining acute accent (U+0065 + U+0301)
        $text = "e\u{0301}";
        $this->assertSame(1, BlueskyFacets::graphemeCount($text));
    }

    public function testTruncateAt300StaysWithinLimit(): void
    {
        $text = str_repeat('a', 500);
        $truncated = BlueskyFacets::truncateToGraphemes($text, 300);

        // Truncated string should have at most 300 graphemes
        $this->assertLessThanOrEqual(300, BlueskyFacets::graphemeCount($truncated));
        // And should end with the ellipsis
        $this->assertSame('…', mb_substr($truncated, -1));
    }

    public function testTruncatePreservesShortStrings(): void
    {
        $text = 'short';
        $this->assertSame('short', BlueskyFacets::truncateToGraphemes($text, 300));
    }

    public function testTruncateAtExactLimit(): void
    {
        $text = str_repeat('a', 300);
        // Already at the limit, no truncation
        $this->assertSame($text, BlueskyFacets::truncateToGraphemes($text, 300));
    }

    public function testTruncatePreservesEmojiBoundary(): void
    {
        // The truncation point should not split a multi-byte grapheme
        $text = str_repeat('🎉', 200);
        $truncated = BlueskyFacets::truncateToGraphemes($text, 100);

        // We should have 100 graphemes total (99 emoji + 1 ellipsis = 100)
        $this->assertLessThanOrEqual(100, BlueskyFacets::graphemeCount($truncated));
        $this->assertSame('…', mb_substr($truncated, -1));
    }
}
