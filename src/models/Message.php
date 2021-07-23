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

use Craft;
use craft\mail\Message as Email;
use craft\web\View;
use Exception;

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

    // ========================================================================= //

    /**
     * Get an array of email addresses, based on the internal configuration.
     */
    public function getRecipients()
    {
        // Get recipients
        $recipients = ($this->config['recipients'] ?? []);

        // Switch according to recipient type
        switch ($recipients['type'] ?? false) {
            case 'all-users':
//                return $this->_getRecipientsAllUsers();
            case 'all-admins':
//                return $this->_getRecipientsAllAdmins();
            case 'all-users-in-group':
//                return $this->_getRecipientsAllUsersInGroup();
            case 'specific-users':
//                return $this->_getRecipientsSpecificUsers();
            case 'specific-emails':
//                return $this->_getRecipientsSpecificEmails();
            case 'custom':
//                return $this->_getRecipientsCustom($recipients);
        }
    }

    // ========================================================================= //

    /**
     * Send the message.
     */
    public function send($data = [])
    {
        switch ($this->type) {
            case 'email':
            default: // TEMP
                $this->_sendEmail($data);
        }
    }

    // ========================================================================= //

    /**
     * Send the message via email.
     */
    private function _sendEmail($data)
    {
        // Parse the message body and subject
        $body = $this->_getBody($data);
        $subject = $this->_getSubject($data);

        // If an error occurred while parsing the body, bail
        if (false === $body) {
            return;
        }

        // Compile email
        $email = new Email();
        $email->setTo('lindsey@doublesecretagency.com');
        $email->setSubject($subject);
        $email->setHtmlBody($body);
        $email->setTextBody($body);

        // Send email
        $success = Craft::$app->getMailer()->send($email);

        // If unsuccessful, log it
        if (!$success) {

            // Log failure to send

        }
    }

    // ========================================================================= //

    /**
     * Parse the message body.
     *
     * @return string|false Returns false if an error occurred.
     */
    private function _getBody($data)
    {
        // Get view services
        $view = Craft::$app->getView();

        // Attempt to render the Twig template
        try {

            // Render message body template
            $body = $view->renderTemplate($this->template, $data, View::TEMPLATE_MODE_SITE);

            // Return trimmed body text
            return trim($body);

        } catch (Exception $e) {

            // Log an error

            // Return an empty string
            return false;
        }
    }

    /**
     * Parse the message subject.
     */
    private function _getSubject($data): string
    {
        // Get view services
        $view = Craft::$app->getView();

        // Attempt to render the Twig template
        try {

            // Render message subject
            $subject = $view->renderString($this->subject, $data, View::TEMPLATE_MODE_SITE);

            // Return parsed subject
            return trim($subject);

        } catch (Exception $e) {

            // Log an error

            // Return unparsed subject
            return trim($this->subject);
        }
    }

}
