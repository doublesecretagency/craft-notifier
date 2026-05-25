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
 * Installation Migration
 * @since 1.0.0
 */
class Install extends Migration
{

    /**
     * @var string The notifications table name.
     */
    const NOTIFICATIONS = '{{%notifier_notifications}}';

    /**
     * @var string The log table name.
     */
    const LOG = '{{%notifier_log}}';

    /**
     * @var string The schedule tracking table name.
     */
    const TRACK_SCHEDULED = '{{%notifier_trackscheduled}}';

    /**
     * @var string The feed tracking table name.
     */
    const TRACK_FEEDS = '{{%notifier_trackfeeds}}';

    /**
     * @inheritdoc
     */
    public function safeUp(): void
    {
        $this->createTables();
        $this->addForeignKeys();
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): void
    {
        $this->dropTableIfExists(self::TRACK_FEEDS);
        $this->dropTableIfExists(self::TRACK_SCHEDULED);
        $this->dropTableIfExists(self::LOG);
        $this->dropTableIfExists(self::NOTIFICATIONS);
    }

    /**
     * Creates the tables.
     */
    protected function createTables(): void
    {
        // If table does not already exist, create it
        if (!$this->db->tableExists(self::NOTIFICATIONS)) {
            $this->createTable(self::NOTIFICATIONS, [
                'id'               => $this->integer()->notNull(),
                'description'      => $this->string(),
                'eventType'        => $this->string(),
                'event'             => $this->string(),
                'eventConfig'      => $this->text(),
                'messageType'      => $this->string(),
                'messageConfig'    => $this->text(),
                'recipientsType'   => $this->string(),
                'recipientsConfig' => $this->text(),
                'dateCreated'      => $this->dateTime()->notNull(),
                'dateUpdated'      => $this->dateTime()->notNull(),
                'dateDeleted'      => $this->dateTime()->null(),
                'uid'              => $this->uid(),
                'PRIMARY KEY([[id]])',
            ]);
        }

        // If table does not already exist, create it
        if (!$this->db->tableExists(self::LOG)) {
            $this->createTable(self::LOG, [
                'id'             => $this->primaryKey(),
                'notificationId' => $this->integer(),
                'envelopeId'     => $this->integer(),
                'type'           => $this->string(),
                'message'        => $this->string(),
                'details'        => $this->text(),
                'dateCreated'    => $this->dateTime()->notNull(),
                'dateUpdated'    => $this->dateTime()->notNull(),
                'uid'            => $this->uid(),
            ]);
        }

        // If table does not already exist, create it
        if (!$this->db->tableExists(self::TRACK_SCHEDULED)) {
            $this->createTable(self::TRACK_SCHEDULED, [
                'id'             => $this->primaryKey(),
                'notificationId' => $this->integer()->notNull(),
                'lastRunAt'      => $this->dateTime()->notNull(),
            ]);
            $this->createIndex(null, self::TRACK_SCHEDULED, ['notificationId'], true);
        }

        // If table does not already exist, create it
        if (!$this->db->tableExists(self::TRACK_FEEDS)) {
            $this->createTable(self::TRACK_FEEDS, [
                'id'             => $this->primaryKey(),
                'notificationId' => $this->integer()->notNull(),
                'itemId'         => $this->string(255)->notNull(),
            ]);
            $this->createIndex(null, self::TRACK_FEEDS, ['notificationId', 'itemId'], true);
        }
    }

    /**
     * Adds the foreign keys.
     */
    protected function addForeignKeys(): void
    {
        // Relate Notifications to Elements
        $this->addForeignKey(null, self::NOTIFICATIONS, ['id'], '{{%elements}}', ['id'], 'CASCADE');

        // Relate Logs to Notifications
        $this->addForeignKey(null, self::LOG, ['notificationId'], self::NOTIFICATIONS, ['id'], 'SET NULL');

        // Relate Schedule Tracking to Notifications
        $this->addForeignKey(null, self::TRACK_SCHEDULED, ['notificationId'], self::NOTIFICATIONS, ['id'], 'CASCADE');

        // Relate Feed Tracking to Notifications
        $this->addForeignKey(null, self::TRACK_FEEDS, ['notificationId'], self::NOTIFICATIONS, ['id'], 'CASCADE');
    }

}
