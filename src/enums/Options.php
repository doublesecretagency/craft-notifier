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

namespace doublesecretagency\notifier\enums;

/**
 * Holds the dropdown option lists used across notifications.
 *
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
        'craft-commerce-orders'     => 'Commerce Orders',
        'craft-commerce-products'   => 'Commerce Products',
        'digital-products-products' => 'Digital Products',
        'digital-products-licenses' => 'Digital Product Licenses',
        'solspace-calendar-events'  => 'Solspace Calendar',
        'feed'                      => 'RSS/JSON Feed',
        'system-snapshot'           => 'System Snapshot',
        'dynamic-data'              => 'Dynamic Data',
    ];

    /**
     * @var array Event types grouped by plugin, for the CP dropdown.
     */
    public const EVENT_TYPE_GROUPED = [
        ['optgroup' => 'Native Elements'],
        'entries' => 'Entries',
        'assets'  => 'Assets',
        'users'   => 'Users',
        ['optgroup' => 'Craft Commerce'],
        'craft-commerce-orders'   => 'Commerce Orders',
        'craft-commerce-products' => 'Commerce Products',
        ['optgroup' => 'Digital Products'],
        'digital-products-products' => 'Products',
        'digital-products-licenses' => 'Licenses',
        ['optgroup' => 'Solspace Calendar'],
        'solspace-calendar-events' => 'Calendar Events',
        ['optgroup' => 'Other Data Sources'],
        'feed'            => 'RSS/JSON Feed',
        'system-snapshot' => 'System Snapshot',
        'dynamic-data'    => 'Dynamic Data',
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
        'feed' => [
            [
                'label' => 'When a new RSS feed item is found',
                'value' => 'new-item'
            ],
        ],
        'system-snapshot' => [
            [
                'label' => 'System Snapshot',
                'value' => 'compile'
            ],
        ],
        'dynamic-data' => [
            [
                'label' => 'Dynamic Data',
                'value' => 'compile'
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
        'discord'      => 'Discord',
        'facebook'     => 'Facebook',
        'instagram'    => 'Instagram',
        'x-twitter'    => 'X (Twitter)',
        'bluesky'      => 'Bluesky',
        'mastodon'     => 'Mastodon',
        'linkedin'     => 'LinkedIn',
        'mqtt'         => 'MQTT',
    ];

    /**
     * @var array Message types grouped into optgroups for the Message Type dropdown.
     */
    public const MESSAGE_TYPE_GROUPED = [
        ['optgroup' => 'Native Pings'],
        'email'        => 'Email',
        'announcement' => 'Announcement',
        'flash'        => 'Flash Message',
        ['optgroup' => 'Push Notifications'],
        'sms'          => 'SMS (Text Message)',
        'pushover'     => 'Pushover',
        'ntfy'         => 'ntfy',
        ['optgroup' => 'Chat Platforms'],
        'slack'        => 'Slack',
        'discord'      => 'Discord',
        ['optgroup' => 'Social Media'],
        'facebook'     => 'Facebook',
        'instagram'    => 'Instagram',
        'x-twitter'    => 'X (Twitter)',
        'bluesky'      => 'Bluesky',
        'mastodon'     => 'Mastodon',
        'linkedin'     => 'LinkedIn',
        ['optgroup' => 'Internet of Things'],
        'mqtt'         => 'MQTT',
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
        'discord'      => 'discord',
        'facebook'     => 'facebook',
        'instagram'    => 'instagram',
        'x-twitter'    => 'x-twitter',
        'bluesky'      => 'bluesky',
        'mastodon'     => 'mastodon',
        'linkedin'     => 'linkedin',
        'mqtt'         => 'tower-broadcast',
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
        'discord-channels'   => 'Selected Discord channel(s)',
        'facebook-pages'     => 'Selected Facebook page(s)',
        'instagram-accounts' => 'Selected Instagram account(s)',
        'x-twitter-accounts' => 'Selected X (Twitter) account(s)',
        'bluesky-accounts'   => 'Selected Bluesky account(s)',
        'mastodon-accounts'  => 'Selected Mastodon account(s)',
        'linkedin-accounts'  => 'Selected LinkedIn account(s)',
        'mqtt-topics'        => 'Selected MQTT topic(s)',
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
        'discord'      => ['discord-channels'],
        'facebook'     => ['facebook-pages'],
        'instagram'    => ['instagram-accounts'],
        'x-twitter'    => ['x-twitter-accounts'],
        'bluesky'      => ['bluesky-accounts'],
        'mastodon'     => ['mastodon-accounts'],
        'linkedin'     => ['linkedin-accounts'],
        'mqtt'         => ['mqtt-topics'],
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

    /**
     * @var array MQTT quality-of-service levels.
     */
    public const MQTT_QOS = [
        '0' => '0 - At most once',
        '1' => '1 - At least once',
        '2' => '2 - Exactly once',
    ];

    /**
     * @var array Supported MQTT protocol versions.
     */
    public const MQTT_VERSION = [
        '3.1'   => 'MQTT 3.1',
        '3.1.1' => 'MQTT 3.1.1',
    ];

    /**
     * @var array Mastodon post visibility levels. Default "public".
     */
    public const MASTODON_VISIBILITY = [
        'public'   => 'Public',
        'unlisted' => 'Unlisted',
        'private'  => 'Followers only',
        'direct'   => 'Direct',
    ];

}
