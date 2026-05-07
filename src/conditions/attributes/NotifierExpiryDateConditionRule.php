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

namespace doublesecretagency\notifier\conditions\attributes;

use Craft;
use craft\base\ElementInterface;
use craft\elements\conditions\entries\ExpiryDateConditionRule;
use doublesecretagency\notifier\helpers\events\EntryEvents;

/**
 * Class NotifierExpiryDateConditionRule
 * @since 3.0.0
 *
 * Adds `has changed` to the rangeType menu for the Expiry Date rule.
 * Same pattern as NotifierPostDateConditionRule.
 */
class NotifierExpiryDateConditionRule extends ExpiryDateConditionRule
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
        if ($this->rangeType !== self::RANGE_TYPE_HAS_CHANGED) {
            return parent::matchElement($element);
        }
        if (empty($element->id) || empty($element->siteId)) {
            return false;
        }
        $original = EntryEvents::getCapturedOriginal($element->id, $element->siteId);
        if (!$original) {
            return false;
        }
        return ($element->expiryDate?->getTimestamp()) != ($original->expiryDate?->getTimestamp());
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
