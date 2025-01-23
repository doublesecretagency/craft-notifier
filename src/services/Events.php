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
use craft\events\RegisterComponentTypesEvent;
use craft\services\Users;
use doublesecretagency\notifier\filters\DraftFilter;
use doublesecretagency\notifier\filters\ElementEnabledFilter;
use doublesecretagency\notifier\filters\FirstSaveFilter;
use doublesecretagency\notifier\filters\ProvisionalDraftFilter;
use doublesecretagency\notifier\filters\RevisionFilter;
use doublesecretagency\notifier\helpers\events\AssetEvents;
use doublesecretagency\notifier\helpers\events\EntryEvents;
use doublesecretagency\notifier\helpers\events\UserEvents;
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
        $this->_registerEntryEvents();
        $this->_registerAssetEvents();
        $this->_registerUserEvents();
    }

    // ========================================================================= //

    /**
     * Register all events for Entries.
     *
     * @return void
     */
    private function _registerEntryEvents(): void
    {
        // Get original Entry prior to saving
        Event::on(
            Entry::class,
            Entry::EVENT_BEFORE_SAVE,
            [EntryEvents::class, 'beforeSave']
        );
        // When an entry is saved (per each site)
        Event::on(
            Entry::class,
            Entry::EVENT_AFTER_SAVE,
            [EntryEvents::class, 'afterSave']
        );
        // When an entry is fully saved and propagated
        Event::on(
            Entry::class,
            Entry::EVENT_AFTER_PROPAGATE,
            [EntryEvents::class, 'afterPropagate']
        );
    }

    /**
     * Register all events for Assets.
     *
     * @return void
     */
    private function _registerAssetEvents(): void
    {
        // Get original Asset prior to saving
        Event::on(
            Asset::class,
            Asset::EVENT_BEFORE_SAVE,
            [AssetEvents::class, 'beforeSave']
        );
        // When a new file is uploaded and saved
        Event::on(
            Asset::class,
            Asset::EVENT_AFTER_PROPAGATE,
            [AssetEvents::class, 'afterPropagate']
        );
    }

    /**
     * Register all events for Users.
     *
     * @return void
     */
    private function _registerUserEvents(): void
    {
        // Get original User prior to saving
        Event::on(
            User::class,
            User::EVENT_BEFORE_SAVE,
            [UserEvents::class, 'beforeSave']
        );
        // When a new user is created
        Event::on(
            User::class,
            User::EVENT_AFTER_PROPAGATE,
            [UserEvents::class, 'afterPropagate']
        );
        // When a user is activated
        Event::on(
            Users::class,
            Users::EVENT_AFTER_ACTIVATE_USER,
            [UserEvents::class, 'afterActivateUser']
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
