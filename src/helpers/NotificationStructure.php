<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\helpers;

use Craft;
use craft\db\Query;
use craft\db\Table;
use craft\helpers\StringHelper;
use craft\models\Structure;
use craft\services\Structures;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\models\Settings;
use doublesecretagency\notifier\NotifierPlugin;
use Throwable;

/**
 * Owns the single Structure used to order notifications.
 *
 * @since 3.1.0
 */
abstract class NotificationStructure
{

    /**
     * @var int|null Cached structure ID for this request.
     */
    private static ?int $_structureId = null;

    /**
     * Get the ID of the Structure used to order notifications.
     *
     * The UID syncs across environments via project config, so each environment
     * creates its own Structure row from that shared UID on first use.
     *
     * @return int|null The structure ID, or null when it could not be resolved.
     */
    public static function getStructureId(): ?int
    {
        // If already resolved this request, return the cached ID
        if (null !== static::$_structureId) {
            return static::$_structureId;
        }

        // Get the structures service
        $structures = Craft::$app->getStructures();

        // Get the plugin settings
        /** @var Settings $settings */
        $settings = NotifierPlugin::$plugin->getSettings();

        // Get the configured structure UID
        $uid = $settings->structureUid;

        // If a UID is configured, try to resolve it to an existing structure
        if ($uid) {
            $structure = $structures->getStructureByUid($uid);
            // If found, cache and return its ID
            if ($structure) {
                return static::$_structureId = $structure->id;
            }
        }

        // Don't generate a UID that can't be persisted (it would throw, or leak a structure per request)
        // If no UID is configured on a read-only environment, bail
        if (!$uid && Craft::$app->getProjectConfig()->readOnly) {
            return null;
        }

        // Reuse the configured UID, or generate a new one
        $structureUid = ($uid ?: StringHelper::UUID());

        try {
            // Build a flat structure (no nesting)
            $structure = new Structure([
                'maxLevels' => 1,
                'uid' => $structureUid,
            ]);

            // If the structure can't be saved, bail
            if (!$structures->saveStructure($structure)) {
                return null;
            }
        } catch (Throwable) {
            // If creation failed, bail
            return null;
        }

        // Save the UID back to the plugin settings
        static::_saveUid($settings, $structure->uid);

        // Cache and return the new structure ID
        return static::$_structureId = $structure->id;
    }

    /**
     * Place any canonical notifications not yet in the manual-order structure.
     *
     * Safe to run on every index render, so it repairs anything the
     * one-shot migration missed or any later drift.
     *
     * @param int $structureId The structure that backs the manual order.
     * @return void
     */
    public static function backfillUnplaced(int $structureId): void
    {
        // Get the mutex service
        $mutex = Craft::$app->getMutex();

        // Lock name for this structure's backfill
        $lockName = "notifier-structure-backfill-{$structureId}";

        // If another process is already backfilling, bail
        if (!$mutex->acquire($lockName)) {
            return;
        }

        try {

            // Get the structures service
            $structures = Craft::$app->getStructures();

            // Get the element IDs already placed in the structure
            $placedIds = (new Query())
                ->select(['elementId'])
                ->from([Table::STRUCTUREELEMENTS])
                ->where(['structureId' => $structureId])
                ->column();

            // Get every canonical notification, oldest first
            $query = Notification::find()
                ->status(null)
                ->orderBy(['elements.id' => SORT_ASC]);

            // If any are already placed, exclude them
            if ($placedIds) {
                $query->andWhere(['not', ['elements.id' => array_map('intval', $placedIds)]]);
            }

            // Loop through each unplaced notification
            foreach ($query->all() as $notification) {
                // Append it, preserving creation order top-to-bottom
                $structures->appendToRoot($structureId, $notification, Structures::MODE_INSERT);
            }

        } catch (Throwable $e) {
            // Never let a placement failure break the caller (index render or migration)
            Craft::warning("Notifier structure backfill skipped: {$e->getMessage()}", __METHOD__);
        } finally {
            // Always release the lock
            $mutex->release($lockName);
        }
    }

    // ========================================================================= //

    /**
     * Save the structure UID to the plugin settings.
     *
     * Skipped when the project config is read-only. Writing project config from a
     * migration on a locked environment throws, which triggers Craft's restore.
     *
     * @param Settings $settings The current plugin settings.
     * @param string $uid The structure UID to store.
     * @return void
     */
    private static function _saveUid(Settings $settings, string $uid): void
    {
        // If the UID is already stored, bail
        if ($settings->structureUid === $uid) {
            return;
        }

        // If the project config is read-only, bail without writing
        if (Craft::$app->getProjectConfig()->readOnly) {
            return;
        }

        // Get the plugin
        $plugin = NotifierPlugin::$plugin;

        // Merge the new UID over the existing settings
        $merged = array_merge($settings->toArray(), ['structureUid' => $uid]);

        // Save the merged settings
        Craft::$app->getPlugins()->savePluginSettings($plugin, $merged);
    }

}
