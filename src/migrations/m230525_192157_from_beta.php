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
        $this->_createTable();
        $this->_portNotifications();
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
     * Create table if it doesn't exist.
     */
    private function _createTable(): void
    {
        // If table already exists, bail
        if ($this->db->tableExists('{{%notifier_notifications}}')) {
            return;
        }

        // Create new table
        $this->createTable('{{%notifier_notifications}}', [
            'id'              => $this->integer()->notNull(),
            'event'           => $this->string(),
            'eventConfig'     => $this->text(),
            'messageType'     => $this->string(),
            'messageTemplate' => $this->string(),
            'messageConfig'   => $this->text(),
            'dateCreated'     => $this->dateTime()->notNull(),
            'dateUpdated'     => $this->dateTime()->notNull(),
            'dateDeleted'     => $this->dateTime()->null(),
            'uid'             => $this->uid(),
            'PRIMARY KEY([[id]])',
        ]);

        // Add foreign key
        $this->addForeignKey(null, '{{%notifier_notifications}}', ['id'], '{{%elements}}', ['id'], 'CASCADE');
    }

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

        // Create the notification
        $notification = new Notification([
            'title'           => "Notification #{$this->_currentNotification}",
            'event'           => 'craft\elements\Entry::EVENT_AFTER_PROPAGATE',
            'eventConfig'     => $trigger['config'],
            'messageType'     => $message['type'],
            'messageTemplate' => $message['template'],
            'messageConfig'   => $message['config'],
        ]);

        // Save the notification
        Craft::$app->getElements()->saveElement($notification);
    }

}
