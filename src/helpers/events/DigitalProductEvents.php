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

use craft\digitalproducts\elements\Product;
use craft\events\ModelEvent;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\NotifierPlugin;
use yii\base\Event;

/**
 * Class DigitalProductEvents
 * @since 3.0.0
 */
class DigitalProductEvents
{

    /**
     * Get original Digital Product prior to saving.
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function beforeSave(ModelEvent $event): void
    {
        /** @var Product $product */
        $product = $event->sender;

        // If no existing ID, bail
        if (!$product->id) {
            return;
        }

        // Fresh DB read; ignorePlaceholders() bypasses the in-memory cache
        $original = Product::find()
            ->id($product->id)
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
     * When a digital product is saved.
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function afterPropagate(ModelEvent $event): void
    {
        // If sender isn't a digital Product, bail
        if (!($event->sender instanceof Product)) {
            return;
        }

        /** @var Product $product */
        $product = $event->sender;

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'digital-products-products',
                'event' => 'after-propagate',
            ])
            ->all();

        // Pass captured original for change-detection use in templates
        $data = [
            'original' => Originals::find(Product::class, $product->id),
        ];

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
    }

    /**
     * When a digital product is deleted.
     *
     * @param Event $event
     * @return void
     */
    public static function afterDelete(Event $event): void
    {
        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'digital-products-products',
                'event' => 'after-delete',
            ])
            ->all();

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event);
    }

    /**
     * When a digital product is restored.
     *
     * @param Event $event
     * @return void
     */
    public static function afterRestore(Event $event): void
    {
        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'digital-products-products',
                'event' => 'after-restore',
            ])
            ->all();

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event);
    }

}
