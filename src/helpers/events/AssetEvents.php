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

}
