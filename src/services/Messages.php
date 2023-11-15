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
use craft\helpers\Queue;
use doublesecretagency\notifier\base\EnvelopeInterface;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\jobs\SendMessage;
use doublesecretagency\notifier\models\OutboundEmail;
use yii\base\Event;

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
                $envelope = $this->_compileEmail($notification, $event);
                break;
            case 'sms':
                $envelope = $this->_compileSms($notification, $event);
                break;
            case 'announcement':
                $envelope = $this->_compileAnnouncement($notification, $event);
                break;
            case 'flash':
                $envelope = $this->_compileFlash($notification, $event);
                break;
            default:
                // Message wasn't sent, type not recognized
                return false;
        }

        // If sending via the queue
        if ($notification->useQueue) {
            // Add message to the queue
            Queue::push(new SendMessage(['envelope' => $envelope]));
            // Successful enough
            $success = true;
        } else {
            // Attempt to send the message immediately
            $success = $envelope->send();
        }

        // Return whether the notification was sent successfully
        return $success;
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
     * Compile the message as an email.
     *
     * @param Notification $notification
     * @param Event $event
     * @return EnvelopeInterface
     */
    private function _compileEmail(Notification $notification, Event $event): EnvelopeInterface
    {
        // EACH RECIPIENT MESSAGE
        // WILL BE DISPATCHED INDIVIDUALLY

        // TEMP
        $to = getenv('TEST_EMAIL');
        // ENDTEMP

        // Parse message body and subject
        $body = $this->parseTwig($notification->messageBody, $notification, $event);
        $subject = $this->parseTwig($notification->messageConfig['emailSubject'] ?? null, $notification, $event);

        // Put outbound email into envelope
        return new OutboundEmail([
            'to' => $to,
            'subject' => $subject,
            'body' => $body,
        ]);
    }

    /**
     * Compile the message as an SMS (Text Message).
     *
     * @param Notification $notification
     * @param Event $event
     * @return bool
     */
    private function _compileSms(Notification $notification, Event $event): bool
    {
        Craft::dd([
            'Method' => '_compileSms',
            'Notification' => $notification,
        ]);

        // Return whether the notification was sent successfully
        return true;
    }

    /**
     * Compile the message as an Announcement.
     *
     * @param Notification $notification
     * @param Event $event
     * @return bool
     */
    private function _compileAnnouncement(Notification $notification, Event $event): bool
    {
        Craft::dd([
            'Method' => '_compileAnnouncement',
            'Notification' => $notification,
        ]);

        // Return whether the notification was sent successfully
        return true;
    }

    /**
     * Compile the message as a Flash Message.
     *
     * @param Notification $notification
     * @param Event $event
     * @return bool
     */
    private function _compileFlash(Notification $notification, Event $event): bool
    {
        Craft::dd([
            'Method' => '_compileFlash',
            'Notification' => $notification,
        ]);

        // Return whether the notification was sent successfully
        return true;
    }

}
