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
use craft\base\ElementInterface;
use craft\helpers\ElementHelper;

/**
 * Filters events based on whether the element is a revision.
 *
 * @see https://github.com/craftcms/webhooks
 * @since 1.1.0
 */
class RevisionFilter extends BaseElementFilter
{
    public static function displayName(): string
    {
        return Craft::t('notifier', 'Element is a revision');
    }

    public static function titleYes(): string
    {
        return Craft::t('notifier', 'Must be a revision');
    }

    public static function titleNo(): string
    {
        return Craft::t('notifier', 'Must not be a revision');
    }

    public static function titleIgnore(): string
    {
        return Craft::t('notifier', 'Can be a revision or non-revision');
    }

    public static function defaultValue(): ?bool
    {
        // Prohibit revisions by default
        return false;
    }

    public static function excludes(): array
    {
        return [
            DraftFilter::class,
            ProvisionalDraftFilter::class,
            FirstSaveFilter::class,
        ];
    }

    protected static function checkElement(ElementInterface $element, bool $value): bool
    {
        $root = ElementHelper::rootElement($element);
        return $root->getIsRevision() === $value;
    }
}
