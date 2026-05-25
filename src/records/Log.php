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

namespace doublesecretagency\notifier\records;

use craft\db\ActiveRecord;
use DateTime;

/**
 * Log record
 * @since 1.0.0
 *
 * @property int $id
 * @property int $notificationId
 * @property int $envelopeId
 * @property string $type
 * @property string $message
 * @property string $details
 * @property DateTime $dateCreated
 */
class Log extends ActiveRecord
{

    public static function tableName(): string
    {
        return '{{%notifier_log}}';
    }

}
