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

use craft\fields\conditions\EmptyFieldConditionRule;
use doublesecretagency\notifier\conditions\operators\HasChangedOperator;

/**
 * Adds "has changed" to the empty/notEmpty field rule's operators (Time, Matrix, Addresses).
 *
 * @since 3.0.0
 */
class NotifierEmptyFieldConditionRule extends EmptyFieldConditionRule
{
    use HasChangedOperator;
}
