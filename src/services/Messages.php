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

namespace doublesecretagency\notifier\services;

use Craft;
use craft\base\Component;
use craft\mail\Message as Email;
use craft\web\View;
use doublesecretagency\notifier\elements\Notification;
use yii\base\Event;
use yii\base\InvalidConfigException;

/**
 * Class Messages
 * @since 1.0.0
 */
class Messages extends Component
{

    /**
     * Send all Notifications activated by a single Event.
     *
     * @param array $notifications
     * @param Event $event
     * @return void
     */
    public function sendAll(array $notifications, Event $event): void
    {
        /** @var Notification $notification */
        foreach ($notifications as $notification) {
            // Send each individual Notification
            $this->send($notification, $event);
        }
    }

    /**
     * Send a message based on the Notification type.
     *
     * @param Notification $notification
     * @param Event $event
     * @return bool
     */
    public function send(Notification $notification, Event $event): bool
    {
        // Send message based on type
        switch ($notification->messageType) {
            case 'email':
                return $this->_sendViaEmail($notification, $event);
            case 'sms':
                return $this->_sendViaSms($notification, $event);
            case 'announcement':
                return $this->_sendViaAnnouncement($notification, $event);
            case 'flash':
                return $this->_sendViaFlash($notification, $event);
        }

        // Message wasn't sent, type not recognized
        return false;
    }

    // ========================================================================= //

    /**
     * Parse all Twig tags embedded within text.
     *
     * @param string $text
     * @param Notification $notification
     * @param Event $event
     * @return string
     */
    public function parseTwig(string $text, Notification $notification, Event $event): string
    {
        // Set all data to be parsed
        $data = [
            // Config Variables
            'recipient' => null,
            'activeUser' => null,
            'event' => $event,
            // Content Variables
            'original' => null,
            'entry' => $event->sender,
        ];

        // Get view services
        $view = Craft::$app->getView();

        // Parse short tags
        $text = $view->renderObjectTemplate($text, $event->sender, $data);

        // Return fully compiled message
        return $text;
    }

    // ========================================================================= //

    /**
     * Send the message as an email.
     *
     * @param Notification $notification
     * @param Event $event
     * @return bool
     */
    private function _sendViaEmail(Notification $notification, Event $event): bool
    {

        // EACH RECIPIENT MESSAGE
        // WILL BE DISPATCHED INDIVIDUALLY

        // TEMP
        $notification->useQueue = false;
        $to = getenv('TEST_EMAIL');
        // ENDTEMP


        // Parse message body and subject
        $body = $this->parseTwig($notification->messageBody, $notification, $event);
        $subject = $this->parseTwig($notification->messageConfig['emailSubject'] ?? null, $notification, $event);

        // Whether to dispatch via the queue, or immediately
        if ($notification->useQueue) {
            $success = $this->_dispatchViaQueue($to, $subject, $body);
        } else {
            $success = $this->_dispatchImmediately($to, $subject, $body);
        }

        // Return whether the notification was sent successfully
        return $success;
    }

    /**
     * Send the message as an SMS (Text Message).
     *
     * @param Notification $notification
     * @param Event $event
     * @return bool
     */
    private function _sendViaSms(Notification $notification, Event $event): bool
    {
        Craft::dd([
            'Method' => '_sendViaSms',
            'Notification' => $notification,
        ]);

        // Return whether the notification was sent successfully
        return true;
    }

    /**
     * Send the message as an Announcement.
     *
     * @param Notification $notification
     * @param Event $event
     * @return bool
     */
    private function _sendViaAnnouncement(Notification $notification, Event $event): bool
    {
        Craft::dd([
            'Method' => '_sendViaAnnouncement',
            'Notification' => $notification,
        ]);

        // Return whether the notification was sent successfully
        return true;
    }

    /**
     * Send the message as a Flash Message.
     *
     * @param Notification $notification
     * @param Event $event
     * @return bool
     */
    private function _sendViaFlash(Notification $notification, Event $event): bool
    {
        Craft::dd([
            'Method' => '_sendViaFlash',
            'Notification' => $notification,
        ]);

        // Return whether the notification was sent successfully
        return true;
    }

    // ========================================================================= //

    /**
     * Dispatch the message via the queue.
     */
    private function _dispatchViaQueue(string $to, string $subject, string $body): bool
    {
        // "Sending {messageType} to {recipient}..."

        // GOING INTO THE QUEUE

        return true;
    }

    /**
     * Dispatch the message immediately.
     */
    private function _dispatchImmediately(string $to, string $subject, string $body): bool
    {
        // BYPASSING THE QUEUE



        return $this->_dispatch($to, $subject, $body);

//        return true;
    }

    // ========================================================================= //

    /**
     * Send an individual email message.
     *
     * @param string $to
     * @param string $subject
     * @param string $body
     * @return bool
     * @throws InvalidConfigException
     */
    private function _dispatch(string $to, string $subject, string $body): bool
    {

        // COMING OUT OF THE QUEUE


        // HOORAY, IT WORKS!!
        Craft::dd([
            'to' => $to,
            'subject' => $subject,
            'body' => $body,
//            'success' => $success,
//            'error' => $email,
        ]);


        // Compile email
        $email = new Email();
        $email->setTo($to);
        $email->setSubject($subject);
        $email->setHtmlBody($body);
        $email->setTextBody($body);

        // Send email
        $success = Craft::$app->getMailer()->send($email);



        return $success;

//        // If unsuccessful, log error and bail
//        if (!$success) {
//            Log::warning("Unable to send the email using Craft's native email handling.");
//            Log::error("Check your general email settings within Craft.");
//            return;
//        }
//
//        // Log success message
//        Log::success("The email to {$to} was sent successfully! ({$subject})");
    }

}
