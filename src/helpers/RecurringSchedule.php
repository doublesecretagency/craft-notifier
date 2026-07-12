<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\helpers;

use DateTime;
use DateTimeZone;

/**
 * Works out the next run time for a Daily / Weekly / Monthly / Yearly schedule.
 *
 * @since 3.1.0
 */
abstract class RecurringSchedule
{

    /**
     * @var array How often a notification can recur.
     */
    public const FREQUENCIES = [
        'daily'   => 'Daily',
        'weekly'  => 'Weekly',
        'monthly' => 'Monthly',
        'yearly'  => 'Yearly',
    ];

    /**
     * Get the default config for a new recurring notification.
     *
     * @return array The default config (frequency, interval, startDate, dayOfWeek, dayOfMonth, pinMonth, time).
     */
    public static function defaults(): array
    {
        return [
            'frequency'  => 'weekly', // Weekly
            'interval'   => 1,        // Every 1 unit
            'startDate'  => '',       // No floor (the form defaults this to today)
            'dayOfWeek'  => 1,        // Monday (ISO-8601: 1=Mon - 7=Sun)
            'dayOfMonth' => 1,        // First of the month
            'pinMonth'   => 1,        // January (yearly)
            'time'       => '09:00',  // 9:00 AM (per system timezone)
        ];
    }

    /**
     * Get the next run time strictly after a given datetime.
     *
     * The cadence is anchored to the start date. A missing start date means no
     * floor (the Unix epoch), so an old config keeps its next-slot-from-now behavior.
     *
     * @param DateTime $reference The datetime to find the next run after.
     * @param array $config The schedule config (frequency / interval / startDate / pins / time).
     * @param DateTimeZone $tz The Craft system timezone.
     * @return DateTime The next run time, in the system timezone.
     */
    public static function nextRunAfter(DateTime $reference, array $config, DateTimeZone $tz): DateTime
    {
        // Fill in any missing or invalid values with the defaults
        $config = static::normalize($config);

        // Split the configured time into hour and minute
        [$hour, $minute] = static::_parseTime($config['time']);

        // Work entirely in the system timezone
        $reference = (clone $reference)->setTimezone($tz);

        // Get the interval and frequency
        $interval = (int) $config['interval'];
        $frequency = $config['frequency'];

        // Build the anchor, the first on-pin slot at or after the start date
        $anchor = static::_anchor($frequency, $config, $hour, $minute, $tz);

        // If the anchor is still ahead of the reference, that's the next run
        if ($anchor > $reference) {
            return $anchor;
        }

        // Otherwise step forward by whole intervals until just past the reference
        return static::_stepPast($anchor, $reference, $frequency, $interval, $hour, $minute);
    }

    /**
     * Normalize a (possibly malformed) config against the defaults.
     *
     * @param array $config
     * @return array The normalized config (frequency, interval, startDate, dayOfWeek, dayOfMonth, pinMonth, time).
     */
    public static function normalize(array $config): array
    {
        // Get the defaults
        $defaults = static::defaults();

        // Get the frequency, falling back to the default when unrecognized
        $frequency = (string) ($config['frequency'] ?? $defaults['frequency']);

        // If the frequency isn't recognized, use the default
        if (!isset(static::FREQUENCIES[$frequency])) {
            $frequency = $defaults['frequency'];
        }

        // Clamp the interval to at least 1
        $interval = (int) ($config['interval'] ?? $defaults['interval']);
        $interval = max(1, $interval);

        // Validate the start date, falling back to no floor when malformed
        $startDate = static::_normalizeDate((string) ($config['startDate'] ?? $defaults['startDate']));

        // Clamp the day-of-week into the ISO-8601 range (1-7)
        $dayOfWeek = (int) ($config['dayOfWeek'] ?? $defaults['dayOfWeek']);
        $dayOfWeek = max(1, min(7, $dayOfWeek));

        // Clamp the day-of-month into the supported range (1-28)
        $dayOfMonth = (int) ($config['dayOfMonth'] ?? $defaults['dayOfMonth']);
        $dayOfMonth = max(1, min(28, $dayOfMonth));

        // Clamp the pin month into the calendar range (1-12)
        $pinMonth = (int) ($config['pinMonth'] ?? $defaults['pinMonth']);
        $pinMonth = max(1, min(12, $pinMonth));

        // Get the time, falling back to the default when malformed
        $time = (string) ($config['time'] ?? $defaults['time']);

        // If the time isn't a valid HH:MM, use the default
        if (!preg_match('/^\d{1,2}:\d{2}$/', trim($time))) {
            $time = $defaults['time'];
        }

        // Return the normalized config
        return [
            'frequency'  => $frequency,
            'interval'   => $interval,
            'startDate'  => $startDate,
            'dayOfWeek'  => $dayOfWeek,
            'dayOfMonth' => $dayOfMonth,
            'pinMonth'   => $pinMonth,
            'time'       => $time,
        ];
    }

