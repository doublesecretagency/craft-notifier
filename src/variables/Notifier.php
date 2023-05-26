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

namespace doublesecretagency\notifier\variables;

use Craft;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\elements\db\NotificationQuery;

/**
 * Notifier variable
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
    public function notifications(array $criteria = []): NotificationQuery
    {
        $query = Notification::find();
        Craft::configure($query, $criteria);
        return $query;
    }

}
