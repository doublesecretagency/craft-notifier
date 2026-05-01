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

namespace doublesecretagency\notifier\helpers\events;

use craft\commerce\elements\Order;
use yii\base\Event;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\NotifierPlugin;

/**
 * Class CommerceOrderEvents
 * @since 3.0.0
 */
class CommerceOrderEvents
{

    /**
     * When an order is completed (placed).
     *
     * @param Event $event
     * @return void
     */
    public static function afterCompleteOrder(Event $event): void
    {
        // If sender isn't an Order, bail
        if (!($event->sender instanceof Order)) {
            return;
        }

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'commerce-orders',
                'event' => 'after-complete-order',
            ])
            ->all();

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event);
    }

    /**
     * When an order is fully paid.
     *
     * @param Event $event
     * @return void
     */
    public static function afterOrderPaid(Event $event): void
    {
        // If sender isn't an Order, bail
        if (!($event->sender instanceof Order)) {
            return;
        }

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'commerce-orders',
                'event' => 'after-order-paid',
            ])
            ->all();

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event);
    }

}
