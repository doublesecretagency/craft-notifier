<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Get notified when things happen.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier;

use Craft;
use craft\base\Plugin;
use craft\elements\Entry;
use craft\events\ModelEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\helpers\Json;
use craft\web\UrlManager;
use doublesecretagency\notifier\records\Trigger;
use doublesecretagency\notifier\web\twig\Extension;
use yii\base\Event;

/**
 * Class NotifierPlugin
 * @since 1.0.0
 */
class NotifierPlugin extends Plugin
{

    /**
     * @var string Current schema version of the plugin.
     */
    public $schemaVersion = '0.0.0';

    /**
     * @var Plugin Self-referential plugin property.
     */
    public static $plugin;

    /**
     * @var bool The plugin has a section with subpages.
     */
    public $hasCpSection = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Load Twig extension
        Craft::$app->getView()->registerTwigExtension(new Extension());

        // Register all CP site routes
        $this->_registerCpRoutes();

        // Configure all notification triggers
        $this->_configureTriggers();
    }

    // ========================================================================= //

    /**
     * Register CP site routes.
     */
    private function _registerCpRoutes()
    {
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            static function(RegisterUrlRulesEvent $event) {
                // Set template paths
                $triggerTemplate = ['template' => 'notifier/_edit-trigger'];
                $messageTemplate = ['template' => 'notifier/_edit-message'];
                // Routes for editing Triggers
                $event->rules['notifier/trigger/new']             = $triggerTemplate;
                $event->rules['notifier/trigger/<triggerId:\d+>'] = $triggerTemplate;
                // Routes for editing Messages
                $event->rules['notifier/trigger/<triggerId:\d+>/message/new']             = $messageTemplate;
                $event->rules['notifier/trigger/<triggerId:\d+>/message/<messageId:\d+>'] = $messageTemplate;
            }
        );
    }

    // ========================================================================= //

    /**
     * Configure all notification triggers.
     */
    private function _configureTriggers()
    {
        // If plugin isn't installed yet, bail
        if (!$this->isInstalled) {
            return;
        }

        // Get all notification triggers
        $triggers = Trigger::find()->all();

        // Loop through all triggers
        foreach ($triggers as $trigger) {

            // Get config
            $config = $trigger->config;

            // Check if JSON is valid
            // Must use this function to validate (I know it's redundant)
            $valid = json_decode($config);

            // Convert config data to an array
            $config = ($valid ? Json::decode($config) : null);

            // Switch according to trigger event type
            switch ($trigger->event) {

                // When an Entry is saved
                case 'Entry::EVENT_AFTER_SAVE':
                    $this->_onEntrySave($config);
                    break;

            }

        }
    }

    // ========================================================================= //

    /**
     * Triggers when an Entry is saved.
     */
    private function _onEntrySave($config)
    {
        Event::on(
            Entry::class,
            Entry::EVENT_AFTER_SAVE,
            static function (ModelEvent $event) use ($config) {

                // Get entry
                /** @var Entry $entry */
                $entry = $event->sender;

                // If entry is just a draft, bail
                if ($entry->isDraft) {
                    return;
                }


                // $isNew = $event->isNew;
                // $section = $entry->getSection()->handle;

//                Craft::dd($entry);
//                Craft::dd($config);

            }
        );
    }

}
