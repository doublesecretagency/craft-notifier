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

namespace doublesecretagency\notifier\helpers\events;

use craft\events\ModelEvent;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\NotifierPlugin;
use Solspace\Calendar\Elements\Event as CalendarEvent;
use yii\base\Event;

/**
 * Class CalendarEventEvents
 *
 * Handlers for Solspace Calendar Event element lifecycle.
 * The class name is "CalendarEventEvents" - the element is called Event,
 * and the handlers are events about that element.
 *
 * @since 3.0.0
 */
class CalendarEventEvents
{

    /**
     * Get original Calendar Event prior to saving.
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function beforeSave(ModelEvent $event): void
    {
        /** @var CalendarEvent $calendarEvent */
        $calendarEvent = $event->sender;

        // If no existing ID, bail
        if (!$calendarEvent->id) {
            return;
        }

        // Fresh DB read; ignorePlaceholders() bypasses the in-memory cache
        $original = CalendarEvent::find()
            ->id($calendarEvent->id)
            ->siteId($calendarEvent->siteId)
            ->status(null)
            ->ignorePlaceholders()
            ->one();

        // If lookup failed, bail
        if (!$original) {
            return;
        }

        // Eagerly load field values; lazy reads later would pick up post-save content
        $original->getFieldValues();

        // Stash for the after-* handlers and the condition operators
        Originals::capture($original);
    }

    /**
     * When a Solspace Calendar event is saved.
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function afterPropagate(ModelEvent $event): void
    {
        // If sender isn't a Calendar Event, bail
        if (!($event->sender instanceof CalendarEvent)) {
            return;
        }

        /** @var CalendarEvent $calendarEvent */
        $calendarEvent = $event->sender;

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'solspace-calendar-events',
                'event' => 'after-propagate',
            ])
            ->all();

        // Pass captured original for change-detection use in templates
        $data = [
            'original' => Originals::find(CalendarEvent::class, $calendarEvent->id, $calendarEvent->siteId),
        ];

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
    }

    /**
     * When a Solspace Calendar event is deleted.
     *
     * @param Event $event
     * @return void
     */
    public static function afterDelete(Event $event): void
    {
        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'solspace-calendar-events',
                'event' => 'after-delete',
            ])
            ->all();

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event);
    }

    /**
     * When a Solspace Calendar event is restored.
     *
     * @param Event $event
     * @return void
     */
    public static function afterRestore(Event $event): void
    {
        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'solspace-calendar-events',
                'event' => 'after-restore',
            ])
            ->all();

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event);
    }

}
