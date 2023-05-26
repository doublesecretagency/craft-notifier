<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events get triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\helpers;

/**
 * Notifier helper
 * @since 1.0.0
 */
class Notifier
{

    /**
     * Get all notification logs.
     *
     * @return array
     */
    public static function logs(): array
    {
        return Log::getAllMessages();
    }

}
