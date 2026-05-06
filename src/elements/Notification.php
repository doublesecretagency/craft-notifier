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

namespace doublesecretagency\notifier\elements;

use Craft;
use craft\base\Element;
use craft\elements\User;
use craft\elements\conditions\ElementConditionInterface;
use craft\helpers\UrlHelper;
use craft\models\FieldLayout;
use craft\web\CpScreenResponseBehavior;
use doublesecretagency\notifier\elements\conditions\NotificationCondition;
use doublesecretagency\notifier\elements\db\NotificationQuery;
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
use yii\base\Event;
use yii\base\Exception as BaseException;
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
     * @var string|null Type of message to send. (ie: email, text)
     */
    public ?string $messageType = null;

    /**
     * @var array Message configuration details.
     */
    public array $messageConfig = [];

    /**
     * @var string|null Type of recipients. (ie: Admins)
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
        ]);
    }

    /**
     * Ensure the saving user holds the `notifier-editDynamicRecipients` permission
     * when the Notification uses the Dynamic Recipients recipient type.
     *
     * The CP template hides the dropdown option from unpermitted users; this
     * server-side check catches crafted POSTs that bypass the UI gate.
     *
     * Skipped for non-CP requests (console commands, queue workers, programmatic
     * saves from other plugins) since those contexts have no user identity to
     * check against and are assumed trusted.
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

        // Otherwise require the save permission — drafts are an edit affordance
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

        // Scope to selected entry types when present, otherwise fall back to all layouts
        $layouts = $this->_resolveConditionFieldLayouts($forEventType);
        if ($layouts) {
            $condition->setFieldLayouts($layouts);
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

            // Get the notification record
            if (!$isNew) {
                $record = NotificationRecord::findOne($this->id);

                if (!$record) {
                    throw new BaseException('Invalid notification ID: '.$this->id);
                }
            } else {
                $record = new NotificationRecord();
                $record->id = $this->id;
            }

            // Get request service
            $request = Craft::$app->getRequest();

            // Get POST values
            $description      = $request->getBodyParam('description');
            $eventType        = $request->getBodyParam('eventType');
            $event            = $request->getBodyParam('event');
            $eventConfig      = $request->getBodyParam('eventConfig');
            $messageType      = $request->getBodyParam('messageType');
            $messageConfig    = $request->getBodyParam('messageConfig');
            $recipientsType   = $request->getBodyParam('recipientsType');
            $recipientsConfig = $request->getBodyParam('recipientsConfig');

            // Read only the active tab's condition (each tab posts its own per-type key)
            $selectedEventType = ($eventType ?? (string) $this->eventType);
            $eventCondition    = $request->getBodyParam("eventCondition_{$selectedEventType}");

            // Extract specific event
            $event = ($event[$eventType] ?? null);

            // Relocate the condition payload into eventConfig under the canonical key
            if ($eventCondition !== null) {
                if (!is_array($eventConfig)) {
                    $eventConfig = [];
                }
                $eventConfig['condition'] = $eventCondition;
            }

            // Save to the `notifier_notifications` table
            $record->description      = $description      ?? $this->description;
            $record->eventType        = $eventType        ?? $this->eventType;
            $record->event            = $event            ?? $this->event;
            $record->eventConfig      = $eventConfig      ?? $this->eventConfig;
            $record->messageType      = $messageType      ?? $this->messageType;
            $record->messageConfig    = $messageConfig    ?? $this->messageConfig;
            $record->recipientsType   = $recipientsType   ?? $this->recipientsType;
            $record->recipientsConfig = $recipientsConfig ?? $this->recipientsConfig;

            $record->save(false);
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

}
