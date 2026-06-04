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

namespace doublesecretagency\notifier\conditions;

use craft\elements\conditions\entries\EntryCondition;

/**
 * Registration target that keeps Notifier's condition rules out of Craft's own entries filter.
 *
 * @since 3.0.0
 */
class NotifierEntryCondition extends EntryCondition
{
}
