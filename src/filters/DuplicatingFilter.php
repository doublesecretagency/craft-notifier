<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\filters;

use Craft;
use craft\base\Element;
use craft\base\ElementInterface;

/**
 * Filters events based on whether the element is being duplicated.
 *
 * @see https://github.com/craftcms/webhooks
 * @since 1.1.0
 */
class DuplicatingFilter extends BaseElementFilter
{
    public static function displayName(): string
    {
        return Craft::t('notifier', 'Element is being duplicated');
    }

    public static function titleYes(): string
    {
        return Craft::t('notifier', 'Must be duplicating the element');
    }

    public static function titleNo(): string
    {
        return Craft::t('notifier', 'Must not be duplicating the element');
    }

    protected static function checkElement(ElementInterface $element, bool $value): bool
    {
        /** @var Element $element */
        return (bool)$element->duplicateOf === $value;
    }
}
