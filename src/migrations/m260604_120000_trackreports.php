<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\migrations;

use craft\db\Migration;

/**
 * Creates the table that tracks when each report notification last fired.
 *
 * @since 3.1.0
 */
class m260604_120000_trackreports extends Migration
{

    /**
     * @var string The report-schedule tracking table name.
     */
    private const TRACK_REPORTS = '{{%notifier_trackreports}}';

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // If the table already exists, bail
        if ($this->db->tableExists(self::TRACK_REPORTS)) {
            return true;
        }

        // Create the report-schedule tracking table
        $this->createTable(self::TRACK_REPORTS, [
            'id'             => $this->primaryKey(),
            'notificationId' => $this->integer()->notNull(),
            'lastRunAt'      => $this->dateTime()->null(),
            'nextRunAt'      => $this->dateTime()->notNull(),
        ]);

        // One row per notification
        $this->createIndex(null, self::TRACK_REPORTS, ['notificationId'], true);

        // Drop the row when its notification is hard-deleted
        $this->addForeignKey(null, self::TRACK_REPORTS, ['notificationId'], '{{%notifier_notifications}}', ['id'], 'CASCADE');

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        $this->dropTableIfExists(self::TRACK_REPORTS);
        return true;
    }

}
