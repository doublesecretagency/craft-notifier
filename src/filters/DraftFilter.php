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
use craft\base\ElementInterface;
use craft\helpers\ElementHelper;

/**
 * Filters events based on whether the element is a draft.
 *
 * @see https://github.com/craftcms/webhooks
 * @since 1.1.0
 */
class DraftFilter extends BaseElementFilter
{

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('notifier', 'Element is a draft');
    }

    /**
     * @inheritdoc
     */
    public static function titleYes(): string
    {
        return Craft::t('notifier', 'Must be a draft');
    }

    /**
     * @inheritdoc
     */
    public static function titleNo(): string
    {
        return Craft::t('notifier', 'Must not be a draft');
    }

    /**
     * @inheritdoc
     */
    public static function titleIgnore(): string
    {
        return Craft::t('notifier', 'Can be a draft or non-draft');
    }

    /**
     * @inheritdoc
     */
    public static function defaultValue(): ?bool
    {
        // Prohibit drafts by default
        return false;
    }

    /**
     * @inheritdoc
     */
    public static function excludes(): array
    {
        return [
            RevisionFilter::class,
            FirstSaveFilter::class,
        ];
    }

    /**
     * @inheritdoc
     */
    protected static function checkElement(ElementInterface $element, bool $value): bool
    {
        $root = ElementHelper::rootElement($element);
        return $root->getIsDraft() === $value;
    }

}
