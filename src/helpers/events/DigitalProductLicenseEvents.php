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

use craft\digitalproducts\elements\License;
use craft\events\ModelEvent;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\NotifierPlugin;
use yii\base\Event;

/**
 * Class DigitalProductLicenseEvents
 * @since 3.0.0
 */
class DigitalProductLicenseEvents
{

    /**
     * Get original License prior to saving.
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function beforeSave(ModelEvent $event): void
    {
        /** @var License $license */
        $license = $event->sender;

        // If no existing ID, bail
        if (!$license->id) {
            return;
        }

        // Fresh DB read; ignorePlaceholders() bypasses the in-memory cache
        $original = License::find()
            ->id($license->id)
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
     * When a digital product license is saved.
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function afterPropagate(ModelEvent $event): void
    {
        // If sender isn't a License, bail
        if (!($event->sender instanceof License)) {
            return;
        }

        /** @var License $license */
        $license = $event->sender;

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'digital-products-licenses',
                'event' => 'after-propagate',
            ])
            ->all();

        // Pass captured original for change-detection use in templates
        $data = [
            'original' => Originals::find(License::class, $license->id),
        ];

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
    }

    /**
     * When a digital product license is deleted.
     *
     * @param Event $event
     * @return void
     */
    public static function afterDelete(Event $event): void
    {
        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'digital-products-licenses',
                'event' => 'after-delete',
            ])
            ->all();

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event);
    }

    /**
     * When a digital product license is restored.
     *
     * @param Event $event
     * @return void
     */
    public static function afterRestore(Event $event): void
    {
        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'digital-products-licenses',
                'event' => 'after-restore',
            ])
            ->all();

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event);
    }

}
