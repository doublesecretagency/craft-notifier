<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Get notified when things happen.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\utilities;

use Craft;
use craft\base\Utility;
use doublesecretagency\notifier\helpers\Notifier;

class LogUtility extends Utility
{

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('notifier', 'Notification Logs');
    }

    /**
     * @inheritdoc
     */
    public static function id(): string
    {
        return 'notification-logs';
    }

    /**
     * @inheritdoc
     */
    public static function iconPath()
    {
        // Set the icon mask path
        $iconPath = Craft::getAlias('@vendor/doublesecretagency/craft-notifier/src/icon-mask.svg');

        // If not a string, bail
        if (!is_string($iconPath)) {
            return null;
        }

        // Return the icon mask path
        return $iconPath;
    }

    /**
     * @inheritdoc
     */
    public static function contentHtml(): string
    {
        // Render the utility template
        return Craft::$app->getView()->renderTemplate('notifier/_utility/logs', [
            'logs' => Notifier::logs(),
        ]);
    }

}
