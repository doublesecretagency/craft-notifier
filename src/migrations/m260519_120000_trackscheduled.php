<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\migrations;

use craft\db\Migration;

/**
 * m260519_120000_trackscheduled migration
 *
 * Creates the table that tracks when each scheduled notification was last
 * run. The schedule runner reads each row's `lastRunAt`, finds any elements
 * whose date crossed since then, sends a message for each, and advances
 * the timestamp. That timestamp is what guarantees each crossing fires
 * exactly once.
 *
 * @since 3.0.0
 */
class m260519_120000_trackscheduled extends Migration
{

    /**
     * @var string The schedule tracking table name.
     */
    private const TRACK_SCHEDULED = '{{%notifier_trackscheduled}}';

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // If the table already exists, bail
        if ($this->db->tableExists(self::TRACK_SCHEDULED)) {
            return true;
        }

        // Create the schedule tracking table
        $this->createTable(self::TRACK_SCHEDULED, [
            'id'             => $this->primaryKey(),
            'notificationId' => $this->integer()->notNull(),
            'lastRunAt'      => $this->dateTime()->notNull(),
        ]);

        // One row per notification
        $this->createIndex(null, self::TRACK_SCHEDULED, ['notificationId'], true);

        // Drop the row when its notification is hard-deleted
        $this->addForeignKey(null, self::TRACK_SCHEDULED, ['notificationId'], '{{%notifier_notifications}}', ['id'], 'CASCADE');

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        $this->dropTableIfExists(self::TRACK_SCHEDULED);
        return true;
    }

}
