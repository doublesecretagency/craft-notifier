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

namespace doublesecretagency\notifier\records;

use Craft;
use craft\db\ActiveRecord;
use craft\db\SoftDeleteTrait;

/**
 * Notification record
 * @since 1.0.0
 */
class Notification extends ActiveRecord
{
    use SoftDeleteTrait;

    public static function tableName(): string
    {
        return '{{%notifier_notifications}}';
    }
}
