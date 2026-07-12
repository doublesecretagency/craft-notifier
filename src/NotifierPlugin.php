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

namespace doublesecretagency\notifier;

use Craft;
use craft\base\Element;
use craft\base\ElementInterface;
use craft\base\Model;
use craft\base\Plugin;
use craft\commerce\elements\Order;
use craft\commerce\elements\Product as CommerceProduct;
use craft\digitalproducts\elements\License;
use craft\digitalproducts\elements\Product as DigitalProduct;
use craft\elements\Asset;
use craft\elements\Entry;
use craft\elements\User;
use craft\events\DefineHtmlEvent;
use craft\events\DefineMenuItemsEvent;
use craft\events\PluginEvent;
use craft\events\RegisterComponentTypesEvent;
use craft\events\RegisterElementActionsEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\events\RegisterUserPermissionsEvent;
use craft\helpers\Html;
use craft\helpers\UrlHelper;
use craft\services\Elements;
use craft\services\Plugins;
use craft\services\UserPermissions;
use craft\elements\conditions\LanguageConditionRule;
use craft\elements\conditions\LevelConditionRule;
use craft\elements\conditions\SlugConditionRule;
use craft\elements\conditions\StatusConditionRule;
use craft\elements\conditions\TitleConditionRule;
use craft\elements\conditions\UriConditionRule;
use craft\elements\conditions\entries\ExpiryDateConditionRule;
use craft\elements\conditions\entries\PostDateConditionRule;
use craft\elements\conditions\entries\SectionConditionRule;
use craft\elements\conditions\entries\TypeConditionRule;
use craft\fields\conditions\CountryFieldConditionRule;
use craft\fields\conditions\DateFieldConditionRule;
use craft\fields\conditions\EmptyFieldConditionRule;
use craft\fields\conditions\GeneratedFieldConditionRule;
use craft\fields\conditions\LightswitchFieldConditionRule;
use craft\fields\conditions\LinkFieldConditionRule;
use craft\fields\conditions\MoneyFieldConditionRule;
use craft\fields\conditions\NumberFieldConditionRule;
use craft\fields\conditions\OptionsFieldConditionRule;
use craft\fields\conditions\RelationalFieldConditionRule;
use craft\fields\conditions\TextFieldConditionRule;
use craft\services\Utilities;
use craft\web\UrlManager;
use doublesecretagency\notifier\conditions\NotifierEntryCondition;
use doublesecretagency\notifier\conditions\attributes\NotifierExpiryDateConditionRule;
use doublesecretagency\notifier\conditions\attributes\NotifierLanguageConditionRule;
use doublesecretagency\notifier\conditions\attributes\NotifierLevelConditionRule;
use doublesecretagency\notifier\conditions\attributes\NotifierPostDateConditionRule;
use doublesecretagency\notifier\conditions\attributes\NotifierSectionConditionRule;
use doublesecretagency\notifier\conditions\attributes\NotifierSlugConditionRule;
use doublesecretagency\notifier\conditions\attributes\NotifierStatusConditionRule;
use doublesecretagency\notifier\conditions\attributes\NotifierTitleConditionRule;
use doublesecretagency\notifier\conditions\attributes\NotifierTypeConditionRule;
use doublesecretagency\notifier\conditions\attributes\NotifierUriConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierCountryFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierDateFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierEmptyFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierGeneratedFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierLightswitchFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierLinkFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierMoneyFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierNumberFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierOptionsFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierRelationalFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierTextFieldConditionRule;
use doublesecretagency\notifier\elements\actions\SendNotification;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\enums\Options;
use doublesecretagency\notifier\helpers\Compat;
use doublesecretagency\notifier\models\Dispatch;
use doublesecretagency\notifier\models\Settings;
use doublesecretagency\notifier\services\DynamicDataRunner;
use doublesecretagency\notifier\services\Events;
use doublesecretagency\notifier\services\FieldLayouts;
use doublesecretagency\notifier\services\LinkedinConnections;
use doublesecretagency\notifier\services\Messages;
use doublesecretagency\notifier\services\Recipients;
use doublesecretagency\notifier\services\FeedRunner;
use doublesecretagency\notifier\services\ScheduleRunner;
use doublesecretagency\notifier\services\SystemSnapshotRunner;
use doublesecretagency\notifier\utilities\NotificationLog;
use doublesecretagency\notifier\web\twig\Extension;
use Solspace\Calendar\Elements\Event as CalendarEvent;
use yii\base\Event;

