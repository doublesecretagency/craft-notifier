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

namespace doublesecretagency\notifier\services;

use Craft;
use craft\base\Component;
use craft\db\Query;
use craft\elements\Entry;
use craft\helpers\Db;
use DateInterval;
use DateTime;
use DateTimeZone;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\NotifierPlugin;
use Throwable;
use yii\base\Event;
use yii\db\IntegrityException;

/**
 * Fires scheduled notifications once their target date is reached.
 *
 * @since 3.0.0
 */
class ScheduleRunner extends Component
{

    /**
     * @var string The schedule tracking table name.
     */
    private const TABLE = '{{%notifier_trackdates}}';

    /**
     * Run the schedule.
     *
     * @return array Summary with notification / dispatched / sent counts and any errors.
     */
    public function run(): array
    {
        // The current datetime, in UTC to match the stored dates
        $now = new DateTime('now', new DateTimeZone('UTC'));

        // Initialize the run summary
        $summary = ['notifications' => 0, 'dispatched' => 0, 'sent' => 0, 'errors' => []];

        // Loop through every scheduled notification
        foreach (NotifierPlugin::getInstance()->messages->getScheduledNotifications() as $notification) {

            // Count the notification toward the run summary
            $summary['notifications']++;

            // Run it, catching any per-notification failure
            try {
                // Get the dispatched and sent counts from this notification's run
                [$dispatched, $sent] = $this->_runNotification($notification, $now);

                // Merge the counts into the run summary
                $summary['dispatched'] += $dispatched;
                $summary['sent']       += $sent;
            } catch (Throwable $e) {
                $summary['errors'][] = "Notification {$notification->id}: {$e->getMessage()}";
            }

        }

        // Return the run summary
        return $summary;
    }

    /**
     * Get the date range to look for on this run.
     *
     * The start is exclusive and the end is inclusive, so each date fires on exactly one run.
     *
     * @param string $direction When the notification fires ('on', 'before', 'after' the date).
     * @param int $offset Day offset (ignored when direction is 'on').
     * @param DateTime $lastRunAt When the schedule last ran.
     * @param DateTime $now When this run started.
     * @return DateTime[] [start, end] of the date range to look for.
     */
    public static function targetDateRange(string $direction, int $offset, DateTime $lastRunAt, DateTime $now): array
    {
        // Don't mutate the input DateTimes
        $start = (clone $lastRunAt);
        $end = (clone $now);

        // If firing "on" the date (or no offset), look for dates in the run's range as-is
        if ('on' === $direction || $offset <= 0) {
            return [$start, $end];
        }

        // The day offset to shift the range by
        $interval = new DateInterval("P{$offset}D");

        // If firing "N days before" a date, look for dates N days in the future
        if ('before' === $direction) {
            $start->add($interval);
            $end->add($interval);
            return [$start, $end];
        }

        // Otherwise "N days after" - look for dates N days in the past
        $start->sub($interval);
        $end->sub($interval);
        return [$start, $end];
    }

    // ========================================================================= //

