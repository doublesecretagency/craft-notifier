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
use doublesecretagency\notifier\models\OutboundAnnouncement;
use doublesecretagency\notifier\models\OutboundEmail;
use doublesecretagency\notifier\models\OutboundFlash;
use doublesecretagency\notifier\models\OutboundSms;
use Throwable;
use yii\base\Event;
use yii\base\Exception;

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
                // Compile an email
                $envelope = $this->_compileEmail($notification, $event);
                break;
            case 'sms':
                // Compile an SMS (text) message
                $envelope = $this->_compileSms($notification, $event);
                break;
            case 'announcement':
                // Always use the queue
                $notification->useQueue = true;
                // Compile an announcement
                $envelope = $this->_compileAnnouncement($notification, $event);
                break;
            case 'flash':
                // Never use the queue
                $notification->useQueue = false;
                // Compile a flash message
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
        $body    = $this->parseTwig($notification, $event, $notification->messageBody);
        $subject = $this->parseTwig($notification, $event, $notification->messageConfig['emailSubject'] ?? null);

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
     * @return EnvelopeInterface
     */
    private function _compileSms(Notification $notification, Event $event): EnvelopeInterface
    {
        // Parse message body
        $message = $this->parseTwig($notification, $event, $notification->messageBody);

        // Put outbound SMS (text) message into envelope
        return new OutboundSms([
//            'to' => $to,
            'message' => $message,
        ]);
    }

    /**
     * Compile the message as an Announcement.
     *
     * @param Notification $notification
     * @param Event $event
     * @return EnvelopeInterface
     */
    private function _compileAnnouncement(Notification $notification, Event $event): EnvelopeInterface
    {
        // Parse message body and title
        $message = $this->parseTwig($notification, $event, $notification->messageBody);
        $title   = $this->parseTwig($notification, $event, $notification->messageConfig['announcementTitle'] ?? null);

        // Put outbound announcement into envelope
        return new OutboundAnnouncement([
//            'to' => $to,
            'title' => $title,
            'message' => $message,
        ]);
    }

    /**
     * Compile the message as a Flash Message.
     *
     * @param Notification $notification
     * @param Event $event
     * @return EnvelopeInterface
     */
    private function _compileFlash(Notification $notification, Event $event): EnvelopeInterface
    {
        // Parse message body
        $message = $this->parseTwig($notification, $event, $notification->messageBody);

        // Get flash type
        $type = ($notification->messageConfig['flashType'] ?? 'notice');

        // Put outbound flash message into envelope
        return new OutboundFlash([
//            'to' => $to,
            'type' => $type,
            'message' => $message,
        ]);
    }

    // ========================================================================= //

    /**
     * Parse all Twig tags embedded within text.
     *
     * @param Notification $notification
     * @param Event $event
     * @param string $text
     * @return string
     */
    public function parseTwig(Notification $notification, Event $event, string $text): string
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

        // Attempt to parse short tags
        try {
            // Get parsed string
            $text = $view->renderObjectTemplate($text, $event->sender, $data);
        } catch (Exception|Throwable $e) {
            // Get unparsed string
            $text = "PARSE ERROR: {$text}";
        }

        // Return parsed text
        return $text;
    }

}
