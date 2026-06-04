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

namespace doublesecretagency\notifier\filters;

/**
 * Marks a filter that excludes other filters while it is active.
 *
 * @see https://github.com/craftcms/webhooks
 * @since 1.1.0
 */
interface ExclusiveFilterInterface extends FilterInterface
{
    /**
     * Get any filters to disable while this filter is active and enabled.
     *
     * @return string[]
     */
    public static function excludes(): array;
}
