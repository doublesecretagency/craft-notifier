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
use craft\base\conditions\BaseCondition;
use craft\events\PluginEvent;
use craft\events\RegisterComponentTypesEvent;
use craft\events\RegisterConditionRulesEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\events\RegisterUserPermissionsEvent;
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
                                'notifier-testNotifications' => [
                                    'label' => Craft::t('notifier', 'Test notifications'),
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
            MoneyFieldConditionRule::class       => NotifierMoneyFieldConditionRule::class,
            DateFieldConditionRule::class        => NotifierDateFieldConditionRule::class,
            OptionsFieldConditionRule::class     => NotifierOptionsFieldConditionRule::class,
            CountryFieldConditionRule::class     => NotifierCountryFieldConditionRule::class,
            LinkFieldConditionRule::class        => NotifierLinkFieldConditionRule::class,
            RelationalFieldConditionRule::class  => NotifierRelationalFieldConditionRule::class,
            EmptyFieldConditionRule::class       => NotifierEmptyFieldConditionRule::class,
            GeneratedFieldConditionRule::class   => NotifierGeneratedFieldConditionRule::class,
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

        Event::on(
            NotifierEntryCondition::class,
            BaseCondition::EVENT_REGISTER_CONDITION_RULES,
            static function (RegisterConditionRulesEvent $event) use ($swaps) {
                // Walk the rules array and rewrite each entry's `class` when it's
                // a Craft per-field rule we have a Notifier subclass for
                foreach ($event->conditionRules as $i => $rule) {
                    $class = (is_array($rule) ? ($rule['class'] ?? null) : $rule);
                    if (!$class || !isset($swaps[$class])) {
                        continue;
                    }
                    if (is_array($rule)) {
                        $event->conditionRules[$i]['class'] = $swaps[$class];
                    } else {
                        $event->conditionRules[$i] = $swaps[$class];
                    }
                }
            }
        );
    }

}