    /**
     * Format a run time as a sortable ISO-8601 string.
     *
     * @param DateTime $next
     * @return string
     */
    public static function formatNextRun(DateTime $next): string
    {
        return $next->format('c');
    }

    // ========================================================================= //

    /**
     * Build the anchor: the first on-pin slot at or after the start date.
     *
     * @param string $frequency
     * @param array $config The normalized config.
     * @param int $hour
     * @param int $minute
     * @param DateTimeZone $tz
     * @return DateTime
     */
    private static function _anchor(string $frequency, array $config, int $hour, int $minute, DateTimeZone $tz): DateTime
    {
        // Start from the start date at the configured time
        $start = static::_startDateTime($config['startDate'], $hour, $minute, $tz);

        // Snap to the first slot matching the pin
        switch ($frequency) {
            case 'daily':
                return $start;
            case 'monthly':
                return static::_firstMonthly($start, (int) $config['dayOfMonth'], $hour, $minute);
            case 'yearly':
                return static::_firstYearly($start, (int) $config['pinMonth'], (int) $config['dayOfMonth'], $hour, $minute);
            case 'weekly':
            default:
                return static::_firstWeekly($start, (int) $config['dayOfWeek'], $hour, $minute);
        }
    }

    /**
     * Get the start date as a DateTime at the configured time.
     *
     * @param string $startDate A "Y-m-d" string, or empty for no floor.
     * @param int $hour
     * @param int $minute
     * @param DateTimeZone $tz
     * @return DateTime
     */
    private static function _startDateTime(string $startDate, int $hour, int $minute, DateTimeZone $tz): DateTime
    {
        // Treat a missing start date as the Unix epoch
        $date = ('' !== $startDate ? $startDate : '1970-01-01');

        // Return the start date at the configured time
        return (new DateTime($date, $tz))->setTime($hour, $minute);
    }

    /**
     * Get the first weekly slot on or after a given datetime.
     *
     * @param DateTime $start
     * @param int $dayOfWeek ISO-8601 day of week (1=Monday).
     * @param int $hour
     * @param int $minute
     * @return DateTime
     */
    private static function _firstWeekly(DateTime $start, int $dayOfWeek, int $hour, int $minute): DateTime
    {
        // Clone the start date
        $c = clone $start;

        // Walk forward day by day until the weekday matches
        for ($i = 0; $i <= 7; $i++) {
            // If this day lands on the target weekday, use it
            if ((int) $c->format('N') === $dayOfWeek) {
                return $c;
            }

            // Otherwise advance one day, re-applying the time to absorb any DST shift
            $c->modify('+1 day')->setTime($hour, $minute);
        }

        // Return the final candidate as a safe fallback
        return $c;
    }

    /**
     * Get the first monthly slot on or after a given datetime.
     *
     * @param DateTime $start
     * @param int $dayOfMonth Day of month (1-28, already clamped).
     * @param int $hour
     * @param int $minute
     * @return DateTime
     */
    private static function _firstMonthly(DateTime $start, int $dayOfMonth, int $hour, int $minute): DateTime
    {
        // This month's instance of the target day, at the configured time
        $c = (clone $start)
            ->setDate((int) $start->format('Y'), (int) $start->format('n'), $dayOfMonth)
            ->setTime($hour, $minute);

        // If that day is before the start, advance to next month
        if ($c < $start) {
            $c = (clone $start)->modify('first day of next month');
            $c->setDate((int) $c->format('Y'), (int) $c->format('n'), $dayOfMonth)->setTime($hour, $minute);
        }

        // Return the first monthly slot
        return $c;
    }

    /**
     * Get the first yearly slot on or after a given datetime.
     *
     * @param DateTime $start
     * @param int $pinMonth Month of year (1-12).
     * @param int $dayOfMonth Day of month (1-28, already clamped).
     * @param int $hour
     * @param int $minute
     * @return DateTime
     */
    private static function _firstYearly(DateTime $start, int $pinMonth, int $dayOfMonth, int $hour, int $minute): DateTime
    {
        // This year's instance of the target month and day, at the configured time
        $c = (clone $start)
            ->setDate((int) $start->format('Y'), $pinMonth, $dayOfMonth)
            ->setTime($hour, $minute);

        // If that day is before the start, advance to next year
        if ($c < $start) {
            $c = (clone $start)->modify('+1 year');
            $c->setDate((int) $c->format('Y'), $pinMonth, $dayOfMonth)->setTime($hour, $minute);
        }

        // Return the first yearly slot
        return $c;
    }

