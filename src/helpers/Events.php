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

use Craft;
use craft\base\Element;
use craft\base\ElementInterface;
use craft\elements\Entry;
use craft\events\ModelEvent;
use craft\helpers\ElementHelper;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\enums\Events as EventsEnum;
use doublesecretagency\notifier\models\EmailMessage;
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

//                // Loop through matching notifications
//                foreach ($notifications["{$class}::{$event}"] as $notification) {
//
//                    // Register each notification event
//                    static::_register($notification, $class, $event);
//
//                }

            }

        }
    }

    /**
     * Send a message.
     */
    public static function sendMessage(Notification $notification, array $data): void
    {
        // Initialize the message
        $message = null;

        // Send based on message type
        switch ($notification->messageType) {

            case 'email':
                // Send an email
                $message = new EmailMessage($notification, $data);
                break;

        }

        // If no message, bail
        if (!$message) {
            return;
        }

        // Send the message
        $message->send();
    }

    /**
     * Register a single event, fully configured.
     *
     * @param Notification $notification
     * @param string $class
     * @param string $event
     */
    private static function _register(Notification $notification, string $class, string $event): void
    {
        // Retrieve the original element (if needed)
        static::_loadOriginal($class, $event);

        // Dynamically register the event
        Event::on(
            $class,
            constant("{$class}::{$event}"),
            static function (Event $e) use ($class, $notification) {

                // Compile the data for message templates
                $data = [
                    'event' => $e,
                    'notification' => $notification,
                    'activeUser' => Craft::$app->getUser()->getIdentity(),
                ];

                // If not activated by an element
                if (!is_a($e->sender, ElementInterface::class)) {
                    // Send the non-element message
                    static::sendMessage($notification, $data);
                    // Our work here is done
                    return;
                }

                // Get the element which triggered the notification
                /** @var ElementInterface $element */
                $element = $e->sender;

                // Validate based on class
                switch ($class) {

                    case 'craft\elements\Entry':
                        // If entry is not valid per event configuration, bail
                        if (!static::_validateEntry($element, $notification->eventConfig)) {
                            return;
                        }
                        break;

                }

                // Dynamically named element variable
                // (ie: `entry`, `user`, `asset`, etc)
                $elementType = $element::refHandle();

                // Append content variables
                $data['original'] = static::$_original;
                $data['element'] = $element;
                $data[$elementType] = $element; // see above

                // Send the message
                static::sendMessage($notification, $data);
            }
        );
    }

    // ========================================================================= //

    /**
     * Load the original element before it gets modified.
     *
     * @param ModelEvent $event
     */
    public static function loadOriginalElement(ModelEvent $event): void
    {
        // Get element
        /** @var ElementInterface $element */
        $element = $event->sender;

        // If no existing ID, bail
        if (!$element->id) {
            return;
        }

        // Get element class
        $elementClass = $element::class;

        // Load the original element
        static::$_original = (new $elementClass)::find()
            ->id($element->id)
            ->status(null)
            ->one();
    }

    // ========================================================================= //

    /**
     * If needed, retrieve the original element.
     *
     * @param string $class
     * @param string $event
     */
    private static function _loadOriginal(string $class, string $event): void
    {
        // Get array of events which require the original element
        $requireOriginal = EventsEnum::REQUIRE_ORIGINAL[$class] ?? [];

        // If not an event which requires the original, bail
        if (!in_array($event, $requireOriginal, true)) {
            return;
        }

        // Load the original element
        Event::on(
            $class,
            Element::EVENT_BEFORE_SAVE,
            [self::class, 'loadOriginalElement']
        );
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

        // Get entry
        /** @var Entry $entry */
//        $entry = $event->sender;

        /*
        // If part of a bulk re-save, mark invalid
        if ($entry->resaving) {
            return false;
        }

        // TODO: Remove legacy `freshness` by v1.0
        // Whether to activate trigger for new entries, existing entries, or both
        $newExisting = ($this->config['freshness'] ?? $this->config['newExisting'] ?? false);
//        $newExisting = ($this->config['newExisting'] ?? false);

        // Simplify logic
        $new          = $entry->firstSave;
        $onlyNew      = ($newExisting === 'new');
        $onlyExisting = ($newExisting === 'existing');

        // Filter by newness
        if ($new) {
            // If new, and only existing are allowed, mark invalid
            if ($onlyExisting) {
                return false;
            }
        } else {
            // If existing, and only new are allowed, mark invalid
            if ($onlyNew) {
                return false;
            }
        }

        // Get selected sections and entry types
        $sections   = ($this->config['sections']   ?? []);
        $entryTypes = ($this->config['entryTypes'] ?? []);

        // If section isn't selected, mark invalid
        if (!in_array($entry->getSection()->id, $sections, false)) {
            return false;
        }

        // If entry type isn't selected, mark invalid
        if (!in_array($entry->getType()->id, $entryTypes, false)) {
            return false;
        }

        // Entry event is valid!
        return true;
         */



        // Mark valid
        return true;
    }

}
