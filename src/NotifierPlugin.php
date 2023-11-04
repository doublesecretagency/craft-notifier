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

namespace doublesecretagency\notifier;

use Craft;
use craft\base\Plugin;
use craft\events\PluginEvent;
use craft\events\RegisterComponentTypesEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\events\SetElementTableAttributeHtmlEvent;
use craft\helpers\UrlHelper;
use craft\services\Elements;
use craft\services\Plugins;
use craft\services\Utilities;
use craft\web\twig\variables\CraftVariable;
use craft\web\UrlManager;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\enums\Options;
//use doublesecretagency\notifier\utilities\LogUtility;
use doublesecretagency\notifier\services\Events;
use doublesecretagency\notifier\services\Messages;
use doublesecretagency\notifier\variables\Notifier as NotifierVariable;
use doublesecretagency\notifier\web\twig\Extension;
use yii\base\Event;

/**
 * Notifier plugin
 * @since 1.0.0
 *
 * @property Events $events
 * @property Messages $messages
 */
class NotifierPlugin extends Plugin
{

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
        ]);

        // Redirect after plugin is installed
        $this->_postInstallRedirect();

        // If plugin isn't installed yet, bail
        if (!$this->isInstalled) {
            return;
        }

        // Register components
        $this->_registerElementTypes();
        $this->_registerVariables();

        // Register enhancements for the control panel
        if (Craft::$app->getRequest()->getIsCpRequest()) {
            $this->_registerCpRoutes();
//            $this->_registerUtilities();
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
     * Register variables.
     */
    private function _registerVariables(): void
    {
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            static function (Event $event) {
                $variable = $event->sender;
                $variable->set('notifier', NotifierVariable::class);
            }
        );
    }

    /**
     * Register control panel routes.
     */
    private function _registerCpRoutes(): void
    {
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            static function (RegisterUrlRulesEvent $event) {
                // Notifications
                $event->rules['notifications']          = ['template' => 'notifier/notifications/_index'];
                $event->rules['notifications/new']      = ['template' => 'notifier/notifications/_edit'];
                $event->rules['notifications/<id:\d+>'] = ['template' => 'notifier/notifications/_edit'];
            }
        );
    }

//    /**
//     * Register utilities.
//     */
//    private function _registerUtilities(): void
//    {
//        Event::on(
//            Utilities::class,
//            Utilities::EVENT_REGISTER_UTILITY_TYPES,
//            static function (RegisterComponentTypesEvent $event) {
//                // Add logging utility
//                $event->types[] = LogUtility::class;
//            }
//        );
//    }

    /**
     * Register index table attributes.
     */
    private function _registerTableAttributes(): void
    {
        Event::on(
            Notification::class,
            Notification::EVENT_SET_TABLE_ATTRIBUTE_HTML,
            static function (SetElementTableAttributeHtmlEvent $event) {

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
                        // Attempt to display proper label of Recipients Type
                        $event->html = Options::RECIPIENTS_TYPE[$notification->recipientsType] ?? $notification->recipientsType;
                        break;

                }

            }
        );
    }

}
