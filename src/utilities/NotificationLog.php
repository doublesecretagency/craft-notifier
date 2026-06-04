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

namespace doublesecretagency\notifier\utilities;

use Craft;
use craft\base\Utility;
use craft\helpers\DateTimeHelper;
use DateTime;
use DateTimeZone;
use doublesecretagency\notifier\records\Log;
use Exception;

/**
 * Utility that displays the notification log in the CP.
 *
 * @since 1.0.0
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
     *
     * Craft 4 hook. Craft 5 ignores this method in favor of `icon()`.
     *
     * @return string|null
     */
    public static function iconPath(): ?string
    {
        return static::_iconPath();
    }

    /**
     * @inheritdoc
     *
     * Craft 5 hook. Craft 4 ignores this method in favor of `iconPath()`.
     *
     * @return string|null
     */
    public static function icon(): ?string
    {
        return static::_iconPath();
    }

    /**
     * @inheritdoc
     * @throws Exception
     */
    public static function toolbarHtml(): string
    {
        // Get dynamically specified date
        $date = Craft::$app->getRequest()->getQueryParam('date');

        // If date is invalid, use today
        if (!$date) {
            $date = DateTimeHelper::today()->format('Y-m-d');
        }

        // Render the utility toolbar template
        return Craft::$app->getView()->renderTemplate('notifier/_utility/log/toolbar', [
            'date'   => $date,
            'dayLog' => static::_getLogs($date),
        ]);
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

        // Get the previous and next days
        $prevDay = (new DateTime($date))->modify('-1 day');
        $nextDay = (new DateTime($date))->modify('+1 day');

        // Datetime objects for right now & specified date
        $now = DateTimeHelper::now();
        $day = DateTimeHelper::toDateTime($date, true);

        // Whether date is today
        $isToday = ($now->format('Y-m-d') === $day->format('Y-m-d'));

        // Whether date is in the future
        $isFuture = ($now->format('U') < $day->format('U'));

        // Render the utility content template
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
     * Get the absolute path to the utility's icon mask SVG.
     *
     * @return string|null
     */
    private static function _iconPath(): ?string
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
     * Get logs for a single day.
     *
     * @param string $date YYYY-MM-DD
     * @return array
     */
    private static function _getLogs(string $date): array
    {
        // Initialize log for specified day
        $dayLog = [];

        // Get system and UTC timezones
        $systemTz = new DateTimeZone(Craft::$app->timeZone);
        $utc      = new DateTimeZone('UTC');

        // Day boundaries in system timezone, converted to UTC for the query
        $startOfDay = (new DateTime("{$date} 00:00:00", $systemTz))
            ->setTimezone($utc)
            ->format('Y-m-d H:i:s');

        $startOfNextDay = (new DateTime("{$date} 00:00:00", $systemTz))
            ->modify('+1 day')
            ->setTimezone($utc)
            ->format('Y-m-d H:i:s');

        // Get every row for the day in chronological order
        /** @var Log[] $rows */
        $rows = Log::find()
            ->where(['>=', 'dateCreated', $startOfDay])
            ->andWhere(['<',  'dateCreated', $startOfNextDay])
            ->orderBy('id')
            ->all();

        // Loop through every row
        foreach ($rows as $row) {

            // If the row is an envelope, attach its children
            if ('envelope' === $row->type) {
                $envelopeLog = Log::find()
                    ->where(['envelopeId' => $row->id])
                    ->orderBy('id')
                    ->all();
                $dayLog[] = [
                    'envelope' => $row,
                    'logs'     => $envelopeLog,
                ];
                continue;
            }

            // If the row is a child of an envelope, skip it
            if (null !== $row->envelopeId) {
                continue;
            }

            // Otherwise, render as a standalone leaf
            $dayLog[] = [
                'envelope' => $row,
                'logs'     => [],
            ];

        }

        // Return complete log for the day
        return $dayLog;
    }

}
