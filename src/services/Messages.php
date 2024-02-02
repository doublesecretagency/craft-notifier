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
use doublesecretagency\notifier\NotifierPlugin;
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
     * @return void
     */
    public function send(Notification $notification, Event $event, array $data = []): void
    {
        // Send message based on type
        switch ($notification->messageType) {
            case 'email':
                // Compile one or more email
                $envelopes = $this->_compileEmail($notification, $event, $data);
                break;
            case 'sms':
                // Compile one or more SMS (text) messages
                $envelopes = $this->_compileSms($notification, $event, $data);
                break;
            case 'announcement':
                // Always use the queue
                $notification->useQueue = true;
                // Compile a single announcement (in an array)
                $envelopes = [$this->_compileAnnouncement($notification, $event, $data)];
                break;
            case 'flash':
                // Never use the queue
                $notification->useQueue = false;
                // Compile a single flash message (in an array)
                $envelopes = [$this->_compileFlash($notification, $event, $data)];
                break;
            default:
                // Message wasn't sent, type not recognized
                return;
        }

        // Loop through each envelope
        foreach ($envelopes as $envelope) {

            // If sending via the queue
            if ($notification->useQueue) {
                // Add message to the queue
                Queue::push(new SendMessage(['envelope' => $envelope]));
            } else {
                // Send the message immediately
                $envelope->send();
            }

        }

    }

    // ========================================================================= //

    /**
     * Compile the message as one or more emails.
     *
     * @param Notification $notification
     * @param Event $event
     * @param array $data
     * @return EnvelopeInterface[]
     */
    private function _compileEmail(Notification $notification, Event $event, array $data): array
    {
        // Get email addresses for all recipients
        $recipients = NotifierPlugin::getInstance()->recipients->getRecipients($notification->recipientsType, $notification);

        // Initialize outbound messages
        $outbound = [];

        // Set base configuration
        $baseConfig = [
            'notification' => $notification,
            'event' => $event,
            'data' => $data,
        ];

        // Loop through all recipients
        foreach ($recipients as $recipient) {

            // Compress variables for Twig
            $config = array_merge($baseConfig, [
                'recipient' => $recipient,
            ]);

            // Parse message body and subject
            $subject = $this->parseTwig($config, $notification->messageConfig['emailSubject'] ?? null);
            $body    = $this->parseTwig($config, $notification->messageConfig['emailMessage'] ?? null);

            // Put outbound email into envelope
            $outbound[] = new OutboundEmail([
                'to' => $recipient->emailAddress,
                'subject' => $subject,
                'body' => $body,
            ]);

        }

        // Return all outbound messages
        return $outbound;
    }

    /**
     * Compile the message as one or more SMS (Text Message).
     *
     * @param Notification $notification
     * @param Event $event
     * @param array $data
     * @return EnvelopeInterface
     */
    private function _compileSms(Notification $notification, Event $event, array $data): EnvelopeInterface
    {
        // Compress variables for Twig
        $config = [
            'recipient' => null,
            'notification' => $notification,
            'event' => $event,
            'data' => $data,
        ];

        // Parse message body
        $message = $this->parseTwig($config, $notification->messageConfig['smsMessage'] ?? null);

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
        // Compress variables for Twig
        $config = [
            'recipient' => null,
            'notification' => $notification,
            'event' => $event,
            'data' => $data,
        ];

        // Parse message body and title
        $title   = $this->parseTwig($config, $notification->messageConfig['announcementTitle'] ?? null);
        $message = $this->parseTwig($config, $notification->messageConfig['announcementMessage'] ?? null);

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
        // Compress variables for Twig
        $config = [
            'recipient' => null,
            'notification' => $notification,
            'event' => $event,
            'data' => $data,
        ];

        // Parse message body and title
        $title   = $this->parseTwig($config, $notification->messageConfig['flashTitle'] ?? null);
        $message = $this->parseTwig($config, $notification->messageConfig['flashDetails'] ?? null);

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
     * @param array $config
     * @param string $text
     * @return string
     */
    public function parseTwig(array $config, string $text): string
    {
        // Extract config variables
        extract($config);

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
