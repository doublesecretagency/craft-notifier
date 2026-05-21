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

namespace doublesecretagency\notifier\enums;

/**
 * Options enum
 * @since 1.0.0
 */
abstract class Options
{

    /**
     * @var array Available event types.
     */
    public const EVENT_TYPE = [
        'entries'                   => 'Entries',
        'assets'                    => 'Assets',
        'users'                     => 'Users',
        'feed'                      => 'RSS/JSON Feed',
        'craft-commerce-orders'     => 'Commerce Orders',
        'craft-commerce-products'   => 'Commerce Products',
        'digital-products-products' => 'Digital Products',
        'digital-products-licenses' => 'Digital Product Licenses',
        'solspace-calendar-events'  => 'Solspace Calendar',
    ];

    /**
     * @var array Event types grouped by plugin, for the CP dropdown.
     */
    public const EVENT_TYPE_GROUPED = [
        'entries' => 'Entries',
        'assets'  => 'Assets',
        'users'   => 'Users',
        'feed'    => 'RSS/JSON Feed',
        ['optgroup' => 'Craft Commerce'],
        'craft-commerce-orders'   => 'Commerce Orders',
        'craft-commerce-products' => 'Commerce Products',
        ['optgroup' => 'Digital Products'],
        'digital-products-products' => 'Products',
        'digital-products-licenses' => 'Licenses',
        ['optgroup' => 'Solspace Calendar'],
        'solspace-calendar-events' => 'Calendar Events',
    ];

