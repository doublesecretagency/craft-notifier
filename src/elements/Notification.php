<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\elements;

use Craft;
use craft\base\Element;
use craft\db\Query;
use craft\elements\User;
use craft\elements\conditions\ElementConditionInterface;
use craft\helpers\Db;
use craft\helpers\UrlHelper;
use craft\models\FieldLayout;
use craft\web\CpScreenResponseBehavior;
use DateTime;
use doublesecretagency\notifier\elements\conditions\NotificationCondition;
use doublesecretagency\notifier\elements\db\NotificationQuery;
use doublesecretagency\notifier\enums\Options;
use doublesecretagency\notifier\helpers\Compat;
use doublesecretagency\notifier\fieldlayoutelements\notifications\EventFieldLayoutTab;
use doublesecretagency\notifier\fieldlayoutelements\notifications\MessageFieldLayoutTab;
use doublesecretagency\notifier\fieldlayoutelements\notifications\MetaFieldLayoutTab;
use doublesecretagency\notifier\fieldlayoutelements\notifications\RecipientsFieldLayoutTab;
use doublesecretagency\notifier\filters\ExclusiveFilterInterface;
use doublesecretagency\notifier\filters\FilterInterface;
use doublesecretagency\notifier\models\NotificationLog;
use doublesecretagency\notifier\NotifierPlugin;
use doublesecretagency\notifier\records\Notification as NotificationRecord;
use Throwable;
use yii\base\Event;
use yii\base\Exception as BaseException;
use yii\db\IntegrityException;
use yii\web\Response;

/**
 * Notification element type
 * @since 1.0.0
 */
class Notification extends Element
{

    /**
     * @var string|null Optional description of the notification.
     */
    public ?string $description = null;

    /**
     * @var string|null Type of event which will activate the notification.
     */
    public ?string $eventType = null;

    /**
     * @var string|null Specific event which will activate the notification.
     */
    public ?string $event = null;

    /**
     * @var array Event configuration details.
     */
    public array $eventConfig = [];

    /**
     * @var string|null Type of message to send. (e.g. email, text)
     */
    public ?string $messageType = null;

    /**
     * @var array Message configuration details.
     */
    public array $messageConfig = [];

    /**
     * @var string|null Type of recipients. (e.g. Admins)
     */
    public ?string $recipientsType = null;

    /**
     * @var array Message configuration details.
     */
    public array $recipientsConfig = [];

    /**
     * @var NotificationLog|null
     */
    public ?NotificationLog $log = null;

    /**
     * Initialize notification log
     *
     * @return void
     */
    public function init(): void
    {
        parent::init();

        // Initialize notification log
        $this->log = new NotificationLog(['notificationId' => $this->id]);
    }

    // ========================================================================= //

    public static function displayName(): string
    {
        return Craft::t('notifier', 'Notification');
    }

    public static function pluralDisplayName(): string
    {
        return Craft::t('notifier', 'Notifications');
    }

    public static function refHandle(): ?string
    {
        return 'notification';
    }

    public static function hasContent(): bool
    {
        return true;
    }

    public static function hasTitles(): bool
    {
        return true;
    }

    public static function hasStatuses(): bool
    {
        return true;
    }

    public static function find(): NotificationQuery
    {
        return Craft::createObject(NotificationQuery::class, [static::class]);
    }

    public static function createCondition(): ElementConditionInterface
    {
        return Craft::createObject(NotificationCondition::class, [static::class]);
    }

    protected static function defineSources(string $context): array
    {
        return [
            [
                'key' => '*',
                'label' => Craft::t('notifier', 'All notifications'),
            ],
        ];
    }

    protected static function defineActions(string $source): array
    {
        // List any bulk element actions here
        return [];
    }

    protected static function includeSetStatusAction(): bool
    {
        return true;
    }

    protected static function defineSortOptions(): array
    {
        return [
            'title' => Craft::t('app', 'Title'),
            'slug' => Craft::t('app', 'Slug'),
            'uri' => Craft::t('app', 'URI'),
            [
                'label' => Craft::t('app', 'Date Created'),
                'orderBy' => 'elements.dateCreated',
                'attribute' => 'dateCreated',
                'defaultDir' => 'desc',
            ],
            [
                'label' => Craft::t('app', 'Date Updated'),
                'orderBy' => 'elements.dateUpdated',
                'attribute' => 'dateUpdated',
                'defaultDir' => 'desc',
            ],
            [
                'label' => Craft::t('app', 'ID'),
                'orderBy' => 'elements.id',
                'attribute' => 'id',
            ],
            // ...
        ];
    }

