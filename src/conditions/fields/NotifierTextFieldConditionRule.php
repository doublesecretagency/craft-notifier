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

use craft\fields\conditions\TextFieldConditionRule;
use doublesecretagency\notifier\conditions\operators\HasChangedOperator;

/**
 * Adds "has changed" to the Text field rule's operators (PlainText, Email).
 *
 * @since 3.0.0
 */
class NotifierTextFieldConditionRule extends TextFieldConditionRule
{
    use HasChangedOperator;
}