/**
 * Main plugin class that boots Notifier.
 *
 * @since 1.0.0
 *
 * @property Events $events
 * @property Messages $messages
 * @property Recipients $recipients
 * @property FieldLayouts $fieldLayouts
 * @property ScheduleRunner $scheduleRunner
 * @property FeedRunner $feedRunner
 * @property SystemSnapshotRunner $systemSnapshotRunner
 * @property DynamicDataRunner $dynamicDataRunner
 * @property LinkedinConnections $linkedinConnections
 */
class NotifierPlugin extends Plugin
{

    /**
     * @var bool The plugin has a settings page.
     */
    public bool $hasCpSettings = true;

    /**
     * @var string Current schema version of the plugin.
     */
    public string $schemaVersion = '3.2.0';

    /**
     * @var NotifierPlugin Self-referential plugin property.
     */
    public static NotifierPlugin $plugin;

    /**
     * @var bool The plugin has a section with subpages.
     */
    public bool $hasCpSection = true;

    /**
     * @var array A list of recently sent messages.
     */
    public array $sent = [];

    /**
     * @var Dispatch|null Transient pointer to the Dispatch currently parsing Dynamic Data.
     *
     * Set around the Twig parse so the `{% setData %}` tag knows where to deposit data.
     */
    public ?Dispatch $activeDispatchForData = null;

    /**
     * @var Dispatch|null Transient pointer to the Dispatch currently parsing media.
     *
     * Set around the Twig parse so the `{% setMedia %}` tag knows where to deposit media items.
     */
    public ?Dispatch $activeDispatchForMedia = null;

    /**
     * @var Dispatch|null Transient pointer to the Dispatch currently parsing Dynamic Recipients.
     *
     * Set around the Twig parse so the `{% setRecipients %}` tag knows where to deposit recipients.
     */
    public ?Dispatch $activeDispatchForRecipients = null;

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        self::$plugin = $this;

        // Load plugin components
        $this->setComponents([
            'events' => Events::class,
            'messages' => Messages::class,
            'recipients' => Recipients::class,
            'scheduleRunner' => ScheduleRunner::class,
            'feedRunner' => FeedRunner::class,
            'systemSnapshotRunner' => SystemSnapshotRunner::class,
            'dynamicDataRunner' => DynamicDataRunner::class,
            'linkedinConnections' => LinkedinConnections::class,
            'fieldLayouts' => FieldLayouts::class,
        ]);

        // Redirect after plugin is installed
        $this->_postInstallRedirect();

        // If plugin isn't installed yet, bail
        if (!$this->isInstalled) {
            return;
        }

        // Register element types
        $this->_registerElementTypes();

        // Register user permissions
        $this->_registerUserPermissions();

        // Register project config event handlers for web and console applies
        $this->_registerProjectConfigEventHandlers();

        // Register enhancements for the control panel
        if (Craft::$app->getRequest()->getIsCpRequest()) {
            $this->_registerCpRoutes();
            $this->_registerUtilities();
            $this->_registerTableAttributes();
            $this->_registerElementActions();

            // If running Craft 5
            if (Compat::isCraft5()) {
                // Craft 5: Add buttons to the disclosure action menu
                $this->_registerActionMenuItems();
            } else {
                // Craft 4: Add buttons to the element edit screen
                $this->_registerAdditionalButtons();
            }
        }

        // Load Twig extension
        Craft::$app->getView()->registerTwigExtension(new Extension());

        // Register all notification events
        $this->events->registerNotificationEvents();

