<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\services;

use craft\base\Component;
use craft\base\ElementInterface;
use craft\elements\Asset;
use craft\elements\Entry;
use craft\elements\User;
use craft\elements\conditions\assets\AssetCondition;
use craft\elements\conditions\users\UserCondition;
use craft\commerce\elements\Order;
use craft\commerce\elements\Product as CommerceProduct;
use craft\commerce\elements\conditions\orders\OrderCondition;
use craft\commerce\elements\conditions\products\ProductCondition as CommerceProductCondition;
use craft\digitalproducts\elements\License;
use craft\digitalproducts\elements\Product as DigitalProduct;
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
use doublesecretagency\notifier\helpers\events\CalendarEventEvents;
use doublesecretagency\notifier\helpers\events\CommerceOrderEvents;
use doublesecretagency\notifier\helpers\events\CommerceProductEvents;
use doublesecretagency\notifier\helpers\events\DigitalProductEvents;
use doublesecretagency\notifier\helpers\events\DigitalProductLicenseEvents;
use doublesecretagency\notifier\helpers\events\EntryEvents;
use doublesecretagency\notifier\helpers\events\UserEvents;
use Solspace\Calendar\Elements\Event as CalendarEvent;
use Solspace\Calendar\Elements\conditions\EventCondition as CalendarEventCondition;
use yii\base\Event;

