<?php
namespace doublesecretagency\notifier\tests\unit;

use DateTime;
use DateTimeZone;
use doublesecretagency\notifier\helpers\RecurringSchedule;
use PHPUnit\Framework\TestCase;

/**
 * Pure-unit tests for the shared recurring-schedule cadence helper.
 *
 * RecurringSchedule::nextRunAfter() is the single source of truth for "when
 * does this schedule fire next" across both System Snapshot and Dynamic Data.
 * It takes everything as parameters (no Craft globals, no DB), so every case
 * here runs against frozen DateTime inputs.
 */
class RecurringScheduleTest extends TestCase
{
    /**
     * Invoke nextRunAfter() with a reference string and config.
     */
    private function next(string $reference, array $config, string $tz = 'UTC'): DateTime
    {
        $zone = new DateTimeZone($tz);
        return RecurringSchedule::nextRunAfter(new DateTime($reference, $zone), $config, $zone);
    }

    // ========================================================================= //
    // defaults() + normalize()
    // ========================================================================= //

    public function testDefaultsAreWeeklyMondayNineAm(): void
    {
        $defaults = RecurringSchedule::defaults();
        $this->assertSame('weekly', $defaults['frequency']);
        $this->assertSame(1, $defaults['dayOfWeek']);
        $this->assertSame(1, $defaults['dayOfMonth']);
        $this->assertSame('09:00', $defaults['time']);
    }

    public function testNormalizeFallsBackOnGarbageFrequency(): void
    {
        // A malformed frequency (e.g. 'hourly') falls back to the default 'weekly'.
        $config = RecurringSchedule::normalize(['frequency' => 'hourly']);
        $this->assertSame('weekly', $config['frequency']);
    }

    public function testNormalizeAcceptsYearly(): void
    {
        // 'yearly' is a supported frequency.
        $config = RecurringSchedule::normalize(['frequency' => 'yearly']);
        $this->assertSame('yearly', $config['frequency']);
    }

    public function testIntervalDefaultsToOne(): void
    {
        // A config with no interval normalizes to 1.
        $config = RecurringSchedule::normalize([]);
        $this->assertSame(1, $config['interval']);
        // The defaults also expose interval 1.
        $this->assertSame(1, RecurringSchedule::defaults()['interval']);
    }

    public function testNormalizeClampsIntervalToAtLeastOne(): void
    {
        // Zero and negative intervals clamp up to 1.
        $this->assertSame(1, RecurringSchedule::normalize(['interval' => 0])['interval']);
        $this->assertSame(1, RecurringSchedule::normalize(['interval' => -5])['interval']);
    }

    public function testNormalizeClampsPinMonth(): void
    {
        // The yearly pin month clamps into the calendar range (1-12).
        $this->assertSame(1, RecurringSchedule::normalize(['pinMonth' => 0])['pinMonth']);
        $this->assertSame(12, RecurringSchedule::normalize(['pinMonth' => 13])['pinMonth']);
    }

    public function testNormalizeKeepsValidStartDateAndDropsGarbage(): void
    {
        // A real calendar date is kept verbatim.
        $this->assertSame('2026-08-01', RecurringSchedule::normalize(['startDate' => '2026-08-01'])['startDate']);
        // A malformed or impossible date falls back to empty (no floor).
        $this->assertSame('', RecurringSchedule::normalize(['startDate' => 'soon'])['startDate']);
        $this->assertSame('', RecurringSchedule::normalize(['startDate' => '2026-02-30'])['startDate']);
        // A missing start date is empty (no floor) so old configs keep their behavior.
        $this->assertSame('', RecurringSchedule::normalize([])['startDate']);
    }

    public function testNormalizeClampsDayOfMonthToTwentyEight(): void
    {
        // The form caps day-of-month at 28; normalize enforces it defensively.
        $config = RecurringSchedule::normalize(['dayOfMonth' => 31]);
        $this->assertSame(28, $config['dayOfMonth']);
    }

    public function testNormalizeRepairsMalformedTime(): void
    {
        // A non "HH:MM" time falls back to the default.
        $config = RecurringSchedule::normalize(['time' => 'noon']);
        $this->assertSame('09:00', $config['time']);
    }

    // ========================================================================= //
    // Daily
    // ========================================================================= //

