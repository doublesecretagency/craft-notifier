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

use craft\base\ComponentInterface;
use yii\base\Event;

/**
 * Filter Interface
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @see https://github.com/craftcms/webhooks
 * @since 1.1.0
 */
interface FilterInterface extends ComponentInterface
{
    /**
     * Name of filter.
     *
     * @return string
     */
    public static function displayName(): string;

    /**
     * Title shown for "yes" filter.
     *
     * @return string
     */
    public static function titleYes(): string;

    /**
     * Title shown for "no" filter.
     *
     * @return string
     */
    public static function titleNo(): string;

    /**
     * Title shown for "ignore" filter.
     *
     * @return string
     */
    public static function titleIgnore(): string;

    /**
     * Default filter value:
     *  - true  = required
     *  - null  = no preference
     *  - false = prohibited
     *
     * @return bool|null
     */
    public static function defaultValue(): ?bool;

    /**
     * Returns whether the filter should be shown for the given class and event.
     *
     * @param string $class
     * @param string $event
     * @return bool
     */
    public static function show(string $class, string $event): bool;

    /**
     * Returns whether the event passes the filter.
     *
     * @param Event $event The event being filtered
     * @param bool $value The filter value
     * @return bool
     */
    public static function check(Event $event, bool $value): bool;
}
