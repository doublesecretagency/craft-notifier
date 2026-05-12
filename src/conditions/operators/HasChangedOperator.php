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

namespace doublesecretagency\notifier\conditions\operators;

use Craft;
use craft\base\ElementInterface;
use doublesecretagency\notifier\helpers\events\Originals;
use yii\db\QueryInterface;

/**
 * Trait HasChangedOperator
 * @since 3.0.0
 *
 * Adds a `has_changed` operator to per-field condition rules. Two-tier check:
 * live `isFieldDirty()` for the per-site save events, value-diff against
 * the captured original when Craft has already called `markAsClean()`
 * (the entry after-propagate path, or any propagated element save).
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
        if ($this->operator !== self::OPERATOR_HAS_CHANGED) {
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

        // Once Craft has called `markAsClean()`, diff against captured original
        $original = Originals::get($element);
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

}
