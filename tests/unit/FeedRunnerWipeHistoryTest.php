<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Source-level structural tests for FeedRunner::wipeHistory.
 *
 * Called from Notification::afterSave when the Feed URL changes. Removes
 * every tracking row for the notification (seed marker plus every tracked
 * item) so the next save-time seed starts fresh against the new feed.
 */
class FeedRunnerWipeHistoryTest extends TestCase
{
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/services/FeedRunner.php';
        $this->assertTrue(file_exists($path), "FeedRunner.php should exist at: $path");
        $this->source = file_get_contents($path);
    }

    public function testDeclaresWipeHistoryMethod(): void
    {
        // The method takes a notification ID and returns void.
        $this->assertMatchesRegularExpression(
            "/public function wipeHistory\(\s*int\s+\\\$notificationId\s*\)\s*:\s*void/",
            $this->source
        );
    }

    public function testWipeHistoryDeletesFromTrackingTable(): void
    {
        // The body must issue a DELETE against self::TABLE with notificationId in the where clause.
        $this->assertMatchesRegularExpression(
            "/public function wipeHistory[\s\S]*?->delete\(\s*self::TABLE\s*,\s*\['notificationId'\s*=>\s*\\\$notificationId\][\s\S]*?->execute\(\)/",
            $this->source
        );
    }
}
