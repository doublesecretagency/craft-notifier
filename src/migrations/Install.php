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
 * Installation Migration
 * @since 1.0.0
 */
class Install extends Migration
{

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTables();
        $this->createIndexes();
        $this->addForeignKeys();
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTableIfExists('{{%notifier_messages}}');
        $this->dropTableIfExists('{{%notifier_triggers}}');
    }

    /**
     * Creates the tables.
     */
    protected function createTables()
    {
        $this->createTable('{{%notifier_triggers}}', [
            'id'        => $this->primaryKey(),
            'event'     => $this->string()->notNull(),
            'config'    => $this->text(),
        ]);
        $this->createTable('{{%notifier_messages}}', [
            'id'        => $this->primaryKey(),
            'triggerId' => $this->integer()->notNull(),
            'type'      => $this->string(),
            'template'  => $this->string(),
            'config'    => $this->text(),
        ]);
    }

    /**
     * Creates the indexes.
     */
    protected function createIndexes()
    {
        $this->createIndex(null, '{{%notifier_messages}}', ['triggerId']);
    }

    /**
     * Adds the foreign keys.
     */
    protected function addForeignKeys()
    {
        $this->addForeignKey(null, '{{%notifier_messages}}', ['triggerId'], '{{%notifier_triggers}}', ['id'], 'CASCADE');
    }

}
