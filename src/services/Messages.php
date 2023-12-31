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
use craft\base\Element;
use craft\helpers\Queue;
use craft\helpers\StringHelper;
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
     * @param array $data
     * @return void
     */
    public function sendAll(array $notifications, Event $event, array $data = []): void
    {
        /** @var Notification $notification */
        foreach ($notifications as $notification) {
            // Send each individual Notification
            $this->send($notification, $event, $data);
        }
    }

    /**
     * Send a message based on the Notification type.
     *
     * @param Notification $notification
     * @param Event $event
     * @param array $data
     * @return bool
     */
    public function send(Notification $notification, Event $event, array $data = []): bool
    {
        // Send message based on type
        switch ($notification->messageType) {
            case 'email':
                // Compile an email
                $envelope = $this->_compileEmail($notification, $event, $data);
                break;
            case 'sms':
                // Compile an SMS (text) message
                $envelope = $this->_compileSms($notification, $event, $data);
                break;
            case 'announcement':
                // Always use the queue
                $notification->useQueue = true;
                // Compile an announcement
                $envelope = $this->_compileAnnouncement($notification, $event, $data);
                break;
            case 'flash':
                // Never use the queue
                $notification->useQueue = false;
                // Compile a flash message
                $envelope = $this->_compileFlash($notification, $event, $data);
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
     * @param array $data
     * @return EnvelopeInterface
     */
    private function _compileEmail(Notification $notification, Event $event, array $data): EnvelopeInterface
    {
        // EACH RECIPIENT MESSAGE
        // WILL BE DISPATCHED INDIVIDUALLY

        // TEMP
        $to = getenv('TEST_EMAIL');
        // ENDTEMP



        // Parse message body and subject
        $body    = $this->parseTwig($notification, $event, $data, $notification->messageBody);
        $subject = $this->parseTwig($notification, $event, $data, $notification->messageConfig['emailSubject'] ?? null);

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
     * @param array $data
     * @return EnvelopeInterface
     */
    private function _compileSms(Notification $notification, Event $event, array $data): EnvelopeInterface
    {
        // Parse message body
        $message = $this->parseTwig($notification, $event, $data, $notification->messageBody);

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
     * @param array $data
     * @return EnvelopeInterface
     */
    private function _compileAnnouncement(Notification $notification, Event $event, array $data): EnvelopeInterface
    {
        // Parse message body and title
        $message = $this->parseTwig($notification, $event, $data, $notification->messageBody);
        $title   = $this->parseTwig($notification, $event, $data, $notification->messageConfig['announcementTitle'] ?? null);

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
     * @param array $data
     * @return EnvelopeInterface
     */
    private function _compileFlash(Notification $notification, Event $event, array $data): EnvelopeInterface
    {
        // Parse message body and title
        $message = $this->parseTwig($notification, $event, $data, $notification->messageBody);
        $title   = $this->parseTwig($notification, $event, $data, $notification->messageConfig['flashTitle'] ?? null);

        // Get flash type
        $type = ($notification->messageConfig['flashType'] ?? 'notice');

        // Put outbound flash message into envelope
        return new OutboundFlash([
//            'to' => $to,
            'type' => $type,
            'title' => $title,
            'message' => $message,
        ]);
    }

    // ========================================================================= //

    /**
     * Parse all Twig tags embedded within text.
     *
     * @param Notification $notification
     * @param Event $event
     * @param array $data
     * @param string $text
     * @return string
     */
    public function parseTwig(Notification $notification, Event $event, array $data, string $text): string
    {
        // Configure common data
        $commonData = [
            // Config Variables
            'recipient' => null,
            'activeUser' => null,
            'event' => $event,
            // Content Variables
            'original' => null,
            'object' => $event->sender,
        ];

        // Merge all data to be parsed
        $data = array_merge($commonData, $data);

        // If data object is an element
        if (is_a($data['object'], Element::class)) {
            // Get the element
            $element = $data['object'];
            // Get the element type in camelCase
            $type = StringHelper::camelCase($element::lowerDisplayName());
            // Dynamically set the element variable by its type
            $data[$type] = $element;
        }

        // Get view services
        $view = Craft::$app->getView();

        // Attempt to parse short tags
        try {
            // Get parsed string
            $text = $view->renderObjectTemplate($text, $data['object'], $data);
        } catch (Exception|Throwable $e) {
            // Get unparsed string
            $text = "PARSE ERROR: {$text}";
        }

        // Return parsed text
        return $text;
    }

}
