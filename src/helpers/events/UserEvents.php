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

use craft\elements\User;
use craft\events\ModelEvent;
use craft\events\UserEvent;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\NotifierPlugin;

/**
 * Class UserEvents
 * @since 1.1.0
 */
class UserEvents
{

    /**
     * @var array Original elements prior to saving.
     */
    private static array $_originals = [];

    /**
     * Get original User prior to saving.
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function beforeSave(ModelEvent $event): void
    {
        /** @var User $user */
        $user = $event->sender;

        // If no existing ID, bail
        if (!$user->id) {
            return;
        }

        // Fresh DB read; ignorePlaceholders() bypasses the in-memory cache
        $original = User::find()
            ->id($user->id)
            ->status(null)
            ->ignorePlaceholders()
            ->one();

        // If lookup failed, bail
        if (!$original) {
            return;
        }

        // Eagerly load field values; lazy reads later would pick up post-save content
        $original->getFieldValues();

        static::$_originals[$user->id] = $original;
    }

    /**
     * When a new user is created.
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function afterPropagate(ModelEvent $event): void
    {
        /** @var User $entry */
        $user = $event->sender;

        // If not first time being saved, skip it
        if (!$user->firstSave) {
            return;
        }

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'users',
                'event' => 'after-propagate',
            ])
            ->all();

        // Pass data to message parser
        $data = [
            'original' => (static::$_originals[$user->id] ?? null),
        ];

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
    }

    // ========================================================================= //

    /**
     * When a user is activated.
     *
     * @param UserEvent $event
     * @return void
     */
    public static function afterActivateUser(UserEvent $event): void
    {
        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'users',
                'event' => 'after-activate-user',
            ])
            ->all();

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, [
            'object' => $event->user,
        ]);
    }

}
