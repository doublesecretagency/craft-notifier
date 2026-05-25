<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\conditions\attributes;

use craft\base\ElementInterface;
use craft\elements\conditions\LanguageConditionRule;
use doublesecretagency\notifier\conditions\operators\HasChangedAttributeOperator;

/**
 * Class NotifierLanguageConditionRule
 * @since 3.0.0
 *
 * Notifier-scoped subclass that adds `has changed` to the operator dropdown
 * for the Language rule.
 */
class NotifierLanguageConditionRule extends LanguageConditionRule
{
    use HasChangedAttributeOperator;

    /**
     * @inheritdoc
     */
    protected function hasChangedComparisonValue(ElementInterface $element): mixed
    {
        return $element->getLanguage();
    }
}
