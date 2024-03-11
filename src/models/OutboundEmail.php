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

namespace doublesecretagency\notifier\models;

use Craft;
use craft\mail\Message as Email;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\Notifier;
use yii\base\InvalidConfigException;

/**
 * Class OutboundEmail
 * @since 1.0.0
 */
class OutboundEmail extends BaseEnvelope
{

    /**
     * @var string|null
     */
    public ?string $to = null;

    /**
     * @var string
     */
    public string $subject = '';

    /**
     * @var string
     */
    public string $body = '';

    /**
     * Send the email message.
     *
     * @return bool
     * @throws InvalidConfigException
     */
    public function send(): bool
    {
        // Get original notification
        /** @var Notification $notification */
        $notification = Notifier::getNotification($this->notificationId);

        // If invalid notification, bail (unable to log)
        if (!$notification) {
            return false;
        }

        // If no recipient specified, log warning and bail
        if (!$this->to) {
            $notification->log->error("Unable to send email, no recipient specified.", $this->envelopeId);
            return false;
        }

        // Compile email
        $email = new Email();
        $email->setTo($this->to);
        $email->setSubject($this->subject);
        $email->setHtmlBody($this->body);
        $email->setTextBody($this->body);

        // Send email
        $success = Craft::$app->getMailer()->send($email);

        // If unsuccessful, log error and bail
        if (!$success) {
            $notification->log->warning("Unable to send the email using Craft's native email handling.", $this->envelopeId);
            $notification->log->error("Check your general email settings within Craft.", $this->envelopeId);
            return false;
        }

        // Log success message
        $notification->log->success("Successfully sent email message!", $this->envelopeId);

        // Return whether message was sent successfully
        return $success;
    }

}
