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

use craft\elements\Asset;
use craft\events\ModelEvent;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\NotifierPlugin;
use yii\base\Event;

/**
 * Class AssetEvents
 * @since 1.1.0
 */
class AssetEvents
{

    /**
     * @var array Original elements prior to saving.
     */
    private static array $_originals = [];

    /**
     * Get original Asset prior to saving.
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function beforeSave(ModelEvent $event): void
    {
        /** @var Asset $asset */
        $asset = $event->sender;

        // If no existing ID, bail
        if (!$asset->id) {
            return;
        }

        // Fresh DB read; ignorePlaceholders() bypasses the in-memory cache
        $original = Asset::find()
            ->id($asset->id)
            ->siteId($asset->siteId)
            ->status(null)
            ->ignorePlaceholders()
            ->one();

        // If lookup failed, bail
        if (!$original) {
            return;
        }

        // Eagerly load field values; lazy reads later would pick up post-save content
        $original->getFieldValues();

        // Key by assetId+siteId so per-site propagation doesn't clobber the active site's capture
        static::$_originals[$asset->id][$asset->siteId] = $original;
    }

    /**
     * When a new file is uploaded and saved.
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function afterPropagate(ModelEvent $event): void
    {
        /** @var Asset $asset */
        $asset = $event->sender;

        // If not first time being saved, skip it
        if (!$asset->firstSave) {
            return;
        }

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'assets',
                'event' => 'after-propagate',
            ])
            ->all();

        // Pass data to message parser
        $data = [
            'original' => (static::$_originals[$asset->id][$asset->siteId] ?? null),
        ];

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
    }

    /**
     * When an asset is moved (between folders or volumes).
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function afterMove(ModelEvent $event): void
    {
        /** @var Asset $asset */
        $asset = $event->sender;

        // If first time being saved, this is a new upload; skip it
        if ($asset->firstSave) {
            return;
        }

        // Get the captured pre-save original for this asset+site
        $original = (static::$_originals[$asset->id][$asset->siteId] ?? null);

        // If no original captured, can't detect the move; bail
        if (!$original) {
            return;
        }

        // If neither folder nor volume changed, this isn't a move; bail
        if ($original->folderId == $asset->folderId && $original->volumeId == $asset->volumeId) {
            return;
        }

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'assets',
                'event' => 'after-move',
            ])
            ->all();

        // Pass captured original so templates can render before/after paths
        $data = [
            'original' => $original,
        ];

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
    }

    /**
     * When an existing asset is updated (anything other than a move).
     *
     * @param ModelEvent $event
     * @return void
     */
    public static function afterUpdate(ModelEvent $event): void
    {
        /** @var Asset $asset */
        $asset = $event->sender;

        // If first time being saved, this is a new upload; skip it
        if ($asset->firstSave) {
            return;
        }

        // Get the captured pre-save original for this asset+site
        $original = (static::$_originals[$asset->id][$asset->siteId] ?? null);

        // If no original captured, can't verify changes; bail
        if (!$original) {
            return;
        }

        // If folder or volume changed, this save is a move; let after-move own it
        if ($original->folderId != $asset->folderId || $original->volumeId != $asset->volumeId) {
            return;
        }

        // If nothing else changed between the original and the saved asset,
        // this is a no-op save; bail
        if (!static::_assetHasChanges($original, $asset)) {
            return;
        }

        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'assets',
                'event' => 'after-update',
            ])
            ->all();

        // Pass captured original for change-detection use in templates
        $data = [
            'original' => $original,
        ];

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
    }

    // ========================================================================= //

    /**
     * Detect whether any native attribute or custom field value differs between
     * a captured pre-save Asset and its post-save counterpart.
     *
     * @param Asset $original
     * @param Asset $asset
     * @return bool
     */
    private static function _assetHasChanges(Asset $original, Asset $asset): bool
    {
        // Native attributes worth comparing for "did this asset change?"
        $attrs = ['title', 'filename', 'alt', 'focalPoint', 'kind', 'mimeType', 'size', 'width', 'height'];

        foreach ($attrs as $attr) {
            if (($original->$attr ?? null) != ($asset->$attr ?? null)) {
                return true;
            }
        }

        // Custom field values
        $fieldLayout = $asset->getFieldLayout();
        if ($fieldLayout) {
            foreach ($fieldLayout->getCustomFields() as $field) {
                $a = $field->serializeValue($original->getFieldValue($field->handle), $original);
                $b = $field->serializeValue($asset->getFieldValue($field->handle), $asset);
                if (serialize($a) !== serialize($b)) {
                    return true;
                }
            }
        }

        return false;
    }

    // ========================================================================= //

    /**
     * When an asset is deleted.
     *
     * @param Event $event
     * @return void
     */
    public static function afterDelete(Event $event): void
    {
        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'assets',
                'event' => 'after-delete',
            ])
            ->all();

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event);
    }

    /**
     * When an asset is restored.
     *
     * @param Event $event
     * @return void
     */
    public static function afterRestore(Event $event): void
    {
        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'assets',
                'event' => 'after-restore',
            ])
            ->all();

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event);
    }

}
