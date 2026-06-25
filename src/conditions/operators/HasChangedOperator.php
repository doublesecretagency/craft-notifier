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

namespace doublesecretagency\notifier\conditions\operators;

use Craft;
use craft\base\ElementInterface;
use doublesecretagency\notifier\helpers\events\Originals;
use yii\db\QueryInterface;

/**
 * Adds a "has changed" operator to per-field condition rules.
 *
 * @since 3.0.0
 */
trait HasChangedOperator
{

    /**
     * @var string Operator value injected into the rule's operator dropdown.
     */
    public const OPERATOR_HAS_CHANGED = 'has_changed';

    /**
     * @inheritdoc
     */
    protected function operators(): array
    {
        return array_merge(parent::operators(), [self::OPERATOR_HAS_CHANGED]);
    }

    /**
     * @inheritdoc
     */
    protected function operatorLabel(string $operator): string
    {
        // If this is the "has changed" operator, use its label
        if ($operator === self::OPERATOR_HAS_CHANGED) {
            return Craft::t('notifier', 'has changed');
        }
        return parent::operatorLabel($operator);
    }

    /**
     * @inheritdoc
     */
    protected function inputHtml(): string
    {
        // Valueless operator; same precedent as OPERATOR_EMPTY / OPERATOR_NOT_EMPTY
        if ($this->operator === self::OPERATOR_HAS_CHANGED) {
            return '';
        }
        return parent::inputHtml();
    }

    /**
     * @inheritdoc
     */
    public function modifyQuery(QueryInterface $query): void
    {
        // No query-phase equivalent for dirty state; rule evaluates only in matchElement()
        if ($this->operator === self::OPERATOR_HAS_CHANGED) {
            return;
        }
        parent::modifyQuery($query);
    }

    /**
     * @inheritdoc
     */
    public function matchElement(ElementInterface $element): bool
    {
        // If this isn't the "has changed" operator, defer to the parent
        if ($this->operator !== self::OPERATOR_HAS_CHANGED) {
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

}