    protected static function defineTableAttributes(): array
    {
        return [
            'slug' => ['label' => Craft::t('app', 'Slug')],
            'uri'  => ['label' => Craft::t('app', 'URI')],

            'description'    => ['label' => Craft::t('app', 'Description')],
            'eventType'      => ['label' => Craft::t('app', 'Event Type')],
            'event'          => ['label' => Craft::t('app', 'Event')],
            'messageType'    => ['label' => Craft::t('app', 'Message Type')],
            'recipientsType' => ['label' => Craft::t('app', 'Recipients Type')],

            'id'          => ['label' => Craft::t('app', 'ID')],
            'uid'         => ['label' => Craft::t('app', 'UID')],
            'dateCreated' => ['label' => Craft::t('app', 'Date Created')],
            'dateUpdated' => ['label' => Craft::t('app', 'Date Updated')],
        ];
    }

    protected static function defineDefaultTableAttributes(string $source): array
    {
        return [
            'description',
            'eventType',
            'event',
            'messageType',
            'recipientsType',
        ];
    }

    /**
     * @inheritdoc
     */
    protected function defineRules(): array
    {
        return array_merge(parent::defineRules(), [
            ['recipientsType', 'validateDynamicRecipientsPermission'],
            ['messageConfig', 'validateEmailMessageMode'],
            ['messageConfig', 'validateSlackBodyFormat'],
        ]);
    }

    /**
     * Ensure the saving user holds the `notifier-editDynamicRecipients` permission
     * when the Notification uses the Dynamic Recipients recipient type.
     *
     * Server-side gate catching crafted POSTs that bypass the CP template's hidden dropdown.
     *
     * @return void
     */
    public function validateDynamicRecipientsPermission(): void
    {
        // If this Notification doesn't use Dynamic Recipients, bail
        if ('dynamic-recipients' !== $this->recipientsType) {
            return;
        }

        // If this isn't a CP request, bail (console / queue / programmatic saves are trusted)
        if (!Craft::$app->getRequest()->getIsCpRequest()) {
            return;
        }

        // Get the current user
        $user = Craft::$app->getUser()->getIdentity();

        // If there's a user and they hold the required permission, bail
        if ($user && $user->can('notifier-editDynamicRecipients')) {
            return;
        }

        // Otherwise, attach a validation error
        $this->addError('recipientsType', Craft::t('notifier',
            'You do not have permission to use the Dynamic Recipients type.'
        ));
    }

    /**
     * Validate the email message editor mode.
     *
     * Accepts only 'code' (Monaco source editor) or 'rich' (Trix WYSIWYG).
     * A missing value normalizes to 'rich' (the default for new notifications).
     *
     * @return void
     */
    public function validateEmailMessageMode(): void
    {
        // Pull the saved mode, defaulting to 'rich' when absent
        $mode = $this->messageConfig['emailMessageMode'] ?? 'rich';

        // If the value isn't one of the allowed strings, attach an error
        if (!in_array($mode, ['code', 'rich'], true)) {
            $this->addError('messageConfig', Craft::t('notifier',
                'Invalid email message mode.'
            ));
            return;
        }

        // Normalize so persistence is stable even when the value was missing
        $this->messageConfig['emailMessageMode'] = $mode;
    }

    /**
     * Validate the Slack body format toggle.
     *
     * Accepts only 'markdown' (raw Slack mrkdwn) or 'html' (HTML converted
     * to Slack mrkdwn at send time). The CP lightswitch posts '1' or '0',
     * which we normalize to the string form here.
     *
     * @return void
     */
    public function validateSlackBodyFormat(): void
    {
        // Pull the saved value
        $value = $this->messageConfig['slackBodyFormat'] ?? null;

        // Normalize the lightswitch's '1' / '0' to a string mode
        if ('1' === $value || 1 === $value || true === $value) {
            $value = 'html';
        } elseif (null === $value || '' === $value || '0' === $value || 0 === $value || false === $value) {
            $value = 'markdown';
        }

        // If the value isn't one of the allowed strings, attach an error
        if (!in_array($value, ['markdown', 'html'], true)) {
            $this->addError('messageConfig', Craft::t('notifier',
                'Invalid Slack body format.'
            ));
            return;
        }

        // Normalize so persistence is stable
        $this->messageConfig['slackBodyFormat'] = $value;
    }

