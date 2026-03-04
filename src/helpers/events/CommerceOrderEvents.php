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
use craft\events\ModelEvent;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\NotifierPlugin;

/**
 * Class CommerceOrderEvents
 * @since 2.2.0
 */
class CommerceOrderEvents
{

    /**
     * When an order is completed (placed).
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function afterCompleteOrder(ModelEvent $event): void
    {
        /** @var Order $order */
        $order = $event->sender;

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'commerce-orders',
                'event' => 'after-complete-order',
            ])
            ->all();

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, [
            'object' => $order,
            'order' => $order,
        ]);
    }

    /**
     * When an order is fully paid.
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function afterOrderPaid(ModelEvent $event): void
    {
        /** @var Order $order */
        $order = $event->sender;

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'commerce-orders',
                'event' => 'after-order-paid',
            ])
            ->all();

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, [
            'object' => $order,
            'order' => $order,
        ]);
    }

}
