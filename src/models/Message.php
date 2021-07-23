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
use craft\elements\User;
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
     * Send the message.
     */
    public function send(array $data = [])
    {
        switch ($this->type) {
            case 'email':
            default: // TEMP
                $this->_deliverViaEmail($data);
        }
    }

    // ========================================================================= //

    /**
     * Prep and send the message via email.
     *
     * @param array $data
     */
    private function _deliverViaEmail(array $data)
    {
        // Parse the message body and subject
        $body = $this->_getBody($data);
        $subject = $this->_getSubject($data);
        $recipients = $this->_getRecipients($data);

        // If an error occurred while parsing the body, bail
        if (false === $body) {
            return;
        }

        // If no recipients were specified, bail
        if (!$recipients) {
            return;
        }

        // Loop through all recipients
        foreach ($recipients as $to) {
            $this->_postEmailMessage($to, $subject, $body);
        }
    }

    /**
     * Send the actual email.
     *
     * @param $to
     * @param $subject
     * @param $body
     */
    private function _postEmailMessage($to, $subject, $body)
    {
        // Compile email
        $email = new Email();
        $email->setTo($to);
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
     * @param array $data
     * @return string|false Returns false if an error occurred.
     */
    private function _getBody(array $data)
    {
        // Get view services
        $view = Craft::$app->getView();

        // Get message body template
        $template = $this->template;

        // Parse the message body
        try {
            // Render message body template
            $body = $view->renderTemplate($template, $data, View::TEMPLATE_MODE_SITE);
        } catch (Exception $e) {
            // Log an error
            // Return false
            return false;
        }

        // Return body
        return trim($body);
    }

    /**
     * Parse the message subject.
     */
    private function _getSubject(array $data): string
    {
        // Get view services
        $view = Craft::$app->getView();

        // Get message subject template
        $template = ($this->config['subject'] ?? '');

        // Parse the message subject
        try {
            // Render message subject
            $subject = $view->renderString($template, $data, View::TEMPLATE_MODE_SITE);
        } catch (Exception $e) {
            // Log an error
            // Set subject to unparsed template
            $subject = $template;
        }

        // Return subject
        return trim($subject);
    }

    /**
     * Get an array of email addresses.
     */
    private function _getRecipients(array $data): array
    {
        // Get recipients
        $recipients = ($this->config['recipients'] ?? []);

        // Switch according to recipient type
        switch ($recipients['type'] ?? false) {
            case 'all-users':
                return $this->_getRecipientsAllUsers();
            case 'all-admins':
                return $this->_getRecipientsAllAdmins();
            case 'all-users-in-group':
//                return $this->_getRecipientsAllUsersInGroup();
            case 'specific-users':
//                return $this->_getRecipientsSpecificUsers();
            case 'specific-emails':
//                return $this->_getRecipientsSpecificEmails();
            case 'custom':
                return $this->_getRecipientsCustom($recipients, $data);
        }

        // Something went wrong, fallback to empty array
        return [];
    }

    /**
     * Get an array of email addresses based on a custom snippet.
     *
     * @return array
     */
    private function _getRecipientsCustom($recipients, array $data): array
    {
        // Switch according to recipient type
        switch ($recipients['custom']['type'] ?? false) {
            case 'users':
                $snippet = ($recipients['custom']['users'] ?? '');
                return $this->_parseUsersSnippet($snippet, $data);
            case 'emails':
                $snippet = ($recipients['custom']['emails'] ?? '');
                return $this->_parseEmailsSnippet($snippet, $data);
        }

        // Something went wrong, fallback to empty array
        return [];
    }

    // ========================================================================= //

    /**
     * Get an array of User email addresses.
     *
     * @return array
     */
    private function _getRecipientsAllUsers(): array
    {
        // Get all active Users
        $users = User::find()->all();

        // Return email addresses of those Users
        return $this->_userEmailAddresses($users);
    }

    /**
     * Get an array of Admin email addresses.
     *
     * @return array
     */
    private function _getRecipientsAllAdmins(): array
    {
        // Get all active admin Users
        $users = User::find()->admin()->all();

        // Return email addresses of those Users
        return $this->_userEmailAddresses($users);
    }

    // ========================================================================= //

    /**
     * Convert a collection of Users into email addresses.
     */
    private function _userEmailAddresses(array $users): array
    {
        // Initialize array of email addresses
        $emails = [];

        // Get email address of each User
        foreach ($users as $user) {
            $emails[] = $user->email;
        }

        // Return array of email addresses
        return $emails;
    }

    // ========================================================================= //

    /**
     * Use a custom snippet to get a collection of Users' email addresses.
     *
     * @param string $snippet
     * @return array
     */
    private function _parseUsersSnippet(string $snippet, array $data): array
    {
        // Get view services
        $view = Craft::$app->getView();

        // Parse the custom users snippet
        try {

            // Dynamically generated collection of User IDs
            $results = $view->renderString($snippet, $data);

            // If no IDs, bail
            if (!$results) {
                return [];
            }

            // Get array of User IDs
            $ids = $this->_jsonDecode($results);

            // Get all specified Users
            $users = User::find()
                ->id($ids)
                ->all();

            // Return email addresses of those Users
            return $this->_userEmailAddresses($users);

        } catch (Exception $e) {

            // Log an error

            // Return an empty array
            return [];
        }
    }

    /**
     * Use a custom snippet to get a collection of email addresses.
     *
     * @param string $snippet
     * @return array
     */
    private function _parseEmailsSnippet(string $snippet, array $data): array
    {
        // Get view services
        $view = Craft::$app->getView();

        // Parse the custom emails snippet
        try {

            // Dynamically generated collection of email addresses
            $results = $view->renderString($snippet, $data);

            // If no email addresses, bail
            if (!$results) {
                return [];
            }

            // Return array of email addresses
            return $this->_jsonDecode($results);

        } catch (Exception $e) {

            // Log an error

            // Return an empty array
            return [];
        }
    }

}
