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

namespace doublesecretagency\notifier\elements;

use Craft;
use craft\base\Element;
use craft\db\Query;
use craft\db\Table;
use craft\elements\actions\Restore;
use craft\elements\User;
use craft\elements\conditions\ElementConditionInterface;
use craft\helpers\Db;
use craft\helpers\UrlHelper;
use craft\models\FieldLayout;
use craft\services\Structures;
use craft\web\CpScreenResponseBehavior;
use DateTime;
use doublesecretagency\notifier\elements\conditions\NotificationCondition;
use doublesecretagency\notifier\elements\db\NotificationQuery;
use doublesecretagency\notifier\enums\Options;
use doublesecretagency\notifier\helpers\Compat;
use doublesecretagency\notifier\helpers\NotificationStructure;
use doublesecretagency\notifier\filters\ExclusiveFilterInterface;
use doublesecretagency\notifier\filters\FilterInterface;
use doublesecretagency\notifier\models\NotificationFieldLayoutProvider;
use doublesecretagency\notifier\models\NotificationLog;
use doublesecretagency\notifier\models\Settings;
use doublesecretagency\notifier\NotifierPlugin;
use doublesecretagency\notifier\records\Notification as NotificationRecord;
use ReflectionClass;
use ReflectionProperty;
use Throwable;
use yii\base\Event;
use yii\base\Exception as BaseException;
use yii\db\IntegrityException;
use yii\web\Response;

/**
 * Element type representing a single configured notification.
 *
 * @since 1.0.0
 */
class Notification extends Element
{

