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

use craft\db\Migration;

/**
 * Installation Migration
 * @since 1.0.0
 */
class Install extends Migration
{

    /**
     * Table names.
     */
    const NOTIFICATIONS = '{{%notifier_notifications}}';
    const LOG = '{{%notifier_log}}';

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
                'event'            => $this->string(),
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
    }

}
