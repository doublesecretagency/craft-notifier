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
        return static::_toModels($triggers, TriggerModel::class);
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
        return static::_toModels($records, TriggerModel::class);
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

        // Return a Trigger Model
        return static::_toModel($record, TriggerModel::class);
    }

    // ========================================================================= //

    /**
     * Get messages related to this trigger.
     *
     * @param TriggerModel
     * @return array
     */
    public static function getTriggerMessages(TriggerModel $trigger): array
    {
        // Get all Message Records for this trigger
        $records = MessageRecord::findAll([
            'triggerId' => $trigger->id
        ]);

        // Return all Message Models
        return static::_toModels($records, MessageModel::class);
    }

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

        // Return a Message Model
        return static::_toModel($record, MessageModel::class);
    }

    // ========================================================================= //

    /**
     * Convert an array of Trigger Records into Trigger Models
     *
     * @param TriggerRecord[]|MessageRecord[] $collection
     * @param string $modelType
     * @return TriggerModel[]|MessageModel[]
     */
    private static function _toModels(array $collection, string $modelType): array
    {
        // Convert each Record into a Model
        array_walk($collection, static function (&$value) use ($modelType) {
            $value = static::_toModel($value, $modelType);
        });

        // Return collection as Models
        return $collection;
    }

    /**
     * Convert a Record into its corresponding Model.
     *
     * @param TriggerRecord|MessageRecord $record
     * @param string $modelType
     * @return TriggerModel|MessageModel|null
     */
    private static function _toModel($record, string $modelType)
    {
        // If no matching trigger, bail
        if (!$record) {
            return null;
        }

        // Get all attributes of the Record
        $attr = $record->getAttributes();

        // Move config data to raw position
        $attr['configRaw'] = ($attr['config'] ?? '[]');
        unset($attr['config']);

        // Return as a Model (if a match is found)
        return ($record ? new $modelType($attr) : null);
    }

}
