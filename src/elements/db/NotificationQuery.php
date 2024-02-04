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

namespace doublesecretagency\notifier\elements\db;

use craft\elements\db\ElementQuery;

/**
 * Notification query
 * @since 1.0.0
 */
class NotificationQuery extends ElementQuery
{

    protected function beforePrepare(): bool
    {
        $this->joinElementTable('{{%notifier_notifications}}');

        $this->query->select([
            'notifier_notifications.id',
            'notifier_notifications.description',
            'notifier_notifications.eventType',
            'notifier_notifications.event',
            'notifier_notifications.eventConfig',
            'notifier_notifications.messageType',
            'notifier_notifications.messageConfig',
            'notifier_notifications.recipientsType',
            'notifier_notifications.recipientsConfig',

        ]);

        return parent::beforePrepare();
    }

}