    /**
     * @inheritdoc
     */
    public function canView(User $user): bool
    {
        // Defer to parent (admins bypass permissions)
        if (parent::canView($user)) {
            return true;
        }

        // Otherwise require the view permission
        return $user->can('notifier-viewNotifications');
    }

    /**
     * @inheritdoc
     */
    public function canSave(User $user): bool
    {
        // Defer to parent (admins bypass permissions)
        if (parent::canSave($user)) {
            return true;
        }

        // Otherwise require the save permission
        return $user->can('notifier-saveNotifications');
    }

    /**
     * @inheritdoc
     */
    public function canDuplicate(User $user): bool
    {
        // Defer to parent (admins bypass permissions)
        if (parent::canDuplicate($user)) {
            return true;
        }

        // Otherwise require the save permission
        return $user->can('notifier-saveNotifications');
    }

    /**
     * @inheritdoc
     */
    public function canDelete(User $user): bool
    {
        // Defer to parent (admins bypass permissions)
        if (parent::canDelete($user)) {
            return true;
        }

        // Otherwise require the delete permission
        return $user->can('notifier-deleteNotifications');
    }

    /**
     * @inheritdoc
     */
    public function canCreateDrafts(User $user): bool
    {
        // Defer to parent (admins bypass permissions)
        if (parent::canCreateDrafts($user)) {
            return true;
        }

        // Otherwise require the save permission, drafts are an edit affordance
        return $user->can('notifier-saveNotifications');
    }

    protected function cpEditUrl(): ?string
    {
        return sprintf('notifications/%s', $this->getCanonicalId());
    }

    public function getPostEditUrl(): ?string
    {
        return UrlHelper::cpUrl('notifications');
    }

    public function prepareEditScreen(Response $response, string $containerId): void
    {
        /** @var Response|CpScreenResponseBehavior $response */
        $response->crumbs([
            [
                'label' => self::pluralDisplayName(),
                'url' => UrlHelper::cpUrl('notifications'),
            ],
        ]);

        // Pick the correct sidebar method for the active Craft version
        // (Craft 5: metaSidebarTemplate(), Craft 4: sidebarTemplate())
        $sidebarMethod = Compat::metaSidebarMethodName();
        $response->{$sidebarMethod}('notifier/notifications/_edit/details', [
            'notification' => $this,
        ]);

        // Render the "Send a test message" button into the CP screen header
        $response->additionalButtonsTemplate('notifier/notifications/_edit/test-button', [
            'notification' => $this,
        ]);
    }

    public function getFieldLayout(): ?FieldLayout
    {
        // Build the field layout for the Notification element
        $fieldLayout = new FieldLayout();

        // Bind the layout to this element type so card-view rendering can resolve it
        $fieldLayout->type = static::class;

        // Attach the four standard tabs
        $fieldLayout->setTabs([
            new MetaFieldLayoutTab(),
            new EventFieldLayoutTab(),
            new MessageFieldLayoutTab(),
            new RecipientsFieldLayoutTab(),
        ]);

        return $fieldLayout;
    }

    // ========================================================================= //

    /**
     * Get the Craft element condition for a given event type.
     *
     * Defaults to this notification's saved event type. Pass an explicit
     * `$forEventType` to render builders for the inactive tabs.
     *
     * @param string|null $forEventType Event type to build the condition for.
     * @return ElementConditionInterface|null
     */
    public function getEventCondition(?string $forEventType = null): ?ElementConditionInterface
    {
        $forEventType = ($forEventType ?? (string) $this->eventType);

        // Resolve the condition class for the requested event type
        $class = NotifierPlugin::$plugin->events->getConditionClassForEventType($forEventType);

        // If no condition class is registered for this event type, bail
        if (!$class) {
            return null;
        }

        // Only seed persisted config on the active tab; inactive tabs start fresh
        $config = (
            $forEventType === (string) $this->eventType
                ? ($this->eventConfig['condition'] ?? ['class' => $class])
                : ['class' => $class]
        );

        // Re-bind class to defend against stale persisted configs
        $config['class'] = $class;

        // Seed elementType so per-field rules (Lightswitch, Categories, etc.) register
        $elementClass = NotifierPlugin::$plugin->events->getElementClassForEventType($forEventType);
        if ($elementClass) {
            $config['elementType'] = $elementClass;
        }

        // Hydrate via Craft's Conditions service
        /** @var ElementConditionInterface $condition */
        $condition = Craft::$app->getConditions()->createCondition($config);

        // Per-type name and id so all four tab builders coexist in the DOM
        $condition->name = "eventCondition_{$forEventType}";
        $condition->id = "event-condition-{$forEventType}";

        // Render as a <div>; the edit page is already a <form> and nested forms break htmx
        $condition->mainTag = 'div';

        // Scope to selected entry types when present (Craft 5 only; Craft 4 falls back to all layouts)
        if (Compat::isCraft5()) {
            $layouts = $this->_resolveConditionFieldLayouts($forEventType);
            if ($layouts) {
                $condition->setFieldLayouts($layouts);
            }
        }

        return $condition;
    }

