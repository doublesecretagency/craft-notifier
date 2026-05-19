<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Structural tests for the "When a date is reached" config handling.
 *
 * The three date controls are rendered once per element-type tab, so their
 * field names are namespaced per type (`dateReached_<eventType>`) exactly
 * like the manual-trigger label. `Notification::afterSave()` must read the
 * active tab's namespaced param and store a sanitized copy under
 * `eventConfig['dateReached']`.
 */
class NotificationDateReachedConfigTest extends TestCase
{
    private string $notificationSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/elements/Notification.php';
        $this->assertTrue(file_exists($path), "Notification.php should exist at: $path");
        $this->notificationSource = file_get_contents($path);
    }

    public function testReadsNamespacedDateReachedParam(): void
    {
        // The param name carries the event type so the eight element-type
        // tabs never collide on a shared POST key.
        $this->assertStringContainsString(
            'dateReached_{$selectedEventType}',
            $this->notificationSource
        );
    }

    public function testWritesDateReachedIntoEventConfig(): void
    {
        // The resolved config is persisted under eventConfig['dateReached'].
        $this->assertMatchesRegularExpression(
            "/\\\$eventConfig\\['dateReached'\\]\s*=/",
            $this->notificationSource
        );
    }

    public function testStoresAllThreeConfigKeys(): void
    {
        // field / direction / offset are the three controls the schedule runner reads.
        $this->assertMatchesRegularExpression(
            "/\\\$eventConfig\\['dateReached'\\]\s*=\s*\[[\s\S]*?'field'[\s\S]*?'direction'[\s\S]*?'offset'[\s\S]*?\]/",
            $this->notificationSource
        );
    }

    // ========================================================================= //
    // Scheduled history seeding on save
    // ========================================================================= //

    public function testAfterSaveSeedsScheduledHistoryRow(): void
    {
        // afterSave guarantees the scheduled-history row for a scheduled
        // notification, rather than leaving it to the runner's lazy seed.
        $this->assertStringContainsString('_ensureScheduledHistory(', $this->notificationSource);
        $this->assertStringContainsString('{{%notifier_scheduledhistory}}', $this->notificationSource);
    }

    public function testScheduledHistorySeedGuardsOnScheduledEvents(): void
    {
        // Only date-reached and pending-to-live get a cursor row.
        $this->assertMatchesRegularExpression(
            "/_ensureScheduledHistory[\s\S]*?'date-reached'[\s\S]*?'pending-to-live'/",
            $this->notificationSource
        );
    }

    public function testScheduledHistorySeedDoesNotClobberExistingRow(): void
    {
        // An existing cursor must be left untouched; re-seeding it would reset
        // the run window and re-fire past crossings.
        $this->assertMatchesRegularExpression(
            "/_ensureScheduledHistory[\s\S]*?->exists\(\)/",
            $this->notificationSource
        );
    }
}