    /**
     * @var array Available events for all event types.
     *
     * https://craftcms.com/docs/5.x/extend/events.html#event-code-generator
     *
     * Top-level key order must match EVENT_TYPE.
     */
    public const ALL_EVENTS = [
        'entries' => [
            [
                'label' => 'When an entry changes from Pending to Live',
                'value' => 'pending-to-live'
            ],
            [
                'label' => 'When an entry is saved (send one message per each site)',
                'value' => 'after-save',
                'class' => 'craft\elements\Entry::EVENT_AFTER_SAVE'
            ],
            [
                'label' => 'When an entry is saved and propagated (send one message)',
                'value' => 'after-propagate',
                'class' => 'craft\services\Elements::EVENT_AFTER_SAVE_ELEMENT'
            ],
            [
                'label' => 'When an entry is deleted',
                'value' => 'after-delete',
                'class' => 'craft\elements\Entry::EVENT_AFTER_DELETE'
            ],
            [
                'label' => 'When an entry is restored',
                'value' => 'after-restore',
                'class' => 'craft\elements\Entry::EVENT_AFTER_RESTORE'
            ],
            [
                'label' => 'When a scheduled date is reached',
                'value' => 'date-reached'
            ],
            [
                'label' => 'When manually triggered',
                'value' => 'manually-triggered'
            ],
        ],
        'assets' => [
            [
                'label' => 'When a new file is uploaded and saved',
                'value' => 'after-propagate',
                'class' => 'craft\elements\Asset::EVENT_AFTER_PROPAGATE'
            ],
            [
                'label' => 'When an asset is moved',
                'value' => 'after-move',
                'class' => 'craft\elements\Asset::EVENT_AFTER_PROPAGATE'
            ],
            [
                'label' => 'When an asset is updated',
                'value' => 'after-update',
                'class' => 'craft\elements\Asset::EVENT_AFTER_PROPAGATE'
            ],
            [
                'label' => 'When an asset is deleted',
                'value' => 'after-delete',
                'class' => 'craft\elements\Asset::EVENT_AFTER_DELETE'
            ],
            [
                'label' => 'When an asset is restored',
                'value' => 'after-restore',
                'class' => 'craft\elements\Asset::EVENT_AFTER_RESTORE'
            ],
            [
                'label' => 'When a scheduled date is reached',
                'value' => 'date-reached'
            ],
            [
                'label' => 'When manually triggered',
                'value' => 'manually-triggered'
            ],
        ],
        'users' => [
            [
                'label' => 'When a new user is created',
                'value' => 'after-propagate',
                'class' => 'craft\elements\User::EVENT_AFTER_PROPAGATE'
            ],
            [
                'label' => 'When a user is activated',
                'value' => 'after-activate-user',
                'class' => 'craft\services\Users::EVENT_AFTER_ACTIVATE_USER'
            ],
            [
                'label' => 'When a user is updated',
                'value' => 'after-update',
                'class' => 'craft\elements\User::EVENT_AFTER_PROPAGATE'
            ],
            [
                'label' => 'When a user is assigned to one or more groups',
                'value' => 'after-assign-to-groups',
                'class' => 'craft\services\Users::EVENT_AFTER_ASSIGN_USER_TO_GROUPS'
            ],
            [
                'label' => 'When a user is deleted',
                'value' => 'after-delete',
                'class' => 'craft\elements\User::EVENT_AFTER_DELETE'
            ],
            [
                'label' => 'When a user is restored',
                'value' => 'after-restore',
                'class' => 'craft\elements\User::EVENT_AFTER_RESTORE'
            ],
            [
                'label' => 'When a scheduled date is reached',
                'value' => 'date-reached'
            ],
            [
                'label' => 'When manually triggered',
                'value' => 'manually-triggered'
            ],
        ],
        'feed' => [
            [
                'label' => 'When a new RSS feed item is found',
                'value' => 'new-item'
            ],
        ],
        'craft-commerce-orders' => [
            [
                'label' => 'When an order is completed (placed)',
                'value' => 'after-complete-order',
                'class' => 'craft\commerce\elements\Order::EVENT_AFTER_COMPLETE_ORDER'
            ],
            [
                'label' => 'When an order is fully paid',
                'value' => 'after-order-paid',
                'class' => 'craft\commerce\elements\Order::EVENT_AFTER_ORDER_PAID'
            ],
            [
                'label' => 'When a scheduled date is reached',
                'value' => 'date-reached'
            ],
            [
                'label' => 'When manually triggered',
                'value' => 'manually-triggered'
            ],
        ],
        'craft-commerce-products' => [
            [
                'label' => 'When a product is saved',
                'value' => 'after-propagate',
                'class' => 'craft\commerce\elements\Product::EVENT_AFTER_PROPAGATE'
            ],
            [
                'label' => 'When a product is deleted',
                'value' => 'after-delete',
                'class' => 'craft\commerce\elements\Product::EVENT_AFTER_DELETE'
            ],
            [
                'label' => 'When a product is restored',
                'value' => 'after-restore',
                'class' => 'craft\commerce\elements\Product::EVENT_AFTER_RESTORE'
            ],
            [
                'label' => 'When a scheduled date is reached',
                'value' => 'date-reached'
            ],
            [
                'label' => 'When manually triggered',
                'value' => 'manually-triggered'
            ],
        ],
        'digital-products-products' => [
            [
                'label' => 'When a digital product is saved',
                'value' => 'after-propagate',
                'class' => 'craft\digitalproducts\elements\Product::EVENT_AFTER_PROPAGATE'
            ],
            [
                'label' => 'When a digital product is deleted',
                'value' => 'after-delete',
                'class' => 'craft\digitalproducts\elements\Product::EVENT_AFTER_DELETE'
            ],
            [
                'label' => 'When a digital product is restored',
                'value' => 'after-restore',
                'class' => 'craft\digitalproducts\elements\Product::EVENT_AFTER_RESTORE'
            ],
            [
                'label' => 'When a scheduled date is reached',
                'value' => 'date-reached'
            ],
            [
                'label' => 'When manually triggered',
                'value' => 'manually-triggered'
            ],
        ],
        'digital-products-licenses' => [
            [
                'label' => 'When a license is saved',
                'value' => 'after-propagate',
                'class' => 'craft\digitalproducts\elements\License::EVENT_AFTER_PROPAGATE'
            ],
            [
                'label' => 'When a license is deleted',
                'value' => 'after-delete',
                'class' => 'craft\digitalproducts\elements\License::EVENT_AFTER_DELETE'
            ],
            [
                'label' => 'When a license is restored',
                'value' => 'after-restore',
                'class' => 'craft\digitalproducts\elements\License::EVENT_AFTER_RESTORE'
            ],
            [
                'label' => 'When a scheduled date is reached',
                'value' => 'date-reached'
            ],
            [
                'label' => 'When manually triggered',
                'value' => 'manually-triggered'
            ],
        ],
        'solspace-calendar-events' => [
            [
                'label' => 'When a calendar event is saved',
                'value' => 'after-propagate',
                'class' => 'Solspace\Calendar\Elements\Event::EVENT_AFTER_PROPAGATE'
            ],
            [
                'label' => 'When a calendar event is deleted',
                'value' => 'after-delete',
                'class' => 'Solspace\Calendar\Elements\Event::EVENT_AFTER_DELETE'
            ],
            [
                'label' => 'When a calendar event is restored',
                'value' => 'after-restore',
                'class' => 'Solspace\Calendar\Elements\Event::EVENT_AFTER_RESTORE'
            ],
            [
                'label' => 'When a scheduled date is reached',
                'value' => 'date-reached'
            ],
            [
                'label' => 'When manually triggered',
                'value' => 'manually-triggered'
            ],
        ],
    ];