    /**
     * @var string[] Event types which compile a data report, not directly tied to elements.
     */
    private const REPORT_EVENT_TYPES = ['system-snapshot', 'dynamic-data'];

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
     * @var bool Whether the message should be sent via the jobs queue.
     */
    public bool $queue = true;

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

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('notifier', 'Notification');
    }

    /**
     * @inheritdoc
     */
    public static function pluralDisplayName(): string
    {
        return Craft::t('notifier', 'Notifications');
    }

    /**
     * @inheritdoc
     */
    public static function refHandle(): ?string
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public static function hasContent(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public static function hasTitles(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public static function hasStatuses(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public static function find(): NotificationQuery
    {
        return Craft::createObject(NotificationQuery::class, [static::class]);
    }

    /**
     * @inheritdoc
     */
    public static function createCondition(): ElementConditionInterface
    {
        return Craft::createObject(NotificationCondition::class, [static::class]);
    }

    /**
     * @inheritdoc
     */
    protected static function defineSources(string $context): array
    {
        // Get the structure that backs the manual order
        $structureId = NotificationStructure::getStructureId();

        // If the structure can't be resolved, fall back to a plain (unordered) source
        if (!$structureId) {
            return [
                [
                    'key' => '*',
                    'label' => Craft::t('notifier', 'All notifications'),
                ],
            ];
        }

        // Place any notifications not yet in the structure
        NotificationStructure::backfillUnplaced($structureId);

        // Single structured source: a flat, drag-to-reorder list
        return [
            [
                'key' => '*',
                'label' => Craft::t('notifier', 'All notifications'),
                'criteria' => ['structureId' => $structureId],
                'defaultSort' => ['structure', 'asc'],
                'structureId' => $structureId,
                'structureEditable' => static::_canReorder(),
            ],
        ];
    }

    /**
     * Whether the current user may drag notifications into a new order.
     *
     * @return bool
     */
    private static function _canReorder(): bool
    {
        // Get the current user
        $user = Craft::$app->getUser()->getIdentity();

        // If there's no user, deny
        if (!$user) {
            return false;
        }

        // Admins may always reorder
        if ($user->admin) {
            return true;
        }

        // Otherwise require the save permission
        return $user->can('notifier-saveNotifications');
    }

    /**
     * @inheritdoc
     */
    protected static function defineActions(string $source): array
    {
        // Bulk element actions
        return [
            Restore::class, // Allow trashed notifications to be restored
        ];
    }

    /**
     * @inheritdoc
     */
    protected static function includeSetStatusAction(): bool
    {
        return true;
    }

    /**
     * @inheritdoc
     */
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

    /**
     * @inheritdoc
     */
    protected static function defineTableAttributes(): array
    {
        return [
            'slug' => ['label' => Craft::t('app', 'Slug')],
            'uri'  => ['label' => Craft::t('app', 'URI')],

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

    /**
     * @inheritdoc
     */
    protected static function defineDefaultTableAttributes(string $source): array
    {
        return [
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
            ['eventConfig', 'validateDynamicDataPermission'],
            ['messageConfig', 'validateEmailMessageMode'],
            ['recipientsType', 'validateDynamicRecipientsPermission'],
        ]);
    }

    /**
     * Whether this is a report event type (System Snapshot, Dynamic Data).
     *
     * @return bool
     */
    public function isReportType(): bool
    {
        return in_array($this->eventType, self::REPORT_EVENT_TYPES, true);
    }

    /**
     * Ensure the user is allowed to use Dynamic Data.
     *
     * @return void
     */
    public function validateDynamicDataPermission(): void
    {
        // If this Notification doesn't use Dynamic Data, bail
        if ('dynamic-data' !== $this->eventType) {
            return;
        }

        // If this isn't a CP request, bail
        if (!Craft::$app->getRequest()->getIsCpRequest()) {
            return;
        }

        // Get the current user
        $user = Craft::$app->getUser()->getIdentity();

        // If the user exists and has permission, bail
        if ($user && $user->can('notifier-editDynamicData')) {
            return;
        }

        // Otherwise, add a validation error
        $this->addError('eventConfig', Craft::t('notifier',
            'You do not have permission to use the Dynamic Data type.'
        ));
    }

    /**
     * Ensure the user is allowed to use Dynamic Recipients.
     *
     * @return void
     */
    public function validateDynamicRecipientsPermission(): void
    {
        // If this Notification doesn't use Dynamic Recipients, bail
        if ('dynamic-recipients' !== $this->recipientsType) {
            return;
        }

        // If this isn't a CP request, bail, since console, queue, and programmatic saves are trusted
        if (!Craft::$app->getRequest()->getIsCpRequest()) {
            return;
        }

        // Get the current user
        $user = Craft::$app->getUser()->getIdentity();

        // If there's a user and they hold the required permission, bail
        if ($user && $user->can('notifier-editDynamicRecipients')) {
            return;
        }

        // Otherwise, add a validation error
        $this->addError('recipientsType', Craft::t('notifier',
            'You do not have permission to use the Dynamic Recipients type.'
        ));
    }

    /**
     * Validate the email editor mode.
     *
     * Only 'code' or 'rich' are allowed, a missing value falls back to 'rich'.
     *
     * @return void
     */
    public function validateEmailMessageMode(): void
    {
        // Get the saved mode, defaulting to 'rich' when absent
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
     * @inheritdoc
     */
    public function canView(User $user): bool
    {
        // Defer to parent
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
        // Defer to parent
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
        // Defer to parent
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
        // Defer to parent
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
        // Defer to parent
        if (parent::canCreateDrafts($user)) {
            return true;
        }

        // Otherwise require the save permission, drafts are an edit affordance
        return $user->can('notifier-saveNotifications');
    }

    /**
     * @inheritdoc
     */
    protected function cpEditUrl(): ?string
    {
        return sprintf('notifications/%s', $this->getCanonicalId());
    }

    /**
     * @inheritdoc
     */
    public function getPostEditUrl(): ?string
    {
        return UrlHelper::cpUrl('notifications');
    }

    /**
     * @inheritdoc
     */
    public function prepareEditScreen(Response $response, string $containerId): void
    {
        /** @var Response|CpScreenResponseBehavior $response */
        $response->crumbs([
            [
                'label' => self::pluralDisplayName(),
                'url' => UrlHelper::cpUrl('notifications'),
            ],
        ]);

        // Get sidebar method based on Craft major version
        $sidebarMethod = Compat::metaSidebarMethodName();

        // Set the sidebar
        $response->{$sidebarMethod}('notifier/notifications/_edit/details', [
            'notification' => $this,
        ]);

        // Whether this notification is a report type
        $isReport = $this->isReportType();

        // Determine which button template to use
        $buttonTemplate = ($isReport ? 'send-report' : 'send-test');

        // Set the "Send" button
        $response->additionalButtonsTemplate("notifier/notifications/_edit/{$buttonTemplate}", [
            'notification' => $this,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getFieldLayout(): ?FieldLayout
    {
        // Return the admin-defined field layout for notifications
        return NotifierPlugin::getInstance()->fieldLayouts->getLayout();
    }

    /**
     * @inheritdoc
     */
    protected static function defineFieldLayouts(?string $source): array
    {
        // Get the persisted layouts for this element type
        $layouts = Craft::$app->getFields()->getLayoutsByType(static::class);

        // If Craft 4, skip the provider (Craft 4 lacks chip interfaces)
        if (Compat::isCraft4()) {
            return $layouts;
        }

        // Create the field layout provider
        $provider = new NotificationFieldLayoutProvider();

        // Attach the provider so a field's "Used by" chip
        // links back to the field layout designer
        foreach ($layouts as $layout) {
            $layout->provider = $provider;
        }

        // Return the layouts
        return $layouts;
    }

    /**
     * Get the reserved field handles a custom field can't use.
     *
     * A custom field sharing one of these handles would be unreachable via
     * `notification.<handle>`, so the field layout designer rejects it at save.
     *
     * @return string[]
     */
    public static function reservedFieldHandles(): array
    {
        // Initialize the reserved handles
        $handles = [];

        // Loop through the element's public properties
        foreach ((new ReflectionClass(static::class))->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {

            // If the property is static, skip
            if ($property->isStatic()) {
                continue;
            }

            // Reserve the property name
            $handles[] = $property->getName();
        }

        // Return the distinct reserved handles
        return array_values(array_unique($handles));
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

        // Get the condition class for the requested event type
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

        // Get the element class so per-field rules (Lightswitch, Categories, etc.) register
        $elementClass = NotifierPlugin::$plugin->events->getElementClassForEventType($forEventType);

        // If an element class was resolved, seed it
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

        // On Craft 5, scope to the selected entry types; Craft 4 falls back to all layouts
        if (Compat::isCraft5()) {
            // Get the condition field layouts
            $layouts = $this->_resolveConditionFieldLayouts($forEventType);

            // If any layouts resolved, apply them
            if ($layouts) {
                $condition->setFieldLayouts($layouts);
            }
        }

        return $condition;
    }

    /**
     * Get the field layouts for the condition builder, based on the selected entry types.
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

        // Get the selected section + entry type pairs
        $sectionEntryTypes = ($this->eventConfig['sectionEntryTypes'] ?? []);

        // If no entry types are scoped, fall back to Craft's default
        if (!$sectionEntryTypes) {
            return [];
        }

        // Initialize the distinct entry type IDs
        $entryTypeIds = [];

        // Loop through the section and entry type pairs
        foreach ($sectionEntryTypes as $pair) {
            // Get the entry type ID from the pair
            $typeId = (explode('-', (string) $pair, 2)[1] ?? null);

            // If the pair has an entry type ID, collect it
            if (null !== $typeId) {
                $entryTypeIds[(int) $typeId] = (int) $typeId;
            }
        }

        // Get the entries service
        $entriesService = Compat::isCraft5()
            ? Craft::$app->getEntries()
            : Craft::$app->getSections();

        // Initialize the field layouts
        $layouts = [];

        // Loop through each selected entry type
        foreach ($entryTypeIds as $typeId) {
            // Get the entry type
            $entryType = $entriesService->getEntryTypeById((int) $typeId);

            // If the entry type exists, collect its field layout
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

            // Decode the previously-saved eventConfig, a raw JSON string when freshly loaded
            $oldEventConfig = is_string($record->eventConfig)
                ? (json_decode($record->eventConfig, true) ?: [])
                : (is_array($record->eventConfig) ? $record->eventConfig : []);

            // Extract the previously-saved Feed URL
            $oldFeedUrl = trim((string) ($oldEventConfig['feedUrl'] ?? ''));

            // Get request service
            $request = Craft::$app->getRequest();

            // Initialize the POST values
            $eventType = $event = $eventConfig = null;
            $messageType = $messageConfig = $recipientsType = $recipientsConfig = null;
            $queue = null;

            // If not a console request
            if (!$request->getIsConsoleRequest()) {

                // Get POST values
                $eventType        = $request->getBodyParam('eventType');
                $event            = $request->getBodyParam('event');
                $eventConfig      = $request->getBodyParam('eventConfig');
                $messageType      = $request->getBodyParam('messageType');
                $messageConfig    = $request->getBodyParam('messageConfig');
                $recipientsType   = $request->getBodyParam('recipientsType');
                $recipientsConfig = $request->getBodyParam('recipientsConfig');
                $queue            = $request->getBodyParam('queue');

                // Get the active tab's condition and label
                $selectedEventType  = ($eventType ?? (string) $this->eventType);
                $eventCondition     = $request->getBodyParam("eventCondition_{$selectedEventType}");
                $manualTriggerLabel = $request->getBodyParam("manualTriggerLabel_{$selectedEventType}");
                $dateReached        = $request->getBodyParam("dateReached_{$selectedEventType}");
                $recurring          = $request->getBodyParam("recurring_{$selectedEventType}");
                $recurringSchedule  = $request->getBodyParam("recurringSchedule_{$selectedEventType}");
                $dynamicData        = $request->getBodyParam("dynamicData_{$selectedEventType}");

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

                // If the recurring lightswitch was posted
                if ($recurring !== null) {
                    // Copy the normalized boolean to the config
                    $eventConfig['recurring'] = ('1' === $recurring || 1 === $recurring || true === $recurring);
                }

                // If the recurring-schedule config exists
                if (is_array($recurringSchedule)) {
                    // Copy a sanitized copy to the config
                    $eventConfig['recurringSchedule'] = [
                        'frequency'  => (string)    ($recurringSchedule['frequency']  ?? 'weekly'),
                        'interval'   => max(1, (int) ($recurringSchedule['interval']  ?? 1)),
                        'startDate'  => (string)    ($recurringSchedule['startDate']  ?? ''),
                        'dayOfWeek'  => (int)       ($recurringSchedule['dayOfWeek']  ?? 1),
                        'dayOfMonth' => (int)       ($recurringSchedule['dayOfMonth'] ?? 1),
                        'pinMonth'   => (int)       ($recurringSchedule['pinMonth']   ?? 1),
                        'time'       => (string)    ($recurringSchedule['time']       ?? '09:00'),
                    ];
                }

                // If the dynamic-data snippet exists
                if ($dynamicData !== null) {
                    // Copy it to the config
                    $eventConfig['dynamicData'] = (string) $dynamicData;
                }

            }

            // Whether this is a console request
            $isConsole = $request->getIsConsoleRequest();

            // Get the acting user
            $user = ($isConsole ? null : Craft::$app->getUser());

            // Whether the user may edit each wiring tab. Console saves have no
            // forged-POST vector, so treat them as editable
            $canEditEvent      = ($isConsole || $user->checkPermission('notifier-editEventTab'));
            $canEditMessage    = ($isConsole || $user->checkPermission('notifier-editMessageTab'));
            $canEditRecipients = ($isConsole || $user->checkPermission('notifier-editRecipientsTab'));

            // If the user may edit the Event tab, apply its values
            if ($canEditEvent) {
                $record->eventType   = $eventType   ?? $this->eventType;
                $record->event       = $event       ?? $this->event;
                $record->eventConfig = $eventConfig ?? $this->eventConfig;
            }

            // If the user may edit the Message tab, apply its values
            if ($canEditMessage) {
                $record->messageType   = $messageType   ?? $this->messageType;
                $record->messageConfig = $messageConfig ?? $this->messageConfig;
            }

            // If the user may edit the Recipients tab, apply its values
            if ($canEditRecipients) {
                $record->recipientsType   = $recipientsType   ?? $this->recipientsType;
                $record->recipientsConfig = $recipientsConfig ?? $this->recipientsConfig;
            }

            // Normalize the queue lightswitch ('1' / '') into a boolean
            $record->queue = (null !== $queue)
                ? ('1' === $queue || 1 === $queue || true === $queue)
                : $this->queue;

            // Save the notification
            $record->save(false);

            // Sync the Event Type from the just-saved record
            $this->eventType = $record->eventType;

            // Sync the Event from the just-saved record
            $this->event = $record->event;

            // Sync the eventConfig, normalizing to an array if the record holds a JSON string
            $this->eventConfig = is_array($record->eventConfig)
                ? $record->eventConfig
                : (json_decode((string) $record->eventConfig, true) ?: []);

            // Ensure scheduled notifications have a schedule tracking row
            $this->_ensureScheduleTracking($record->event);

            // Ensure report notifications have an up-to-date tracking row
            $this->_ensureReportTracking();

            // Ensure feed notifications are seeded against their current Feed URL
            $this->_ensureFeedSeeding($oldEventType, $oldFeedUrl);

            // Ensure the notification is placed in the manual order
            $this->_ensureStructurePlacement();
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

        // Date-reached tracking table
        $table = '{{%notifier_trackdates}}';

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
        // If this is a draft or revision, bail
        if ($this->getIsDraft() || $this->getIsRevision()) {
            return;
        }

        // If this isn't currently a feed notification, bail
        if ('feed' !== $this->eventType) {
            return;
        }

        // Get the current Feed URL
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

            // Attempt the initial seed
            NotifierPlugin::getInstance()->feedRunner->seedNotification($this);
        } catch (Throwable $e) {
            // Get a feed scan parent for this failure
            $envelopeId = $this->log->feedScan($newFeedUrl);

            // Log the failure as a warning, but don't block the save
            $this->log->warning(Craft::t('notifier',
                '[FEED ERROR] Initial feed scan failed: {message}',
                ['message' => $e->getMessage()]
            ), $envelopeId);
        }
    }

    /**
     * Keep the report tracking row in sync after a save.
     *
     * @return void
     */
    private function _ensureReportTracking(): void
    {
        // If this is a draft or revision, bail
        if ($this->getIsDraft() || $this->getIsRevision()) {
            return;
        }

        // Get the plugin instance
        $plugin = NotifierPlugin::getInstance();

        // Whether this is a report notification with a recurring schedule
        $isRecurring = $this->isReportType() && (bool) ($this->eventConfig['recurring'] ?? false);

        // If not a recurring notification, drop any stale tracking row
        if (!$isRecurring) {
            $plugin->systemSnapshotRunner->wipeTracking($this->id);
            return;
        }

        // Seed (or recompute) the tracking row via the matching runner
        if ('system-snapshot' === $this->eventType) {
            $plugin->systemSnapshotRunner->seedNotification($this);
        } else {
            $plugin->dynamicDataRunner->seedNotification($this);
        }
    }

    /**
     * Ensure the notification has a place in the manual-order structure.
     *
     * @return void
     */
    private function _ensureStructurePlacement(): void
    {
        // If this is a draft or revision, bail
        if ($this->getIsDraft() || $this->getIsRevision()) {
            return;
        }

        // Get the structure that backs the manual order
        $structureId = NotificationStructure::getStructureId();

        // If the structure can't be resolved, bail
        if (!$structureId) {
            return;
        }

        // If already placed in the structure, bail
        if ($this->_isInStructure($structureId)) {
            return;
        }

        // Get the structures service
        $structures = Craft::$app->getStructures();

        // Get the configured default placement
        /** @var Settings $settings */
        $settings = NotifierPlugin::$plugin->getSettings();

        // If placing at the beginning, add before the others
        if (Settings::DEFAULT_PLACEMENT_BEGINNING === $settings->defaultPlacement) {
            $structures->prependToRoot($structureId, $this, Structures::MODE_INSERT);
            return;
        }

        // Otherwise add after the others
        $structures->appendToRoot($structureId, $this, Structures::MODE_INSERT);
    }

    /**
     * Whether this notification is already placed in the manual-order structure.
     *
     * @param int $structureId The structure that backs the manual order.
     * @return bool Whether a structure element row exists for this notification.
     */
    private function _isInStructure(int $structureId): bool
    {
        // Whether a matching structure element row exists
        return (new Query())
            ->from([Table::STRUCTUREELEMENTS])
            ->where([
                'structureId' => $structureId,
                'elementId' => $this->id,
            ])
            ->exists();
    }

}