    public function testDailyReturnsTodayWhenBeforeTime(): void
    {
        // Reference before today's slot returns today at the configured time.
        $next = $this->next('2026-06-04 08:00:00', ['frequency' => 'daily', 'time' => '09:00']);
        $this->assertSame('2026-06-04 09:00', $next->format('Y-m-d H:i'));
    }

    public function testDailyAdvancesToTomorrowWhenAfterTime(): void
    {
        // Reference after today's slot advances to tomorrow.
        $next = $this->next('2026-06-04 09:30:00', ['frequency' => 'daily', 'time' => '09:00']);
        $this->assertSame('2026-06-05 09:00', $next->format('Y-m-d H:i'));
    }

    // ========================================================================= //
    // Weekly
    // ========================================================================= //

    public function testWeeklyLandsOnTargetWeekdayInFuture(): void
    {
        // Target Wednesday (ISO 3) from a Monday reference.
        $next = $this->next('2026-06-01 12:00:00', ['frequency' => 'weekly', 'dayOfWeek' => 3, 'time' => '09:00']);
        $this->assertSame(3, (int) $next->format('N'));
        $this->assertSame('09:00', $next->format('H:i'));
        $this->assertGreaterThan(new DateTime('2026-06-01 12:00:00', new DateTimeZone('UTC')), $next);
    }

    public function testWeeklyUsesTodayWhenWeekdayMatchesAndTimeNotYetPassed(): void
    {
        // Reference falls on the target weekday, before the time → today.
        $next = $this->next('2026-06-03 07:00:00', ['frequency' => 'weekly', 'dayOfWeek' => 3, 'time' => '09:00']);
        $this->assertSame('2026-06-03 09:00', $next->format('Y-m-d H:i'));
    }

    public function testWeeklyWrapsToNextWeekWhenTodayMatchesButTimePassed(): void
    {
        // Reference on the target weekday but after the time → next week.
        $next = $this->next('2026-06-03 10:00:00', ['frequency' => 'weekly', 'dayOfWeek' => 3, 'time' => '09:00']);
        $this->assertSame('2026-06-10 09:00', $next->format('Y-m-d H:i'));
        $this->assertSame(3, (int) $next->format('N'));
    }

    // ========================================================================= //
    // Monthly
    // ========================================================================= //

    public function testMonthlyReturnsThisMonthWhenDayNotYetPassed(): void
    {
        $next = $this->next('2026-06-04 08:00:00', ['frequency' => 'monthly', 'dayOfMonth' => 15, 'time' => '09:00']);
        $this->assertSame('2026-06-15 09:00', $next->format('Y-m-d H:i'));
    }

    public function testMonthlyAdvancesToNextMonthWhenDayPassed(): void
    {
        $next = $this->next('2026-06-20 08:00:00', ['frequency' => 'monthly', 'dayOfMonth' => 15, 'time' => '09:00']);
        $this->assertSame('2026-07-15 09:00', $next->format('Y-m-d H:i'));
    }

    public function testMonthlyHandlesDayTwentyEight(): void
    {
        $next = $this->next('2026-02-01 08:00:00', ['frequency' => 'monthly', 'dayOfMonth' => 28, 'time' => '09:00']);
        $this->assertSame('2026-02-28 09:00', $next->format('Y-m-d H:i'));
    }

    // ========================================================================= //
    // Boundary + DST
    // ========================================================================= //

    public function testReferenceExactlyAtSlotReturnsNextOccurrence(): void
    {
        // At the exact scheduled moment, the next run is strictly in the future.
        $next = $this->next('2026-06-04 09:00:00', ['frequency' => 'daily', 'time' => '09:00']);
        $this->assertSame('2026-06-05 09:00', $next->format('Y-m-d H:i'));
    }

    public function testDailyKeepsWallClockTimeAcrossSpringForward(): void
    {
        // 2027-03-14 is US spring-forward. A 9:00 AM instruction stays 9:00 AM
        // local because the skipped hour (02:00-03:00) is well clear of 09:00.
        $next = $this->next('2027-03-13 23:00:00', ['frequency' => 'daily', 'time' => '09:00'], 'America/New_York');
        $this->assertSame('2027-03-14 09:00', $next->format('Y-m-d H:i'));
        // Confirm it resolved into the post-transition offset (EDT, -04:00)
        $this->assertSame('-04:00', $next->format('P'));
    }

    // ========================================================================= //
    // Interval + start date
    // ========================================================================= //

