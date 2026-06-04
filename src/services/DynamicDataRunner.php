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

use DateTime;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\NotifierPlugin;
use yii\base\Event;

/**
 * Report runner for the Dynamic Data event type.
 *
 * @since 3.1.0
 */
class DynamicDataRunner extends ReportRunner
{

    /**
     * @inheritdoc
     */
    protected function eventType(): string
    {
        return 'dynamic-data';
    }

    /**
     * @inheritdoc
     */
    protected function notifications(): array
    {
        // Get every recurring Dynamic Data notification
        return NotifierPlugin::getInstance()->messages->getDynamicDataNotifications();
    }

    /**
     * @inheritdoc
     */
    protected function dispatch(Notification $notification, DateTime $now): int
    {
        // Build an event with no sender
        $event = new Event(['sender' => null]);

        // Send the notification with empty data, populated dynamically at send time
        return NotifierPlugin::getInstance()->messages->send($notification, $event, []);
    }

}
