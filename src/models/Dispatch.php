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

namespace doublesecretagency\notifier\models;

use Craft;
use craft\base\Element;
use craft\base\Model;
use craft\helpers\Queue;
use craft\helpers\StringHelper;
use craft\web\twig\Environment;
use craft\web\twig\Extension;
use craft\web\twig\GlobalsExtension;
use craft\web\View;
use doublesecretagency\notifier\base\EnvelopeInterface;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\enums\TwigSandbox;
use doublesecretagency\notifier\filters\FilterInterface;
use doublesecretagency\notifier\jobs\SendMessage;
use doublesecretagency\notifier\NotifierPlugin;
use ReflectionClass;
use ReflectionException;
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

/**
 * Class Dispatch
 * @since 1.1.0
 */
class Dispatch extends Model
{

    /**
     * @var Notification|null Notification which originated the message.
     */
    public ?Notification $notification = null;

    /**
     * @var Event|null Event which triggered the notification.
     */
    public ?Event $event = null;

    /**
     * @var array Data to use when configuring the message.
     */
    public array $data = [];

    /**
     * @var bool Whether to send message via the queue.
     */
    public bool $useQueue = true;

    /**
     * @var array Set of outbound envelopes.
     */
    public array $envelopes = [];

    /**
     * @var Environment|null Secure Twig sandbox environment.
     */
    private ?Environment $_twigSandbox = null;

    /**
     * @var TemplateWrapper[]
     */
    private array $_objectTemplates = [];

    // ========================================================================= //

    /**
     * Filter whether this event should trigger the notification.
     *
     * @return bool
     */
    public function filterByEventType(): bool
    {
        // Filter further by event type
        switch ($this->notification->eventType) {
            case 'entries':
                // Check entries filters
                return $this->_filterEntries();
            case 'users':
            case 'assets':
                // No further filters
                return true;
        }

        // Invalid event type
        return false;
    }

    /**
     * Additional filters for entry events.
     *
     * @return bool
     */
    private function _filterEntries(): bool
    {
        // Get event config details
        $sections   = ($this->notification->eventConfig['sections']   ?? []);
        $entryTypes = ($this->notification->eventConfig['entryTypes'] ?? []);
        $filters    = ($this->notification->eventConfig['filters']    ?? []);

        // Get event element
        $element = $this->event->sender;

        // If not in a valid Section, return false
        if (!in_array($element->sectionId, $sections, false)) {
            return false;
        }

        // If not a valid Entry Type, return false
        if (!in_array($element->typeId, $entryTypes, false)) {
            return false;
        }

        // Loop through all filters
        foreach ($filters as $filterClass => $filterValue) {
            /** @var string|FilterInterface $filterClass */

            // If class doesn't exist, skip filter
            if (!class_exists($filterClass)) {
                continue;
            }

            // If check is not enabled, skip filter
            if (!$filterValue) {
                continue;
            }

            // Convert filter value to boolean
            $value = ('yes' === $filterValue);

            // Whether element matches filter configuration
            $match = $filterClass::check($this->event, $value);

            // Filter condition is invalid
            if (!$match) {
                return false;
            }

        }

        // All filters are valid
        return true;
    }

    // ========================================================================= //

    /**
     * Configure the outbound message based on the message type.
     *
     * @return void
     */
    public function configureByMessageType(): void
    {
        // Configure message based on type
        switch ($this->notification->messageType) {
            case 'email':
                $this->useQueue = ($this->notification->messageConfig['emailQueue'] ?? true);
                $this->envelopes = $this->_compileEmail();
                break;
            case 'sms':
                $this->useQueue = ($this->notification->messageConfig['smsQueue'] ?? true);
                $this->envelopes = $this->_compileSms();
                break;
            case 'announcement':
                $this->useQueue = true;
                $this->envelopes = [$this->_compileAnnouncement()];
                break;
            case 'flash':
                $this->useQueue = false;
                $this->envelopes = [$this->_compileFlash()];
                break;
        }
    }

    // ========================================================================= //

