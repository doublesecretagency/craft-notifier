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

use Craft;
use craft\elements\User;
use craft\mail\Message as Email;
use doublesecretagency\notifier\helpers\Log;
use doublesecretagency\notifier\helpers\Recipients;
use Throwable;
use yii\base\ErrorException;

/**
 * Email Message model
 * @since 1.0.0
 */
class EmailMessage extends BaseMessage
{

    /**
     * Send the email message to all recipients.
     *
     * @throws ErrorException|Throwable
     */
    public function send(): void
    {
        // Dynamically get all recipients (can be Users or email addresses)
        $recipients = $this->_getRecipients();

        // Loop over all recipients
        foreach ($recipients as $recipient) {

            // Append recipient data
            $this->_appendRecipientData($recipient);

            // Get and parse the subject
            $subject = ($this->_notification->messageConfig['subject'] ?? '');
            $subject = $this->_parseString($subject);

            // Parse the message body
            $body = $this->_parseMessageBody();

            // Get email address of recipient
            $to = (is_a($recipient, User::class) ? $recipient->email : $recipient);

            // Dispatch a single message
            $this->_dispatch($to, $subject, $body);

        }
    }

    // ========================================================================= //

    /**
     * Get message recipients.
     */
    private function _getRecipients(): array
    {
        // Get specified recipients
        $recipients = ($this->_notification['messageConfig']['recipients'] ?? null);

        // Switch according to recipient type
        switch ($recipients['type'] ?? false) {
            case 'all':
                return Recipients::all();
            case 'admins':
                return Recipients::admin();
            case 'in-group':
                $groups = ($recipients['groups'] ?? null);
                return Recipients::inGroup($groups);
            case 'specific-users':
//                return Recipients::specificUsers();
            case 'specific-emails':
//                return Recipients::specificEmails();
            case 'custom':
                return Recipients::custom($recipients, $this->_data);
        }

        // Something went wrong, fallback to empty array
        return [];
    }

    /**
     * Append data about the recipient.
     */
    private function _appendRecipientData(User|string $recipient): void
    {
        // If the recipient is a User element
        if (is_a($recipient, User::class)) {
            // Append data from User element
            $this->_data['toUser'] = $recipient;
            $this->_data['toEmail'] = $recipient->email;
        } else {
            // Append data from email string
            $this->_data['toUser'] = null;
            $this->_data['toEmail'] = $recipient;
        }
    }

    // ========================================================================= //

    /**
     * Send an individual email message.
     */
    private function _dispatch(string $to, string $subject, string $body): void
    {
        // Compile email
        $email = new Email();
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setHtmlBody($body);
        $email->setTextBody($body);

        // Send email
        $success = Craft::$app->getMailer()->send($email);

        // If unsuccessful, log error and bail
        if (!$success) {
            Log::warning("Unable to send the email using Craft's native email handling.");
            Log::error("Check your general email settings within Craft.");
            return;
        }

        // Log success message
        Log::success("The email to {$to} was sent successfully! ({$subject})");
    }

}
