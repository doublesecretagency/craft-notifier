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
use craft\helpers\App;
use DateTime;
use DateTimeZone;
use Throwable;

/**
 * Compiles a point-in-time report of the Craft installation.
 *
 * @since 3.1.0
 */
abstract class SystemSnapshot
{

    /**
     * Compile a fresh snapshot of the current Craft installation.
     *
     * @return array The compiled report.
     */
    public static function compile(): array
    {
        // When the snapshot was compiled, in UTC
        $compiledAt = new DateTime('now', new DateTimeZone('UTC'));

        // Force-refresh the update data once, sharing it across the craft + plugins sections
        $update = static::_resolveUpdates($compiledAt);

        // Compile each section in isolation
        return [
            'compiledAt' => $compiledAt,
            'craft'      => static::_section('craft', static fn() => static::_compileCraft($update)),
            'plugins'    => static::_section('plugins', static fn() => static::_compilePlugins($update)),
            'sites'      => static::_section('sites', static fn() => static::_compileSites()),
            'system'     => static::_section('system', static fn() => static::_compileSystem()),
            'queue'      => static::_section('queue', static fn() => static::_compileQueue()),
        ];
    }

    // ========================================================================= //

    /**
     * Run a section compiler, logging and nulling out on failure.
     *
     * @param string $name The section name (for the log message).
     * @param callable $compiler Returns the section's array.
     * @return array|null The compiled section, or null on failure.
     */
    private static function _section(string $name, callable $compiler): ?array
    {
        try {
            // Compile the section
            return $compiler();
        } catch (Throwable $e) {
            // Log the failure and report the section as null
            Craft::warning("Notifier System Snapshot: failed to compile \"{$name}\" section: {$e->getMessage()}", __METHOD__);
            return null;
        }
    }

    /**
     * Force-refresh Craft's update data, falling back to cached data on failure.
     *
     * @param DateTime $compiledAt
     * @return array The resolved update data (model, refreshedAt, refreshFailed).
     */
    private static function _resolveUpdates(DateTime $compiledAt): array
    {
        // Try a fresh network check against Craft's update server
        try {
            $model = Craft::$app->getUpdates()->getUpdates(true);
            return [
                'model' => $model,
                'refreshedAt' => $compiledAt,
                'refreshFailed' => false
            ];
        } catch (Throwable) {
            // Fall back to cached update data, flagging the refresh as failed
            try {
                $model = Craft::$app->getUpdates()->getUpdates(false);
            } catch (Throwable) {
                $model = null;
            }
            return [
                'model' => $model,
                'refreshedAt' => $compiledAt,
                'refreshFailed' => true
            ];
        }
    }

    /**
     * Compile the sites section.
     *
     * @return array A map of every site, keyed by handle.
     */
    private static function _compileSites(): array
    {
        // Initialize the sites map
        $sites = [];

        // Loop through every site
        foreach (Craft::$app->getSites()->getAllSites() as $site) {
            // Append the site, keyed by handle
            $sites[$site->handle] = [
                'id'       => (int) $site->id,
                'handle'   => $site->handle,
                'name'     => $site->getName(),
                'url'      => $site->getBaseUrl(),
                'language' => $site->language,
                'primary'  => (bool) $site->primary,
            ];
        }

        // Return the sites map
        return $sites;
    }

    /**
     * Compile the Craft section.
     *
     * @param array $update Resolved update data.
     * @return array
     */
    private static function _compileCraft(array $update): array
    {
        // Get the running and licensed editions
        $edition = Craft::$app->getEditionName();
        $licensedEdition = null;
        $licensed = true;

        // If the licensed-edition API exists (Craft 5), compare against the running edition
        if (method_exists(Craft::$app, 'getLicensedEditionName')) {
            $licensedEdition = Craft::$app->getLicensedEditionName();
            $licensed = (null === $licensedEdition || $licensedEdition === $edition);
        }

        // Return the Craft section
        return [
            'version'         => Craft::$app->getVersion(),
            'edition'         => $edition,
            'systemName'      => Craft::$app->getSystemName(),
            'schemaVersion'   => Craft::$app->schemaVersion,
            'live'            => Craft::$app->getIsLive(),
            'maintenanceMode' => Craft::$app->getIsInMaintenanceMode(),
            'devMode'         => App::devMode(),
            'licensed'        => $licensed,
            'licensedEdition' => $licensedEdition,
            'update'          => static::_craftUpdate($update),
        ];
    }

