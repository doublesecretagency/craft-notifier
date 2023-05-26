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
        $this->dropTableIfExists('{{%notifier_notifications}}');
    }

    /**
     * Creates the tables.
     */
    protected function createTables(): void
    {
        $this->createTable('{{%notifier_notifications}}', [
            'id'              => $this->integer()->notNull(),
            'event'           => $this->string(),
            'eventConfig'     => $this->text(),
            'messageType'     => $this->string(),
            'messageTemplate' => $this->string(),
            'messageConfig'   => $this->text(),
        ]);
    }

    /**
     * Adds the foreign keys.
     */
    protected function addForeignKeys(): void
    {
        $this->addForeignKey(null, '{{%notifier_notifications}}', ['id'], '{{%elements}}', ['id'], 'CASCADE');
    }

}
