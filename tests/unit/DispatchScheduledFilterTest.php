<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Structural tests for the scheduled-event bypass in Dispatch.
 *
 * Poll-driven trigger events (`date-reached`, `pending-to-live`) have no
 * section / entry-type / filter config on the Event tab, so the normal
 * `_filterEntries()` membership gate would drop every one of their
 * dispatches. The schedule runner has already selected the exact elements, so
 * `filterByEventType()` must short-circuit to `true` for them before the
 * event-type switch runs.
 */
class DispatchScheduledFilterTest extends TestCase
{
    private string $dispatchSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/Dispatch.php';
        $this->assertTrue(file_exists($path), "Dispatch.php should exist at: $path");
        $this->dispatchSource = file_get_contents($path);
    }

    public function testFilterNamesBothScheduledEvents(): void
    {
        // Both poll-driven event values must be in the bypass list.
        $this->assertStringContainsString("'date-reached'", $this->dispatchSource);
        $this->assertStringContainsString("'pending-to-live'", $this->dispatchSource);
    }

    public function testFilterBypassesScheduledEventsBeforeTheSwitch(): void
    {
        // The early return must sit inside filterByEventType(), check the
        // event against both scheduled values, and return true before the
        // event-type switch is reached.
        $this->assertMatchesRegularExpression(
            "/function filterByEventType\(\)[\s\S]*?in_array\([\s\S]*?'date-reached'[\s\S]*?'pending-to-live'[\s\S]*?return true;[\s\S]*?switch\b/",
            $this->dispatchSource
        );
    }
}
