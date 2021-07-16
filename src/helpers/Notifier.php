<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Get notified when things happen.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\helpers;

use doublesecretagency\notifier\models\Message as MessageModel;
use doublesecretagency\notifier\models\Trigger as TriggerModel;
use doublesecretagency\notifier\records\Message as MessageRecord;
use doublesecretagency\notifier\records\Trigger as TriggerRecord;

/**
 * Class Notifier
 * @since 1.0.0
 */
class Notifier
{

    /**
     * Get all triggers.
     *
     * @return TriggerModel[]
     */
    public static function getTriggers(): array
    {
        // Get all Trigger Records
        $triggers = TriggerRecord::find()->all();

        // Return results as Models
        return static::_toTriggerModels($triggers);
    }

    /**
     * Get all triggers of a specified type.
     *
     * @param string $type
     * @return TriggerModel[]
     */
    public static function getTriggersByType(string $type): array
    {
        // Get all Trigger Records of specified type
        $records = TriggerRecord::findAll([
            'event' => $type
        ]);

        // Return results as Models
        return static::_toTriggerModels($records);
    }

    /**
     * Get trigger with specified ID.
     *
     * @param int $triggerId
     * @return TriggerModel|null
     */
    public static function getTriggerById(int $triggerId)
    {
        // Get matching Trigger Record
        $record = TriggerRecord::findOne([
            'id' => $triggerId
        ]);

        // Return as a Model (if a match is found)
        return ($record ? new TriggerModel($record->getAttributes()) : null);
    }

    // ========================================================================= //

    /**
     * Get message with specified ID.
     *
     * @param int $messageId
     * @return MessageModel|null
     */
    public static function getMessageById(int $messageId)
    {
        // Get matching Message Record
        $record = MessageRecord::findOne([
            'id' => $messageId
        ]);

        // Return as a Model (if a match is found)
        return ($record ? new MessageModel($record->getAttributes()) : null);
    }

    // ========================================================================= //

    /**
     * Convert an array of Trigger Records into Trigger Models
     *
     * @param array $collection
     * @return TriggerModel[]
     */
    private static function _toTriggerModels(array $collection): array
    {
        // Convert each Record into a Model
        array_walk($collection, static function (&$value) {
            $value = new TriggerModel($value->getAttributes());
        });

        // Return collection as Models
        return $collection;
    }

}
