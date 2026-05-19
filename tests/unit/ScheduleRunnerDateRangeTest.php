<?php
namespace doublesecretagency\notifier\tests\unit;

use DateTime;
use DateTimeZone;
use doublesecretagency\notifier\services\ScheduleRunner;
use PHPUnit\Framework\TestCase;

/**
 * Pure-unit tests for the schedule runner's date-range math.
 *
 * `ScheduleRunner::targetDateRange()` translates a notification's offset
 * configuration into the range of dates that should fire on a given run.
 * It is the one piece of the runner that is pure (no Craft, no DB), so it
 * is worth covering directly. The start of the range is excluded and the
 * end is included, which is what guarantees each element fires exactly
 * once.
 */
class ScheduleRunnerDateRangeTest extends TestCase
{
    /**
     * Build a UTC DateTime from a plain string.
     */
    private function utc(string $value): DateTime
    {
        return new DateTime($value, new DateTimeZone('UTC'));
    }

    // ========================================================================= //
    // Range computation
    // ========================================================================= //

    /**
     * @return array<string, array{0: string, 1: int, 2: string, 3: string, 4: string, 5: string}>
     */
    public static function targetDateRangeProvider(): array
    {
        return [
            // "On" fires exactly when the date itself is crossed; the range
            // is the raw (lastRunAt, now] span with no shift.
            'on keeps the range unchanged' => [
                'on', 0, '2026-05-19 10:00:00', '2026-05-19 10:01:00',
                '2026-05-19 10:00:00', '2026-05-19 10:01:00',
            ],
            // A nonzero offset is meaningless for "on" and must be ignored.
            'on ignores any offset' => [
                'on', 30, '2026-05-19 10:00:00', '2026-05-19 10:01:00',
                '2026-05-19 10:00:00', '2026-05-19 10:01:00',
            ],
            // "15 days before" fires early, so the target date sits 15 days
            // ahead of the run; the range shifts forward.
            'before shifts the range forward' => [
                'before', 15, '2026-05-19 10:00:00', '2026-05-19 10:01:00',
                '2026-06-03 10:00:00', '2026-06-03 10:01:00',
            ],
            // "15 days after" fires late, so the target date sits 15 days
            // behind the run; the range shifts backward.
            'after shifts the range backward' => [
                'after', 15, '2026-05-19 10:00:00', '2026-05-19 10:01:00',
                '2026-05-04 10:00:00', '2026-05-04 10:01:00',
            ],
            'after with a one-day offset' => [
                'after', 1, '2026-05-19 10:00:00', '2026-05-19 10:01:00',
                '2026-05-18 10:00:00', '2026-05-18 10:01:00',
            ],
            // A zero or negative offset cannot shift anything, regardless of
            // the direction.
            'before with a zero offset is left unchanged' => [
                'before', 0, '2026-05-19 10:00:00', '2026-05-19 10:01:00',
                '2026-05-19 10:00:00', '2026-05-19 10:01:00',
            ],
        ];
    }

    /**
     * @dataProvider targetDateRangeProvider
     */
    public function testTargetDateRange(
        string $direction,
        int $offset,
        string $lastRunAt,
        string $now,
        string $expectedStart,
        string $expectedEnd
    ): void {
        [$start, $end] = ScheduleRunner::targetDateRange(
            $direction,
            $offset,
            $this->utc($lastRunAt),
            $this->utc($now)
        );
        $this->assertSame($expectedStart, $start->format('Y-m-d H:i:s'));
        $this->assertSame($expectedEnd, $end->format('Y-m-d H:i:s'));
    }

    public function testTargetDateRangeDoesNotMutateItsInputs(): void
    {
        // The bounds are cloned internally, so the caller's DateTimes must
        // survive the call untouched.
        $lastRunAt = $this->utc('2026-05-19 10:00:00');
        $now = $this->utc('2026-05-19 10:01:00');

        ScheduleRunner::targetDateRange('before', 15, $lastRunAt, $now);

        $this->assertSame('2026-05-19 10:00:00', $lastRunAt->format('Y-m-d H:i:s'));
        $this->assertSame('2026-05-19 10:01:00', $now->format('Y-m-d H:i:s'));
    }
}
