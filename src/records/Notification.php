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

namespace doublesecretagency\notifier\records;

use craft\db\ActiveRecord;
use craft\db\SoftDeleteTrait;

/**
 * Database record for a single notification.
 *
 * @since 1.0.0
 *
 * @property int $id
 * @property string $eventType
 * @property string $event
 * @property array $eventConfig
 * @property string $messageType
 * @property array $messageConfig
 * @property string $recipientsType
 * @property array $recipientsConfig
 * @property bool $queue
 */
class Notification extends ActiveRecord
{

    use SoftDeleteTrait;

    /**
     * @inheritdoc
     */
    public static function tableName(): string
    {
        return '{{%notifier_notifications}}';
    }

}