    /**
     * @var array Available message types.
     */
    public const MESSAGE_TYPE = [
        'email'        => 'Email',
        'announcement' => 'Announcement',
        'flash'        => 'Flash Message',
        'sms'          => 'SMS (Text Message)',
        'pushover'     => 'Pushover',
        'ntfy'         => 'ntfy',
        'slack'        => 'Slack',
        'bluesky'      => 'Bluesky',
    ];

    /**
     * @var array Icon for each message type, shown beside the manual-send action menu item.
     */
    public const MESSAGE_TYPE_ICON = [
        'email'        => 'envelope',
        'announcement' => 'gift',
        'flash'        => 'bolt',
        'sms'          => 'comment-dots',
        'pushover'     => 'mobile-screen',
        'ntfy'         => 'angle-right',
        'slack'        => 'slack',
        'bluesky'      => 'bluesky',
    ];

    /**
     * @var array Available flash message types.
     */
    public const FLASH_TYPE = [
//        'success' => 'Success', // Disabled to mask bug (conflict with default "on save" flash message)
        'notice'  => 'Notice',
        'error'   => 'Error',
    ];

    /**
     * @var array Available recipient types.
     */
    public const RECIPIENTS_TYPE = [
        'current-user'       => 'Current User (who triggers the Event)',
        'all-users'          => 'All Users',
        'all-admins'         => 'All Admins',
        'selected-groups'    => 'All Users in selected User Group(s)',
        'selected-users'     => 'Only selected User(s)',
        'dynamic-recipients' => 'Dynamic Recipients',
        'ntfy-topics'        => 'Selected ntfy topic(s)',
        'slack-channels'     => 'Selected Slack channel(s)',
        'bluesky-accounts'   => 'Selected Bluesky account(s)',
    ];

    /**
     * @var array Map of which recipient types are available for each message type.
     *
     * Used to filter the Recipients Type dropdown on the notification edit screen.
     */
    public const ALLOWED_RECIPIENT_TYPES = [
        'email'        => ['current-user', 'all-users', 'all-admins', 'selected-groups', 'selected-users', 'dynamic-recipients'],
        'announcement' => ['current-user', 'all-users', 'all-admins', 'selected-groups', 'selected-users'],
        'flash'        => ['current-user'],
        'sms'          => ['current-user', 'all-users', 'all-admins', 'selected-groups', 'selected-users', 'dynamic-recipients'],
        'pushover'     => ['current-user', 'all-users', 'all-admins', 'selected-groups', 'selected-users', 'dynamic-recipients'],
        'ntfy'         => ['ntfy-topics'],
        'slack'        => ['slack-channels'],
        'bluesky'      => ['bluesky-accounts'],
    ];

    /**
     * @var array ntfy priority levels (1 = min, 5 = max). Default 3.
     */
    public const NTFY_PRIORITY = [
        '5' => '5 - Max',
        '4' => '4 - High',
        '3' => '3 - Default',
        '2' => '2 - Low',
        '1' => '1 - Min',
    ];

}
