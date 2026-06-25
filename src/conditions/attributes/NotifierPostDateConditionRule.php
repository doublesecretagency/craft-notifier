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

namespace doublesecretagency\notifier\conditions\attributes;

use Craft;
use craft\base\ElementInterface;
use craft\elements\conditions\entries\PostDateConditionRule;
use doublesecretagency\notifier\helpers\events\Originals;

/**
 * Adds "has changed" to the Post Date rule's options.
 *
 * @since 3.0.0
 */
class NotifierPostDateConditionRule extends PostDateConditionRule
{

    /**
     * @var string Range-type value injected into the rule's rangeType menu.
     */
    public const RANGE_TYPE_HAS_CHANGED = 'has_changed';

    /**
     * @inheritdoc
     */
    protected function rangeTypeOptions(): array
    {
        return array_merge(parent::rangeTypeOptions(), [
            self::RANGE_TYPE_HAS_CHANGED => Craft::t('notifier', 'has changed'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function matchElement(ElementInterface $element): bool
    {
        // If this isn't the "has changed" range type, defer to the parent
        if ($this->rangeType !== self::RANGE_TYPE_HAS_CHANGED) {
            return parent::matchElement($element);
        }

        // Get the captured pre-save original
        $original = Originals::get($element);

        // If no original was captured, it can't have changed
        if (!$original) {
            return false;
        }

        // Compare the current post date against the original
        return ($element->postDate?->getTimestamp()) != ($original->postDate?->getTimestamp());
    }

    /**
     * @inheritdoc
     */
    protected function queryParamValue(): array|string|null
    {
        // No query-phase equivalent for dirty state
        if ($this->rangeType === self::RANGE_TYPE_HAS_CHANGED) {
            return null;
        }
        return parent::queryParamValue();
    }

}
