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
use craft\base\Element;
use craft\base\Plugin;
use craft\elements\Entry;
use craft\events\ModelEvent;
use craft\events\RegisterComponentTypesEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\services\Utilities;
use craft\web\UrlManager;
use doublesecretagency\notifier\helpers\Notifier;
use doublesecretagency\notifier\models\Message as MessageModel;
use doublesecretagency\notifier\utilities\LogUtility;
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
    public string $schemaVersion = '0.9.0';

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
     * @var Element|null The original version of a saved Element.
     */
    private ?Element $_original = null;

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        self::$plugin = $this;

        // Load Twig extension
        Craft::$app->getView()->registerTwigExtension(new Extension());

        // Register enhancements for the control panel
        if (Craft::$app->getRequest()->getIsCpRequest()) {
            $this->_registerCpRoutes();
            $this->_registerUtilities();
        }

        // If plugin isn't installed yet
        if (!$this->isInstalled) {
            // Bail before triggering events
            return;
        }

        // Trigger notifications when an Entry is saved
        $this->_onEntrySave();
    }

    // ========================================================================= //

    /**
     * Register CP site routes.
     */
    private function _registerCpRoutes(): void
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

    // ========================================================================= //

    /**
     * Register logging utility.
     */
    private function _registerUtilities(): void
    {
        Event::on(
            Utilities::class,
            Utilities::EVENT_REGISTER_UTILITY_TYPES,
            static function(RegisterComponentTypesEvent $event) {
                // Add logging utility
                $event->types[] = LogUtility::class;
            }
        );
    }

    // ========================================================================= //

    /**
     * Triggered when an Entry is saved.
     */
    private function _onEntrySave(): void
    {
        // Get the original element
        Event::on(
            Entry::class,
            Element::EVENT_BEFORE_SAVE,
            function (ModelEvent $event) {

                // Get entry
                /** @var Entry $entry */
                $entry = $event->sender;

                // If no existing ID, bail
                if (!$entry->id) {
                    return;
                }

                // Get the original element
                $this->_original = Entry::find()->id($entry->id)->one();
            }
        );

        // Run trigger
        Event::on(
            Entry::class,
            Element::EVENT_AFTER_SAVE,
            function (ModelEvent $event) {

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

                    // Valid the conditions of an Entry event
                    $valid = $trigger->validateEntry($event);

                    // If the Entry event is not valid, skip it
                    if (!$valid) {
                        continue;
                    }

                    // Set data for message templates
                    $data = [
                        // Content variables
                        'original' => $this->_original,
                        'entry' => $entry,
                        // Config variables
                        'activeUser' => Craft::$app->getUser()->getIdentity(),
                        'event' => $event,
                    ];

                    // Get messages related to this trigger
                    $messages = $trigger->getMessages();

                    // Send each message to all recipients
                    foreach ($messages as $message) {
                        /** @var MessageModel $message */
                        $message->sendAll($data);
                    }

                }

            }
        );

    }

}
