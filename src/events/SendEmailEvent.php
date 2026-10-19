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

namespace doublesecretagency\notifier\events;

use craft\events\CancelableEvent;
use craft\mail\Message;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\models\OutboundEmail;

/**
 * Event triggered before and after an email is sent.
 *
 * @since 3.2.5
 */
class SendEmailEvent extends CancelableEvent
{

    /**
     * @var Message|null The email about to be sent (or just sent).
     */
    public ?Message $message = null;

    /**
     * @var Notification|null The notification sending the email.
     */
    public ?Notification $notification = null;

    /**
     * @var OutboundEmail|null The envelope holding the recipient, subject, and body.
     */
    public ?OutboundEmail $envelope = null;

    /**
     * @var bool|null Whether the email was sent successfully, set only after sending.
     */
    public ?bool $isSuccessful = null;

}
