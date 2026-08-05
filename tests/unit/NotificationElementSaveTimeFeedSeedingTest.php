<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Source-level structural tests for the save-time feed-seeding hook.
 *
 * Notification::afterSave must capture the previously-saved Feed URL
 * before overwriting the record, then call _ensureFeedSeeding($oldFeedUrl).
 * The helper compares old vs new URLs, wipes the existing tracking history
 * on a URL change, and runs the initial seed if a URL is configured. The
 * whole flow is wrapped in a try/catch so a feed failure cannot fail the
 * save itself.
 */
class NotificationElementSaveTimeFeedSeedingTest extends TestCase
{
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/elements/Notification.php';
        $this->assertTrue(file_exists($path), "Notification.php should exist at: $path");
        $this->source = file_get_contents($path);
    }

    // ========================================================================= //
    // afterSave wiring
    // ========================================================================= //

    public function testCapturesOldEventTypeAndFeedUrlBeforeOverwritingRecord(): void
    {
        // Both the old Event Type and the old Feed URL must be captured from $record
        // before the record's fields are reassigned and saved.
        $this->assertMatchesRegularExpression(
            "/\\\$oldEventType\s*=\s*\\\$record->eventType[\s\S]*?\\\$oldFeedUrl\s*=\s*trim\([\s\S]*?\\\$oldEventConfig\['feedUrl'\][\s\S]*?\\\$record->save\(false\)/",
            $this->source
        );
    }

    public function testDecodesRecordEventConfigJsonBeforeReadingOldFeedUrl(): void
    {
        // NotificationRecord doesn't auto-decode JSON columns: a freshly-loaded record returns
        // eventConfig as a raw JSON string. Reading it as `$record->eventConfig['feedUrl']`
        // silently returns null because array-access on a string yields nothing.
        // The capture must json_decode the string first, defensively handling both the
        // string-from-load and array-from-just-assignment cases.
        $this->assertMatchesRegularExpression(
            "/is_string\(\\\$record->eventConfig\)[\s\S]*?json_decode\(\\\$record->eventConfig,\s*true\)/",
            $this->source
        );
    }

    public function testAfterSaveCallsEnsureFeedSeeding(): void
    {
        // The hook fires right after _ensureScheduleTracking, with both old values.
        $this->assertMatchesRegularExpression(
            "/_ensureScheduleTracking[\s\S]*?_ensureFeedSeeding\(\\\$oldEventType,\s*\\\$oldFeedUrl\)/",
            $this->source
        );
    }

    public function testSyncsElementEventConfigFromRecordAfterSave(): void
    {
        // POST values land on $record (not $this) during afterSave. Without syncing back,
        // $this->eventConfig still reflects the load-time state and the feed-seeding compare
        // would see OLD vs OLD on a URL change (the check falsely bails). Also affects
        // feedRunner->seedNotification($this) which reads the URL from $this->eventConfig.
        // The sync must happen after $record->save(false) and before _ensureFeedSeeding.
        $this->assertMatchesRegularExpression(
            "/\\\$record->save\(false\)[\s\S]*?\\\$this->eventType\s*=\s*\\\$record->eventType[\s\S]*?\\\$this->eventConfig\s*=\s*is_array\(\\\$record->eventConfig\)[\s\S]*?_ensureFeedSeeding/",
            $this->source
        );
    }

    // ========================================================================= //
    // _ensureFeedSeeding behavior
    // ========================================================================= //

    public function testEnsureFeedSeedingBailsForDraftsAndRevisions(): void
    {
        // Drafts and revisions live at their own element IDs with no prior NotificationRecord,
        // so the old-vs-new compare would look like a brand-new feed every save. Seeding must
        // only happen on canonical saves. This guard must come before the eventType check so
        // the cheaper isDraft / isRevision rejection runs first.
        $this->assertMatchesRegularExpression(
            "/_ensureFeedSeeding[\s\S]*?\\\$this->getIsDraft\(\)\s*\|\|\s*\\\$this->getIsRevision\(\)[\s\S]*?return[\s\S]*?'feed'\s*!==\s*\\\$this->eventType/",
            $this->source
        );
    }

    public function testEnsureFeedSeedingBailsForNonFeedEventTypes(): void
    {
        // The eventType guard must reject any notification whose eventType is not 'feed'.
        $this->assertMatchesRegularExpression(
            "/_ensureFeedSeeding[\s\S]*?'feed'\s*!==\s*\\\$this->eventType[\s\S]*?return/",
            $this->source
        );
    }

    public function testEnsureFeedSeedingBailsWhenNoUrlConfigured(): void
    {
        // Empty Feed URL guard must come before any wipe/seed work.
        $this->assertMatchesRegularExpression(
            "/_ensureFeedSeeding[\s\S]*?\\\$newFeedUrl\s*=\s*trim[\s\S]*?if\s*\(''\s*===\s*\\\$newFeedUrl\)[\s\S]*?return/",
            $this->source
        );
    }

    public function testEnsureFeedSeedingWipesHistoryWhenUrlChangedOrJustReactivated(): void
    {
        // The wipe must fire when EITHER the Feed URL changed OR the Event Type just became
        // 'feed' (the notification was reactivated after a dormant period under a different
        // Event Type). Without the eventType-changed half, a dormant feedUrl that stayed in
        // eventConfig untouched would carry its stale seed marker forward into the new active
        // period, and the next scheduled run would flood recipients with messages for every
        // item that appeared during dormancy.
        $this->assertMatchesRegularExpression(
            "/if\s*\(\s*'feed'\s*!==\s*\\\$oldEventType\s*\|\|\s*\\\$oldFeedUrl\s*!==\s*\\\$newFeedUrl\s*\)\s*\{[\s\S]*?feedRunner->wipeHistory\(\\\$this->id\)[\s\S]*?\}/",
            $this->source
        );
    }

    public function testEnsureFeedSeedingAlwaysCallsSeedNotificationForReliableReseed(): void
    {
        // seedNotification must be called UNCONDITIONALLY (not inside the wipe conditional),
        // because we rely on its internal idempotency: if the SEED_MARKER row is present, it
        // bails as a no-op; if the marker is missing (manual truncate, fresh notification,
        // just-wiped history), it seeds. This is what lets a truncate + resave re-seed
        // naturally, and is what makes the dormant-to-active flip safe.
        // Structural check: wipeHistory inside an if-block that closes, then a blank line,
        // then seedNotification at the same indent (outside the conditional).
        $this->assertMatchesRegularExpression(
            "/wipeHistory\(\\\$this->id\);\s*\n\s*\}\s*\n\s*\n[\s\S]*?feedRunner->seedNotification\(\\\$this\)/",
            $this->source
        );
    }

    public function testEnsureFeedSeedingWrapsInTryCatchSoSaveCannotFail(): void
    {
        // The seed/wipe calls must be inside a try/catch (Throwable) block
        // whose body logs the failure but does not rethrow. The failure is
        // logged as a warning nested under a feed scan parent, never as an
        // independent top-level error row.
        $matched = preg_match(
            "/_ensureFeedSeeding[\s\S]*?try\s*\{[\s\S]*?\}\s*catch\s*\(\s*Throwable\s+\\\$e\s*\)\s*\{([\s\S]*?)\}/",
            $this->source,
            $matches
        );
        $this->assertSame(1, $matched, 'Expected to find the try/catch wrapping the seed/wipe calls.');
        $this->assertStringContainsString('log->feedScan', $matches[1]);
        $this->assertStringContainsString('log->warning', $matches[1]);
        $this->assertStringNotContainsString('log->error', $matches[1]);
        $this->assertStringNotContainsString('throw', $matches[1]);
    }

    public function testEnsureFeedSeedingHasNoShortCircuitCheck(): void
    {
        // The earlier "if (!$eventTypeChanged && !$urlChanged) return" short-circuit was
        // removed deliberately. seedNotification is idempotent (it bails when the SEED_MARKER
        // row is present), so we rely on that instead. That also lets a manual truncate of
        // the tracking table re-seed naturally on the next save. Confirm the dead variables
        // and short-circuit don't sneak back in via a future refactor.
        $this->assertDoesNotMatchExpression('eventTypeChanged');
        $this->assertDoesNotMatchExpression('!$eventTypeChanged && !$urlChanged');
    }

    private function assertDoesNotMatchExpression(string $needle): void
    {
        $this->assertStringNotContainsString(
            $needle,
            $this->source,
            "Source should no longer contain '$needle'. The short-circuit check was removed in favor of seedNotification's internal idempotency."
        );
    }
}
