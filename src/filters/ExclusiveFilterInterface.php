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

namespace doublesecretagency\notifier\filters;

/**
 * Exclusive Filter Interface
 *
 * This can be used by filters which should exclude other filters from being available when this filter is active and enabled.
 *
 * @see https://github.com/craftcms/webhooks
 * @since 1.1.0
 */
interface ExclusiveFilterInterface extends FilterInterface
{
    /**
     * Returns any filters that should be disabled if this filter is active and enabled.
     *
     * @return string[]
     */
    public static function excludes(): array;
}
