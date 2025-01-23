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

namespace doublesecretagency\notifier\services;

use craft\base\Component;
use craft\elements\Asset;
use craft\elements\Entry;
use craft\elements\User;
use craft\events\ModelEvent;
use craft\events\RegisterComponentTypesEvent;
use craft\events\UserEvent;
use craft\services\Users;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\filters\DraftFilter;
use doublesecretagency\notifier\filters\DuplicatingFilter;
use doublesecretagency\notifier\filters\ElementEnabledFilter;
use doublesecretagency\notifier\filters\FirstSaveFilter;
use doublesecretagency\notifier\filters\NewElementFilter;
use doublesecretagency\notifier\filters\PropagatingFilter;
use doublesecretagency\notifier\filters\ProvisionalDraftFilter;
use doublesecretagency\notifier\filters\ResavingFilter;
use doublesecretagency\notifier\filters\RevisionFilter;
use doublesecretagency\notifier\NotifierPlugin;
use yii\base\Event;

/**
 * Class Events
 * @since 1.0.0
 */
class Events extends Component
{

    /**
     * @event RegisterComponentTypesEvent The event that is triggered when registering filter types.
     *
     * Filter types must implement [[FilterInterface]].
     * ---
     * ```php
     * use craft\events\RegisterComponentTypesEvent;
     * use doublesecretagency\notifier\services\Events as NotifierEvents;
     * use yii\base\Event;
     *
     * if (class_exists(NotifierEvents::class)) {
     *     Event::on(NotifierEvents::class,
     *         NotifierEvents::EVENT_REGISTER_FILTER_TYPES,
     *         function(RegisterComponentTypesEvent $event) {
     *             $event->types[] = MyFilterType::class;
     *         }
     *     );
     * }
     * ```
     * @since 1.1.0
     */
    public const EVENT_REGISTER_FILTER_TYPES = 'registerFilterTypes';

    /**
     * @var array Original elements prior to saving.
     */
    private array $_originals = [];

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
        // Get original Entry prior to saving
        Event::on(
            Entry::class,
            Entry::EVENT_BEFORE_SAVE,
            function (ModelEvent $event) {
                /** @var Entry $entry */
                $entry = $event->sender;
                // If entry has an existing ID
                if ($entry->id) {
                    // Get the original element
                    $this->_originals[$entry->id] = Entry::find()->id($entry->id)->one();
                }
            }
        );

        // When an entry is saved (per each site)
        Event::on(
            Entry::class,
            Entry::EVENT_AFTER_SAVE,
            function (ModelEvent $event) {
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
                    'original' => ($this->_originals[$entry->id] ?? null),
                ];
                // Send all matching notifications
                NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
            }
        );

        // When an entry is fully saved and propagated
        Event::on(
            Entry::class,
            Entry::EVENT_AFTER_PROPAGATE,
            function (ModelEvent $event) {
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
                    'original' => ($this->_originals[$entry->id] ?? null),
                ];
                // Send all matching notifications
                NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
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
        // Get original Asset prior to saving
        Event::on(
            Asset::class,
            Asset::EVENT_BEFORE_SAVE,
            function (ModelEvent $event) {
                /** @var Asset $asset */
                $asset = $event->sender;
                // If no existing ID, bail
                if (!$asset->id) {
                    return;
                }
                // Get the original element
                $original = Asset::find()
                    ->id($asset->id)
                    ->one();
                // Set original element
                $this->_originals[$asset->id] = $original;
            }
        );

        // When a new file is uploaded and saved
        Event::on(
            Asset::class,
            Asset::EVENT_AFTER_PROPAGATE,
            function (ModelEvent $event) {
                /** @var Asset $asset */
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
                // Pass data to message parser
                $data = [
                    'original' => ($this->_originals[$asset->id] ?? null),
                ];
                // Send all matching notifications
                NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
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
        // Get original User prior to saving
        Event::on(
            User::class,
            User::EVENT_BEFORE_SAVE,
            function (ModelEvent $event) {
                /** @var User $user */
                $user = $event->sender;
                // If no existing ID, bail
                if (!$user->id) {
                    return;
                }
                // Get the original element
                $original = User::find()
                    ->id($user->id)
                    ->one();
                // Set original element
                $this->_originals[$user->id] = $original;
            }
        );

        // When a new user is created
        Event::on(
            User::class,
            User::EVENT_AFTER_PROPAGATE,
            function (ModelEvent $event) {
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
                    'original' => ($this->_originals[$user->id] ?? null),
                ];
                // Send all matching notifications
                NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
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

    // ========================================================================= //

    /**
     * Returns all available filter classes.
     *
     * @return string[] The available field type classes
     */
    public function getAllFilters(): array
    {
        $filterTypes = [
            ElementEnabledFilter::class,
            FirstSaveFilter::class,
//            NewElementFilter::class,
            DraftFilter::class,
            ProvisionalDraftFilter::class,
            RevisionFilter::class,
//            DuplicatingFilter::class,
//            PropagatingFilter::class,
//            ResavingFilter::class,
        ];

        $event = new RegisterComponentTypesEvent([
            'types' => $filterTypes,
        ]);
        $this->trigger(self::EVENT_REGISTER_FILTER_TYPES, $event);

        return $event->types;
    }


}
