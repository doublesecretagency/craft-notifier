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
use craft\helpers\StringHelper;
use craft\models\Structure;
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

    // ========================================================================= //

    /**
     * Save the structure UID to the plugin settings.
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

        // Get the plugin
        $plugin = NotifierPlugin::$plugin;

        // Merge the new UID over the existing settings
        $merged = array_merge($settings->toArray(), ['structureUid' => $uid]);

        // Save the merged settings
        Craft::$app->getPlugins()->savePluginSettings($plugin, $merged);
    }

}
