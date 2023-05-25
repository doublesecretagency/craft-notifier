<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events get triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\elements\db;

use Craft;
use craft\elements\db\ElementQuery;

/**
 * Notification query
 * @since 1.0.0
 */
class NotificationQuery extends ElementQuery
{
    protected function beforePrepare(): bool
    {
        // todo: join the `notifications` table
        // $this->joinElementTable('notifications');

        // todo: apply any custom query params
        // ...

        return parent::beforePrepare();
    }
}
