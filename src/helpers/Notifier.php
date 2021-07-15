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
     * Get all messages related to specified trigger.
     *
     * @param int $triggerId
     * @return array
     */
    public static function getMessages(int $triggerId): array
    {
        return Message::findAll([
            'triggerId' => $triggerId
        ]);
    }

    // ========================================================================= //

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
