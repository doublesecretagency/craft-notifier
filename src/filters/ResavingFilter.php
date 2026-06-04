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

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('notifier', 'Element is being bulk-resaved');
    }

    /**
     * @inheritdoc
     */
    public static function titleYes(): string
    {
        return Craft::t('notifier', 'Must be bulk-resaving the element');
    }

    /**
     * @inheritdoc
     */
    public static function titleNo(): string
    {
        return Craft::t('notifier', 'Must not be bulk-resaving the element');
    }

    /**
     * @inheritdoc
     */
    public static function excludes(): array
    {
        return [
            FirstSaveFilter::class,
        ];
    }

    /**
     * @inheritdoc
     */
    protected static function checkElement(ElementInterface $element, bool $value): bool
    {
        /** @var Element $element */
        return $element->resaving === $value;
    }

}
