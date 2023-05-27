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

namespace doublesecretagency\notifier\helpers;

use craft\base\ElementInterface;
use craft\elements\Entry;
use craft\helpers\ElementHelper;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\enums\Events as EventsEnum;
use yii\base\Event;

/**
 * Events helper
 * @since 1.0.0
 */
class Events
{

    /**
     * @var ElementInterface|null The original version of a saved Element.
     */
    private static ?ElementInterface $_original = null;

    /**
     * Register all notification events.
     */
    public static function registerAll(): void
    {
        // Get all enabled notifications (grouped by event type)
        $notifications = Notification::find()->collect()->groupBy('event');

        // Loop through all available events
        foreach (EventsEnum::AVAILABLE as $element) {

            // Get the element class
            $class = $element['class'];

            // Loop through events for each group
            foreach ($element['events'] as $event => $description) {

                // Loop through matching notifications
                foreach ($notifications["{$class}::{$event}"] as $notification) {

                    // Get event configuration
                    $config = ($notification->eventConfig ?? []);

                    // Register each event with corresponding configuration
                    static::_register($class, $event, $config);

                }

            }

        }

    }

    // ========================================================================= //

    /**
     * Register a single event, fully configured.
     *
     * @param string $class
     * @param string $event
     * @param array $config
     */
    private static function _register(string $class, string $event, array $config): void
    {
        // Dynamically register the event
        Event::on(
            $class,
            constant("{$class}::{$event}"),
            static function (Event $e) use ($class, $event, $config) {

                // Get element
                /** @var ElementInterface $element */
                $element = $e->sender;

                // Validate based on class
                switch ($class) {

                    case 'craft\elements\Entry':
                        // If entry is not valid per configuration, bail
                        if (!static::_validateEntry($element, $config)) {
                            return;
                        }
                        break;

                }

                // Get and set the original element (if needed)
                static::_loadOriginal($element->id, $class, $event);




                \Craft::dd($config);





            }
        );
    }

    /**
     * If needed, load the original element.
     *
     * @param int|null $id
     * @param string $class
     * @param string $event
     */
    private static function _loadOriginal(?int $id, string $class, string $event): void
    {
        // If no ID provided, bail
        if (!$id) {
            return;
        }

        // Whitelist of events which
        // require the original to be fetched
        $whitelist = [
            'craft\elements\Entry' => [
                'EVENT_AFTER_PROPAGATE'
            ]
        ];

        // Get array of whitelisted events
        $requireOriginal = $whitelist[$class] ?? [];

        // If not an event which requires the original, bail
        if (!in_array($event, $requireOriginal, true)) {
            return;
        }

        // Load the original element based on class
        switch ($class) {
            case 'craft\elements\Entry':
                static::$_original = Entry::find()->id($id)->one();
                break;
        }
    }

    // ========================================================================= //

    /**
     * Checks whether an Entry is valid, based on specified configuration.
     *
     * @param ElementInterface $element
     * @param array $config
     * @return bool
     */
    private static function _validateEntry(ElementInterface $element, array $config): bool
    {
        // If entry is a draft or revision, mark invalid
        if (ElementHelper::isDraftOrRevision($element)) {
            return false;
        }

        // Other validation with $config

        // Mark valid
        return true;
    }

}