    /**
     * Run a single notification and dispatch any elements that are due.
     *
     * @param Notification $notification
     * @param DateTime $now
     * @return array Tuple of [dispatched elements, sent].
     */
    private function _runNotification(Notification $notification, DateTime $now): array
    {
        // Get the database service
        $db = Craft::$app->getDb();

        // Format the current datetime for the database
        $nowDb = Db::prepareDateForDb($now);

        // Get the last run time recorded for this notification
        $lastRunAt = (new Query())
            ->select(['lastRunAt'])
            ->from(self::TABLE)
            ->where(['notificationId' => $notification->id])
            ->scalar();

        // If this is the first run, record the starting point and bail
        if (false === $lastRunAt) {
            // An overlapping cron tick racing the same insert is harmless
            try {
                $db->createCommand()
                    ->insert(self::TABLE, [
                        'notificationId' => $notification->id,
                        'lastRunAt' => Db::prepareDateForDb($notification->dateCreated),
                    ])
                    ->execute();
            } catch (IntegrityException) {
                // Another cron tick already created this notification's row
            }
            return [0, 0];
        }

        // Claim this run so two overlapping cron ticks can't both fire it
        $claimed = $db->createCommand()
            ->update(
                self::TABLE,
                ['lastRunAt' => $nowDb],
                ['notificationId' => $notification->id, 'lastRunAt' => $lastRunAt]
            )
            ->execute();

        // If another cron tick already claimed this run, bail
        if (0 === $claimed) {
            return [0, 0];
        }

        // Get the effective date config
        $config = $this->_dateConfig($notification);

        // If the config is incomplete, bail
        if (!$config) {
            return [0, 0];
        }

        // Get the date range to look for on this run
        $previousRunAt = new DateTime($lastRunAt, new DateTimeZone('UTC'));
        [$start, $end] = static::targetDateRange($config['direction'], $config['offset'], $previousRunAt, $now);

        // Dispatch every matching element
        return $this->_dispatchMatches($notification, $config['field'], $start, $end);
    }

    /**
     * Get the effective date config for a scheduled notification.
     *
     * @param Notification $notification
     * @return array|null Config with 'field', 'direction', 'offset'; null when incomplete.
     */
    private function _dateConfig(Notification $notification): ?array
    {
        // If this is "Pending to Live", use the fixed preset
        if ('pending-to-live' === $notification->event) {
            return [
                'field' => 'postDate',
                'direction' => 'on',
                'offset' => 0
            ];
        }

        // Otherwise "When a date is reached" reads its config from the notification
        $config = ($notification->eventConfig['dateReached'] ?? null);

        // If no date field is configured, bail
        if (!is_array($config) || empty($config['field'])) {
            return null;
        }

        // Return the sanitized config
        return [
            'field'     => (string) $config['field'],
            'direction' => (string) ($config['direction'] ?? 'on'),
            'offset'    => (int) ($config['offset'] ?? 0),
        ];
    }

    /**
     * Dispatch every element whose target date falls within the date range.
     *
     * @param Notification $notification
     * @param string $field Date field to compare ('postDate', 'expiryDate', or a custom field handle).
     * @param DateTime $start Start of the date range (exclusive).
     * @param DateTime $end End of the date range (inclusive).
     * @return array Tuple of [dispatched elements, sent].
     */
    private function _dispatchMatches(Notification $notification, string $field, DateTime $start, DateTime $end): array
    {
        // Get the element class for this notification's event type
        $elementClass = NotifierPlugin::getInstance()->events->getElementClassForEventType($notification->eventType);

        // If the event type is unsupported, bail
        if (!$elementClass) {
            return [0, 0];
        }

        // Build the element query
        $query = $elementClass::find();

        // If the element is an Entry, include every status except disabled
        if (Entry::class === $elementClass) {
            $query->status(['live', 'pending', 'expired']);
        }

        // Format the bounds in the system timezone for the query
        $tz = new DateTimeZone(Craft::$app->getTimeZone());
        $startParam = (clone $start)->setTimezone($tz)->format('Y-m-d H:i:s');
        $endParam = (clone $end)->setTimezone($tz)->format('Y-m-d H:i:s');

        // Constrain to the target date range, open at the start and closed at the end
        $query->{$field}([
            'and',
            "> {$startParam}",
            "<= {$endParam}",
        ]);

        // Initialize the dispatched and sent counts
        $dispatched = 0;
        $sent = 0;

        // Loop through every matching element
        foreach ($query->all() as $element) {
            // Dispatch the notification for this element and capture the envelope count
            $event = new Event(['sender' => $element]);
            $sent += NotifierPlugin::getInstance()->messages->send($notification, $event, ['object' => $element]);
            $dispatched++;
        }

        // Return the dispatched and sent counts
        return [$dispatched, $sent];
    }

}