    /**
     * Step forward from the anchor by whole intervals until just past the reference.
     *
     * @param DateTime $anchor
     * @param DateTime $reference
     * @param string $frequency
     * @param int $interval
     * @param int $hour
     * @param int $minute
     * @return DateTime
     */
    private static function _stepPast(DateTime $anchor, DateTime $reference, string $frequency, int $interval, int $hour, int $minute): DateTime
    {
        // Estimate how many whole interval-periods fit between the anchor and reference
        $k = static::_periodsBetween($anchor, $reference, $frequency, $interval);

        // Jump that many periods in one move, re-pinning and re-applying the time
        $cand = static::_advance($anchor, $frequency, $k * $interval, $hour, $minute);

        // Correct any estimate slack so the result is the first slot strictly after the reference
        while ($cand <= $reference) {
            $cand = static::_advance($cand, $frequency, $interval, $hour, $minute);
        }

        // Return the next run
        return $cand;
    }

    /**
     * Get how many whole interval-periods fit between the anchor and the reference.
     *
     * @param DateTime $anchor
     * @param DateTime $reference
     * @param string $frequency
     * @param int $interval
     * @return int
     */
    private static function _periodsBetween(DateTime $anchor, DateTime $reference, string $frequency, int $interval): int
    {
        // Count the whole units (days / weeks / months / years) between the two datetimes
        switch ($frequency) {
            case 'daily':
                $units = intdiv($reference->getTimestamp() - $anchor->getTimestamp(), 86400);
                break;
            case 'weekly':
                $units = intdiv($reference->getTimestamp() - $anchor->getTimestamp(), 7 * 86400);
                break;
            case 'monthly':
                $units = ((int) $reference->format('Y') - (int) $anchor->format('Y')) * 12
                       + ((int) $reference->format('n') - (int) $anchor->format('n'));
                break;
            case 'yearly':
            default:
                $units = (int) $reference->format('Y') - (int) $anchor->format('Y');
                break;
        }

        // Return the whole-interval count
        return intdiv(max(0, $units), max(1, $interval));
    }

    /**
     * Advance a slot forward by a count of frequency units, re-pinning and re-applying the time.
     *
     * @param DateTime $date A slot already sitting on its pin.
     * @param string $frequency
     * @param int $count How many units of the frequency to advance.
     * @param int $hour
     * @param int $minute
     * @return DateTime
     */
    private static function _advance(DateTime $date, string $frequency, int $count, int $hour, int $minute): DateTime
    {
        // If there's nothing to advance, just normalize the time
        if ($count <= 0) {
            return (clone $date)->setTime($hour, $minute);
        }

        // Clone the date
        $c = clone $date;

        // Advance by the frequency's unit
        switch ($frequency) {
            case 'daily':
                // Add the days
                return $c->modify("+{$count} days")->setTime($hour, $minute);
            case 'weekly':
                // Convert the weeks to days and add
                $days = $count * 7;
                return $c->modify("+{$days} days")->setTime($hour, $minute);
            case 'monthly':
                // Capture the pin day, step from the first of the month to avoid overflow, then re-pin
                $day = (int) $c->format('j');
                $c->modify('first day of this month')->modify("+{$count} months");
                return $c->setDate((int) $c->format('Y'), (int) $c->format('n'), $day)->setTime($hour, $minute);
            case 'yearly':
            default:
                // Capture the pin month and day, step the year, then re-pin
                $month = (int) $c->format('n');
                $day = (int) $c->format('j');
                $c->modify("+{$count} years");
                return $c->setDate((int) $c->format('Y'), $month, $day)->setTime($hour, $minute);
        }
    }

    /**
     * Validate a "Y-m-d" date string, returning an empty string when malformed.
     *
     * @param string $date
     * @return string A valid "Y-m-d" string, or empty for no floor.
     */
    private static function _normalizeDate(string $date): string
    {
        // Get the trimmed date
        $date = trim($date);

        // If it's a real calendar date, keep it
        if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $date, $m)
            && checkdate((int) $m[2], (int) $m[3], (int) $m[1])) {
            return $date;
        }

        // Otherwise treat it as no floor
        return '';
    }

    /**
     * Split an "HH:MM" string into an [hour, minute] pair.
     *
     * @param string $time
     * @return array An [hour, minute] pair.
     */
    private static function _parseTime(string $time): array
    {
        // If the time is malformed, fall back to 9:00 AM
        if (!preg_match('/^(\d{1,2}):(\d{2})$/', trim($time), $m)) {
            return [9, 0];
        }

        // Clamp the hour and minute into valid ranges
        $hour = max(0, min(23, (int) $m[1]));
        $minute = max(0, min(59, (int) $m[2]));

        // Return the hour and minute
        return [$hour, $minute];
    }

}