        // Register Notifier-scoped condition rules
        $this->_registerConditionRules();
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): ?Model
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    public function getSettingsResponse(): mixed
    {
        return Craft::$app->getResponse()->redirect(
            UrlHelper::cpUrl('settings/plugins/notifier/general')
        );
    }

    /**
     * @inheritdoc
     */
    public function getCpNavItem(): ?array
    {
        $item = parent::getCpNavItem();

        // Change label and URL of nav item
        $item['label'] = 'Notifications';
        $item['url'] = 'notifications';

        return $item;
    }

    // ========================================================================= //

    /**
     * Redirect to the Notifications page after the plugin is installed.
     *
     * @return void
     */
    private function _postInstallRedirect(): void
    {
        // After the plugin has been installed
        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            static function (PluginEvent $event) {
                // If installed plugin isn't Notifier, bail
                if ('notifier' !== $event->plugin->handle) {
                    return;
                }

                // If installed via console, no need for a redirect
                if (Craft::$app->getRequest()->getIsConsoleRequest()) {
                    return;
                }

                // Redirect to the Notifications page
                $url = UrlHelper::cpUrl('notifications', ['welcome' => 1]);
                Craft::$app->getResponse()->redirect($url)->send();
            }
        );
    }

    // ========================================================================= //

    /**
     * Register element types.
     *
     * @return void
     */
    private function _registerElementTypes(): void
    {
        Event::on(
            Elements::class,
            Elements::EVENT_REGISTER_ELEMENT_TYPES,
            static function (RegisterComponentTypesEvent $event) {
                $event->types[] = Notification::class;
            }
        );
    }

    /**
     * Register user permissions.
     *
     * @return void
     */
    private function _registerUserPermissions(): void
    {
        Event::on(
            UserPermissions::class,
            UserPermissions::EVENT_REGISTER_PERMISSIONS,
            static function (RegisterUserPermissionsEvent $event) {

                // Get the warning shared by both Dynamic types
                $twigWarning = Craft::t('notifier', 'Runs custom Twig code when a message is sent. Only grant this to highly trusted users!');

                // Register the plugin's permissions under a "Notifier" heading
                $event->permissions[] = [
                    'heading' => Craft::t('notifier', 'Notifier'),
                    'permissions' => [
                        'notifier-viewNotifications' => [
                            'label' => Craft::t('notifier', 'View notifications'),
                            'info' => Craft::t('notifier', 'Adds "Notifications" to the control panel navigation.'),
                            'nested' => [
                                'notifier-saveNotifications' => [
                                    'label' => Craft::t('notifier', 'Save notifications'),
                                    'nested' => [
                                        'notifier-editEventTab' => [
                                            'label' => Craft::t('notifier', 'Edit the Event tab'),
                                            'nested' => [
                                                'notifier-editDynamicData' => [
                                                    'label' => Craft::t('notifier', 'Use the Dynamic Data type'),
                                                    'warning' => $twigWarning,
                                                ],
                                            ],
                                        ],
                                        'notifier-editMessageTab' => [
                                            'label' => Craft::t('notifier', 'Edit the Message tab'),
                                        ],
                                        'notifier-editRecipientsTab' => [
                                            'label' => Craft::t('notifier', 'Edit the Recipients tab'),
                                            'nested' => [
                                                'notifier-editDynamicRecipients' => [
                                                    'label' => Craft::t('notifier', 'Use the Dynamic Recipients type'),
                                                    'warning' => $twigWarning,
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                'notifier-testNotifications' => [
                                    'label' => Craft::t('notifier', 'Send test notifications'),
                                ],
                                'notifier-sendManualNotifications' => [
                                    'label' => Craft::t('notifier', 'Send manual notifications'),
                                ],
                                'notifier-deleteNotifications' => [
                                    'label' => Craft::t('notifier', 'Delete notifications'),
                                ],
                            ],
                        ],
                        'notifier-viewNotificationLog' => [
                            'label' => Craft::t('notifier', 'View notification log'),
                            'info' => Craft::t('notifier', 'Adds "Notification Log" to the control panel Utilities.'),
                            'nested' => [
                                'notifier-deleteNotificationLog' => [
                                    'label' => Craft::t('notifier', 'Delete notification log'),
                                ],
                            ],
                        ],
                    ],
                ];
            }
        );
    }

    /**
     * Register project config event handlers.
     *
     * @return void
     */
    private function _registerProjectConfigEventHandlers(): void
    {
        // Get the field layouts service
        $fieldLayouts = $this->fieldLayouts;

        // Rebuild the notification field layout whenever its project config changes
        Craft::$app->getProjectConfig()
            ->onAdd(FieldLayouts::PATH, [$fieldLayouts, 'handleChangedLayout'])
            ->onUpdate(FieldLayouts::PATH, [$fieldLayouts, 'handleChangedLayout'])
            ->onRemove(FieldLayouts::PATH, [$fieldLayouts, 'handleChangedLayout']);
    }

    /**
     * Register control panel routes.
     *
     * @return void
     */
    private function _registerCpRoutes(): void
    {
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            static function (RegisterUrlRulesEvent $event) {
                // Index
                $event->rules['notifications'] = ['template' => 'notifier/notifications/_index'];

                // New Notification
                $event->rules['notifications/new'] = 'notifier/notifications/create';

                // Edit Notification
                $event->rules['notifications/<notificationId:\d+>'] = 'notifier/notifications/edit';

                // Settings sub-pages
                $event->rules['settings/plugins/notifier/general']  = 'notifier/settings-providers/general';
                $event->rules['settings/plugins/notifier/fields']   = 'notifier/settings-fields/fields';
                $event->rules['settings/plugins/notifier/twilio']   = 'notifier/settings-providers/twilio';
                $event->rules['settings/plugins/notifier/pushover'] = 'notifier/settings-providers/pushover';
                $event->rules['settings/plugins/notifier/ntfy']     = 'notifier/settings-providers/ntfy';
                $event->rules['settings/plugins/notifier/slack']    = 'notifier/settings-providers/slack';
                $event->rules['settings/plugins/notifier/discord']  = 'notifier/settings-providers/discord';
                $event->rules['settings/plugins/notifier/facebook']  = 'notifier/settings-providers/facebook';
                $event->rules['settings/plugins/notifier/instagram'] = 'notifier/settings-providers/instagram';
                $event->rules['settings/plugins/notifier/x-twitter'] = 'notifier/settings-providers/x-twitter';
                $event->rules['settings/plugins/notifier/bluesky']  = 'notifier/settings-providers/bluesky';
                $event->rules['settings/plugins/notifier/mastodon'] = 'notifier/settings-providers/mastodon';
                $event->rules['settings/plugins/notifier/linkedin'] = 'notifier/settings-providers/linkedin';
                $event->rules['settings/plugins/notifier/mqtt']     = 'notifier/settings-providers/mqtt';
            }
        );
    }

    /**
     * Register utilities.
     *
     * @return void
     */
    private function _registerUtilities(): void
    {
        // Pick the correct event name for the active Craft version
        // (Craft 5: 'registerUtilities', Craft 4: 'registerUtilityTypes')
        Event::on(
            Utilities::class,
            Compat::utilitiesEventName(),
            static function (RegisterComponentTypesEvent $event) {
                // If logging is disabled, hide the utility entirely
                if (!NotifierPlugin::$plugin->getSettings()->loggingEnabled) {
                    return;
                }

                // Get the current user
                $user = Craft::$app->getUser()->getIdentity();

                // If no current user, bail
                if (!$user) {
                    return;
                }

                // If the user can't view the log, bail
                if (!$user->admin && !$user->can('notifier-viewNotificationLog')) {
                    return;
                }

                // Add logging utility
                $event->types[] = NotificationLog::class;
            }
        );
    }

    /**
     * Register index table attributes.
     *
     * @return void
     */
    private function _registerTableAttributes(): void
    {
        // Event name + class name both differ between Craft 4 and 5; closure stays untyped
        // so the same handler covers DefineAttributeHtmlEvent and SetElementTableAttributeHtmlEvent
        Event::on(
            Notification::class,
            Compat::defineAttributeHtmlEventName(),
            static function ($event) {

                /** @var Notification $notification */
                $notification = $event->sender;

                // Render attribute of each column
                switch ($event->attribute) {

                    case 'eventType':
                        // Attempt to display proper label of Event Type
                        $event->html = Options::EVENT_TYPE[$notification->eventType] ?? $notification->eventType;
                        break;

                    case 'event':
                        // Report event types show their schedule state
                        if ($notification->isReportType()) {
                            $event->html = ($notification->eventConfig['recurring'] ?? false)
                                ? Craft::t('notifier', 'Generate report on a recurring schedule')
                                : Craft::t('notifier', 'Generate report on demand');
                            break;
                        }

                        // Get all events within specified type
                        $events = Options::ALL_EVENTS[$notification->eventType] ?? [];

                        // Filter through all events
                        $filtered = array_filter($events,
                            static function ($e) use ($notification) {
                                // Get the value of each potential event
                                $value = ($e['value'] ?? false);

                                // Return whether value matches selected event
                                return $value === $notification->event;
                            }
                        );

                        // Get the first (and only) matching event
                        $mainEvent = reset($filtered);

                        // Attempt to display proper label of Event
                        $event->html = $mainEvent['label'] ?? $notification->event;
                        break;

                    case 'messageType':
                        // Attempt to display proper label of Message Type
                        $event->html = Options::MESSAGE_TYPE[$notification->messageType] ?? $notification->messageType;
                        break;

                    case 'recipientsType':
                        // If a flash message, force the current-user recipient label
                        if ('flash' === $notification->messageType) {
                            // For flash messages
                            $event->html = Options::RECIPIENTS_TYPE['current-user'];
                        } else {
                            // Attempt to display proper label of Recipients Type
                            $event->html = Options::RECIPIENTS_TYPE[$notification->recipientsType] ?? $notification->recipientsType;
                        }
                        break;

                }

            }
        );
    }

    /**
     * Register the "Send Notification" bulk action on every supported element index.
     *
     * @return void
     */
    private function _registerElementActions(): void
    {
        // Map each supported element class to its Notifier event type
        $elementTypes = [
            Entry::class => 'entries',
            Asset::class => 'assets',
            User::class  => 'users',
        ];

        // If Craft Commerce is installed, map its order element
        if (class_exists(Order::class)) {
            $elementTypes[Order::class] = 'craft-commerce-orders';
        }

        // If Craft Commerce is installed, map its product element
        if (class_exists(CommerceProduct::class)) {
            $elementTypes[CommerceProduct::class] = 'craft-commerce-products';
        }

        // If Digital Products is installed, map its product and license elements
        if (class_exists(DigitalProduct::class)) {
            $elementTypes[DigitalProduct::class] = 'digital-products-products';
            $elementTypes[License::class] = 'digital-products-licenses';
        }

        // If Solspace Calendar is installed, map its event element
        if (class_exists(CalendarEvent::class)) {
            $elementTypes[CalendarEvent::class] = 'solspace-calendar-events';
        }

        // Register a "Send Notification" bulk action for each element type
        foreach ($elementTypes as $elementClass => $eventType) {
            Event::on(
                $elementClass,
                Element::EVENT_REGISTER_ACTIONS,
                static function (RegisterElementActionsEvent $event) use ($eventType) {
                    // Get the current user
                    $user = Craft::$app->getUser()->getIdentity();

                    // If the user can't send manual notifications, bail
                    if (!$user || !$user->can('notifier-sendManualNotifications')) {
                        return;
                    }

                    // Whether any manually triggered notifications exist for this type
                    $exists = Notification::find()
                        ->where([
                            'eventType' => $eventType,
                            'event' => 'manually-triggered',
                        ])
                        ->exists();

                    // If none exist, bail
                    if (!$exists) {
                        return;
                    }

                    // Append the "Send Notification" bulk action
                    $event->actions[] = [
                        'type' => SendNotification::class,
                        'notifierEventType' => $eventType,
                    ];
                }
            );
        }
    }

    /**
     * Register the "Send Notification" item on every supported element's action menu.
     *
     * Craft 5 only; the disclosure action menu does not exist in Craft 4.
     *
     * @return void
     */
    private function _registerActionMenuItems(): void
    {
        Event::on(
            Element::class,
            Element::EVENT_DEFINE_ACTION_MENU_ITEMS,
            static function (DefineMenuItemsEvent $event) {
                // Get the current user
                $user = Craft::$app->getUser()->getIdentity();

                // If the user can't send manual notifications, bail
                if (!$user || !$user->can('notifier-sendManualNotifications')) {
                    return;
                }

                // Get the element whose action menu is being built
                $element = $event->sender;

                // If the element isn't a saved element, bail
                if (!($element instanceof ElementInterface) || !$element->id) {
                    return;
                }

                // Get all manually triggered notifications which apply to this element
                $notifications = NotifierPlugin::$plugin->messages->getManualNotifications($element);

                // If none apply, append nothing
                if (!$notifications) {
                    return;
                }

                // Always fire against the canonical element, never a provisional draft
                $elementId = $element->getCanonicalId();

                // Confirmation shown before any notification is dispatched
                $confirm = Craft::t('notifier', 'Are you sure you want to send this notification?');

                // Generic error shown if the request fails outright
                $error = Craft::t('app', 'A server error occurred.');

                // Get the view service
                $view = Craft::$app->getView();

                // Append one menu item per applicable notification
                foreach ($notifications as $notification) {
                    // Unique DOM id for this menu item
                    $itemId = sprintf('notifier-send-%s', mt_rand());

                    // Label distinguishes multiple manual triggers on the same element
                    $label = $notification->getManualTriggerLabel();

                    // Append the menu item
                    $event->items[] = [
                        'id' => $itemId,
                        'icon' => $notification->getMessageTypeIcon(),
                        'label' => $label,
                    ];

                    // Wire the item to POST the manual-send action on activation
                    $view->registerJsWithVars(static fn($id, $notificationId, $eId, $confirmMsg, $errorMsg) => <<<JS
(() => {
    const btn = $('#' + $id);
    btn.on('activate', () => {
        if (!window.confirm($confirmMsg)) {
            return;
        }
        Craft.sendActionRequest('POST', 'notifier/notifications/send-manual', {
            data: {notificationId: $notificationId, elementId: $eId},
        }).then((response) => {

            // Get the response data
            const data = (response.data || {});

            // If the send succeeded, display a notice
            if (data.success) {
                Craft.cp.displayNotice(data.message);
            } else {
                Craft.cp.displayError(data.message);
            }
        }).catch(() => {
            Craft.cp.displayError($errorMsg);
        });
    });
})();
JS, [
                        $view->namespaceInputId($itemId),
                        (int) $notification->id,
                        (int) $elementId,
                        $confirm,
                        $error,
                    ]);
                }
            }
        );
    }

    /**
     * Register a "Send Notification" button on every supported element's edit screen.
     *
     * Craft 4 fallback for the disclosure action menu, which only exists in Craft 5.
     *
     * @return void
     */
    private function _registerAdditionalButtons(): void
    {
        Event::on(
            Element::class,
            Element::EVENT_DEFINE_ADDITIONAL_BUTTONS,
            static function (DefineHtmlEvent $event) {
                // Get the current user
                $user = Craft::$app->getUser()->getIdentity();

                // If the user can't send manual notifications, bail
                if (!$user || !$user->can('notifier-sendManualNotifications')) {
                    return;
                }

                // Get the element whose edit screen is being built
                $element = $event->sender;

                // If the element isn't a saved element, bail
                if (!($element instanceof ElementInterface) || !$element->id) {
                    return;
                }

                // Get all manually triggered notifications which apply to this element
                $notifications = NotifierPlugin::$plugin->messages->getManualNotifications($element);

                // If none apply, append nothing
                if (!$notifications) {
                    return;
                }

                // Always fire against the canonical element, never a provisional draft
                $elementId = $element->getCanonicalId();

                // Confirmation shown before any notification is dispatched
                $confirm = Craft::t('notifier', 'Are you sure you want to send this notification?');

                // Generic error shown if the request fails outright
                $error = Craft::t('app', 'A server error occurred.');

                // Get the view service
                $view = Craft::$app->getView();

                // Append one button per applicable notification, since the header HTML is not namespaced
                foreach ($notifications as $notification) {
                    // Unique DOM id for this button
                    $buttonId = sprintf('notifier-send-%s', mt_rand());

                    // Label distinguishes multiple manual triggers on the same element
                    $label = $notification->getManualTriggerLabel();

                    // Render the button into the edit screen header
                    $event->html .= Html::tag('button', Html::encode($label), [
                        'id' => $buttonId,
                        'type' => 'button',
                        'class' => 'btn',
                    ]);

                    // Wire the button to POST the manual-send action on click
                    $view->registerJsWithVars(static fn($id, $notificationId, $eId, $confirmMsg, $errorMsg) => <<<JS
(() => {
    const btn = $('#' + $id);
    btn.on('click', () => {
        if (!window.confirm($confirmMsg)) {
            return;
        }
        Craft.sendActionRequest('POST', 'notifier/notifications/send-manual', {
            data: {notificationId: $notificationId, elementId: $eId},
        }).then((response) => {

            // Get the response data
            const data = (response.data || {});

            // If the send succeeded, display a notice
            if (data.success) {
                Craft.cp.displayNotice(data.message);
            } else {
                Craft.cp.displayError(data.message);
            }
        }).catch(() => {
            Craft.cp.displayError($errorMsg);
        });
    });
})();
JS, [
                        $buttonId,
                        (int) $notification->id,
                        (int) $elementId,
                        $confirm,
                        $error,
                    ]);
                }
            }
        );
    }

    // ========================================================================= //

    /**
     * Register Notifier-scoped element-condition rules.
     *
     * @return void
     */
    private function _registerConditionRules(): void
    {
        // Map every Craft per-field rule + supported native attribute rule
        // to its Notifier subclass so the `has changed` operator appears
        // in every applicable rule's dropdown
        $swaps = [
            // Per-field rules
            TextFieldConditionRule::class        => NotifierTextFieldConditionRule::class,
            LightswitchFieldConditionRule::class => NotifierLightswitchFieldConditionRule::class,
            NumberFieldConditionRule::class      => NotifierNumberFieldConditionRule::class,
            DateFieldConditionRule::class        => NotifierDateFieldConditionRule::class,
            OptionsFieldConditionRule::class     => NotifierOptionsFieldConditionRule::class,
            CountryFieldConditionRule::class     => NotifierCountryFieldConditionRule::class,
            RelationalFieldConditionRule::class  => NotifierRelationalFieldConditionRule::class,
            EmptyFieldConditionRule::class       => NotifierEmptyFieldConditionRule::class,
            // Native attribute rules
            TitleConditionRule::class            => NotifierTitleConditionRule::class,
            SlugConditionRule::class             => NotifierSlugConditionRule::class,
            UriConditionRule::class              => NotifierUriConditionRule::class,
            StatusConditionRule::class           => NotifierStatusConditionRule::class,
            LevelConditionRule::class            => NotifierLevelConditionRule::class,
            LanguageConditionRule::class         => NotifierLanguageConditionRule::class,
            PostDateConditionRule::class         => NotifierPostDateConditionRule::class,
            ExpiryDateConditionRule::class       => NotifierExpiryDateConditionRule::class,
            SectionConditionRule::class          => NotifierSectionConditionRule::class,
            TypeConditionRule::class             => NotifierTypeConditionRule::class,
        ];

        // Notifier subclasses for these extend Craft 5 only parent classes
        if (Compat::isCraft5()) {
            $swaps[MoneyFieldConditionRule::class]     = NotifierMoneyFieldConditionRule::class;
            $swaps[LinkFieldConditionRule::class]      = NotifierLinkFieldConditionRule::class;
            $swaps[GeneratedFieldConditionRule::class] = NotifierGeneratedFieldConditionRule::class;
        }

        // Get the property name carrying the rules array
        $rulesProp = Compat::conditionRulesPropertyName();

        // Closure stays untyped because event class differs between Craft 4 and 5
        Event::on(
            NotifierEntryCondition::class,
            Compat::conditionRulesEventName(),
            static function ($event) use ($swaps, $rulesProp) {
                // Loop through the rules array and rewrite each entry's `class` when it's
                // a Craft per-field rule we have a Notifier subclass for
                foreach ($event->{$rulesProp} as $i => $rule) {
                    // Get the rule's class
                    $class = (is_array($rule) ? ($rule['class'] ?? null) : $rule);

                    // If there's no swap for this class, skip it
                    if (!$class || !isset($swaps[$class])) {
                        continue;
                    }

                    // If the rule is an array, swap its class key; otherwise swap the string
                    if (is_array($rule)) {
                        $event->{$rulesProp}[$i]['class'] = $swaps[$class];
                    } else {
                        $event->{$rulesProp}[$i] = $swaps[$class];
                    }
                }
            }
        );
    }

}
