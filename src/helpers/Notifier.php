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
     * @param bool $includeDrafts
     * @return Notification|null
     */
    public static function getNotification(int $id, bool $includeDrafts = false): ?Notification
    {
        // Get Notification by its ID
        $query = static::notifications()
            ->id($id)
            ->status(null);

        // If including drafts, allow drafts
        if ($includeDrafts) {
            $query->drafts(null);
        }

        // Return the matching Notification
        return $query->one();
    }

}