    /**
     * Resolve field layouts to attach to the condition builder, based on the
     * notification's selected entry types.
     *
     * @param string|null $forEventType Event type the builder is being rendered for.
     * @return FieldLayout[]
     */
    private function _resolveConditionFieldLayouts(?string $forEventType = null): array
    {
        $forEventType = ($forEventType ?? (string) $this->eventType);

        // Only the entries event type supports field-layout filtering for now
        if ('entries' !== $forEventType) {
            return [];
        }

        // Get configured entry types
        $entryTypeIds = ($this->eventConfig['entryTypes'] ?? []);

        // If no entry types are scoped, fall back to Craft's default
        if (!$entryTypeIds) {
            return [];
        }

        // Load the entries service (Craft 5: getEntries(), Craft 4: getSections())
        $entriesService = Compat::isCraft5()
            ? Craft::$app->getEntries()
            : Craft::$app->getSections();

        // Collect each selected entry type's field layout
        $layouts = [];
        foreach ($entryTypeIds as $typeId) {
            $entryType = $entriesService->getEntryTypeById((int) $typeId);
            if ($entryType) {
                $layouts[] = $entryType->getFieldLayout();
            }
        }

        // Return the resolved layouts
        return $layouts;
    }

    /**
     * Get all event filters for Notification.
     *
     * @return array
     */
    public function getFilters(): array
    {
        // Get all available filters
        $allFilters = NotifierPlugin::$plugin->events->getAllFilters();

        // Get existing filters
        $existingFilters = ($this->eventConfig['filters'] ?? []);

        // Configure and return all filters
        return array_map(function(string $class) use ($existingFilters) {
            return $this->_configureFilter($class, $existingFilters);
        }, $allFilters);
    }

    /**
     * Configure each individual filter.
     *
     * @param string|FilterInterface $class
     * @param array $filters
     * @return array
     */
    private function _configureFilter(string|FilterInterface $class, array $filters = []): array
    {
        // Get default filter value
        $defaultValue = $class::defaultValue();

        // Default config values
        $show = true;
        $enabled = is_bool($defaultValue);
        $value = ($defaultValue ?? false);

        // If filter already exists
        if (isset($filters[$class])) {
            // Set filter configuration
//            $show = $class && $event && $class::show($class, $event);
            $enabled = (bool) $filters[$class];
            $value = ('yes' === $filters[$class]);
        }

        // Configure filter
        $config = [
            'class' => $class,
            'displayName' => $class::displayName(),
            'titleNo' => $class::titleNo(),
            'titleIgnore' => $class::titleIgnore(),
            'titleYes' => $class::titleYes(),
            'show' => $show,
            'enabled' => $enabled,
            'value' => $value,
        ];

        // Append exclusions
        if (is_subclass_of($class, ExclusiveFilterInterface::class)) {
            $config['excludes'] = $class::excludes();
        }

        // Return configuration
        return $config;
    }

    // ========================================================================= //

