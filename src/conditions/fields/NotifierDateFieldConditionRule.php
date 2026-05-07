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

namespace doublesecretagency\notifier\conditions\fields;

use Craft;
use craft\base\ElementInterface;
use craft\fields\conditions\DateFieldConditionRule;
use doublesecretagency\notifier\helpers\events\EntryEvents;

/**
 * Class NotifierDateFieldConditionRule
 * @since 3.0.0
 *
 * Notifier-scoped subclass that adds `has changed` to the rangeType dropdown
 * for Date field rules. Date rules use `rangeType` instead of `operator`, so
 * this class handles the has-changed semantics inline rather than via the
 * shared `HasChangedOperator` trait.
 */
class NotifierDateFieldConditionRule extends DateFieldConditionRule
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

        // Resolve the field-layout instances this rule was configured against
        try {
            $fieldInstances = $this->fieldInstances();
        } catch (\yii\base\InvalidConfigException) {
            return false;
        }

        // Live dirty state covers the per-site `entry-saved` event
        foreach ($fieldInstances as $field) {
            if ($element->isFieldDirty($field->handle)) {
                return true;
            }
        }

        // After-propagate runs after `markAsClean()`; diff against captured original
        if (empty($element->id) || empty($element->siteId)) {
            return false;
        }
        $original = EntryEvents::getCapturedOriginal($element->id, $element->siteId);
        if (!$original) {
            return false;
        }

        foreach ($fieldInstances as $field) {
            // Serialize first; raw object values can have cyclic refs that crash `!=`
            $current = $field->serializeValue($element->getFieldValue($field->handle), $element);
            $previous = $field->serializeValue($original->getFieldValue($field->handle), $original);
            if ($current != $previous) {
                return true;
            }
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    protected function elementQueryParam(): array|string|null
    {
        // No query-phase equivalent for dirty state; rule evaluates only in matchElement()
        if ($this->rangeType === self::RANGE_TYPE_HAS_CHANGED) {
            return null;
        }
        return parent::elementQueryParam();
    }

}
