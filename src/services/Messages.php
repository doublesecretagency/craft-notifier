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

namespace doublesecretagency\notifier\services;

use Craft;
use craft\base\Component;
use craft\base\Element;
use craft\helpers\Queue;
use craft\helpers\StringHelper;
use craft\web\twig\Environment;
use craft\web\twig\Extension;
use craft\web\twig\GlobalsExtension;
use doublesecretagency\notifier\base\EnvelopeInterface;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\enums\TwigSandbox;
use doublesecretagency\notifier\jobs\SendMessage;
use doublesecretagency\notifier\models\OutboundAnnouncement;
use doublesecretagency\notifier\models\OutboundEmail;
use doublesecretagency\notifier\models\OutboundFlash;
use doublesecretagency\notifier\models\OutboundSms;
use doublesecretagency\notifier\models\Recipient;
use doublesecretagency\notifier\models\Settings;
use doublesecretagency\notifier\NotifierPlugin;
use doublesecretagency\notifier\web\twig\MessageExtension;
use Throwable;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Extension\StringLoaderExtension;
use Twig\Loader\FilesystemLoader;
use Twig\Sandbox\SecurityPolicy;
use Twig\Template as TwigTemplate;
use Twig\TemplateWrapper;
use yii\base\Arrayable;
use yii\base\Event;
use yii\base\Exception;
use yii\base\Model;

/**
 * Class Messages
 * @since 1.0.0
 */
class Messages extends Component
{

    /**
     * @var Environment|null
     */
    private ?Environment $_twigSandbox = null;

