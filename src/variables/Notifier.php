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

namespace doublesecretagency\notifier\variables;

use Craft;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\elements\db\NotificationQuery;
use doublesecretagency\notifier\enums\Events;

/**
 * Notifier variable
 * @since 1.0.0
 */
class Notifier
{

    /**
     * Returns a new NotificationQuery instance.
     *
     * @param array $criteria
     * @return NotificationQuery
     */
    public function notifications(array $criteria = []): NotificationQuery
    {
        $query = Notification::find();
        Craft::configure($query, $criteria);
        return $query;
    }

    /**
     * Compile the select options for all available events.
     *
     * @return array
     */
    public function eventsOptions(): array
    {
        // Initialize select options
        $options = [];

        // Loop through all available events
        foreach (Events::AVAILABLE as $group => $element) {

            // Append options group
            $options[] = ['optgroup' => $group];

            // Loop through events for each group
            foreach ($element['events'] as $event => $description) {
                // Append an option for each event
                $options[] = [
                    'label' => $description,
                    'value' => "{$element['class']}::{$event}"
                ];
            }

        }

        // Return the select options
        return $options;
    }

}
