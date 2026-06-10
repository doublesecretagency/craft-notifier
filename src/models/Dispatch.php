<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\models;

use Craft;
use craft\base\Element;
use craft\base\ElementInterface;
use craft\base\Model;
use craft\errors\InvalidPluginException;
use craft\helpers\Queue;
use craft\helpers\StringHelper;
use craft\web\View;
use doublesecretagency\notifier\base\EnvelopeInterface;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\exceptions\RequiredFieldEmptyException;
use doublesecretagency\notifier\filters\FilterInterface;
use doublesecretagency\notifier\helpers\SlackMrkdwn;
use doublesecretagency\notifier\jobs\SendMessage;
use doublesecretagency\notifier\NotifierPlugin;
use nystudio107\crafttwigsandbox\web\SandboxView;
use Throwable;
use Twig\Error\RuntimeError;
use yii\base\Event;
use yii\base\Exception;

/**
 * Core model driving the notification send pipeline.
 *
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
     * @var bool Whether this dispatch was triggered by a manual "Send Test" action.
     */
    public bool $isTest = false;

    /**
     * @var array Set of outbound envelopes.
     */
    public array $envelopes = [];

    /**
     * @var array Raw items collected from the Dynamic Recipients Twig snippet.
     */
    public array $collectedDynamicRecipients = [];

    /**
     * @var bool Whether the `{% setRecipients %}` tag was invoked during the snippet parse.
     */
    public bool $setRecipientsInvoked = false;

    /**
     * @var array Keyed values collected from the Dynamic Data Twig snippet.
     */
    public array $collectedDynamicData = [];

    /**
     * @var bool Whether the `{% setData %}` tag was invoked during the snippet parse.
     */
    public bool $setDataInvoked = false;

    /**
     * @var SandboxView|null Secure Twig sandbox environment.
     */
    private ?SandboxView $_sandboxView = null;

    // ========================================================================= //

    /**
     * Filter whether this event should trigger the notification.
     *
     * @return bool
     */
    public function filterByEventType(): bool
    {
        // If this is a scheduled event, bail successfully
        if (in_array($this->notification->event, ['date-reached', 'pending-to-live'], true)) {
            return true;
        }

        // If this is a feed event, bail successfully
        if ('feed' === $this->notification->eventType) {
            return true;
        }

        // If this is a report event type, bail successfully
        if ($this->notification->isReportType()) {
            return true;
        }

        // Filter further by event type
        switch ($this->notification->eventType) {
            case 'entries':
                if (!$this->_filterEntries()) {
                    return false;
                }
                break;
            case 'assets':
                if (!$this->_filterAssets()) {
                    return false;
                }
                break;
            case 'users':
                if (!$this->_filterUsers()) {
                    return false;
                }
                break;
            case 'craft-commerce-orders':
                // No event-type-specific filters; condition gate runs below
                break;
            case 'craft-commerce-products':
                if (!$this->_filterCommerceProducts()) {
                    return false;
                }
                break;
            case 'digital-products-products':
                if (!$this->_filterDigitalProducts()) {
                    return false;
                }
                break;
            case 'digital-products-licenses':
                if (!$this->_filterDigitalProductLicenses()) {
                    return false;
                }
                break;
            case 'solspace-calendar-events':
                if (!$this->_filterCalendarEvents()) {
                    return false;
                }
                break;
            default:
                // Invalid event type
                return false;
        }

        // Apply the optional Craft element condition
        return $this->_matchEventCondition();
    }

    /**
     * Match the saved element against the optional Craft element condition.
     *
     * @return bool
     */
    private function _matchEventCondition(): bool
    {
        $condition = $this->notification->getEventCondition();

        // If no condition is configured, dispatch is unaffected
        if (!$condition) {
            return true;
        }

        // Match Twig variable seeding precedence (object covers bridged events like User Activated)
        $element = ($this->data['object'] ?? $this->event->sender);

        // If the subject is not an element, the condition can't evaluate
        if (!($element instanceof ElementInterface)) {
            return true;
        }

        return $condition->matchElement($element);
    }

    /**
     * Additional filters for entry events.
     *
     * @return bool
     */
    private function _filterEntries(): bool
    {
        // Get event element
        $element = $this->event->sender;

        // Get event config details
        $sections   = ($this->notification->eventConfig['sections']   ?? []);
        $entryTypes = ($this->notification->eventConfig['entryTypes'] ?? []);
        $filters    = ($this->notification->eventConfig['filters']    ?? []);

        // If triggered by an AFTER_SAVE event
        if ('after-save' === $this->notification->event) {

            // Get additional config details
            $sites = ($this->notification->eventConfig['sites'] ?? []);

            // If not in a valid Site, return false
            if (!in_array($element->siteId, $sites, false)) {
                return false;
            }

        }

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

    /**
     * Additional filters for asset events.
     *
     * @return bool
     */
    private function _filterAssets(): bool
    {
        // Get event element
        $element = $this->event->sender;

        // Get configured Volumes
        $volumes = ($this->notification->eventConfig['volumes'] ?? []);

        // If not in a valid Volume, return false
        if (!in_array($element->volumeId, $volumes, false)) {
            return false;
        }

        // Volume gate passed
        return true;
    }

    /**
     * Additional filters for user events.
     *
     * @return bool
     */
    private function _filterUsers(): bool
    {
        // Get the user being saved or activated
        $element = ($this->data['object'] ?? $this->event->sender);

        // Get configured User Groups (the value `0` means "Ungrouped Users")
        $userGroups = array_map('intval', ($this->notification->eventConfig['userGroups'] ?? []));

        // If no User Groups are selected, return false
        if (empty($userGroups)) {
            return false;
        }

        // If this is the assignment event, gate on the newly-assigned groups
        if ('after-assign-to-groups' === $this->notification->event) {
            // Get the newly-assigned group IDs
            $newGroupIds = array_map('intval', ($this->data['newGroupIds'] ?? []));
            // Bail unless one of the new assignments matches a configured group
            return !empty(array_intersect($newGroupIds, $userGroups));
        }

        // Get IDs of the User Groups this user belongs to
        $userGroupIds = array_map(
            static fn($g) => (int) $g->id,
            $element->getGroups()
        );

        // If the user has no Groups, only "Ungrouped Users" can match
        if (empty($userGroupIds)) {
            return in_array(0, $userGroups, true);
        }

        // If the user is not in any selected Group, return false
        if (!array_intersect($userGroupIds, $userGroups)) {
            return false;
        }

        // All filters are valid
        return true;
    }

    /**
     * Additional filters for Craft Commerce product events.
     *
     * @return bool
     */
    private function _filterCommerceProducts(): bool
    {
        // Get event element
        $element = ($this->data['object'] ?? $this->event->sender);

        // Get configured Product Types
        $productTypes = array_map('intval', ($this->notification->eventConfig['productTypes'] ?? []));

        // If no Product Types are selected, return false
        if (empty($productTypes)) {
            return false;
        }

        // If element has no typeId, return false
        if (empty($element->typeId)) {
            return false;
        }

        // If not in a valid Product Type, return false
        if (!in_array((int) $element->typeId, $productTypes, true)) {
            return false;
        }

        // Product Type gate passed
        return true;
    }

    /**
     * Additional filters for Digital Products product events.
     *
     * @return bool
     */
    private function _filterDigitalProducts(): bool
    {
        // Get event element
        $element = ($this->data['object'] ?? $this->event->sender);

        // Get configured Digital Product Types
        $productTypes = array_map('intval', ($this->notification->eventConfig['digitalProductTypes'] ?? []));

        // If no Digital Product Types are selected, return false
        if (empty($productTypes)) {
            return false;
        }

        // If element has no typeId, return false
        if (empty($element->typeId)) {
            return false;
        }

        // If not in a valid Digital Product Type, return false
        if (!in_array((int) $element->typeId, $productTypes, true)) {
            return false;
        }

        // Digital Product Type gate passed
        return true;
    }

    /**
     * Additional filters for Digital Products license events.
     * Gates on the parent product's type.
     *
     * @return bool
     */
    private function _filterDigitalProductLicenses(): bool
    {
        // Get event element
        $element = ($this->data['object'] ?? $this->event->sender);

        // Get configured Digital Product Types (shared filter with digital-products-products)
        $productTypes = array_map('intval', ($this->notification->eventConfig['digitalProductTypes'] ?? []));

        // If no Digital Product Types are selected, return false
        if (empty($productTypes)) {
            return false;
        }

        // Get the parent product
        $product = (method_exists($element, 'getProduct') ? $element->getProduct() : null);

        // If parent product can't be resolved, return false
        if (!$product) {
            return false;
        }

        // If not in a valid Digital Product Type, return false
        if (!in_array((int) $product->typeId, $productTypes, true)) {
            return false;
        }

        // Digital Product Type gate passed
        return true;
    }

    /**
     * Additional filters for Solspace Calendar event events.
     *
     * @return bool
     */
    private function _filterCalendarEvents(): bool
    {
        // Get event element
        $element = ($this->data['object'] ?? $this->event->sender);

        // Get configured Calendars
        $calendars = array_map('intval', ($this->notification->eventConfig['calendars'] ?? []));

        // If no Calendars are selected, return false
        if (empty($calendars)) {
            return false;
        }

        // If element has no calendarId, return false
        if (empty($element->calendarId)) {
            return false;
        }

        // If not in a valid Calendar, return false
        if (!in_array((int) $element->calendarId, $calendars, true)) {
            return false;
        }

        // Calendar gate passed
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
        // If this is a Dynamic Data notification, run the user's snippet first
        if ('dynamic-data' === $this->notification->eventType) {
            // If the snippet fails to parse or never calls setData, send nothing
            if (!$this->parseDynamicDataSnippet($this->notification) || !$this->setDataInvoked) {
                $this->envelopes = [];
                return;
            }
            // Expose the collected data to the message body as {{ data.* }}
            $this->data['data'] = $this->collectedDynamicData;
        }

        // Whether to send the notification via the queue
        $this->useQueue = (bool) $this->notification->queue;

        // Configure message based on type
        switch ($this->notification->messageType) {
            case 'email':
                $this->envelopes = $this->_compileEmail();
                break;
            case 'sms':
                $this->envelopes = $this->_compileSms();
                break;
            case 'announcement':
                // Announcements are always queued
                $this->useQueue = true;
                $this->envelopes = $this->_compileAnnouncement();
                break;
            case 'flash':
                // Flash messages are never queued
                $this->useQueue = false;
                $this->envelopes = [$this->_compileFlash()];
                break;
            case 'pushover':
                $this->envelopes = $this->_compilePushover();
                break;
            case 'ntfy':
                $this->envelopes = $this->_compileNtfy();
                break;
            case 'slack':
                $this->envelopes = $this->_compileSlack();
                break;
            case 'bluesky':
                $this->envelopes = $this->_compileBluesky();
                break;
            case 'mqtt':
                $this->envelopes = $this->_compileMqtt();
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
        $recipients = NotifierPlugin::getInstance()->recipients->getRecipients($this->notification, $this);

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

            // If the recipient has no email address, log and skip
            if (!$recipient->emailAddress) {
                $this->notification->log->warning(Craft::t('notifier',
                    'Recipient "{name}" has no email address.',
                    ['name' => ($recipient->name ?? $genericRecipient)]
                ));
                continue;
            }

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

            // Initialize logging for envelope (with the test flag tagged on for the log row)
            $envelopeId = $this->notification->log->envelope($jobInfo, $details + ['isTest' => $this->isTest]);

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
        // Get phone numbers for all recipients
        $recipients = NotifierPlugin::getInstance()->recipients->getRecipients($this->notification, $this);

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

            // If the recipient has no phone number, log and skip
            if (!$recipient->phoneNumber) {
                $this->notification->log->warning(Craft::t('notifier',
                    'Recipient "{name}" has no phone number.',
                    ['name' => ($recipient->name ?? $genericRecipient)]
                ));
                continue;
            }

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
                // Body is required by Twilio's SMS API
                $this->_requireFieldNotEmpty('smsMessage', 'Body');
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

            // Initialize logging for envelope (with the test flag tagged on for the log row)
            $envelopeId = $this->notification->log->envelope($jobInfo, $details + ['isTest' => $this->isTest]);

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
     * Compile the message as one or more Announcements.
     *
     * @return array
     * @throws InvalidPluginException
     */
    private function _compileAnnouncement(): array
    {
        // Get recipients, limited to CP-accessible users
        $recipients = NotifierPlugin::getInstance()->recipients->getRecipients($this->notification, $this, true);

        // Get the Notifier plugin ID
        $pluginInfo = Craft::$app->getPlugins()->getStoredPluginInfo('notifier');
        $pluginId = ($pluginInfo['id'] ?? null);

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

            // If the recipient has no associated User, log and skip
            if (!$recipient->user) {
                $this->notification->log->warning(Craft::t('notifier',
                    'Recipient "{name}" has no associated User; cannot send announcement.',
                    ['name' => ($recipient->name ?? $genericRecipient)]
                ));
                continue;
            }

            // If the User cannot access the control panel, log and skip
            if (!$recipient->user->can('accessCp')) {
                $this->notification->log->warning(Craft::t('notifier',
                    'Recipient "{name}" cannot access the control panel; cannot send announcement.',
                    ['name' => ($recipient->name ?? $genericRecipient)]
                ));
                continue;
            }

            // Set job info
            $jobInfo = [
                'messageType' => 'an announcement',
                'recipient' => ($recipient->name ?? $genericRecipient),
            ];

            // Compress variables for Twig
            $config = array_merge($baseConfig, [
                'recipient' => $recipient,
            ]);

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
                'userId' => $recipient->user->id,
                'pluginId' => $pluginId,
                'title' => $title,
                'message' => $message,
            ];

            // Initialize logging for envelope
            $envelopeId = $this->notification->log->envelope($jobInfo, $details + ['isTest' => $this->isTest]);

            // If a parsing error occurred, log and skip it
            if ($parseError) {
                $this->_logError($parseError, $envelopeId);
                continue;
            }

            // Put outbound announcement into envelope
            $outbound[] = new OutboundAnnouncement(array_merge([
                'notificationId' => $this->notification->id,
                'envelopeId' => $envelopeId,
                'jobInfo' => $jobInfo
            ], $details));

        }

        // Return all outbound messages
        return $outbound;
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
            'message' => $message,
        ];

        // Attempt to get the currently active user
        try {
            $currentUser = Craft::$app->getUser()->getIdentity();
        } catch (Throwable $e) {
            $currentUser = null;
        }

        // Initialize logging for envelope (with the test flag tagged on for the log row)
        $envelopeId = $this->notification->log->envelope([
            'messageType' => 'a flash message',
            'recipient' => ($currentUser->name ?? 'the current user'),
        ], $details + ['isTest' => $this->isTest]);

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

    /**
     * Compile the message as one or more Pushover notifications.
     *
     * @return EnvelopeInterface[]
     */
    private function _compilePushover(): array
    {
        // Get the per-User Pushover key field handle off the notification
        $keyFieldHandle = ($this->notification->messageConfig['pushoverKeyField'] ?? null);

        // Get User recipients via the existing User-centric recipient resolution
        $recipients = NotifierPlugin::getInstance()->recipients->getRecipients($this->notification, $this);

        // Initialize outbound messages
        $outbound = [];

        // Set base configuration
        $baseConfig = [
            'notification' => $this->notification,
            'event'        => $this->event,
            'data'         => $this->data,
        ];

        // Get generic recipient name
        $genericRecipient = $this->notification->getTaskRecipient();

        // Loop through all recipients
        foreach ($recipients as $recipient) {

            // If no key field is configured, log and stop
            if (!$keyFieldHandle) {
                $this->notification->log->warning(Craft::t('notifier',
                    'Pushover user-key field is not configured on this notification.'
                ));
                break;
            }

            // If the recipient has no User, log and skip (Pushover requires a User profile)
            if (!$recipient->user) {
                $this->notification->log->warning(Craft::t('notifier',
                    'Recipient "{name}" has no associated User; cannot send Pushover message.',
                    ['name' => ($recipient->name ?? $genericRecipient)]
                ));
                continue;
            }

            // Get the per-User Pushover key from the configured custom field
            $userKey = (string) ($recipient->user->{$keyFieldHandle} ?? '');

            // If user has no key, log [SKIPPED] and continue
            if (!$userKey) {
                $this->notification->log->warning(Craft::t('notifier',
                    '[SKIPPED] User "{name}" has no Pushover key.',
                    ['name' => ($recipient->name ?? $recipient->user->username ?? $genericRecipient)]
                ));
                continue;
            }

            // Set job info
            $jobInfo = [
                'messageType' => 'a Pushover message',
                'recipient'   => ($recipient->name ?? $recipient->user->username ?? $genericRecipient),
            ];

            // Compress variables for Twig
            $config = array_merge($baseConfig, [
                'recipient' => $recipient,
            ]);

            // Attempt to parse message body and title
            try {
                // Body is required by the Pushover API
                $this->_requireFieldNotEmpty('pushoverBody', 'Body');
                $title = $this->_parseTwig($config, $this->notification->messageConfig['pushoverTitle'] ?? '');
                $body  = $this->_parseTwig($config, $this->notification->messageConfig['pushoverBody']  ?? '');
                $parseError = null;
            } catch (Exception|Throwable $e) {
                $title = ($this->notification->messageConfig['pushoverTitle'] ?? '');
                $body  = ($this->notification->messageConfig['pushoverBody']  ?? '');
                $parseError = $e;
            }

            // Get message details
            $details = [
                'userKey' => $userKey,
                'title'   => $title,
                'body'    => $body,
            ];

            // Log envelope
            $envelopeId = $this->notification->log->envelope($jobInfo, [
                'title' => $title,
                'body'  => $body,
                'isTest' => $this->isTest,
            ]);

            // If a parsing error occurred, log and skip
            if ($parseError) {
                $this->_logError($parseError, $envelopeId);
                continue;
            }

            // Put outbound Pushover message into envelope
            $outbound[] = new OutboundPushover(array_merge([
                'notificationId' => $this->notification->id,
                'envelopeId'     => $envelopeId,
                'jobInfo'        => $jobInfo,
            ], $details));

        }

        // Return all outbound messages
        return $outbound;
    }

    /**
     * Compile the message as one or more ntfy push notifications.
     *
     * @return EnvelopeInterface[]
     */
    private function _compileNtfy(): array
    {
        // Get topic recipients
        $recipients = NotifierPlugin::getInstance()->recipients->getRecipients($this->notification, $this);

        // Initialize outbound messages
        $outbound = [];

        // Set base configuration
        $baseConfig = [
            'notification' => $this->notification,
            'event'        => $this->event,
            'data'         => $this->data,
        ];

        // Get generic recipient name
        $genericRecipient = $this->notification->getTaskRecipient();

        // Loop through all recipients
        foreach ($recipients as $recipient) {

            // If the recipient has no topic, log and skip
            if (!$recipient->topic) {
                $this->notification->log->warning(Craft::t('notifier',
                    'Recipient "{name}" has no ntfy topic.',
                    ['name' => ($recipient->name ?? $genericRecipient)]
                ));
                continue;
            }

            // Set job info
            $jobInfo = [
                'messageType' => 'an ntfy message',
                'recipient'   => ($recipient->name ?? $recipient->topic),
            ];

            // Compress variables for Twig
            $config = array_merge($baseConfig, [
                'recipient' => $recipient,
            ]);

            // Attempt to parse all rendered fields
            try {
                $title    = $this->_parseTwig($config, $this->notification->messageConfig['ntfyTitle']    ?? '');
                $body     = $this->_parseTwig($config, $this->notification->messageConfig['ntfyBody']     ?? '');
                $clickUrl = $this->_parseTwig($config, $this->notification->messageConfig['ntfyClickUrl'] ?? '');
                $parseError = null;
            } catch (Exception|Throwable $e) {
                $title    = ($this->notification->messageConfig['ntfyTitle']    ?? '');
                $body     = ($this->notification->messageConfig['ntfyBody']     ?? '');
                $clickUrl = ($this->notification->messageConfig['ntfyClickUrl'] ?? '');
                $parseError = $e;
            }

            // Get simple-config fields (priority, tags, markdown)
            $priority = (int) ($this->notification->messageConfig['ntfyPriority'] ?? 3);
            $tags     = ($this->notification->messageConfig['ntfyTags']     ?? null);
            $markdown = (bool) ($this->notification->messageConfig['ntfyMarkdown'] ?? false);

            // Get message details
            $details = [
                'topic'    => $recipient->topic,
                'title'    => $title,
                'body'     => $body,
                'priority' => $priority,
                'tags'     => $tags,
                'clickUrl' => ($clickUrl ?: null),
                'markdown' => $markdown,
            ];

            // Initialize logging for envelope
            $envelopeId = $this->notification->log->envelope($jobInfo, $details + ['isTest' => $this->isTest]);

            // If a parsing error occurred, log and skip
            if ($parseError) {
                $this->_logError($parseError, $envelopeId);
                continue;
            }

            // Put outbound ntfy message into envelope
            $outbound[] = new OutboundNtfy(array_merge([
                'notificationId' => $this->notification->id,
                'envelopeId'     => $envelopeId,
                'jobInfo'        => $jobInfo,
            ], $details));

        }

        // Return all outbound messages
        return $outbound;
    }

    /**
     * Compile the message as one or more Slack channel posts.
     *
     * @return EnvelopeInterface[]
     */
    private function _compileSlack(): array
    {
        // Get Slack channel recipients
        $recipients = NotifierPlugin::getInstance()->recipients->getRecipients($this->notification, $this);

        // Initialize outbound messages
        $outbound = [];

        // Set base configuration
        $baseConfig = [
            'notification' => $this->notification,
            'event'        => $this->event,
            'data'         => $this->data,
        ];

        // Get generic recipient name
        $genericRecipient = $this->notification->getTaskRecipient();

        // Whether link previews are enabled (default to true)
        $unfurlLinks = (bool) ($this->notification->messageConfig['slackUnfurlLinks'] ?? true);

        // Loop through all recipients
        foreach ($recipients as $recipient) {

            // If the recipient has no bot token, log and skip
            if (!$recipient->slackBotToken) {
                $this->notification->log->warning(Craft::t('notifier',
                    'Recipient "{name}" has no Slack bot token.',
                    ['name' => ($recipient->slackChannelLabel ?? $recipient->name ?? $genericRecipient)]
                ));
                continue;
            }

            // If the recipient has no channel ID, log and skip
            if (!$recipient->slackChannelId) {
                $this->notification->log->warning(Craft::t('notifier',
                    'Recipient "{name}" has no Slack channel ID.',
                    ['name' => ($recipient->slackChannelLabel ?? $recipient->name ?? $genericRecipient)]
                ));
                continue;
            }

            // Set job info (avoid leaking the bot token into the log)
            $displayLabel = ($recipient->slackChannelLabel ?? 'a Slack channel');
            $jobInfo = [
                'messageType' => 'a Slack message',
                'recipient'   => $displayLabel,
            ];

            // Compress variables for Twig
            $config = array_merge($baseConfig, [
                'recipient' => $recipient,
            ]);

            // Attempt to parse the body, icon URL, icon emoji, and username
            try {
                // Body is required by Slack's chat.postMessage API (when no blocks/attachments)
                $this->_requireFieldNotEmpty('slackBody', 'Body');
                $body      = $this->_parseTwig($config, $this->notification->messageConfig['slackBody']      ?? '');
                $iconUrl   = trim($this->_parseTwig($config, $this->notification->messageConfig['slackIcon']     ?? ''));
                $iconEmoji = trim($this->_parseTwig($config, $this->notification->messageConfig['slackEmoji']    ?? ''));
                $username  = trim($this->_parseTwig($config, $this->notification->messageConfig['slackUsername'] ?? ''));
                // If the author opted into HTML mode, convert to Slack mrkdwn before sending
                if ('html' === ($this->notification->messageConfig['slackBodyFormat'] ?? 'markdown')) {
                    $body = SlackMrkdwn::fromHtml($body);
                }
                $parseError = null;
            } catch (Exception|Throwable $e) {
                $body      = ($this->notification->messageConfig['slackBody']      ?? '');
                $iconUrl   = trim((string) ($this->notification->messageConfig['slackIcon']     ?? ''));
                $iconEmoji = trim((string) ($this->notification->messageConfig['slackEmoji']    ?? ''));
                $username  = trim((string) ($this->notification->messageConfig['slackUsername'] ?? ''));
                $parseError = $e;
            }

            // Get message details
            $details = [
                'botToken'    => $recipient->slackBotToken,
                'channelId'   => $recipient->slackChannelId,
                'label'       => $recipient->slackChannelLabel,
                'body'        => $body,
                'iconUrl'     => $iconUrl,
                'iconEmoji'   => $iconEmoji,
                'username'    => $username,
                'unfurlLinks' => $unfurlLinks,
            ];

            // Log envelope with the label only (not the bot token, to keep credentials out of the log)
            $envelopeId = $this->notification->log->envelope($jobInfo, [
                'label'       => $recipient->slackChannelLabel,
                'channelId'   => $recipient->slackChannelId,
                'body'        => $body,
                'iconUrl'     => $iconUrl,
                'iconEmoji'   => $iconEmoji,
                'username'    => $username,
                'unfurlLinks' => $unfurlLinks,
                'isTest'      => $this->isTest,
            ]);

            // If a parsing error occurred, log and skip
            if ($parseError) {
                $this->_logError($parseError, $envelopeId);
                continue;
            }

            // Put outbound Slack message into envelope
            $outbound[] = new OutboundSlack(array_merge([
                'notificationId' => $this->notification->id,
                'envelopeId'     => $envelopeId,
                'jobInfo'        => $jobInfo,
            ], $details));

        }

        // Return all outbound messages
        return $outbound;
    }

    /**
     * Compile the message as one or more Bluesky posts.
     *
     * @return EnvelopeInterface[]
     */
    private function _compileBluesky(): array
    {
        // Get Bluesky account recipients
        $recipients = NotifierPlugin::getInstance()->recipients->getRecipients($this->notification, $this);

        // Initialize outbound messages
        $outbound = [];

        // Set base configuration
        $baseConfig = [
            'notification' => $this->notification,
            'event'        => $this->event,
            'data'         => $this->data,
        ];

        // Get generic recipient name
        $genericRecipient = $this->notification->getTaskRecipient();

        // Loop through all recipients
        foreach ($recipients as $recipient) {

            // If the recipient is missing required Bluesky credentials, log and skip
            if (!$recipient->blueskyHandle || !$recipient->blueskyAppPassword) {
                $this->notification->log->warning(Craft::t('notifier',
                    'Recipient "{name}" has no Bluesky credentials.',
                    ['name' => ($recipient->name ?? $genericRecipient)]
                ));
                continue;
            }

            // Set job info
            $jobInfo = [
                'messageType' => 'a Bluesky post',
                'recipient'   => ($recipient->name ?? $recipient->blueskyHandle),
            ];

            // Compress variables for Twig
            $config = array_merge($baseConfig, [
                'recipient' => $recipient,
            ]);

            // Attempt to parse message body
            try {
                $body = $this->_parseTwig($config, $this->notification->messageConfig['blueskyBody'] ?? '');
                $parseError = null;
            } catch (Exception|Throwable $e) {
                $body = ($this->notification->messageConfig['blueskyBody'] ?? '');
                $parseError = $e;
            }

            // Derive the post language from the primary site
            $language = explode('-', Craft::$app->getSites()->getPrimarySite()->language)[0];

            // Whether to generate link-preview cards (default to true)
            $linkCard = (bool) ($this->notification->messageConfig['blueskyLinkCard'] ?? true);

            // Get message details
            $details = [
                'handle'      => $recipient->blueskyHandle,
                'appPassword' => $recipient->blueskyAppPassword,
                'label'       => $recipient->name,
                'body'        => $body,
                'language'    => $language,
                'linkCard'    => $linkCard,
            ];

            // Log envelope with handle only (app password is intentionally NOT logged)
            $envelopeId = $this->notification->log->envelope($jobInfo, [
                'handle'   => $recipient->blueskyHandle,
                'body'     => $body,
                'language' => $language,
                'isTest'   => $this->isTest,
            ]);

            // If a parsing error occurred, log and skip
            if ($parseError) {
                $this->_logError($parseError, $envelopeId);
                continue;
            }

            // Put outbound Bluesky post into envelope
            $outbound[] = new OutboundBluesky(array_merge([
                'notificationId' => $this->notification->id,
                'envelopeId'     => $envelopeId,
                'jobInfo'        => $jobInfo,
            ], $details));

        }

        // Return all outbound messages
        return $outbound;
    }

    /**
     * Compile the message as one or more MQTT publishes.
     *
     * @return EnvelopeInterface[]
     */
    private function _compileMqtt(): array
    {
        // Get topic recipients
        $recipients = NotifierPlugin::getInstance()->recipients->getRecipients($this->notification, $this);

        // Initialize outbound messages
        $outbound = [];

        // Set base configuration
        $baseConfig = [
            'notification' => $this->notification,
            'event'        => $this->event,
            'data'         => $this->data,
        ];

        // Get generic recipient name
        $genericRecipient = $this->notification->getTaskRecipient();

        // Get message-level QoS and retain flag
        $qos    = (int) ($this->notification->messageConfig['mqttQos'] ?? 0);
        $retain = (bool) ($this->notification->messageConfig['mqttRetain'] ?? false);

        // Loop through all recipients
        foreach ($recipients as $recipient) {

            // If the recipient has no topic, log and skip
            if (!$recipient->topic) {
                $this->notification->log->warning(Craft::t('notifier',
                    'Recipient "{name}" has no MQTT topic.',
                    ['name' => ($recipient->name ?? $genericRecipient)]
                ));
                continue;
            }

            // Set job info
            $jobInfo = [
                'messageType' => 'an MQTT message',
                'recipient'   => ($recipient->name ?? $recipient->topic),
            ];

            // Compress variables for Twig
            $config = array_merge($baseConfig, [
                'recipient' => $recipient,
            ]);

            // Attempt to parse the payload
            try {
                $payload = $this->_parseTwig($config, $this->notification->messageConfig['mqttBody'] ?? '');
                $parseError = null;
            } catch (Exception|Throwable $e) {
                $payload = ($this->notification->messageConfig['mqttBody'] ?? '');
                $parseError = $e;
            }

            // Get message details
            $details = [
                'topic'   => $recipient->topic,
                'payload' => $payload,
                'qos'     => $qos,
                'retain'  => $retain,
            ];

            // Initialize logging for envelope
            $envelopeId = $this->notification->log->envelope($jobInfo, $details + ['isTest' => $this->isTest]);

            // If a parsing error occurred, log and skip
            if ($parseError) {
                $this->_logError($parseError, $envelopeId);
                continue;
            }

            // Put outbound MQTT message into envelope
            $outbound[] = new OutboundMqtt(array_merge([
                'notificationId' => $this->notification->id,
                'envelopeId'     => $envelopeId,
                'jobInfo'        => $jobInfo,
            ], $details));

        }

        // Return all outbound messages
        return $outbound;
    }

    // ========================================================================= //

    /**
     * Run the Dynamic Recipients Twig snippet authored on the Notification.
     *
     * @param Notification $notification
     * @return bool Whether the snippet was successfully parsed.
     */
    public function parseDynamicRecipientSnippet(Notification $notification): bool
    {
        // Start fresh before each parse
        $this->collectedDynamicRecipients = [];
        $this->setRecipientsInvoked = false;

        // Get the snippet
        $snippet = ($notification->recipientsConfig['dynamicRecipients'] ?? '');

        // Set up the variables available to the snippet
        $config = [
            'recipient' => null,
            'notification' => $notification,
            'event' => $this->event,
            'data' => $this->data,
        ];

        // Remember the previously active dispatch
        $previouslyActive = NotifierPlugin::$plugin->activeDispatchForRecipients;

        try {
            // Point the plugin at this dispatch while the snippet runs
            NotifierPlugin::$plugin->activeDispatchForRecipients = $this;

            // Run the snippet, ignoring the rendered output
            $this->_parseTwig($config, $snippet);
        } catch (Exception|Throwable $e) {
            // Clear any recipients left behind by the failed parse
            $this->collectedDynamicRecipients = [];
            // Log the parse error and bail
            $message = $this->_cleanError("[TWIG ERROR] {$e->getMessage()}");
            $notification->log->error($message);
            return false;
        } finally {
            // Restore the previously active dispatch
            NotifierPlugin::$plugin->activeDispatchForRecipients = $previouslyActive;
        }

        // Parse succeeded
        return true;
    }

    /**
     * Run the Dynamic Data Twig snippet authored on the Notification.
     *
     * @param Notification $notification
     * @return bool Whether the snippet was successfully parsed.
     */
    public function parseDynamicDataSnippet(Notification $notification): bool
    {
        // Start fresh before each parse
        $this->collectedDynamicData = [];
        $this->setDataInvoked = false;

        // Get the snippet
        $snippet = ($notification->eventConfig['dynamicData'] ?? '');

        // Set up the variables available to the snippet
        $config = [
            'recipient' => null,
            'notification' => $notification,
            'event' => $this->event,
            'data' => $this->data,
        ];

        // Remember the previously active dispatch
        $previouslyActive = NotifierPlugin::$plugin->activeDispatchForData;

        try {
            // Point the plugin at this dispatch while the snippet runs
            NotifierPlugin::$plugin->activeDispatchForData = $this;
            // Run the snippet, ignoring the rendered output
            $this->_parseTwig($config, $snippet);
        } catch (Exception|Throwable $e) {
            // Clear any data left behind by the failed parse
            $this->collectedDynamicData = [];
            // Log the parse error and bail
            $message = $this->_cleanError("[TWIG ERROR] {$e->getMessage()}");
            $notification->log->error($message);
            return false;
        } finally {
            // Restore the previously active dispatch
            NotifierPlugin::$plugin->activeDispatchForData = $previouslyActive;
        }

        // If the snippet never called setData, log a warning
        if (!$this->setDataInvoked) {
            $notification->log->warning(Craft::t('notifier',
                'The Dynamic Data snippet did not call the {tag} tag.',
                ['tag' => '{% setData %}']
            ));
        }

        // Parse succeeded
        return true;
    }

    // ========================================================================= //

    /**
     * Throw if a required messageConfig field is missing or empty.
     *
     * @param string $key The messageConfig key to validate.
     * @param string $label The user-facing label for the error message.
     * @return void
     * @throws RequiredFieldEmptyException If the field is missing, null, or only whitespace.
     */
    private function _requireFieldNotEmpty(string $key, string $label): void
    {
        // Get the field value as a trimmed string
        $value = trim((string) ($this->notification->messageConfig[$key] ?? ''));

        // If the value is empty, throw a typed exception
        if ('' === $value) {
            throw new RequiredFieldEmptyException("{$label} is empty.");
        }
    }

    /**
     * Parse all Twig tags embedded within text.
     *
     * @param array $config
     * @param string|null $text Optional source text; null and empty render as empty string.
     * @return string
     * @throws Exception
     * @throws Throwable
     */
    private function _parseTwig(array $config, ?string $text): string
    {
        // Coerce null to empty string; optional fields routinely pass missing values
        $text = (string) $text;

        // Extract config variables
        extract($config);

        /** @var Recipient $recipient */

        // Configure special variables
        $vars = [
            // Event Variables
            'event' => $this->event,
            'object' => ($this->data['object'] ?? $this->event->sender),
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
        // If message was skipped intentionally, log a warning and bail
        if (is_a($e, RuntimeError::class)) {
            // Log a warning
            $message = $this->_cleanError("[SKIPPED] {$e->getMessage()}");
            $this->notification->log->warning($message, $envelopeId);
            return;
        }
        // If a required field was empty, log an error and bail
        if (is_a($e, RequiredFieldEmptyException::class)) {
            $this->notification->log->error("[TWIG ERROR] {$e->getMessage()}", $envelopeId);
            return;
        }
        // Otherwise treat as a Twig parse error
        $message = $this->_cleanError("[TWIG ERROR] {$e->getMessage()}");
        // If message contains "is not allowed in"
        if (str_contains($message, 'is not allowed in')) {
            // Append link to sandbox documentation
            $message .= ' Learn how to [configure the Twig sandbox](https://plugins.doublesecretagency.com/notifier/messages/twig-sandbox).';
        }
        // Log the error
        $this->notification->log->error($message, $envelopeId);
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
     * Render an object template via the Twig sandbox.
     *
     * @param string $template The source template string.
     * @param mixed $object The object that should be passed into the template.
     * @param array $variables Any additional variables that should be available to the template.
     * @return string The rendered template.
     * @throws Throwable in case of failure.
     */
    private function _renderObjectTemplate(string $template, mixed $object, array $variables = []): string
    {
        // If there are no dynamic tags, just return the template
        if (!str_contains($template, '{')) {
            return trim($template);
        }

        // Get the sandbox configuration
        $config = Craft::$app->config->getConfigFromFile('notifier-sandbox');

        // If no config is specified
        if (!$config) {
            // Set the default config
            $config = [
                'list' => Sandbox::BLACKLIST,
                'mode' => Sandbox::ADD,
                'twig' => [],
            ];
        }

        // Get the Sites service
        $sitesService = Craft::$app->getSites();

        // Remember the request's current site
        $previousSite = $sitesService->getCurrentSite();

        // Whether to render in the element's site context
        $shouldSwitchSite = ($object instanceof Element && $object->siteId);

        // If so, switch to the element's site
        if ($shouldSwitchSite) {
            $sitesService->setCurrentSite($object->getSite());
        }

        try {
            // If sandbox is explicitly disabled
            if (Sandbox::DISABLE === ($config['mode'] ?? null)) {

                /** @var View $view */
                $view = Craft::$app->getView();

                // Ensure template is in "site" mode
                $view->setTemplateMode(View::TEMPLATE_MODE_SITE);

                // If the Closure module is installed
                if (Craft::$app->hasModule('closure')) {
                    // Add it to the default Craft Twig environment
                    \nystudio107\closure\Closure::getInstance()?->addClosure($view->getTwig());
                }

                // Invalidate cached Twig globals so currentSite picks up the swapped site
                $view->getTwig()->resetGlobals();

                // Parse text via default Craft Twig environment
                return $view->renderObjectTemplate($template, $object, $variables);
            }

            // If sandboxed Twig environment doesn't exist, create it
            if (!$this->_sandboxView) {
                $this->_sandboxView = (new Sandbox(['config' => $config]))->view;
            }

            // Invalidate cached Twig globals so currentSite picks up the swapped site
            $this->_sandboxView->getTwig()->resetGlobals();

            // Parse text via sandbox environment
            return $this->_sandboxView->renderObjectTemplate($template, $object, $variables);
        } finally {
            // Restore the request's original current site
            if ($shouldSwitchSite) {
                $sitesService->setCurrentSite($previousSite);
            }
        }
    }

    // ========================================================================= //

    /**
     * Send all compiled envelopes.
     *
     * @return int Number of envelopes successfully handed off (queued or directly sent).
     */
    public function sendEnvelopes(): int
    {
        // Initialize the count of successful envelopes
        $count = 0;

        // Loop through each envelope
        foreach ($this->envelopes as $envelope) {
            // If invalid envelope, skip it
            if (!$envelope) {
                continue;
            }
            // If sending via the queue
            if ($this->useQueue) {
                // Add message to the queue
                $this->notification->log->info(Craft::t('notifier', 'Adding message to queue.'), $envelope->envelopeId);
                try {
                    Queue::push(new SendMessage(['envelope' => $envelope]));
                    // Successfully queued, count it
                    $count++;
                } catch (Throwable) {
                    // Queue push failed; don't count this envelope
                }
            } else {
                // Send message immediately
                $this->notification->log->info(Craft::t('notifier', 'Sending message immediately (bypassing queue).'), $envelope->envelopeId);
                // Send returns true on success
                if ($envelope->send()) {
                    $count++;
                }
            }
        }

        // Return the count of successful envelopes
        return $count;
    }

}
