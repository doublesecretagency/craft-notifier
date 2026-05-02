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

use craft\elements\Entry;
use craft\events\DraftEvent;
use craft\events\ElementEvent;
use craft\events\ModelEvent;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\NotifierPlugin;

/**
 * Class EntryEvents
 * @since 1.1.0
 */
class EntryEvents
{

    /**
     * @var array Original elements prior to saving.
     */
    private static array $_originals = [];

    /**
     * Get original Entry prior to saving.
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function beforeSave(ModelEvent $event): void
    {
        /** @var Entry $entry */
        $entry = $event->sender;

        // If entry has an existing ID
        if ($entry->id) {
            // Get the original element
            static::$_originals[$entry->id] = Entry::find()->id($entry->id)->one();
        }
    }

    /**
     * When an entry is saved (send one message per each site).
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function afterSave(ModelEvent $event): void
    {
        /** @var Entry $entry */
        $entry = $event->sender;

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'entries',
                'event' => 'after-save',
            ])
            ->all();

        // Configure data for parsing messages
        $data = [
            'original' => (static::$_originals[$entry->id] ?? null),
        ];

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
    }

    /**
     * Bridge `Elements::EVENT_AFTER_SAVE_ELEMENT` to the `afterPropagate` handler.
     *
     * This event delivers the entry via `$event->element`, but the downstream pipeline
     * reads it from `$event->sender`. The bridge reshapes the event so `afterPropagate`
     * and everything downstream can keep working unchanged.
     *
     * @param ElementEvent $event
     * @return void
     */
    public static function afterSaveElement(ElementEvent $event): void
    {
        // If element is not an Entry, bail
        if (!($event->element instanceof Entry)) {
            return;
        }
        // If this is a per-site recursive firing, bail (only the top-level invocation should dispatch)
        if ($event->element->propagating) {
            return;
        }
        // If this is the canonical clone mid-applyDraft, bail and let `afterApplyDraft` handle it.
        // Craft's `duplicateElement()` defers `afterPropagate()` (and therefore `createRevision()`)
        // until *after* this event fires, so the new revision wouldn't yet be queryable here.
        if ($event->element->duplicateOf instanceof Entry && $event->element->duplicateOf->getIsDraft()) {
            return;
        }
        // Bridge to the existing handler with a ModelEvent shape
        $modelEvent = new ModelEvent();
        $modelEvent->sender = $event->element;
        static::afterPropagate($modelEvent);
    }

    /**
     * Bridge `Drafts::EVENT_AFTER_APPLY_DRAFT` to the `afterPropagate` handler.
     *
     * The afterSaveElement bridge skips the apply-draft case because Craft fires
     * `EVENT_AFTER_SAVE_ELEMENT` before the new revision has been created. This
     * event fires after the entire applyDraft flow completes, so `entry.currentRevision`
     * is queryable by the time the notification renders.
     *
     * @param DraftEvent $event
     * @return void
     */
    public static function afterApplyDraft(DraftEvent $event): void
    {
        // If canonical is not an Entry, bail
        if (!($event->canonical instanceof Entry)) {
            return;
        }
        // Bridge to the existing handler with a ModelEvent shape
        $modelEvent = new ModelEvent();
        $modelEvent->sender = $event->canonical;
        static::afterPropagate($modelEvent);
    }

    /**
     * When an entry is saved and propagated (send one message).
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function afterPropagate(ModelEvent $event): void
    {
        /** @var Entry $entry */
        $entry = $event->sender;

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'entries',
                'event' => 'after-propagate',
            ])
            ->all();

        // Configure data for parsing messages
        $data = [
            'original' => (static::$_originals[$entry->id] ?? null),
        ];

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
    }

}