    /**
     * @inheritdoc
     * @throws BaseException
     */
    public function afterSave(bool $isNew): void
    {
        // If not propagating
        if (!$this->propagating) {

            // If not new
            if (!$isNew) {
                // Get the existing notification record
                $record = NotificationRecord::findOne($this->id);
                // If it can't be found, throw an exception
                if (!$record) {
                    throw new BaseException(Craft::t('notifier', 'Invalid notification ID: {id}', ['id' => $this->id]));
                }
            } else {
                // Create a new notification record
                $record = new NotificationRecord();
                // Set the notification ID
                $record->id = $this->id;
            }

            // Capture the previously-saved Event Type
            $oldEventType = $record->eventType;

            // Decode the previously-saved eventConfig (raw JSON string when freshly loaded)
            $oldEventConfig = is_string($record->eventConfig)
                ? (json_decode($record->eventConfig, true) ?: [])
                : (is_array($record->eventConfig) ? $record->eventConfig : []);

            // Extract the previously-saved Feed URL
            $oldFeedUrl = trim((string) ($oldEventConfig['feedUrl'] ?? ''));

            // Get request service
            $request = Craft::$app->getRequest();

            // Initialize POST values (null falls back to the saved value)
            $description = $eventType = $event = $eventConfig = null;
            $messageType = $messageConfig = $recipientsType = $recipientsConfig = null;

            // If not a console request
            if (!$request->getIsConsoleRequest()) {

                // Get POST values
                $description      = $request->getBodyParam('description');
                $eventType        = $request->getBodyParam('eventType');
                $event            = $request->getBodyParam('event');
                $eventConfig      = $request->getBodyParam('eventConfig');
                $messageType      = $request->getBodyParam('messageType');
                $messageConfig    = $request->getBodyParam('messageConfig');
                // Normalize the Slack body format lightswitch ('1' / '0') into 'html' / 'markdown'
                if (is_array($messageConfig) && array_key_exists('slackBodyFormat', $messageConfig)) {
                    $messageConfig['slackBodyFormat'] = (
                        '1' === $messageConfig['slackBodyFormat'] || 1 === $messageConfig['slackBodyFormat'] || true === $messageConfig['slackBodyFormat']
                    ) ? 'html' : 'markdown';
                }
                $recipientsType   = $request->getBodyParam('recipientsType');
                $recipientsConfig = $request->getBodyParam('recipientsConfig');

                // Get the active tab's condition and label
                $selectedEventType  = ($eventType ?? (string) $this->eventType);
                $eventCondition     = $request->getBodyParam("eventCondition_{$selectedEventType}");
                $manualTriggerLabel = $request->getBodyParam("manualTriggerLabel_{$selectedEventType}");
                $dateReached        = $request->getBodyParam("dateReached_{$selectedEventType}");

                // Extract specific event
                $event = ($event[$eventType] ?? null);

                // If the config is not an array, initialize it
                if (!is_array($eventConfig)) {
                    $eventConfig = [];
                }

                // If an event condition exists
                if ($eventCondition !== null) {
                    // Copy it to the config
                    $eventConfig['condition'] = $eventCondition;
                }

                // If the manual trigger label exists
                if ($manualTriggerLabel !== null) {
                    // Copy it to the config
                    $eventConfig['manualTriggerLabel'] = $manualTriggerLabel;
                }

                // If the date-reached config exists
                if (is_array($dateReached)) {
                    // Copy a sanitized copy to the config
                    $eventConfig['dateReached'] = [
                        'field'     => (string) ($dateReached['field']     ?? ''),
                        'direction' => (string) ($dateReached['direction'] ?? 'on'),
                        'offset'    => (int)    ($dateReached['offset']    ?? 0),
                    ];
                }

            }

            // Configure the notification
            $record->description      = $description      ?? $this->description;
            $record->eventType        = $eventType        ?? $this->eventType;
            $record->event            = $event            ?? $this->event;
            $record->eventConfig      = $eventConfig      ?? $this->eventConfig;
            $record->messageType      = $messageType      ?? $this->messageType;
            $record->messageConfig    = $messageConfig    ?? $this->messageConfig;
            $record->recipientsType   = $recipientsType   ?? $this->recipientsType;
            $record->recipientsConfig = $recipientsConfig ?? $this->recipientsConfig;

            // Save the notification
            $record->save(false);

            // Sync the Event Type from the just-saved record
            $this->eventType = $record->eventType;

            // Sync the eventConfig (normalize to an array if the record holds the JSON string)
            $this->eventConfig = is_array($record->eventConfig)
                ? $record->eventConfig
                : (json_decode((string) $record->eventConfig, true) ?: []);

            // Ensure scheduled notifications have a schedule tracking row
            $this->_ensureScheduleTracking($record->event);

            // Ensure feed notifications are seeded against their current Feed URL
            $this->_ensureFeedSeeding($oldEventType, $oldFeedUrl);
        }

        parent::afterSave($isNew);
    }

    // ========================================================================= //

