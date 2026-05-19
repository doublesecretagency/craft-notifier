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

namespace doublesecretagency\notifier\migrations;

use craft\db\Migration;

/**
 * m260519_120000_scheduledhistory migration
 *
 * Creates the table that records when each scheduled notification was last
 * run. The schedule runner reads each row's `lastRunAt`, finds any elements
 * whose date crossed since then, sends a message for each, and advances
 * the timestamp. That timestamp is what guarantees each crossing fires
 * exactly once.
 *
 * @since 3.0.0
 */
class m260519_120000_scheduledhistory extends Migration
{

    /**
     * @var string The scheduled history table name.
     */
    private const SCHEDULED_HISTORY = '{{%notifier_scheduledhistory}}';

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // If the table already exists, bail
        if ($this->db->tableExists(self::SCHEDULED_HISTORY)) {
            return true;
        }

        // Create the scheduled history table
        $this->createTable(self::SCHEDULED_HISTORY, [
            'id'             => $this->primaryKey(),
            'notificationId' => $this->integer()->notNull(),
            'lastRunAt'      => $this->dateTime()->notNull(),
        ]);

        // Only one row per notification
        $this->createIndex(null, self::SCHEDULED_HISTORY, ['notificationId'], true);

        // Remove this row if its notification is hard-deleted
        $this->addForeignKey(null, self::SCHEDULED_HISTORY, ['notificationId'], '{{%notifier_notifications}}', ['id'], 'CASCADE');

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        $this->dropTableIfExists(self::SCHEDULED_HISTORY);
        return true;
    }

}
