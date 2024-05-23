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

use Craft;
use craft\base\Element;
use craft\base\ElementInterface;

/**
 * Filters events based on whether the element is propagating.
 *
 * @see https://github.com/craftcms/webhooks
 * @since 1.1.0
 */
class PropagatingFilter extends BaseElementFilter
{
    public static function displayName(): string
    {
        return Craft::t('notifier', 'Element is being propagated');
    }

    public static function titleYes(): string
    {
        return Craft::t('notifier', 'Element must be propagating');
    }

    public static function titleNo(): string
    {
        return Craft::t('notifier', 'Element must not be propagating');
    }

    protected static function checkElement(ElementInterface $element, bool $value): bool
    {
        /** @var Element $element */
        return (bool)$element->propagating === $value;
    }
}
