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

use craft\fields\conditions\GeneratedFieldConditionRule;
use doublesecretagency\notifier\conditions\operators\HasChangedOperator;

/**
 * Class NotifierGeneratedFieldConditionRule
 * @since 3.0.0
 *
 * Notifier-scoped subclass that adds `has changed` to the operator dropdown
 * for generated-field rules (computed virtual fields in field layouts).
 */
class NotifierGeneratedFieldConditionRule extends GeneratedFieldConditionRule
{
    use HasChangedOperator;
}
