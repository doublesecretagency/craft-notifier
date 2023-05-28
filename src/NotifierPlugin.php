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
use craft\events\RegisterComponentTypesEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\services\Elements;
use craft\services\Utilities;
use craft\web\twig\variables\CraftVariable;
use craft\web\UrlManager;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\Events;
use doublesecretagency\notifier\utilities\LogUtility;
use doublesecretagency\notifier\variables\Notifier as NotifierVariable;
use doublesecretagency\notifier\web\twig\Extension;
use yii\base\Event;

/**
 * Notifier plugin
 * @since 1.0.0
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
            $this->_registerUtilities();
        }

        // Load Twig extension
        Craft::$app->getView()->registerTwigExtension(new Extension());

        // Register all notification events
        Events::registerAll();
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

    /**
     * Register utilities.
     */
    private function _registerUtilities(): void
    {
        Event::on(
            Utilities::class,
            Utilities::EVENT_REGISTER_UTILITY_TYPES,
            static function (RegisterComponentTypesEvent $event) {
                // Add logging utility
                $event->types[] = LogUtility::class;
            }
        );
    }

}
