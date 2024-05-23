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
 * Filters events based on whether the element is being bulk-resaved.
 *
 * @see https://github.com/craftcms/webhooks
 * @since 1.1.0
 */
class ResavingFilter extends BaseElementFilter
{
    public static function displayName(): string
    {
        return Craft::t('notifier', 'Element is being bulk-resaved');
    }

    public static function titleYes(): string
    {
        return Craft::t('notifier', 'Must be bulk-resaving the element');
    }

    public static function titleNo(): string
    {
        return Craft::t('notifier', 'Must not be bulk-resaving the element');
    }

    public static function excludes(): array
    {
        return [
            FirstSaveFilter::class,
        ];
    }

    protected static function checkElement(ElementInterface $element, bool $value): bool
    {
        /** @var Element $element */
        return $element->resaving === $value;
    }
}
