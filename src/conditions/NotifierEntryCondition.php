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

namespace doublesecretagency\notifier\conditions;

use craft\elements\conditions\entries\EntryCondition;

/**
 * Class NotifierEntryCondition
 * @since 3.0.0
 *
 * Empty subclass used as the registration target for Notifier-only condition
 * rules. Keeps plugin rules out of Craft's CP entries-index filter and any
 * other consumer of EntryCondition::class.
 */
class NotifierEntryCondition extends EntryCondition
{
}
