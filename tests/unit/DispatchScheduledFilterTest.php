<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Structural tests for scheduled-event filtering in Dispatch.
 *
 * Poll-driven trigger events (`date-reached`, `pending-to-live`) are selected
 * by the schedule runner, then run through the SAME event-type filters as
 * normal events: the type gate (Sections & Entry Types, Volumes, User Groups,
 * Product Types, Calendars) and the optional field-level condition. An earlier
 * revision short-circuited the event-type switch for them with an early
 * return; that bypass is gone, so scheduled notifications honor their
 * configured filters.
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

    public function testNoScheduledEventBypassRemains(): void
    {
        // The pre-3.1.x early return matched the scheduled event values and
        // returned before the event-type switch, skipping every filter. That
        // shape (in_array(... 'pending-to-live' ...)) { return ...) must be gone.
        $this->assertDoesNotMatchRegularExpression(
            "/in_array\([\s\S]{0,80}'pending-to-live'[\s\S]{0,40}\)\s*\)\s*\{\s*return/",
            $this->dispatchSource
        );
    }

    public function testConditionGateRunsAfterTheTypeSwitch(): void
    {
        // The optional field-level condition is the final gate for every event
        // that reaches the switch, scheduled events included.
        $this->assertMatchesRegularExpression(
            "/function filterByEventType\(\)[\s\S]*?switch\s*\([\s\S]*?return \\\$this->_matchEventCondition\(\);/",
            $this->dispatchSource
        );
    }

    public function testSaveContextFiltersGatedToSaveEvents(): void
    {
        // The save-context filter loop (first-save / draft / revision / new /
        // etc.) reads save-event shape; some filters even access $event->isNew,
        // which the scheduler's synthetic Event lacks. So _filterEntries() must
        // clear $filters for any non-save event before the loop, ensuring stale
        // config can't mis-gate (or error on) a scheduled or lifecycle dispatch.
        $this->assertMatchesRegularExpression(
            "/if \(!in_array\(\\\$this->notification->event, \['after-save', 'after-propagate'\], true\)\)[\s\S]*?\\\$filters = \[\];/",
            $this->dispatchSource
        );
    }
}
