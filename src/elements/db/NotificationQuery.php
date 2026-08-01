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

namespace doublesecretagency\notifier\elements\db;

use craft\elements\db\ElementQuery;
use doublesecretagency\notifier\helpers\ContentRecovery;

/**
 * Element query for fetching notifications.
 *
 * @since 1.0.0
 */
class NotificationQuery extends ElementQuery
{

    /**
     * @inheritdoc
     */
    protected function beforePrepare(): bool
    {
        // Recover any content stranded by the Craft 4 to 5 upgrade
        ContentRecovery::run();

        // Join the notifications table
        $this->joinElementTable('{{%notifier_notifications}}');

        // Select the notification columns
        $this->query->select([
            'notifier_notifications.id',
            'notifier_notifications.eventType',
            'notifier_notifications.event',
            'notifier_notifications.eventConfig',
            'notifier_notifications.messageType',
            'notifier_notifications.messageConfig',
            'notifier_notifications.recipientsType',
            'notifier_notifications.recipientsConfig',
            'notifier_notifications.queue',
        ]);

        // Return the prepared query
        return parent::beforePrepare();
    }

}
