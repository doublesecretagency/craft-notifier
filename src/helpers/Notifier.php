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

use doublesecretagency\notifier\records\Message;
use doublesecretagency\notifier\records\Trigger;

/**
 * Class Notifier
 * @since 1.0.0
 */
class Notifier
{

    /**
     * Get all triggers.
     *
     * @return array
     */
    public static function getTriggers(): array
    {
        return Trigger::find()->all();
    }

    /**
     * Get specified trigger.
     *
     * @param int $triggerId
     * @return Trigger|null
     */
    public static function getTriggerById(int $triggerId)
    {
        return Trigger::findOne([
            'id' => $triggerId
        ]);
    }

    /**
     * Get specified trigger.
     *
     * @param string $type
     * @return array
     */
    public static function getTriggersByType(string $type): array
    {
        $records = Trigger::findAll([
            'event' => $type
        ]);

        $models = [];

        foreach ($records as $record) {

            // Get the record attributes
            $omitColumns = ['dateCreated','dateUpdated','uid'];
            $attr = $record->getAttributes(null, $omitColumns);

            // Return a Message model
            $models[] = new \doublesecretagency\notifier\models\Trigger($attr);

        }

        return $models;
    }

    // ========================================================================= //

    /**
     * Get specified message.
     *
     * @param int $messageId
     * @return Message|null
     */
    public static function getMessageById(int $messageId)
    {
        return Message::findOne([
            'id' => $messageId
        ]);
    }

}