    /**
     * Compile the message as one or more emails.
     *
     * @return EnvelopeInterface[]
     */
    private function _compileEmail(): array
    {
        // Get email addresses for all recipients
        $recipients = NotifierPlugin::getInstance()->recipients->getRecipients($this->notification);

        // Initialize outbound messages
        $outbound = [];

        // Set base configuration
        $baseConfig = [
            'notification' => $this->notification,
            'event' => $this->event,
            'data' => $this->data,
        ];

        // Get generic recipient name
        $genericRecipient = $this->notification->getTaskRecipient();

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
                $subject = $this->_parseTwig($config, $this->notification->messageConfig['emailSubject'] ?? null);
                $body    = $this->_parseTwig($config, $this->notification->messageConfig['emailMessage'] ?? null);
                // No parse error by default
                $parseError = null;
            } catch (Exception|Throwable $e) {
                // Unable to parse text
                $subject = ($this->notification->messageConfig['emailSubject'] ?? null);
                $body    = ($this->notification->messageConfig['emailMessage'] ?? null);
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
            $envelopeId = $this->notification->log->envelope($jobInfo, $details);

            // If a parsing error occurred, log and skip it
            if ($parseError) {
                $this->_logError($parseError, $envelopeId);
                continue;
            }

            // Put outbound email into envelope
            $outbound[] = new OutboundEmail(array_merge([
                'notificationId' => $this->notification->id,
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
     * @return EnvelopeInterface[]
     */
    private function _compileSms(): array
    {
        // Get email addresses for all recipients
        $recipients = NotifierPlugin::getInstance()->recipients->getRecipients($this->notification);

        // Initialize outbound messages
        $outbound = [];

        // Set base configuration
        $baseConfig = [
            'notification' => $this->notification,
            'event' => $this->event,
            'data' => $this->data,
        ];

        // Get generic recipient name
        $genericRecipient = $this->notification->getTaskRecipient();

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
                $message = $this->_parseTwig($config, $this->notification->messageConfig['smsMessage'] ?? null);
                // No parse error by default
                $parseError = null;
            } catch (Exception|Throwable $e) {
                // Unable to parse text
                $message = ($this->notification->messageConfig['smsMessage'] ?? null);
                // Get parse error
                $parseError = $e;
            }

            // Get message details
            $details = [
                'phoneNumber' => $recipient->phoneNumber,
                'message' => $message,
            ];

            // Initialize logging for envelope
            $envelopeId = $this->notification->log->envelope($jobInfo, $details);

            // If a parsing error occurred, log and skip it
            if ($parseError) {
                $this->_logError($parseError, $envelopeId);
                continue;
            }

            // Put outbound SMS (text) message into envelope
            $outbound[] = new OutboundSms(array_merge([
                'notificationId' => $this->notification->id,
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
     * @return EnvelopeInterface|null
     */
    private function _compileAnnouncement(): ?EnvelopeInterface
    {
        // Whether announcement is being sent only to Admins
        $adminsOnly = ($this->notification->recipientsConfig['adminsOnly'] ?? false);

        // Set job info
        $jobInfo = [
            'messageType' => 'an announcement',
            'recipient' => ($adminsOnly ? 'system Admins only' : 'all control panel users'),
        ];

        // Compress variables for Twig
        $config = [
            'recipient' => null,
            'notification' => $this->notification,
            'event' => $this->event,
            'data' => $this->data,
        ];

        // Attempt to parse message body and title
        try {
            // Parse text
            $title   = $this->_parseTwig($config, $this->notification->messageConfig['announcementTitle'] ?? null);
            $message = $this->_parseTwig($config, $this->notification->messageConfig['announcementMessage'] ?? null);
            // No parse error by default
            $parseError = null;
        } catch (Exception|Throwable $e) {
            // Unable to parse text
            $title   = ($this->notification->messageConfig['announcementTitle'] ?? null);
            $message = ($this->notification->messageConfig['announcementMessage'] ?? null);
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
        $envelopeId = $this->notification->log->envelope($jobInfo, $details);

        // If a parsing error occurred, log and skip it
        if ($parseError) {
            $this->_logError($parseError, $envelopeId);
            return null;
        }

        // Put outbound announcement into envelope
        return new OutboundAnnouncement(array_merge([
            'notificationId' => $this->notification->id,
            'envelopeId' => $envelopeId,
            'jobInfo' => $jobInfo
        ], $details));
    }

    /**
     * Compile the message as a Flash Message.
     *
     * @return EnvelopeInterface|null
     */
    private function _compileFlash(): ?EnvelopeInterface
    {
        // Compress variables for Twig
        $config = [
            'recipient' => null,
            'notification' => $this->notification,
            'event' => $this->event,
            'data' => $this->data,
        ];

        // Attempt to parse message body and title
        try {
            // Parse text
            $title   = $this->_parseTwig($config, $this->notification->messageConfig['flashTitle'] ?? null);
            $message = $this->_parseTwig($config, $this->notification->messageConfig['flashDetails'] ?? null);
            // No parse error by default
            $parseError = null;
        } catch (Exception|Throwable $e) {
            // Unable to parse text
            $title   = ($this->notification->messageConfig['flashTitle'] ?? null);
            $message = ($this->notification->messageConfig['flashDetails'] ?? null);
            // Get parse error
            $parseError = $e;
        }

        // Get flash type
        $type = ($this->notification->messageConfig['flashType'] ?? 'notice');

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
        $envelopeId = $this->notification->log->envelope([
            'messageType' => 'a flash message',
            'recipient' => ($currentUser->name ?? 'the current user'),
        ], $details);

        // If a parsing error occurred, log and skip it
        if ($parseError) {
            $this->_logError($parseError, $envelopeId);
            return null;
        }

        // Put outbound flash message into envelope
        return new OutboundFlash(array_merge([
            'notificationId' => $this->notification->id,
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

        /** @var Recipient $recipient */

        // Configure special variables
        $vars = [
            // Event Variables
            'event' => $this->event,
            'object' => $this->event->sender,
            // People Variables
            'recipient' => $recipient,
            // Element Variables
            'element' => null,
            'original' => ($this->data['original'] ?? null),
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
        $vars = array_merge($this->data, $vars);

        // Return parsed text
        return $this->_renderObjectTemplate($text, $vars['object'], $vars);
    }

    /**
     * Log a parsing error.
     *
     * @param Exception|Throwable $e
     * @param int $envelopeId
     * @return void
     */
    private function _logError(Exception|Throwable $e, int $envelopeId): void
    {
        // If message was skipped intentionally
        if (is_a($e, RuntimeError::class)) {
            // Log a warning
            $message = $this->_cleanError("[SKIPPED] {$e->getMessage()}");
            $this->notification->log->warning($message, $envelopeId);
        } else {
            // Log an error
            $message = $this->_cleanError("[TWIG ERROR] {$e->getMessage()}");
            $this->notification->log->error($message, $envelopeId);
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

        /** @var View $view */
        $view = Craft::$app->getView();

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

        // Add native Craft extensions
        $this->_twigSandbox->addExtension(new StringLoaderExtension());
        $this->_twigSandbox->addExtension(new Extension($view, $this->_twigSandbox));
        $this->_twigSandbox->addExtension(new GlobalsExtension());

        // Add sandbox security policy
        $policy = new SecurityPolicy($tags, $filters, $methods, $properties, $functions);
        $sandbox = new SandboxExtension($policy, true);
        $this->_twigSandbox->addExtension($sandbox);

        // Access any plugin-defined extensions (via a private property)
        $reflection = new ReflectionClass($view);
        $property = $reflection->getProperty('_twigExtensions');
        $property->setAccessible(true);
        $pluginExtensions = $property->getValue($view);

        // Add all extensions defined by plugins or modules
        foreach ($pluginExtensions as $pluginExtension) {
            $this->_twigSandbox->addExtension($pluginExtension);
        }

        // If the Closure module is installed
        if (Craft::$app->hasModule('closure')) {
            // Add it to the sandbox
            \nystudio107\closure\Closure::getInstance()?->addClosure($this->_twigSandbox);
        }

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
        /** @var Settings $settings */
        $settings = NotifierPlugin::$plugin->getSettings();

        /** @var View $view */
        $view = Craft::$app->getView();

        // Ensure template is in "site" mode
        $view->setTemplateMode(View::TEMPLATE_MODE_SITE);

        // If sandbox is explicitly disabled
        if (false === $settings->twigSandbox) {

            // If the Closure module is installed
            if (Craft::$app->hasModule('closure')) {
                // Add it to the default Craft Twig environment
                \nystudio107\closure\Closure::getInstance()?->addClosure($view->getTwig());
            }

            // Parse text via default Craft Twig environment
            return $view->renderObjectTemplate($template, $object, $variables);
        }

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
                $template = $view->normalizeObjectTemplate($template);
                $this->_objectTemplates[$cacheKey] = $twig->createTemplate($template);
            }

            // Get the variables to pass to the template
            if ($object instanceof \yii\base\Model) {
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

    // ========================================================================= //

    /**
     * Send all compiled envelopes.
     *
     * @return void
     */
    public function sendEnvelopes(): void
    {
        // Loop through each envelope
        foreach ($this->envelopes as $envelope) {
            // If invalid envelope, skip it
            if (!$envelope) {
                continue;
            }
            // If sending via the queue
            if ($this->useQueue) {
                // Add message to the queue
                $this->notification->log->info("Adding message to queue.", $envelope->envelopeId);
                Queue::push(new SendMessage(['envelope' => $envelope]));
            } else {
                // Send message immediately
                $this->notification->log->info("Sending message immediately (bypassing queue).", $envelope->envelopeId);
                $envelope->send();
            }
        }
    }

}
