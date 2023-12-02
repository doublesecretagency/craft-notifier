<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events get triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\services;

use craft\base\Component;
use craft\elements\Asset;
use craft\elements\Entry;
use craft\elements\User;
use craft\events\ModelEvent;
use craft\events\UserEvent;
use craft\helpers\ElementHelper;
use craft\services\Users;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\NotifierPlugin;
use yii\base\Event;

/**
 * Class Events
 * @since 1.0.0
 */
class Events extends Component
{

    /**
     * Register all Events for outgoing Notifications.
     *
     * @return void
     */
    public function registerNotificationEvents(): void
    {
        $this->_registerEntriesEvents();
        $this->_registerAssetsEvents();
        $this->_registerUsersEvents();
    }

    // ========================================================================= //

    /**
     * Register all events for Entries.
     *
     * @return void
     */
    private function _registerEntriesEvents(): void
    {
        // When an entry is fully saved and propagated
        Event::on(
            Entry::class,
            Entry::EVENT_AFTER_PROPAGATE,
            static function (ModelEvent $event) {
                /** @var Entry $entry */
                $entry = $event->sender;
                // If draft or revision, skip it
                if (ElementHelper::isDraftOrRevision($entry)) {
                    return;
                }
                // Get all notifications for this event
                $notifications = Notification::find()
                    ->where([
                        'eventType' => 'entries',
                        'event' => 'after-propagate',
                    ])
                    ->all();
                // Send all matching notifications
                NotifierPlugin::getInstance()->messages->sendAll($notifications, $event);
            }
        );
    }

    /**
     * Register all events for Assets.
     *
     * @return void
     */
    private function _registerAssetsEvents(): void
    {
        // When a new file is uploaded and saved
        Event::on(
            Asset::class,
            Asset::EVENT_AFTER_PROPAGATE,
            static function (ModelEvent $event) {
                /** @var Asset $entry */
                $asset = $event->sender;
                // If not first time being saved, skip it
                if (!$asset->firstSave) {
                    return;
                }
                // Get all notifications for this event
                $notifications = Notification::find()
                    ->where([
                        'eventType' => 'assets',
                        'event' => 'after-propagate',
                    ])
                    ->all();
                // Send all matching notifications
                NotifierPlugin::getInstance()->messages->sendAll($notifications, $event);
            }
        );
    }

    /**
     * Register all events for Users.
     *
     * @return void
     */
    private function _registerUsersEvents(): void
    {
        // When a new user is created
        Event::on(
            User::class,
            User::EVENT_AFTER_PROPAGATE,
            static function (ModelEvent $event) {
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
                // Send all matching notifications
                NotifierPlugin::getInstance()->messages->sendAll($notifications, $event);
            }
        );
        // When a user is activated
        Event::on(
            Users::class,
            Users::EVENT_AFTER_ACTIVATE_USER,
            static function (UserEvent $event) {
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
        );
    }

}
