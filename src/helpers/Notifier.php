<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events get triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\helpers;

use Craft;
use doublesecretagency\notifier\elements\db\NotificationQuery;
use doublesecretagency\notifier\elements\Notification;

/**
 * Class Notifier
 * @since 1.0.0
 */
class Notifier
{

    /**
     * Returns a new NotificationQuery instance.
     *
     * @param array $criteria
     * @return NotificationQuery
     */
    public static function notifications(array $criteria = []): NotificationQuery
    {
        $query = Notification::find();
        Craft::configure($query, $criteria);
        return $query;
    }

    /**
     * Get a single Notification by its ID.
     *
     * @param int $id
     * @return Notification|null
     */
    public static function getNotification(int $id): ?Notification
    {
        // Return the matching Notification
        return static::notifications()
            ->id($id)
            ->status(null)
            ->one();
    }

}
