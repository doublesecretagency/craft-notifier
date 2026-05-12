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

use Craft;
use craft\elements\User;
use craft\events\ModelEvent;
use craft\events\UserEvent;
use craft\events\UserGroupsAssignEvent;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\NotifierPlugin;
use yii\base\Event;

/**
 * Class UserEvents
 * @since 1.1.0
 */
class UserEvents
{

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

        // Stash for the after-* handlers and the condition operators
        Originals::capture($original);
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
            'original' => Originals::find(User::class, $user->id),
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

    /**
     * When an existing user is updated.
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function afterUpdate(ModelEvent $event): void
    {
        /** @var User $user */
        $user = $event->sender;

        // If first time being saved, this is a new user; skip it
        if ($user->firstSave) {
            return;
        }

        // Get captured pre-save original for this user
        $original = Originals::find(User::class, $user->id);

        // If the pending status just transitioned from true to false, this
        // save is part of the activation flow; let after-activate-user own it
        if ($original && $original->pending && !$user->pending) {
            return;
        }

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'users',
                'event' => 'after-update',
            ])
            ->all();

        // Pass captured original for change-detection use in templates
        $data = [
            'original' => $original,
        ];

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
    }

    /**
     * When a user is assigned to one or more groups.
     *
     * @param UserGroupsAssignEvent $event
     * @return void
     */
    public static function afterAssignToGroups(UserGroupsAssignEvent $event): void
    {
        // Load the user being assigned
        $user = Craft::$app->getUsers()->getUserById($event->userId);

        // If user can't be loaded, bail
        if (!$user) {
            return;
        }

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'users',
                'event' => 'after-assign-to-groups',
            ])
            ->all();

        // Pass the user as the object, plus the newGroupIds for runtime filtering
        $data = [
            'object' => $user,
            'newGroupIds' => $event->newGroupIds,
            'removedGroupIds' => $event->removedGroupIds,
            'groupIds' => $event->groupIds,
        ];

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
    }

    // ========================================================================= //

    /**
     * When a user is deleted.
     *
     * @param Event $event
     * @return void
     */
    public static function afterDelete(Event $event): void
    {
        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'users',
                'event' => 'after-delete',
            ])
            ->all();

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event);
    }

    /**
     * When a user is restored.
     *
     * @param Event $event
     * @return void
     */
    public static function afterRestore(Event $event): void
    {
        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'users',
                'event' => 'after-restore',
            ])
            ->all();

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event);
    }

}
