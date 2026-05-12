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
 * Trait HasChangedAttributeOperator
 * @since 3.0.0
 *
 * Adds a `has_changed` operator to native attribute condition rules
 * (Title, Slug, Status, Post Date, etc.). Sibling of HasChangedOperator;
 * differs in that the comparison value comes from a single attribute /
 * derived getter on the element, not from a fieldInstances() loop.
 */
trait HasChangedAttributeOperator
{

    /**
     * @var string Operator value injected into the rule's operator dropdown.
     */
    public const OPERATOR_HAS_CHANGED = 'has_changed';

    /**
     * Return the value used for the has_changed diff. Must be scalar /
     * array / DateTime, anything that compares safely with `!=` without
     * recursing into cyclic object graphs.
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

        $original = Originals::get($element);
        if (!$original) {
            return false;
        }

        return $this->hasChangedComparisonValue($element) != $this->hasChangedComparisonValue($original);
    }

}
