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
 * Filters events based on whether the element is enabled.
 *
 * @see https://github.com/craftcms/webhooks
 * @since 1.1.0
 */
class ElementEnabledFilter extends BaseElementFilter
{
    public static function displayName(): string
    {
        return Craft::t('notifier', 'Element is enabled');
    }

    public static function titleYes(): string
    {
        return Craft::t('notifier', 'Must be enabled');
    }

    public static function titleNo(): string
    {
        return Craft::t('notifier', 'Must be disabled');
    }

    public static function titleIgnore(): string
    {
        return Craft::t('notifier', 'Can be enabled or disabled');
    }

    public static function defaultValue(): ?bool
    {
        // Require enabled by default
        return true;
    }

    protected static function checkElement(ElementInterface $element, bool $value): bool
    {
        /** @var Element $element */
        return $value === ($element->enabled && $element->getEnabledForSite());
    }
}
