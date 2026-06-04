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
use craft\helpers\Db;
use DateTime;
use DateTimeZone;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\RecurringSchedule;
use Throwable;
use yii\db\IntegrityException;

/**
 * Shared run loop for report notifications sent on a recurring schedule.
 *
 * @since 3.1.0
 */
abstract class ReportRunner extends Component
{

    /**
     * @var string The shared recurring-schedule tracking table name.
     */
    protected const TABLE = '{{%notifier_trackreports}}';

    /**
     * Get the event type this runner handles.
     *
     * @return string
     */
    abstract protected function eventType(): string;

    /**
     * Get every recurring notification this runner is responsible for.
     *
     * @return Notification[]
     */
    abstract protected function notifications(): array;

    /**
     * Dispatch a single fire of the notification.
     *
     * @param Notification $notification
     * @param DateTime $now
     * @return int Number of envelopes successfully handed off.
     */
    abstract protected function dispatch(Notification $notification, DateTime $now): int;

    // ========================================================================= //

    /**
     * Run every recurring notification and dispatch any that are due.
     *
     * @return array Summary with notifications/dispatched/sent counts and any errors.
     */
    public function run(): array
    {
        // The current datetime
        $now = new DateTime('now', new DateTimeZone(Craft::$app->getTimeZone()));

        // Initialize the run summary
        $summary = [
            'notifications' => 0,
            'dispatched' => 0,
            'sent' => 0,
            'errors' => []
        ];

        // Loop through every recurring notification
        foreach ($this->notifications() as $notification) {

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
     * Set up or refresh a recurring notification's tracking row.
     *
     * Creates the row if it's missing, or updates when it should next run while
     * keeping the last-run time.
     *
     * @param Notification $notification
     * @return void
     */
    public function seedNotification(Notification $notification): void
    {
        // If this isn't a recurring notification for this runner, bail
        if (!$this->_handles($notification)) {
            return;
        }

        // Get the next run time from the current config
        $nextRunAt = $this->_nextRunAt($notification, new DateTime('now', $this->_systemTz()));

        // Get the database service
        $db = Craft::$app->getDb();

        // Whether a tracking row already exists for this notification
        $exists = (new Query())
            ->from(static::TABLE)
            ->where(['notificationId' => $notification->id])
            ->exists();

        // If a row already exists, recompute nextRunAt but preserve lastRunAt
        if ($exists) {
            $db->createCommand()
                ->update(static::TABLE, ['nextRunAt' => Db::prepareDateForDb($nextRunAt)], ['notificationId' => $notification->id])
                ->execute();
            return;
        }

        try {
            // Otherwise, seed a fresh tracking row
            $db->createCommand()
                ->insert(static::TABLE, [
                    'notificationId' => $notification->id,
                    'lastRunAt'      => null,
                    'nextRunAt'      => Db::prepareDateForDb($nextRunAt),
                ])
                ->execute();
        } catch (IntegrityException) {
            // A concurrent save already seeded the row
        }
    }

    /**
     * Wipe a notification's recurring tracking row.
     *
     * Called when a notification switches away from a recurring event type.
     *
     * @param int $notificationId
     * @return void
     */
    public function wipeTracking(int $notificationId): void
    {
        // Delete the tracking row for this notification
        Craft::$app->getDb()->createCommand()
            ->delete(static::TABLE, ['notificationId' => $notificationId])
            ->execute();
    }

    // ========================================================================= //

    /**
     * Run a single recurring notification, dispatch it when the scheduled time arrives.
     *
     * @param Notification $notification
     * @param DateTime $now
     * @return array Tuple of [dispatched, sent].
     */
    private function _runNotification(Notification $notification, DateTime $now): array
    {
        // Get the database service
        $db = Craft::$app->getDb();

        // Get the tracking row's next-run time
        $nextRunAtRaw = (new Query())
            ->select(['nextRunAt'])
            ->from(static::TABLE)
            ->where(['notificationId' => $notification->id])
            ->scalar();

        // If the tracking row is missing
        if (false === $nextRunAtRaw) {
            // Seed and bail without sending anything
            $this->seedNotification($notification);
            return [0, 0];
        }

        // Get datetime of the next run
        $nextRunAt = new DateTime($nextRunAtRaw, $this->_systemTz());

        // If it's not time to run yet, bail
        if ($now < $nextRunAt) {
            return [0, 0];
        }

        // Get the next run after now, so a backed-up cron fires once and skips ahead
        $following = $this->_nextRunAt($notification, $now);

        // Claim this run so two overlapping cron ticks can't both fire it
        $claimed = $db->createCommand()
            ->update(
                static::TABLE,
                ['lastRunAt' => Db::prepareDateForDb($now), 'nextRunAt' => Db::prepareDateForDb($following)],
                ['notificationId' => $notification->id, 'nextRunAt' => $nextRunAtRaw]
            )
            ->execute();

        // If another cron tick already claimed it, bail
        if (0 === $claimed) {
            return [0, 0];
        }

        // Dispatch the notification
        $sent = $this->dispatch($notification, $now);

        // Return the dispatched and sent counts
        return [1, $sent];
    }

    /**
     * Get a notification's next run time after a given moment.
     *
     * @param Notification $notification
     * @param DateTime $reference
     * @return DateTime
     */
    private function _nextRunAt(Notification $notification, DateTime $reference): DateTime
    {
        // Get the saved schedule config
        $config = ($notification->eventConfig['recurringSchedule'] ?? []);

        // Return the next run time from the shared cadence helper
        return RecurringSchedule::nextRunAfter($reference, $config, $this->_systemTz());
    }

    /**
     * Whether this runner handles the given notification.
     *
     * @param Notification $notification
     * @return bool
     */
    private function _handles(Notification $notification): bool
    {
        // Handle only this runner's event type with its recurring schedule turned on
        return ($this->eventType() === $notification->eventType)
            && (bool) ($notification->eventConfig['recurring'] ?? false);
    }

    /**
     * Get the Craft system timezone.
     *
     * @return DateTimeZone
     */
    private function _systemTz(): DateTimeZone
    {
        return new DateTimeZone(Craft::$app->getTimeZone());
    }

}