    /**
     * Send this Notification based on the activated Event.
     *
     * @param Event $event
     * @return void
     */
    public function send(Event $event): void
    {
        NotifierPlugin::getInstance()->messages->send($this, $event);
    }

    // ========================================================================= //

    /**
     * Get the label for this notification's manual trigger.
     *
     * Shown on the "Send Notification" element action
     * to differentiate multiple manual triggers.
     *
     * @return string The configured label, or the default fallback.
     */
    public function getManualTriggerLabel(): string
    {
        // Get the configured label
        $label = trim((string) ($this->eventConfig['manualTriggerLabel'] ?? ''));

        // Return the label, or the default fallback
        return ($label ?: Craft::t('notifier', 'Send Notification'));
    }

    // ========================================================================= //

    /**
     * Get the icon for this notification's message type.
     *
     * Shown beside the manual-send action of an element's edit screen
     * to differentiate multiple manual triggers.
     *
     * @return string A Font Awesome icon name.
     */
    public function getMessageTypeIcon(): string
    {
        // Get the icon for the message type, or use a generic fallback
        return (Options::MESSAGE_TYPE_ICON[$this->messageType] ?? 'paper-plane');
    }

    // ========================================================================= //

    /**
     * Determine the task recipient.
     *
     * @return string
     */
    public function getTaskRecipient(): string
    {
        // Set task recipient based on recipients type
        switch ($this->recipientsType) {
            case 'current-user':       return 'the current user';
            case 'all-users':          return 'all Users';
            case 'all-admins':         return 'all Admins';
            case 'selected-groups':    return 'all Users in selected User Group(s)';
            case 'selected-users':     return 'selected User';
            case 'dynamic-recipients': return 'dynamic recipients';
        }
        // Fallback to "unknown"
        return 'unknown recipient';
    }

    // ========================================================================= //

    /**
     * Ensure a scheduled notification has a row in the schedule tracking table.
     *
     * @param string|null $event The notification's saved event.
     * @return void
     */
    private function _ensureScheduleTracking(?string $event): void
    {
        // If this isn't a scheduled event, bail
        if (!in_array($event, ['date-reached', 'pending-to-live'], true)) {
            return;
        }

        // Schedule tracking table
        $table = '{{%notifier_trackscheduled}}';

        // Whether a matching row already exists for this notification
        $exists = (new Query())
            ->from($table)
            ->where(['notificationId' => $this->id])
            ->exists();

        // If a row already exists, bail
        if ($exists) {
            return;
        }

        try {
            // Initialize the scheduled notification's timestamp
            Craft::$app->getDb()->createCommand()
                ->insert($table, [
                    'notificationId' => $this->id,
                    'lastRunAt' => Db::prepareDateForDb(new DateTime()),
                ])
                ->execute();
        } catch (IntegrityException) {
            // A concurrent save already seeded the row
        }
    }

    /**
     * Run the save-time seed flow for a feed notification.
     *
     * @param string|null $oldEventType The previously-saved Event Type (null for new notifications).
     * @param string $oldFeedUrl The previously-saved Feed URL (empty for new notifications).
     * @return void
     */
    private function _ensureFeedSeeding(?string $oldEventType, string $oldFeedUrl): void
    {
        // If this is a draft or revision, bail (only canonical saves run the seed flow)
        if ($this->getIsDraft() || $this->getIsRevision()) {
            return;
        }

        // If this isn't currently a feed notification, bail
        if ('feed' !== $this->eventType) {
            return;
        }

        // Read the current Feed URL
        $newFeedUrl = trim((string) ($this->eventConfig['feedUrl'] ?? ''));

        // If no Feed URL is configured, bail
        if ('' === $newFeedUrl) {
            return;
        }

        // Run the seed flow, catching any failure so the save itself never fails
        try {
            // If reactivating feed or swapping the Feed URL, wipe the stale tracking history
            if ('feed' !== $oldEventType || $oldFeedUrl !== $newFeedUrl) {
                NotifierPlugin::getInstance()->feedRunner->wipeHistory($this->id);
            }

            // Attempt the initial seed (idempotent; no-ops if already seeded)
            NotifierPlugin::getInstance()->feedRunner->seedNotification($this);
        } catch (Throwable $e) {
            // Log the failure but don't block the save
            $this->log->error(Craft::t('notifier',
                'Initial feed scan failed: {message}',
                ['message' => $e->getMessage()]
            ));
        }
    }

}
