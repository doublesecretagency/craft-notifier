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

/**
 * Filters events based on whether the element is being saved for the first time.
 *
 * @see https://github.com/craftcms/webhooks
 * @since 1.1.0
 */
class FirstSaveFilter extends BaseElementFilter
{

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('notifier', 'Element is being saved for the first time');
    }

    /**
     * @inheritdoc
     */
    public static function titleYes(): string
    {
        return Craft::t('notifier', 'Must be a new entry');
    }

    /**
     * @inheritdoc
     */
    public static function titleNo(): string
    {
        return Craft::t('notifier', 'Must be an existing entry');
    }

    /**
     * @inheritdoc
     */
    public static function titleIgnore(): string
    {
        return Craft::t('notifier', 'Can be existing or new');
    }

    /**
     * @inheritdoc
     */
    public static function excludes(): array
    {
        return [
            NewElementFilter::class,
            DraftFilter::class,
            ProvisionalDraftFilter::class,
            RevisionFilter::class,
            ResavingFilter::class,
        ];
    }

    /**
     * @inheritdoc
     */
    protected static function checkElement(ElementInterface $element, bool $value): bool
    {
        return ($element->firstSave === $value) && !$element->getIsRevision();
    }

}
