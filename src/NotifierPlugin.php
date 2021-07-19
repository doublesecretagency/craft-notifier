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
use craft\web\UrlManager;
use doublesecretagency\notifier\helpers\Notifier;
use doublesecretagency\notifier\models\Message as MessageModel;
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

//        // If plugin isn't installed yet, bail before triggering events
//        if (!$this->isInstalled) {
//            return;
//        }

        // Trigger notifications when an Entry is saved
        $this->_onEntrySave();
    }

    // ========================================================================= //

    /**
     * Triggered when an Entry is saved.
     */
    private function _onEntrySave()
    {
        Event::on(
            Entry::class,
            Entry::EVENT_AFTER_SAVE,
            static function (ModelEvent $event) {

                // Get entry
                /** @var Entry $entry */
                $entry = $event->sender;

                // If entry is a revision, bail
                if ($entry->getIsRevision()) {
                    return;
                }

                // Get all relevant triggers
                $triggers = Notifier::getTriggersByType('Entry::EVENT_AFTER_SAVE');

                // Loop through all triggers
                foreach ($triggers as $trigger) {

                    // Get trigger configuration
                    $config = $trigger->getConfiguration();

                    // Valid the conditions of an Entry event
                    $valid = $trigger->validateEntry($config, $event);

                    // If the Entry event is not valid, skip it
                    if (!$valid) {
                        continue;
                    }


                    // TEMP
                    // Use current user
                    $user = Craft::$app->getUser()->getIdentity();
                    // ENDTEMP


                    // Set data for message templates
                    $data = [
                        'entry' => $entry,
                        'user' => $user,
                    ];

                    // Get messages related to this trigger
                    $messages = $trigger->getMessages();

                    // Send each message
                    foreach ($messages as $message) {
                        /** @var MessageModel $message */
                        $message->send($data);
                    }

                }

            }
        );

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
                $triggerTemplate = ['template' => 'notifier/_form/trigger'];
                $messageTemplate = ['template' => 'notifier/_form/message'];
                // Routes for editing Triggers
                $event->rules['notifier/trigger/new']             = $triggerTemplate;
                $event->rules['notifier/trigger/<triggerId:\d+>'] = $triggerTemplate;
                // Routes for editing Messages
                $event->rules['notifier/trigger/<triggerId:\d+>/message/new']             = $messageTemplate;
                $event->rules['notifier/trigger/<triggerId:\d+>/message/<messageId:\d+>'] = $messageTemplate;
            }
        );
    }

}
