<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS
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
use yii\base\Event;

/**
 * Class CommerceOrderEvents
 * @since 3.0.0
 */
class CommerceOrderEvents
{

    /**
     * Get original Order prior to saving.
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function beforeSave(ModelEvent $event): void
    {
        /** @var Order $order */
        $order = $event->sender;

        // If no existing ID, bail
        if (!$order->id) {
            return;
        }

        // Fresh DB read; ignorePlaceholders() bypasses the in-memory cache
        $original = Order::find()
            ->id($order->id)
            ->isCompleted(null)
            ->status(null)
            ->ignorePlaceholders()
            ->one();

        // If lookup failed, bail
        if (!$original) {
            return;
        }

        // Eagerly load field values; lazy reads later would pick up post-save content
        $original->getFieldValues();

        // Stash for the after-* handlers and the condition operators
        Originals::capture($original);
    }

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

        /** @var Order $order */
        $order = $event->sender;

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'craft-commerce-orders',
                'event' => 'after-complete-order',
            ])
            ->all();

        // Pass captured original for change-detection use in templates
        $data = [
            'original' => Originals::find(Order::class, $order->id),
        ];

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
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

        /** @var Order $order */
        $order = $event->sender;

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'craft-commerce-orders',
                'event' => 'after-order-paid',
            ])
            ->all();

        // Pass captured original for change-detection use in templates
        $data = [
            'original' => Originals::find(Order::class, $order->id),
        ];

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
    }

}
