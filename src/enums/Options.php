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

namespace doublesecretagency\notifier\enums;

/**
 * Options enum
 * @since 1.0.0
 */
abstract class Options
{

    /**
     * Available event types.
     */
    public const EVENT_TYPE = [
        'users'   => 'Users',
        'entries' => 'Entries',
        'assets'  => 'Assets',
    ];

    /**
     * Available events for all event types.
     * https://craftcms.com/docs/4.x/extend/events.html#event-code-generator
     */
    public const ALL_EVENTS = [
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
                'label' => 'When a user is deleted',
                'value' => 'after-delete-user',
//                'class' => 'craft\services\Users::EVENT_AFTER_ACTIVATE_USER'
            ]
        ],
        'entries' => [
            [
                'label' => 'When an entry is fully saved and propagated',
                'value' => 'after-propagate',
                'class' => 'craft\elements\Entry::EVENT_AFTER_PROPAGATE'
            ],
            [
                'label' => 'When an entry is deleted',
                'value' => 'after-delete-entry',
//                'class' => 'craft\elements\Entry::EVENT_AFTER_PROPAGATE'
            ]
        ],
        'assets' => [
            [
                'label' => 'When a new file is uploaded and saved',
                'value' => 'after-propagate',
                'class' => 'craft\elements\Asset::EVENT_AFTER_PROPAGATE'
            ],
            [
                'label' => 'When an asset is moved',
                'value' => 'after-move-asset',
//                'class' => 'craft\elements\Asset::EVENT_AFTER_PROPAGATE'
            ],
            [
                'label' => 'When an asset is deleted',
                'value' => 'after-delete-asset',
//                'class' => 'craft\elements\Asset::EVENT_AFTER_PROPAGATE'
            ]
        ]
    ];

    /**
     * Available message types.
     */
    public const MESSAGE_TYPE = [
        'email'        => 'Email',
        'sms'          => 'SMS (Text Message)',
        'announcement' => 'Announcement',
        'flash'        => 'Flash Message',
    ];

    /**
     * Available flash message types.
     */
    public const FLASH_TYPE = [
//        'success' => 'Success', // Disabled to mask bug (conflict with default "on save" flash message)
        'notice'  => 'Notice',
        'error'   => 'Error',
    ];

    /**
     * Available recipient types.
     */
    public const RECIPIENTS_TYPE = [
        'current-user'      => 'User who triggered the Event',
        'selected-users'    => 'Only selected User(s)',
        'selected-groups'   => 'All Users in selected User Group(s)',
        'all-admins'        => 'All Admins',
        'all-users'         => 'All Users',
        'custom-recipients' => 'Custom Recipients',
    ];

}
