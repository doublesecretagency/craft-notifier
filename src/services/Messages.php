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
use doublesecretagency\notifier\models\Recipient;
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
                // Use the queue if specified
                $useQueue = ($notification->messageConfig['emailQueue'] ?? true);
                // Compile one or more email
                $envelopes = $this->_compileEmail($notification, $event, $data);
                break;
            case 'sms':
                // Use the queue if specified
                $useQueue = ($notification->messageConfig['smsQueue'] ?? true);
                // Compile one or more SMS (text) messages
                $envelopes = $this->_compileSms($notification, $event, $data);
                break;
            case 'announcement':
                // Always use the queue
                $useQueue = true;
                // Compile a single announcement (in an array)
                $envelopes = [$this->_compileAnnouncement($notification, $event, $data)];
                break;
            case 'flash':
                // Never use the queue
                $useQueue = false;
                // Compile a single flash message (in an array)
                $envelopes = [$this->_compileFlash($notification, $event, $data)];
                break;
            default:
                // Message wasn't sent, type not recognized
                return;
        }

        // Loop through each envelope
        foreach ($envelopes as $envelope) {
            // If invalid envelope, log and skip it
            if (!$envelope) {
                // Log invalid envelope
                $notification->log->warning("Can't send, envelope is invalid.", $envelope->envelopeId);
                continue;
            }
            // If sending via the queue
            if ($useQueue) {
                // Add message to the queue
                $notification->log->info("Adding message to queue.", $envelope->envelopeId);
                Queue::push(new SendMessage(['envelope' => $envelope]));
            } else {
                // Send message immediately
                $notification->log->info("Sending message immediately (bypassing queue).", $envelope->envelopeId);
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
        $recipients = NotifierPlugin::getInstance()->recipients->getRecipients($notification);

        // Initialize outbound messages
        $outbound = [];

        // Set base configuration
        $baseConfig = [
            'notification' => $notification,
            'event' => $event,
            'data' => $data,
        ];

        // Get generic recipient name
        $genericRecipient = $notification->getTaskRecipient();

        // Loop through all recipients
        foreach ($recipients as $recipient) {

            // Set job info
            $jobInfo = [
                'messageType' => 'an email',
                'recipient' => ($recipient->name ?? $genericRecipient),
            ];

            // Compress variables for Twig
            $config = array_merge($baseConfig, [
                'recipient' => $recipient,
            ]);

            // Parse message body and subject
            $subject = $this->parseTwig($config, $notification->messageConfig['emailSubject'] ?? null);
            $body    = $this->parseTwig($config, $notification->messageConfig['emailMessage'] ?? null);

            // Get message details
            $details = [
                'to' => $recipient->emailAddress,
                'subject' => $subject,
                'body' => $body,
            ];

            // Initialize logging for envelope
            $envelopeId = $notification->log->envelope($jobInfo, $details);

            // Put outbound email into envelope
            $outbound[] = new OutboundEmail(array_merge([
                'notificationId' => $notification->id,
                'envelopeId' => $envelopeId,
                'jobInfo' => $jobInfo
            ], $details));

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
     * @return EnvelopeInterface[]
     */
    private function _compileSms(Notification $notification, Event $event, array $data): array
    {
        // Get email addresses for all recipients
        $recipients = NotifierPlugin::getInstance()->recipients->getRecipients($notification);

        // Initialize outbound messages
        $outbound = [];

        // Set base configuration
        $baseConfig = [
            'notification' => $notification,
            'event' => $event,
            'data' => $data,
        ];

        // Get generic recipient name
        $genericRecipient = $notification->getTaskRecipient();

        // Loop through all recipients
        foreach ($recipients as $recipient) {

            // Set job info
            $jobInfo = [
                'messageType' => 'an SMS message',
                'recipient' => ($recipient->name ?? $genericRecipient),
            ];

            // Compress variables for Twig
            $config = array_merge($baseConfig, [
                'recipient' => $recipient,
            ]);

            // Parse message body
            $message = $this->parseTwig($config, $notification->messageConfig['smsMessage'] ?? null);

            // Get message details
            $details = [
                'phoneNumber' => $recipient->phoneNumber,
                'message' => $message,
            ];

            // Initialize logging for envelope
            $envelopeId = $notification->log->envelope($jobInfo, $details);

            // Put outbound SMS (text) message into envelope
            $outbound[] = new OutboundSms(array_merge([
                'notificationId' => $notification->id,
                'envelopeId' => $envelopeId,
                'jobInfo' => $jobInfo
            ], $details));

        }

        // Return all outbound messages
        return $outbound;
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
        // Whether announcement is being sent only to Admins
        $adminsOnly = ($notification->recipientsConfig['adminsOnly'] ?? false);

        // Set job info
        $jobInfo = [
            'messageType' => 'an announcement',
            'recipient' => ($adminsOnly ? 'system Admins only' : 'all control panel users'),
        ];

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

        // Get message details
        $details = [
            'title' => $title,
            'message' => $message,
            'adminsOnly' => $adminsOnly,
        ];

        // Initialize logging for envelope
        $envelopeId = $notification->log->envelope($jobInfo, $details);

        // Put outbound announcement into envelope
        return new OutboundAnnouncement(array_merge([
            'notificationId' => $notification->id,
            'envelopeId' => $envelopeId,
            'jobInfo' => $jobInfo
        ], $details));
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

        // Get message details
        $details = [
            'type' => $type,
            'title' => $title,
            'message' => $message
        ];

        // Attempt to get the currently active user
        try {
            $currentUser = Craft::$app->getUser()->getIdentity();
        } catch (Throwable $e) {
            $currentUser = null;
        }

        // Initialize logging for envelope
        $envelopeId = $notification->log->envelope([
            'messageType' => 'a flash message',
            'recipient' => ($currentUser->name ?? 'the current user'),
        ], $details);

        // Put outbound flash message into envelope
        return new OutboundFlash(array_merge([
            'notificationId' => $notification->id,
            'envelopeId' => $envelopeId
        ], $details));
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

        /** @var Notification $notification */
        /** @var Event $event */
        /** @var array $data */
        /** @var Recipient $recipient */

        // Configure special variables
        $vars = [
            // Event Variables
            'event' => $event,
            'object' => $event->sender,
            // People Variables
            'recipient' => $recipient,
            // Element Variables
            'element' => null,
            'original' => ($data['original'] ?? null),
        ];

        // If object is an element
        if (is_a($vars['object'], Element::class)) {
            // Get the element
            $element = $vars['object'];
            // Get the element type in camelCase
            $type = StringHelper::camelCase($element::lowerDisplayName());
            // Set aliases for element
            $vars['element'] = $element;
            $vars[$type] = $element;
        }

        // Merge data with variables to be parsed
        $vars = array_merge($data, $vars);

        // Get view services
        $view = Craft::$app->getView();

        // Attempt to parse short tags
        try {
            // Get parsed string
            $text = $view->renderObjectTemplate($text, $vars['object'], $vars);
        } catch (Exception|Throwable $e) {
            // Get error message
            $text = "[UNABLE TO PARSE NOTIFICATION] {$e->getMessage()}";
        }

        // Return parsed text
        return $text;
    }

}