    /**
     * @var TemplateWrapper[]
     */
    private array $_objectTemplates = [];

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
            // If invalid envelope, skip it
            if (!$envelope) {
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

            // Attempt to parse message body and subject
            try {
                // Parse text
                $subject = $this->_parseTwig($config, $notification->messageConfig['emailSubject'] ?? null);
                $body    = $this->_parseTwig($config, $notification->messageConfig['emailMessage'] ?? null);
                // No parse error by default
                $parseError = null;
            } catch (Exception|Throwable $e) {
                // Unable to parse text
                $subject = ($notification->messageConfig['emailSubject'] ?? null);
                $body    = ($notification->messageConfig['emailMessage'] ?? null);
                // Get parse error
                $parseError = $e;
            }

            // Get message details
            $details = [
                'to' => $recipient->emailAddress,
                'subject' => $subject,
                'body' => $body,
            ];

            // Initialize logging for envelope
            $envelopeId = $notification->log->envelope($jobInfo, $details);

            // If a parsing error occurred, log and skip it
            if ($parseError) {
                $this->_logError($parseError, $notification, $envelopeId);
                continue;
            }

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

            // Attempt to parse message body
            try {
                // Parse text
                $message = $this->_parseTwig($config, $notification->messageConfig['smsMessage'] ?? null);
                // No parse error by default
                $parseError = null;
            } catch (Exception|Throwable $e) {
                // Unable to parse text
                $message = ($notification->messageConfig['smsMessage'] ?? null);
                // Get parse error
                $parseError = $e;
            }

            // Get message details
            $details = [
                'phoneNumber' => $recipient->phoneNumber,
                'message' => $message,
            ];

            // Initialize logging for envelope
            $envelopeId = $notification->log->envelope($jobInfo, $details);

            // If a parsing error occurred, log and skip it
            if ($parseError) {
                $this->_logError($parseError, $notification, $envelopeId);
                continue;
            }

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
     * @return EnvelopeInterface|null
     */
    private function _compileAnnouncement(Notification $notification, Event $event, array $data): ?EnvelopeInterface
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

        // Attempt to parse message body and title
        try {
            // Parse text
            $title   = $this->_parseTwig($config, $notification->messageConfig['announcementTitle'] ?? null);
            $message = $this->_parseTwig($config, $notification->messageConfig['announcementMessage'] ?? null);
            // No parse error by default
            $parseError = null;
        } catch (Exception|Throwable $e) {
            // Unable to parse text
            $title   = ($notification->messageConfig['announcementTitle'] ?? null);
            $message = ($notification->messageConfig['announcementMessage'] ?? null);
            // Get parse error
            $parseError = $e;
        }

        // Get message details
        $details = [
            'title' => $title,
            'message' => $message,
            'adminsOnly' => $adminsOnly,
        ];

        // Initialize logging for envelope
        $envelopeId = $notification->log->envelope($jobInfo, $details);

        // If a parsing error occurred, log and skip it
        if ($parseError) {
            $this->_logError($parseError, $notification, $envelopeId);
            return null;
        }

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
     * @return EnvelopeInterface|null
     */
    private function _compileFlash(Notification $notification, Event $event, array $data): ?EnvelopeInterface
    {
        // Compress variables for Twig
        $config = [
            'recipient' => null,
            'notification' => $notification,
            'event' => $event,
            'data' => $data,
        ];

        // Attempt to parse message body and title
        try {
            // Parse text
            $title   = $this->_parseTwig($config, $notification->messageConfig['flashTitle'] ?? null);
            $message = $this->_parseTwig($config, $notification->messageConfig['flashDetails'] ?? null);
            // No parse error by default
            $parseError = null;
        } catch (Exception|Throwable $e) {
            // Unable to parse text
            $title   = ($notification->messageConfig['flashTitle'] ?? null);
            $message = ($notification->messageConfig['flashDetails'] ?? null);
            // Get parse error
            $parseError = $e;
        }

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

        // If a parsing error occurred, log and skip it
        if ($parseError) {
            $this->_logError($parseError, $notification, $envelopeId);
            return null;
        }

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
     * @throws Exception
     * @throws Throwable
     */
    private function _parseTwig(array $config, string $text): string
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

        /** @var Settings $settings */
        $settings = NotifierPlugin::$plugin->getSettings();

        // If sandbox is explicitly disabled
        if (false === $settings->twigSandbox) {

            // Parse text via default Craft Twig environment
            $text = Craft::$app->getView()->renderObjectTemplate($text, $vars['object'], $vars);

        } else {

            // Parse text via secure Twig sandbox environment
            $text = $this->_renderObjectTemplate($text, $vars['object'], $vars);

        }

        // Return parsed text
        return $text;
    }

    /**
     * Log a parsing error.
     *
     * @param Exception|Throwable $e
     * @param Notification $notification
     * @param int $envelopeId
     * @return void
     */
    private function _logError(Exception|Throwable $e, Notification $notification, int $envelopeId): void
    {
        // If message was skipped intentionally
        if (is_a($e, RuntimeError::class)) {
            // Log a warning
            $message = $this->_cleanError("[SKIPPED] {$e->getMessage()}");
            $notification->log->warning($message, $envelopeId);
        } else {
            // Log an error
            $message = $this->_cleanError("[TWIG ERROR] {$e->getMessage()}");
            $notification->log->error($message, $envelopeId);
        }
    }

    /**
     * Clean an error message.
     *
     * @param string $text
     * @return string
     */
    private function _cleanError(string $text): string
    {
        // Replace string token with comprehensible name
        return preg_replace('/"__string_template__[a-z0-9]+"/', 'Twig snippet', $text);
    }

    // ========================================================================= //

    /**
     * Returns a sandboxed Twig environment.
     *
     * @return Environment
     * @throws Exception
     */
    private function _getTwig(): Environment
    {
        // If sandbox already exists, return it
        if ($this->_twigSandbox) {
            return $this->_twigSandbox;
        }

        /** @var Settings $settings */
        $settings = NotifierPlugin::$plugin->getSettings();

        // Get override configuration
        $sandbox = ($settings->twigSandbox ?? []);

        // Replace specified Twig allowances
        $tags       = ($sandbox['override']['tags']       ?? TwigSandbox::DEFAULT_TAGS);
        $filters    = ($sandbox['override']['filters']    ?? TwigSandbox::DEFAULT_FILTERS);
        $functions  = ($sandbox['override']['functions']  ?? TwigSandbox::DEFAULT_FUNCTIONS);
        $methods    = ($sandbox['override']['methods']    ?? TwigSandbox::DEFAULT_METHODS);
        $properties = ($sandbox['override']['properties'] ?? TwigSandbox::DEFAULT_PROPERTIES);

        // Append specified Twig allowances
        $tags       = array_merge($tags,       ($sandbox['allow']['tags']       ?? []));
        $filters    = array_merge($filters,    ($sandbox['allow']['filters']    ?? []));
        $functions  = array_merge($functions,  ($sandbox['allow']['functions']  ?? []));
        $methods    = array_merge($methods,    ($sandbox['allow']['methods']    ?? []));
        $properties = array_merge($properties, ($sandbox['allow']['properties'] ?? []));

        // Remove specified Twig allowances
        $tags       = array_diff($tags,       ($sandbox['disallow']['tags']       ?? []));
        $filters    = array_diff($filters,    ($sandbox['disallow']['filters']    ?? []));
        $functions  = array_diff($functions,  ($sandbox['disallow']['functions']  ?? []));
        $methods    = array_diff($methods,    ($sandbox['disallow']['methods']    ?? []));
        $properties = array_diff($properties, ($sandbox['disallow']['properties'] ?? []));

        // Create a new Twig environment
        $templatesPath = Craft::$app->getPath()->getSiteTemplatesPath();
        $loader = new FilesystemLoader($templatesPath);
        $this->_twigSandbox = new Environment($loader);
        $this->_twigSandbox->addExtension(new MessageExtension());

        // Add native Craft extensions
        $this->_twigSandbox->addExtension(new StringLoaderExtension());
        $this->_twigSandbox->addExtension(new Extension(Craft::$app->getView(), $this->_twigSandbox));
        $this->_twigSandbox->addExtension(new GlobalsExtension());

        // Add sandbox security policy
        $policy = new SecurityPolicy($tags, $filters, $methods, $properties, $functions);
        $sandbox = new SandboxExtension($policy, true);
        $this->_twigSandbox->addExtension($sandbox);

        // Return sandbox
        return $this->_twigSandbox;
    }

    /**
     * Renders an object template via the Twig sandbox.
     *
     * @param string $template the source template string
     * @param mixed $object the object that should be passed into the template
     * @param array $variables any additional variables that should be available to the template
     * @return string The rendered template.
     * @throws Throwable in case of failure
     */
    private function _renderObjectTemplate(string $template, mixed $object, array $variables = []): string
    {
        // If there are no dynamic tags, just return the template
        if (!str_contains($template, '{')) {
            return trim($template);
        }

        // Get sandboxed Twig environment
        $twig = $this->_getTwig();

        // Temporarily disable strict variables if it's enabled
        $strictVariables = $twig->isStrictVariables();

        // If strict variables, disable them
        if ($strictVariables) {
            $twig->disableStrictVariables();
        }

        // Set escaper strategy
        $twig->setDefaultEscaperStrategy(false);

        try {
            // Is this the first time we've parsed this template?
            $cacheKey = md5($template);
            if (!isset($this->_objectTemplates[$cacheKey])) {
                // Replace shortcut "{var}"s with "{{object.var}}"s, without affecting normal Twig tags
                $template = Craft::$app->getView()->normalizeObjectTemplate($template);
                $this->_objectTemplates[$cacheKey] = $twig->createTemplate($template);
            }

            // Get the variables to pass to the template
            if ($object instanceof Model) {
                foreach ($object->attributes() as $name) {
                    if (!isset($variables[$name]) && str_contains($template, $name)) {
                        $variables[$name] = $object->$name;
                    }
                }
            }

            // Get attributes of object to pass to the template
            if ($object instanceof Arrayable) {
                // See if we should be including any of the extra fields
                $extra = [];
                foreach ($object->extraFields() as $field => $definition) {
                    if (is_int($field)) {
                        $field = $definition;
                    }
                    if (preg_match('/\b' . preg_quote($field, '/') . '\b/', $template)) {
                        $extra[] = $field;
                    }
                }
                $variables += $object->toArray([], $extra, false);
            }

            // Compile variables
            $variables['object'] = $object;
            $variables['_variables'] = $variables;

            // Render it!
            /** @var TwigTemplate $templateObj */
            $templateObj = $this->_objectTemplates[$cacheKey];
            return trim($templateObj->render($variables));

        } finally {

            // Reset escaper strategy
            $twig->setDefaultEscaperStrategy();

            // Re-enable strict variables
            if ($strictVariables) {
                $twig->enableStrictVariables();
            }

        }
    }

}
