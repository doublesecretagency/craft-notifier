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

namespace doublesecretagency\notifier;

use Craft;
use craft\base\Model;
use craft\base\Plugin;
use craft\events\PluginEvent;
use craft\events\RegisterComponentTypesEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\events\RegisterUserPermissionsEvent;
use craft\helpers\UrlHelper;
use craft\services\Elements;
use craft\services\Plugins;
use craft\services\UserPermissions;
use craft\services\Utilities;
use craft\web\UrlManager;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\enums\Options;
use doublesecretagency\notifier\helpers\Compat;
use doublesecretagency\notifier\models\Dispatch;
use doublesecretagency\notifier\models\Settings;
use doublesecretagency\notifier\services\Events;
use doublesecretagency\notifier\services\Messages;
use doublesecretagency\notifier\services\Recipients;
use doublesecretagency\notifier\utilities\NotificationLog;
use doublesecretagency\notifier\web\twig\Extension;
use yii\base\Event;

/**
 * Notifier plugin
 * @since 1.0.0
 *
 * @property Events $events
 * @property Messages $messages
 * @property Recipients $recipients
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
    public string $schemaVersion = '1.0.0';

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
     * @var Dispatch|null Transient pointer to the Dispatch currently resolving Dynamic Recipients.
     *
     * Set by `Dispatch::parseDynamicRecipientSnippet()` immediately before the
     * Twig parse and cleared in its `finally` clause. The `{% setRecipients %}`
     * Twig tag reads this pointer (via its compiled node output) to know where
     * to deposit items; if null, the tag's compiled code silently no-ops.
     * Keeping the collector on the active Dispatch (rather than globally on the
     * plugin) isolates queue-worker reuse, re-entrant notifications, and
     * accidental tag invocations from message bodies.
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
        ]);

        // Redirect after plugin is installed
        $this->_postInstallRedirect();

        // If plugin isn't installed yet, bail
        if (!$this->isInstalled) {
            return;
        }

        // Register components
        $this->_registerElementTypes();

        // Register user permissions
        $this->_registerUserPermissions();

        // Register enhancements for the control panel
        if (Craft::$app->getRequest()->getIsCpRequest()) {
            $this->_registerCpRoutes();
            $this->_registerUtilities();
            $this->_registerTableAttributes();
        }

        // Load Twig extension
        Craft::$app->getView()->registerTwigExtension(new Extension());

        // Register all notification events
        $this->events->registerNotificationEvents();
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
    protected function settingsHtml(): ?string
    {
        // Get data from config file
        $configFile = Craft::$app->getConfig()->getConfigFromFile('notifier');

        // Load plugin settings template
        return Craft::$app->getView()->renderTemplate('notifier/settings', [
            'configFile' => $configFile,
            'settings' => $this->getSettings(),
        ]);
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
     * After the plugin has been installed,
     * redirect to the Notifications page.
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
                // Redirect to the Notifications page (with a welcome message)
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
     * Register user permissions for the plugin.
     *
     * Exposes a "Notifier" heading in the CP user-group permissions screen
     * with two sibling subtrees:
     *
     * - "View notifications" (root) governing the Notification element type:
     *   "Save notifications" nests beneath it, with "Use the Dynamic
     *   Recipients type" nested even deeper since authoring arbitrary Twig
     *   snippets is a privileged action. "Delete notifications" sits at the
     *   same level as "Save notifications".
     * - "View notification log" (root) governing the audit-trail surface:
     *   "Delete notification log" nests beneath it. Kept separate from the
     *   notification subtree so site auditors can read the log without being
     *   able to alter notification configuration, and vice versa.
     *
     * @return void
     */
    private function _registerUserPermissions(): void
    {
        Event::on(
            UserPermissions::class,
            UserPermissions::EVENT_REGISTER_PERMISSIONS,
            static function (RegisterUserPermissionsEvent $event) {
                // Register the plugin's permissions under a "Notifier" heading
                $event->permissions[] = [
                    'heading' => Craft::t('notifier', 'Notifier'),
                    'permissions' => [
                        'notifier-viewNotifications' => [
                            'label' => Craft::t('notifier', 'View notifications'),
                            'nested' => [
                                'notifier-saveNotifications' => [
                                    'label' => Craft::t('notifier', 'Save notifications'),
                                    'nested' => [
                                        'notifier-editDynamicRecipients' => [
                                            'label' => Craft::t('notifier', 'Use the Dynamic Recipients type'),
                                        ],
                                    ],
                                ],
                                'notifier-deleteNotifications' => [
                                    'label' => Craft::t('notifier', 'Delete notifications'),
                                ],
                            ],
                        ],
                        'notifier-viewNotificationLog' => [
                            'label' => Craft::t('notifier', 'View notification log'),
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
            }
        );
    }

    /**
     * Register utilities.
     *
     * The Notification Log utility is hidden entirely when `loggingEnabled`
     * is false. When enabled, it is gated behind the
     * `notifier-viewNotificationLog` permission. Unpermissioned users (and
     * users with no current identity) won't see the utility appear in the
     * CP utilities listing at all. Admins always see it via the parent
     * canView() bypass on the user model.
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
     */
    private function _registerTableAttributes(): void
    {
        // Pick the correct event name for the active Craft version
        // (Craft 5: 'defineAttributeHtml', Craft 4: 'setTableAttributeHtml')
        // Closure parameter is untyped because the event class itself was
        // renamed (DefineAttributeHtmlEvent vs SetElementTableAttributeHtmlEvent).
        // Both expose the same `$event->html`, `$event->attribute`, `$event->sender` shape.
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
                        if ('announcement' === $notification->messageType) {
                            // For announcements
                            $adminsOnly = ($notification->recipientsConfig['adminsOnly'] ?? false);
                            $event->html = ($adminsOnly ? 'Admins Only' : 'All CP Users');
                        } else if ('flash' === $notification->messageType) {
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

}
