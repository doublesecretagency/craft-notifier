<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Structural tests for the RSS bypass in Dispatch.
 *
 * The RSS Feed event type has no element subject, so the standard
 * `_filterEntries() / _filterAssets() / _filterUsers()` element filters
 * cannot apply -- the runner has already selected the exact items to
 * dispatch. `filterByEventType()` must short-circuit to `true` for
 * `eventType === 'feed'` before the event-type switch is reached;
 * otherwise the `default` branch returns `false` and every RSS dispatch
 * gets silently dropped.
 */
class DispatchFeedFilterTest extends TestCase
{
    private string $dispatchSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/Dispatch.php';
        $this->assertTrue(file_exists($path), "Dispatch.php should exist at: $path");
        $this->dispatchSource = file_get_contents($path);
    }

    public function testFilterRecognizesRssFeedEventType(): void
    {
        // The bypass anchors on the event-type slug, not the event value.
        $this->assertStringContainsString("'feed'", $this->dispatchSource);
    }

    public function testFilterBypassesRssBeforeTheSwitch(): void
    {
        // The early return must sit inside filterByEventType(), check the
        // event type, and return true before the event-type switch is reached.
        $this->assertMatchesRegularExpression(
            "/function filterByEventType\(\)[\s\S]*?'feed' === \\\$this->notification->eventType[\s\S]*?return true;[\s\S]*?switch\b/",
            $this->dispatchSource
        );
    }
}
