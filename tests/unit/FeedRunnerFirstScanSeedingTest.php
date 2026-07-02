<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Source-level structural tests for the RSS runner's first-scan seeding.
 *
 * The first time a notification is processed, the runner tracks every
 * currently-visible feed item in the tracking table and dispatches nothing.
 * Subsequent ticks dispatch only items whose item ID is new. The seed
 * marker is what tells the two cases apart, so its presence -- and the
 * "do not dispatch on first scan" branch around it -- are pinned here.
 */
class FeedRunnerFirstScanSeedingTest extends TestCase
{
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/services/FeedRunner.php';
        $this->assertTrue(file_exists($path), "FeedRunner.php should exist at: $path");
        $this->source = file_get_contents($path);
    }

    // ========================================================================= //
    // Seed marker
    // ========================================================================= //

    public function testDeclaresASeedMarkerConstant(): void
    {
        // A reserved itemId distinguishes "we have seen this notification"
        // from "the feed was empty on the first scan." The constant value is
        // implementation detail; only its existence is part of the contract.
        $this->assertMatchesRegularExpression(
            "/const\s+SEED_MARKER\b/",
            $this->source
        );
    }

    public function testFirstScanIsMarkedAfterSuccessfulParse(): void
    {
        // The marker is only claimed AFTER parseAuto succeeds, so a failed parse
        // never leaves a stale marker that would back-fill on the next scan.
        $this->assertMatchesRegularExpression(
            "/Feed::parseAuto\([\s\S]*?_markFirstScan\(/",
            $this->source
        );
    }

    public function testParseFailureLogsAndBailsWithoutClaimingMarker(): void
    {
        // The catch block for FeedParseException lives inside _fetchAndParse,
        // and must log the failure as a warning nested under a feed scan
        // parent, then return null.
        $this->assertMatchesRegularExpression(
            "/catch\s*\(\s*FeedParseException[\s\S]*?log->feedScan\([\s\S]*?log->warning\([\s\S]*?return null;[\s\S]*?\}/",
            $this->source
        );

        // The catch body itself must not claim the marker.
        $matched = preg_match(
            "/catch\s*\(\s*FeedParseException[^}]*\}/",
            $this->source,
            $matches
        );
        $this->assertSame(1, $matched, 'Expected to find the FeedParseException catch block.');
        $this->assertStringNotContainsString('_markFirstScan', $matches[0]);

        // _runNotification must bail when _fetchAndParse returns null,
        // before reaching the _markFirstScan call.
        $this->assertMatchesRegularExpression(
            "/_fetchAndParse[\s\S]*?if\s*\(\s*null\s*===\s*\\\$parsed\s*\)\s*\{[\s\S]*?return\s+\[0,\s*0\];[\s\S]*?\}[\s\S]*?_markFirstScan/",
            $this->source
        );
    }

    // ========================================================================= //
    // First-scan branch
    // ========================================================================= //

    public function testFirstScanSeedsEveryItemWithoutDispatching(): void
    {
        // The first-scan branch loops the parsed items and tracks each one,
        // then early-returns with no dispatch call.
        $this->assertMatchesRegularExpression(
            "/isFirstScan[\s\S]*?foreach[\s\S]*?_trackItem[\s\S]*?return\s+\[0,\s*0\]/",
            $this->source
        );
    }

    public function testFirstScanIteratesOldestToNewest(): void
    {
        // Feeds are ordered newest-first; we reverse so seeded item IDs are
        // inserted in chronological order.
        $this->assertMatchesRegularExpression(
            "/isFirstScan[\s\S]*?foreach\s*\(\s*array_reverse\(\\\$parsed\['items'\]\)/",
            $this->source
        );
    }

    public function testSubsequentScanIteratesOldestToNewest(): void
    {
        // The dispatch branch reverses items so messages arrive in chronological order.
        $this->assertMatchesRegularExpression(
            "/_trackItem[\s\S]*?continue[\s\S]*?_send/",
            $this->source
        );
        // The dispatch loop runs over array_reverse, not the raw items array.
        $this->assertMatchesRegularExpression(
            "/\\\$dispatched\s*=\s*0;[\s\S]*?\\\$sent\s*=\s*0;[\s\S]*?foreach\s*\(\s*array_reverse\(\\\$parsed\['items'\]\)/",
            $this->source
        );
    }

    public function testSubsequentScanSkipsAlreadyTrackedItems(): void
    {
        // If trackItem returns false (item already known), the runner skips
        // the dispatch. This is the line that prevents duplicate sends.
        $this->assertMatchesRegularExpression(
            "/!\\\$this->_trackItem\([\s\S]*?continue/",
            $this->source
        );
    }

    public function testTracksIntoTheTrackingTable(): void
    {
        // INSERT statements must target the tracking table itself.
        $this->assertStringContainsString(
            '{{%notifier_trackfeeds}}',
            $this->source
        );
    }

    // ========================================================================= //
    // Variable bridging
    // ========================================================================= //

    public function testDispatchPassesItemAndFeedThroughTheData(): void
    {
        // The Twig context seeds `item` and `feed` through the data array
        // (see Dispatch::_parseTwig). The dispatch call must hand both off.
        $this->assertMatchesRegularExpression(
            "/messages->send\([\s\S]*?'item'[\s\S]*?'feed'/",
            $this->source
        );
    }
}
