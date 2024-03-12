<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events are triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\utilities;

use Craft;
use craft\base\Utility;
use craft\helpers\DateTimeHelper;
use DateTime;
use doublesecretagency\notifier\records\Log;
use Exception;

/**
 * Notification Log utility
 */
class NotificationLog extends Utility
{

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('notifier', 'Notification Log');
    }

    /**
     * @inheritdoc
     */
    public static function id(): string
    {
        return 'notification-log';
    }

    /**
     * @inheritdoc
     */
    public static function icon(): ?string
    {
        // Set the icon mask path
        $iconPath = Craft::getAlias('@vendor/doublesecretagency/craft-notifier/src/icon-mask.svg');

        // If not a string, bail
        if (!is_string($iconPath)) {
            return null;
        }

        // Return the icon mask path
        return $iconPath;
    }

    /**
     * @inheritdoc
     * @throws Exception
     */
    public static function contentHtml(): string
    {
        // Get dynamically specified date
        $date = Craft::$app->getRequest()->getQueryParam('date');

        // If date is invalid, use today
        if (!$date) {
            $date = DateTimeHelper::today()->format('Y-m-d');
        }

        // Determine previous and next days
        $prevDay = (new DateTime($date))->modify('-1 day');
        $nextDay = (new DateTime($date))->modify('+1 day');

        // Datetime objects for right now & specified date
        $now = DateTimeHelper::now();
        $day = DateTimeHelper::toDateTime($date, true);

        // Whether date is today
        $isToday = ($now->format('Y-m-d') === $day->format('Y-m-d'));

        // Whether date is in the future
        $isFuture = ($now->format('U') < $day->format('U'));

        // Render the utility template
        return Craft::$app->getView()->renderTemplate('notifier/_utility/log', [
            'date'     => $date,
            'dayLog'   => static::_getLogs($date),
            'isToday'  => $isToday,
            'isFuture' => $isFuture,
            'prevDay'  => $prevDay->format('Y-m-d'),
            'nextDay'  => $nextDay->format('Y-m-d')
        ]);
    }

    // ========================================================================= //

    /**
     * Get logs for a single day.
     *
     * @param string $date YYYY-MM-DD
     * @return array
     */
    private static function _getLogs(string $date): array
    {
        // Initialize log for specified day
        $dayLog = [];

        // Get system timezone
        $timeZone = Craft::$app->timeZone;

        // Convert dateCreated to the system timezone
        $dateCreated = "DATE(CONVERT_TZ(dateCreated, 'UTC', '{$timeZone}'))";

        // Get all envelopes on selected day
        $envelopes = Log::find()
            ->where([$dateCreated => $date])
            ->andWhere(['type' => 'envelope'])
            ->orderBy('id')
            ->all();

        // Log each individual envelope
        /** @var Log $envelope */
        foreach ($envelopes as $envelope) {

            // Get all logs for each envelope
            $envelopeLog = Log::find()
                ->where(['envelopeId' => $envelope->id])
                ->orderBy('id')
                ->all();

            // Add to day log
            $dayLog[] = [
                'envelope' => $envelope,
                'logs' => $envelopeLog
            ];

        }

        // Return complete log for the day
        return $dayLog;
    }

}
