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
use doublesecretagency\notifier\helpers\SystemSnapshot;
use doublesecretagency\notifier\NotifierPlugin;
use yii\base\Event;

/**
 * Report runner for the System Snapshot event type.
 *
 * @since 3.1.0
 */
class SystemSnapshotRunner extends ReportRunner
{

    /**
     * @inheritdoc
     */
    protected function eventType(): string
    {
        return 'system-snapshot';
    }

    /**
     * @inheritdoc
     */
    protected function notifications(): array
    {
        // Get every recurring System Snapshot notification
        return NotifierPlugin::getInstance()->messages->getSystemSnapshotNotifications();
    }

    /**
     * @inheritdoc
     */
    protected function dispatch(Notification $notification, DateTime $now): int
    {
        // Compile a fresh snapshot of the installation
        $report = SystemSnapshot::compile();

        // Send the notification with the compiled report
        $event = new Event(['sender' => null]);
        return NotifierPlugin::getInstance()->messages->send($notification, $event, ['report' => $report]);
    }

}
