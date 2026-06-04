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

use craft\fields\conditions\RelationalFieldConditionRule;
use doublesecretagency\notifier\conditions\operators\HasChangedOperator;

/**
 * Adds "has changed" to the relation field rule's operators (Categories, Tags, Entries, Assets, Users).
 *
 * @since 3.0.0
 */
class NotifierRelationalFieldConditionRule extends RelationalFieldConditionRule
{
    use HasChangedOperator;
}
