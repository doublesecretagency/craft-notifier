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
use craft\events\ModelEvent;
use craft\helpers\ElementHelper;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\enums\Events as EventsEnum;
use doublesecretagency\notifier\models\Message as MessageModel;
use Throwable;
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
     * Register a single event, fully configured.
     *
     * @param string $class
     * @param string $event
     * @param array $config
     */
    private static function _register(string $class, string $event, array $config): void
    {
        // Retrieve the original element (if needed)
        static::_loadOriginal($class, $event);

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

                // Send the message
                static::_sendMessage($element, $e);
            }
        );
    }

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

        // Mark valid
        return true;
    }

    // ========================================================================= //

    /**
     * Send the corresponding message.
     * @throws Throwable
     */
    private static function _sendMessage($element, $event): void
    {
        // Set data for message templates
        $data = [
            // Content variables
            'original' => static::$_original,
            'element' => $element,
            // Config variables
            'activeUser' => Craft::$app->getUser()->getIdentity(),
            'event' => $event,
        ];


        // todo: Dynamically add the $data['entry'] value


        return; // TEMP


        // Get messages related to this trigger
        $messages = $trigger->getMessages();

        // Send each message to all recipients
        foreach ($messages as $message) {
            /** @var MessageModel $message */
            $message->sendAll($data);
        }


    }

}
