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

use craft\elements\Entry;
use craft\events\ModelEvent;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\NotifierPlugin;

/**
 * Class EntryEvents
 * @since 1.1.0
 */
class EntryEvents
{

    /**
     * @var array Original elements prior to saving.
     */
    private static array $_originals = [];

    /**
     * Get original Entry prior to saving.
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function beforeSave(ModelEvent $event): void
    {
        /** @var Entry $entry */
        $entry = $event->sender;

        // If entry has an existing ID
        if ($entry->id) {
            // Get the original element
            static::$_originals[$entry->id] = Entry::find()->id($entry->id)->one();
        }
    }

    /**
     * When an entry is saved (per each site).
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function afterSave(ModelEvent $event): void
    {
        /** @var Entry $entry */
        $entry = $event->sender;

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'entries',
                'event' => 'after-save',
            ])
            ->all();

        // Configure data for parsing messages
        $data = [
            'original' => (static::$_originals[$entry->id] ?? null),
        ];

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
    }

    /**
     * When an entry is fully saved and propagated.
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function afterPropagate(ModelEvent $event): void
    {
        /** @var Entry $entry */
        $entry = $event->sender;

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'entries',
                'event' => 'after-propagate',
            ])
            ->all();

        // Configure data for parsing messages
        $data = [
            'original' => (static::$_originals[$entry->id] ?? null),
        ];

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
    }

}
