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
use craft\elements\conditions\assets\AssetCondition;
use craft\elements\conditions\users\UserCondition;
use craft\commerce\elements\Order;
use craft\commerce\elements\conditions\orders\OrderCondition;
use craft\events\RegisterComponentTypesEvent;
use craft\services\Drafts;
use craft\services\Elements;
use craft\services\Users;
use doublesecretagency\notifier\conditions\NotifierEntryCondition;
use doublesecretagency\notifier\filters\DraftFilter;
use doublesecretagency\notifier\filters\ElementEnabledFilter;
use doublesecretagency\notifier\filters\FirstSaveFilter;
use doublesecretagency\notifier\filters\ProvisionalDraftFilter;
use doublesecretagency\notifier\filters\RevisionFilter;
use doublesecretagency\notifier\helpers\events\AssetEvents;
use doublesecretagency\notifier\helpers\events\CommerceOrderEvents;
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

        if (class_exists(Order::class)) {
            $this->_registerCommerceOrderEvents();
        }
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
        // When an entry is saved (send one message per each site)
        Event::on(
            Entry::class,
            Entry::EVENT_AFTER_SAVE,
            [EntryEvents::class, 'afterSave']
        );
        // When an entry is saved and propagated (send one message)
        Event::on(
            Elements::class,
            Elements::EVENT_AFTER_SAVE_ELEMENT,
            [EntryEvents::class, 'afterSaveElement']
        );
        // When a provisional draft is applied
        // (the bridge above defers to here so the new revision is queryable)
        Event::on(
            Drafts::class,
            Drafts::EVENT_AFTER_APPLY_DRAFT,
            [EntryEvents::class, 'afterApplyDraft']
        );
        // When an entry is deleted
        Event::on(
            Entry::class,
            Entry::EVENT_AFTER_DELETE,
            [EntryEvents::class, 'afterDelete']
        );
        // When an entry is restored
        Event::on(
            Entry::class,
            Entry::EVENT_AFTER_RESTORE,
            [EntryEvents::class, 'afterRestore']
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
        // When an asset is moved between folders or volumes
        Event::on(
            Asset::class,
            Asset::EVENT_AFTER_PROPAGATE,
            [AssetEvents::class, 'afterMove']
        );
        // When an existing asset is updated (anything other than a move)
        Event::on(
            Asset::class,
            Asset::EVENT_AFTER_PROPAGATE,
            [AssetEvents::class, 'afterUpdate']
        );
        // When an asset is deleted
        Event::on(
            Asset::class,
            Asset::EVENT_AFTER_DELETE,
            [AssetEvents::class, 'afterDelete']
        );
        // When an asset is restored
        Event::on(
            Asset::class,
            Asset::EVENT_AFTER_RESTORE,
            [AssetEvents::class, 'afterRestore']
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
        // When an existing user is updated
        Event::on(
            User::class,
            User::EVENT_AFTER_PROPAGATE,
            [UserEvents::class, 'afterUpdate']
        );
        // When a user is deleted
        Event::on(
            User::class,
            User::EVENT_AFTER_DELETE,
            [UserEvents::class, 'afterDelete']
        );
        // When a user is restored
        Event::on(
            User::class,
            User::EVENT_AFTER_RESTORE,
            [UserEvents::class, 'afterRestore']
        );
    }

    /**
     * Register all events for Commerce Orders.
     *
     * @return void
     */
    private function _registerCommerceOrderEvents(): void
    {
        // When an order is completed (placed)
        Event::on(
            Order::class,
            Order::EVENT_AFTER_COMPLETE_ORDER,
            [CommerceOrderEvents::class, 'afterCompleteOrder']
        );

        // When an order is fully paid
        Event::on(
            Order::class,
            Order::EVENT_AFTER_ORDER_PAID,
            [CommerceOrderEvents::class, 'afterOrderPaid']
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

    /**
     * Get the Craft element-condition class for a given event type.
     *
     * @param string $eventType
     * @return string|null Fully-qualified ElementConditionInterface class, or null when unsupported.
     */
    public function getConditionClassForEventType(string $eventType): ?string
    {
        return match ($eventType) {
            // Native
            'entries' => NotifierEntryCondition::class,
            'assets'  => AssetCondition::class,
            'users'   => UserCondition::class,
            // Plugins
            'commerce-orders' => class_exists(OrderCondition::class) ? OrderCondition::class : null,
            default => null,
        };
    }

    /**
     * Get the Craft element class for a given event type.
     *
     * Seeds `ElementCondition::$elementType` so per-field rules register at hydrate time.
     *
     * @param string $eventType
     * @return string|null Fully-qualified ElementInterface class, or null when unsupported.
     */
    public function getElementClassForEventType(string $eventType): ?string
    {
        return match ($eventType) {
            // Native
            'entries' => Entry::class,
            'assets'  => Asset::class,
            'users'   => User::class,
            // Plugins
            'commerce-orders' => class_exists(Order::class) ? Order::class : null,
            default => null,
        };
    }


}