    public function testEveryTwoDaysStepsByTwoFromStartDate(): void
    {
        // Series from 2026-06-01: 06-01, 06-03, 06-05 ... next after 06-04 is 06-05
        $next = $this->next('2026-06-04 08:00:00', [
            'frequency' => 'daily', 'interval' => 2, 'startDate' => '2026-06-01', 'time' => '09:00',
        ]);
        $this->assertSame('2026-06-05 09:00', $next->format('Y-m-d H:i'));
    }

    public function testEveryTwoDaysKeepsPhaseFromAPastStartDate(): void
    {
        // The same series, a later reference still lands on the on-cycle day
        $next = $this->next('2026-06-10 08:00:00', [
            'frequency' => 'daily', 'interval' => 2, 'startDate' => '2026-06-01', 'time' => '09:00',
        ]);
        $this->assertSame('2026-06-11 09:00', $next->format('Y-m-d H:i'));
    }

    public function testEveryThreeWeeksOnSaturdayStartsOnFirstSaturday(): void
    {
        $cfg = ['frequency' => 'weekly', 'interval' => 3, 'dayOfWeek' => 6, 'startDate' => '2026-06-01', 'time' => '09:00'];
        // First Saturday on or after the start date
        $next = $this->next('2026-06-01 12:00:00', $cfg);
        $this->assertSame('2026-06-06 09:00', $next->format('Y-m-d H:i'));
        $this->assertSame(6, (int) $next->format('N'));
        // The following run is exactly three weeks later, still a Saturday
        $following = $this->next($next->format('Y-m-d H:i:s'), $cfg);
        $this->assertSame('2026-06-27 09:00', $following->format('Y-m-d H:i'));
        $this->assertSame(6, (int) $following->format('N'));
    }

    public function testEveryFourMonthsOnDaySix(): void
    {
        $cfg = ['frequency' => 'monthly', 'interval' => 4, 'dayOfMonth' => 6, 'startDate' => '2026-06-01', 'time' => '09:00'];
        $next = $this->next('2026-06-01 08:00:00', $cfg);
        $this->assertSame('2026-06-06 09:00', $next->format('Y-m-d H:i'));
        // The following run is exactly four months later, still on day 6
        $following = $this->next($next->format('Y-m-d H:i:s'), $cfg);
        $this->assertSame('2026-10-06 09:00', $following->format('Y-m-d H:i'));
        $this->assertSame(6, (int) $following->format('j'));
    }

    public function testEveryTwoYearsOnPinnedMonthAndDay(): void
    {
        $cfg = ['frequency' => 'yearly', 'interval' => 2, 'pinMonth' => 6, 'dayOfMonth' => 6, 'startDate' => '2026-06-01', 'time' => '09:00'];
        $next = $this->next('2026-01-01 00:00:00', $cfg);
        $this->assertSame('2026-06-06 09:00', $next->format('Y-m-d H:i'));
        // The following run is exactly two years later
        $following = $this->next($next->format('Y-m-d H:i:s'), $cfg);
        $this->assertSame('2028-06-06 09:00', $following->format('Y-m-d H:i'));
    }

    public function testFutureStartDateMakesFirstRunTheAnchor(): void
    {
        // A start date in the future yields that date as the first run
        $next = $this->next('2026-06-04 08:00:00', [
            'frequency' => 'daily', 'interval' => 1, 'startDate' => '2027-01-01', 'time' => '09:00',
        ]);
        $this->assertSame('2027-01-01 09:00', $next->format('Y-m-d H:i'));
    }

    public function testSteppingIsDeterministicAcrossCalls(): void
    {
        // Calling nextRunAfter on its own result advances by exactly one interval period
        $cfg = ['frequency' => 'daily', 'interval' => 2, 'startDate' => '2026-06-01', 'time' => '09:00'];
        $first = $this->next('2026-06-04 08:00:00', $cfg);
        $second = $this->next($first->format('Y-m-d H:i:s'), $cfg);
        $this->assertSame(2 * 86400, $second->getTimestamp() - $first->getTimestamp());
    }

    public function testMissingStartDateKeepsLegacyNextSlotBehavior(): void
    {
        // An old config (no interval, no start date) behaves like a plain daily schedule
        $next = $this->next('2026-06-04 08:00:00', ['frequency' => 'daily', 'time' => '09:00']);
        $this->assertSame('2026-06-04 09:00', $next->format('Y-m-d H:i'));
    }
}
