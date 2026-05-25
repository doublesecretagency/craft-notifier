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

namespace doublesecretagency\notifier\conditions\fields;

use craft\fields\conditions\MoneyFieldConditionRule;
use doublesecretagency\notifier\conditions\operators\HasChangedOperator;

/**
 * Class NotifierMoneyFieldConditionRule
 * @since 3.0.0
 *
 * Notifier-scoped subclass that adds `has changed` to the operator dropdown
 * for Money field rules.
 */
class NotifierMoneyFieldConditionRule extends MoneyFieldConditionRule
{
    use HasChangedOperator;
}
