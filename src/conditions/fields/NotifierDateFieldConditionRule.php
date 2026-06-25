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

namespace doublesecretagency\notifier\conditions\fields;

use Craft;
use craft\base\ElementInterface;
use craft\fields\conditions\DateFieldConditionRule;
use doublesecretagency\notifier\helpers\events\Originals;

/**
 * Adds "has changed" to the Date field rule's options.
 *
 * @since 3.0.0
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
        // If this isn't the "has changed" range type, defer to the parent
        if ($this->rangeType !== self::RANGE_TYPE_HAS_CHANGED) {
            return parent::matchElement($element);
        }

        // Get the field-layout instances this rule was configured against
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

        // Get the captured original (set once Craft has called `markAsClean()`)
        $original = Originals::get($element);

        // If there's no captured original, nothing changed
        if (!$original) {
            return false;
        }

        foreach ($fieldInstances as $field) {
            // Serialize first; raw object values can have cyclic refs that crash `!=`
            $current = $field->serializeValue($element->getFieldValue($field->handle), $element);
            $previous = $field->serializeValue($original->getFieldValue($field->handle), $original);

            // If the serialized values differ, the field changed
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
