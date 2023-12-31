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

    const NOTIFICATIONS = '{{%notifier_notifications}}';

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
        $this->dropTableIfExists(self::NOTIFICATIONS);
    }

    /**
     * Creates the tables.
     */
    protected function createTables(): void
    {
        // If table already exists, bail
        if ($this->db->tableExists(self::NOTIFICATIONS)) {
            return;
        }

        $this->createTable(self::NOTIFICATIONS, [
            'id'               => $this->integer()->notNull(),
            'description'      => $this->string(),
            'useQueue'         => $this->boolean(),
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

    /**
     * Adds the foreign keys.
     */
    protected function addForeignKeys(): void
    {
        $this->addForeignKey(null, self::NOTIFICATIONS, ['id'], '{{%elements}}', ['id'], 'CASCADE');
    }

}