    /**
     * Compile the Craft update sub-section.
     *
     * @param array $update Resolved update data.
     * @return array
     */
    private static function _craftUpdate(array $update): array
    {
        // Get the CMS update model (may be null if the refresh and cache both failed)
        $cms = ($update['model']->cms ?? null);

        // Return the Craft update sub-section
        return [
            'available'     => (bool) ($cms?->getHasReleases() ?? false),
            'latest'        => ($cms?->getLatest()->version ?? null),
            'critical'      => (bool) ($cms?->getHasCritical() ?? false),
            'refreshedAt'   => $update['refreshedAt'],
            'refreshFailed' => $update['refreshFailed'],
        ];
    }

    /**
     * Compile the plugins section.
     *
     * @param array $update Resolved update data.
     * @return array
     */
    private static function _compilePlugins(array $update): array
    {
        // Get the plugins service and the resolved per-plugin update models
        $pluginsService = Craft::$app->getPlugins();
        $pluginUpdates = ($update['model']->plugins ?? []);

        // Initialize the plugins map
        $plugins = [];

        // Loop through every installed plugin
        foreach ($pluginsService->getAllPlugins() as $handle => $plugin) {

            // Get the stored license status for this plugin
            $info = $pluginsService->getPluginInfo($handle);
            $license = (string) ($info['licenseKeyStatus'] ?? 'unknown');

            // Get this plugin's update model (if any)
            $pluginUpdate = ($pluginUpdates[$handle] ?? null);

            // Append the plugin's snapshot, keyed by handle
            $plugins[$handle] = [
                'name'        => $plugin->name,
                'handle'      => $handle,
                'packageName' => $plugin->packageName,
                'version'     => $plugin->getVersion(),
                'edition'     => ($info['edition'] ?? null),
                'license'     => $license,
                'update'      => [
                    'available' => (bool) ($pluginUpdate?->getHasReleases() ?? false),
                    'latest'    => ($pluginUpdate?->getLatest()->version ?? null),
                    'critical'  => (bool) ($pluginUpdate?->getHasCritical() ?? false),
                    'abandoned' => (bool) ($pluginUpdate?->abandoned ?? false),
                ],
            ];

        }

        // Return the plugins map
        return $plugins;
    }

    /**
     * Compile the system section (PHP / OS / DB).
     *
     * @return array
     */
    private static function _compileSystem(): array
    {
        // Get the database connection
        $db = Craft::$app->getDb();

        // Build the driver-and-version string the same way Craft's System Report does
        $dbLabel = $db->getDriverLabel() . ' ' . App::normalizeVersion($db->getSchema()->getServerVersion());

        // Return the system section
        return [
            'php' => App::phpVersion(),
            'os'  => PHP_OS . ' ' . php_uname('r'),
            'db'  => $dbLabel,
        ];
    }

    /**
     * Compile the queue health section.
     *
     * @return array
     */
    private static function _compileQueue(): array
    {
        // The Craft queue table
        $table = '{{%queue}}';

        // Jobs queued but not yet executed
        $pending = (new Query())
            ->from($table)
            ->where(['fail' => false, 'timeUpdated' => null])
            ->count();

        // Jobs that exhausted their retries
        $failed = (new Query())
            ->from($table)
            ->where(['fail' => true])
            ->count();

        // Jobs scheduled for future execution
        $delayed = (new Query())
            ->from($table)
            ->where(['timeUpdated' => null])
            ->andWhere(['>', 'delay', 0])
            ->count();

        // Return the queue section
        return [
            'pending' => (int) $pending,
            'failed'  => (int) $failed,
            'delayed' => (int) $delayed,
        ];
    }

}
