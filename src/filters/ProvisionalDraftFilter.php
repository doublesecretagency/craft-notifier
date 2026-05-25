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
use craft\base\ElementInterface;
use craft\helpers\ElementHelper;

/**
 * Filters events based on whether the element is a draft.
 *
 * @see https://github.com/craftcms/webhooks
 * @since 1.1.0
 */
class ProvisionalDraftFilter extends BaseElementFilter
{
    public static function displayName(): string
    {
        return Craft::t('notifier', 'Element is a provisional draft');
    }

    public static function titleYes(): string
    {
        return Craft::t('notifier', 'Must be a provisional draft');
    }

    public static function titleNo(): string
    {
        return Craft::t('notifier', 'Must not be a provisional draft');
    }

    public static function titleIgnore(): string
    {
        return Craft::t('notifier', 'Can be a provisional draft or non-provisional');
    }

    public static function defaultValue(): ?bool
    {
        // Prohibit provisional drafts by default
        return false;
    }

    public static function excludes(): array
    {
        return [
            DraftFilter::class,
            RevisionFilter::class,
            FirstSaveFilter::class,
        ];
    }

    protected static function checkElement(ElementInterface $element, bool $value): bool
    {
        $root = ElementHelper::rootElement($element);
        return $root->isProvisionalDraft === $value;
    }
}
