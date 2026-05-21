<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Source-level structural tests for FeedRunner::seedNotification.
 *
 * The save-time seed path is what makes the docs' "initial scan on save"
 * claim true. It must bail early for non-feed notifications, empty Feed
 * URLs, and already-seeded notifications, then run the same fetch + parse
 * path the cron runner uses, then track every current item against the
 * notification. It must never dispatch.
 */
class FeedRunnerSeedNotificationTest extends TestCase
{
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/services/FeedRunner.php';
        $this->assertTrue(file_exists($path), "FeedRunner.php should exist at: $path");
        $this->source = file_get_contents($path);
    }

    // ========================================================================= //
    // Method existence
    // ========================================================================= //

    public function testDeclaresSeedNotificationMethod(): void
    {
        // The save-time entry point exists with the expected signature.
        $this->assertMatchesRegularExpression(
            "/public function seedNotification\(\s*Notification\s+\\\$notification\s*\)\s*:\s*bool/",
            $this->source
        );
    }

    // ========================================================================= //
    // Early-bail conditions
    // ========================================================================= //

    public function testSeedNotificationBailsWhenNotFeedEventType(): void
    {
        // The first guard must reject any notification whose eventType is not 'feed'.
        $this->assertMatchesRegularExpression(
            "/'feed'\s*!==\s*\\\$notification->eventType[\s\S]*?return false/",
            $this->source
        );
    }

    public function testSeedNotificationBailsWhenFeedUrlEmpty(): void
    {
        // After resolving the eventConfig['feedUrl'], an empty string must short-circuit.
        $this->assertMatchesRegularExpression(
            "/eventConfig\['feedUrl'\][\s\S]*?''\s*===\s*\\\$feedUrl[\s\S]*?return false/",
            $this->source
        );
    }

    public function testSeedNotificationBailsWhenMarkerAlreadyClaimed(): void
    {
        // Before fetching anything, check if the SEED_MARKER row already exists.
        $this->assertMatchesRegularExpression(
            "/itemId'\s*=>\s*self::SEED_MARKER[\s\S]*?->exists\(\)[\s\S]*?return false/",
            $this->source
        );
    }

    // ========================================================================= //
    // Seed-only behavior
    // ========================================================================= //

    public function testSeedNotificationDoesNotDispatch(): void
    {
        // The seed path must never invoke _send (the dispatch helper). Pull
        // out the body of seedNotification by regex and check it's clean.
        $matched = preg_match(
            "/public function seedNotification\([\s\S]*?\n    \}/",
            $this->source,
            $matches
        );
        $this->assertSame(1, $matched, 'Expected to find the seedNotification method body.');
        $this->assertStringNotContainsString('$this->_send', $matches[0]);
    }

    public function testSeedNotificationUsesSharedFetchAndParse(): void
    {
        // To avoid drift between cron and save-time, both paths share _fetchAndParse.
        $this->assertMatchesRegularExpression(
            "/public function seedNotification[\s\S]*?\\\$this->_fetchAndParse\(\\\$notification\)/",
            $this->source
        );
    }

    public function testSeedNotificationClaimsMarkerAndTracksItems(): void
    {
        // After parsing, claim the marker and loop the parsed items to track each.
        $this->assertMatchesRegularExpression(
            "/public function seedNotification[\s\S]*?_markFirstScan[\s\S]*?foreach[\s\S]*?_trackItem/",
            $this->source
        );
    }

    public function testSeedNotificationIteratesOldestToNewest(): void
    {
        // Feeds are ordered newest-first; we reverse so seeded item IDs are
        // inserted in chronological order.
        $this->assertMatchesRegularExpression(
            "/public function seedNotification[\s\S]*?foreach\s*\(\s*array_reverse\(\\\$parsed\['items'\]\)/",
            $this->source
        );
    }
}
