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

use craft\base\ElementInterface;
use craft\elements\conditions\entries\TypeConditionRule;
use doublesecretagency\notifier\conditions\operators\HasChangedAttributeOperator;

/**
 * Class NotifierTypeConditionRule
 * @since 3.0.0
 *
 * Notifier-scoped subclass that adds `has changed` to the operator dropdown
 * for the Entry Type rule.
 */
class NotifierTypeConditionRule extends TypeConditionRule
{
    use HasChangedAttributeOperator;

    /**
     * @inheritdoc
     */
    protected function hasChangedComparisonValue(ElementInterface $element): mixed
    {
        return $element->getType()?->uid;
    }
}
