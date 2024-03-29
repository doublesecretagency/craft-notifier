<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events are triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\records;

use craft\db\ActiveRecord;
use craft\db\SoftDeleteTrait;

/**
 * Notification record
 * @since 1.0.0
 *
 * @property int $id
 * @property string $description
 * @property string $eventType
 * @property string $event
 * @property array $eventConfig
 * @property string $messageType
 * @property array $messageConfig
 * @property string $recipientsType
 * @property array $recipientsConfig
 */
class Notification extends ActiveRecord
{
    use SoftDeleteTrait;

    public static function tableName(): string
    {
        return '{{%notifier_notifications}}';
    }
}
