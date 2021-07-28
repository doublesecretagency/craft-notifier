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

namespace doublesecretagency\notifier\models;

/**
 * Class Message
 * @since 1.0.0
 */
class Message extends BaseNotification
{

    /**
     * @var int ID of related Trigger.
     */
    public $triggerId;

    /**
     * @var string Type of message (Email, SMS, etc).
     */
    public $type;

    /**
     * @var string Template for rendering the message body.
     */
    public $template;

}
