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

namespace doublesecretagency\notifier\migrations;

use Craft;
use craft\db\Migration;
use craft\db\Query;
use doublesecretagency\notifier\elements\Notification;

/**
 * m230525_192157_from_beta migration
 */
class m230525_192157_from_beta extends Migration
{

    /**
     * @var int Number of current notification being created.
     */
    private int $_currentNotification = 0;

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // Install new table
        (new Install())->safeUp();

        // Port existing data
        $this->_portNotifications();

        // Drop old tables
        $this->dropTableIfExists('{{%notifier_messages}}');
        $this->dropTableIfExists('{{%notifier_triggers}}');

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        echo "m230525_192157_from_beta cannot be reverted.\n";
        return false;
    }

    // ========================================================================= //

    /**
     * Port all existing notification data.
     */
    private function _portNotifications(): void
    {
        // If an old table is missing, bail
        if (
            !$this->db->tableExists('{{%notifier_triggers}}') ||
            !$this->db->tableExists('{{%notifier_messages}}')
        ) {
            return;
        }

        // Get all existing triggers
        $triggerRows = (new Query())
            ->select('*')
            ->from('{{%notifier_triggers}}')
            ->orderBy('[[id]]')
            ->all();

        // Loop through existing triggers
        foreach ($triggerRows as $triggerData) {

            // Get all messages for each trigger
            $messageRows = (new Query())
                ->select('*')
                ->from('{{%notifier_messages}}')
                ->where(['triggerId' => $triggerData['id']])
                ->orderBy('[[id]]')
                ->all();

            // Loop through messages for each trigger
            foreach ($messageRows as $messageData) {
                // Save a single notification
                $this->_saveNotification($triggerData, $messageData);
            }

        }
    }

    /**
     * Save a single notification.
     */
    private function _saveNotification($trigger, $message): void
    {
        // Increment the current notification
        $this->_currentNotification++;

        // Add message body to config
        $message['config']['emailMessage'] = "{% include '{$message['template']}' %}";

        // Create the notification
        $notification = new Notification([
            'title'           => "Notification #{$this->_currentNotification}",
            'description'      => '[IMPORTED] Please check details to ensure notification continues working as intended.',
            'eventType'        => 'entries',
            'event'            => 'craft\elements\Entry::EVENT_AFTER_PROPAGATE',
            'eventConfig'      => $trigger['config'],
            'messageType'      => $message['type'],
            'messageConfig'    => $message['config'],
            'recipientsType'   => null,
            'recipientsConfig' => null,
        ]);

        // Save the notification
        Craft::$app->getElements()->saveElement($notification);
    }

}
