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

use craft\fields\conditions\LinkFieldConditionRule;
use doublesecretagency\notifier\conditions\operators\HasChangedOperator;

/**
 * Class NotifierLinkFieldConditionRule
 * @since 3.0.0
 *
 * Notifier-scoped subclass that adds `has changed` to the operator dropdown
 * for Link field rules (also covers the deprecated Url alias).
 */
class NotifierLinkFieldConditionRule extends LinkFieldConditionRule
{
    use HasChangedOperator;
}
