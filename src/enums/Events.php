<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events get triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 * @noinspection ClassConstantCanBeUsedInspection
 */

namespace doublesecretagency\notifier\enums;

/**
 * Events enum
 * @since 1.0.0
 */
abstract class Events
{

    /**
     * List of all available trigger events.
     */
    public const AVAILABLE = [
        'Entries' => [
            'class' => 'craft\elements\Entry',
            'events' => [
                'EVENT_AFTER_PROPAGATE' => "After an entry is fully saved and propagated",
            ]
        ]
    ];

    /**
     * List of events which require the original to be fetched.
     */
    public const REQUIRE_ORIGINAL = [
        'craft\elements\Entry' => [
            'EVENT_AFTER_PROPAGATE'
        ]
    ];

}
