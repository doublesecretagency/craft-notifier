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
        'entries' => 'Entries',
        'assets'  => 'Assets',
        'users'   => 'Users',
    ];

    /**
     * Available events for all event types.
     * https://craftcms.com/docs/4.x/extend/events.html#event-code-generator
     */
    public const ALL_EVENTS = [
        'entries' => [
            [
                'label' => 'When an entry is fully saved and propagated',
                'value' => 'after-propagate',
                'class' => 'craft\elements\Entry::EVENT_AFTER_PROPAGATE'
            ]
        ],
        'assets' => [
            [
                'label' => 'When a new file is uploaded and saved',
                'value' => 'locate-uploaded-files',
                'class' => 'craft\fields\Assets::EVENT_LOCATE_UPLOADED_FILES'
            ]
        ],
        'users' => [
            [
                'label' => 'When a user is activated',
                'value' => 'after-activate-user',
                'class' => 'craft\services\Users::EVENT_AFTER_ACTIVATE_USER'
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
        'success' => 'Success',
        'notice'  => 'Notice',
        'error'   => 'Error',
    ];

    /**
     * Available recipient types.
     */
    public const RECIPIENTS_TYPE = [
        'current-user'      => 'User who activated the Event',
        'selected-users'    => 'Only selected User(s)',
        'selected-groups'   => 'All Users in selected User Group(s)',
        'all-admins'        => 'All Admins',
        'all-users'         => 'All Users',
        'custom-recipients' => 'Custom Recipients',
    ];

}
