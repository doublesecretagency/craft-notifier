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
 * Adds a "has changed" operator to attribute condition rules.
 *
 * @since 3.0.0
 */
trait HasChangedAttributeOperator
{

    /**
     * @var string Operator value injected into the rule's operator dropdown.
     */
    public const OPERATOR_HAS_CHANGED = 'has_changed';

    /**
     * Return the value used for the has_changed diff.
     *
     * Must be scalar, array, or DateTime, anything that compares safely with `!=`
     * without recursing into cyclic object graphs.
     *
     * @param ElementInterface $element
     * @return mixed
     */
    abstract protected function hasChangedComparisonValue(ElementInterface $element): mixed;

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

        // Get the captured pre-save original
        $original = Originals::get($element);

        // If no original was captured, it can't have changed
        if (!$original) {
            return false;
        }

        // Compare the current value against the original
        return $this->hasChangedComparisonValue($element) != $this->hasChangedComparisonValue($original);
    }

}
