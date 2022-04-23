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

namespace doublesecretagency\notifier\models;

/**
 * Class Message
 * @since 1.0.0
 */
class Message extends BaseNotification
{

    /**
     * @var int|null ID of related Trigger.
     */
    public ?int $triggerId = null;

    /**
     * @var string|null Type of message (Email, SMS, etc).
     */
    public ?string $type = null;

    /**
     * @var string|null Template for rendering the message body.
     */
    public ?string $template = null;

}