/**
 * Registers the events which trigger notifications.
 *
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

        // If Craft Commerce is installed, register its order events
        if (class_exists(Order::class)) {
            $this->_registerCommerceOrderEvents();
        }

        // If Craft Commerce is installed, register its product events
        if (class_exists(CommerceProduct::class)) {
            $this->_registerCommerceProductEvents();
        }

        // If Digital Products is installed, register its product and license events
        if (class_exists(DigitalProduct::class)) {
            $this->_registerDigitalProductEvents();
            $this->_registerDigitalProductLicenseEvents();
        }

        // If Solspace Calendar is installed, register its calendar events
        if (class_exists(CalendarEvent::class)) {
            $this->_registerCalendarEventEvents();
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
        // When a user is assigned to one or more groups
        Event::on(
            Users::class,
            Users::EVENT_AFTER_ASSIGN_USER_TO_GROUPS,
            [UserEvents::class, 'afterAssignToGroups']
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
        // Get original Order prior to saving
        Event::on(
            Order::class,
            Order::EVENT_BEFORE_SAVE,
            [CommerceOrderEvents::class, 'beforeSave']
        );

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

    /**
     * Register all events for Commerce Products.
     *
     * @return void
     */
    private function _registerCommerceProductEvents(): void
    {
        // Get original Commerce product prior to saving
        Event::on(
            CommerceProduct::class,
            CommerceProduct::EVENT_BEFORE_SAVE,
            [CommerceProductEvents::class, 'beforeSave']
        );
        // When a Commerce product is saved
        Event::on(
            CommerceProduct::class,
            CommerceProduct::EVENT_AFTER_PROPAGATE,
            [CommerceProductEvents::class, 'afterPropagate']
        );
        // When a Commerce product is deleted
        Event::on(
            CommerceProduct::class,
            CommerceProduct::EVENT_AFTER_DELETE,
            [CommerceProductEvents::class, 'afterDelete']
        );
        // When a Commerce product is restored
        Event::on(
            CommerceProduct::class,
            CommerceProduct::EVENT_AFTER_RESTORE,
            [CommerceProductEvents::class, 'afterRestore']
        );
    }

    /**
     * Register all events for Digital Products.
     *
     * @return void
     */
    private function _registerDigitalProductEvents(): void
    {
        // Get original Digital Product prior to saving
        Event::on(
            DigitalProduct::class,
            DigitalProduct::EVENT_BEFORE_SAVE,
            [DigitalProductEvents::class, 'beforeSave']
        );
        // When a digital product is saved
        Event::on(
            DigitalProduct::class,
            DigitalProduct::EVENT_AFTER_PROPAGATE,
            [DigitalProductEvents::class, 'afterPropagate']
        );
        // When a digital product is deleted
        Event::on(
            DigitalProduct::class,
            DigitalProduct::EVENT_AFTER_DELETE,
            [DigitalProductEvents::class, 'afterDelete']
        );
        // When a digital product is restored
        Event::on(
            DigitalProduct::class,
            DigitalProduct::EVENT_AFTER_RESTORE,
            [DigitalProductEvents::class, 'afterRestore']
        );
    }

    /**
     * Register all events for Digital Product Licenses.
     *
     * @return void
     */
    private function _registerDigitalProductLicenseEvents(): void
    {
        // Get original License prior to saving
        Event::on(
            License::class,
            License::EVENT_BEFORE_SAVE,
            [DigitalProductLicenseEvents::class, 'beforeSave']
        );
        // When a license is saved
        Event::on(
            License::class,
            License::EVENT_AFTER_PROPAGATE,
            [DigitalProductLicenseEvents::class, 'afterPropagate']
        );
        // When a license is deleted
        Event::on(
            License::class,
            License::EVENT_AFTER_DELETE,
            [DigitalProductLicenseEvents::class, 'afterDelete']
        );
        // When a license is restored
        Event::on(
            License::class,
            License::EVENT_AFTER_RESTORE,
            [DigitalProductLicenseEvents::class, 'afterRestore']
        );
    }

    /**
     * Register all events for Solspace Calendar events.
     *
     * @return void
     */
    private function _registerCalendarEventEvents(): void
    {
        // Get original Calendar Event prior to saving
        Event::on(
            CalendarEvent::class,
            CalendarEvent::EVENT_BEFORE_SAVE,
            [CalendarEventEvents::class, 'beforeSave']
        );
        // When a calendar event is saved
        Event::on(
            CalendarEvent::class,
            CalendarEvent::EVENT_AFTER_PROPAGATE,
            [CalendarEventEvents::class, 'afterPropagate']
        );
        // When a calendar event is deleted
        Event::on(
            CalendarEvent::class,
            CalendarEvent::EVENT_AFTER_DELETE,
            [CalendarEventEvents::class, 'afterDelete']
        );
        // When a calendar event is restored
        Event::on(
            CalendarEvent::class,
            CalendarEvent::EVENT_AFTER_RESTORE,
            [CalendarEventEvents::class, 'afterRestore']
        );
    }

    // ========================================================================= //

    /**
     * Get all available filter classes.
     *
     * @return string[] The available filter classes
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
            'craft-commerce-orders' => class_exists(OrderCondition::class) ? OrderCondition::class : null,
            'craft-commerce-products' => class_exists(CommerceProductCondition::class) ? CommerceProductCondition::class : null,
            // Digital Products has no dedicated condition classes; null falls back to no Field Conditions slot
            'digital-products-products' => null,
            'digital-products-licenses' => null,
            'solspace-calendar-events' => class_exists(CalendarEventCondition::class) ? CalendarEventCondition::class : null,
            default => null,
        };
    }

    /**
     * Get the Craft element class for a given event type.
     *
     * Inverse of `getEventTypeForElement()`.
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
            'craft-commerce-orders' => class_exists(Order::class) ? Order::class : null,
            'craft-commerce-products' => class_exists(CommerceProduct::class) ? CommerceProduct::class : null,
            'digital-products-products' => class_exists(DigitalProduct::class) ? DigitalProduct::class : null,
            'digital-products-licenses' => class_exists(License::class) ? License::class : null,
            'solspace-calendar-events' => class_exists(CalendarEvent::class) ? CalendarEvent::class : null,
            default => null,
        };
    }

    /**
     * Get the Notifier event type for a given element.
     *
     * Inverse of `getElementClassForEventType()`.
     *
     * @param ElementInterface $element
     * @return string|null Notifier event type, or null when the element type is unsupported.
     */
    public function getEventTypeForElement(ElementInterface $element): ?string
    {
        return match (true) {
            // Native
            $element instanceof Entry => 'entries',
            $element instanceof Asset => 'assets',
            $element instanceof User  => 'users',
            // Plugins
            $element instanceof Order           => 'craft-commerce-orders',
            $element instanceof CommerceProduct => 'craft-commerce-products',
            $element instanceof DigitalProduct  => 'digital-products-products',
            $element instanceof License         => 'digital-products-licenses',
            $element instanceof CalendarEvent   => 'solspace-calendar-events',
            default => null,
        };
    }

}
