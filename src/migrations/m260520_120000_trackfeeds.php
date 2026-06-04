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
 * Creates the table that tracks which feed items have already been sent.
 *
 * @since 3.0.0
 */
class m260520_120000_trackfeeds extends Migration
{

    /**
     * @var string The feed tracking table name.
     */
    private const TRACK_FEEDS = '{{%notifier_trackfeeds}}';

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // If the table already exists, bail
        if ($this->db->tableExists(self::TRACK_FEEDS)) {
            return true;
        }

        // Create the feed tracking table
        $this->createTable(self::TRACK_FEEDS, [
            'id'             => $this->primaryKey(),
            'notificationId' => $this->integer()->notNull(),
            'itemId'         => $this->string(255)->notNull(),
        ]);

        // One row per notification, per feed item
        $this->createIndex(null, self::TRACK_FEEDS, ['notificationId', 'itemId'], true);

        // Drop every row when its notification is hard-deleted
        $this->addForeignKey(null, self::TRACK_FEEDS, ['notificationId'], '{{%notifier_notifications}}', ['id'], 'CASCADE');

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        $this->dropTableIfExists(self::TRACK_FEEDS);
        return true;
    }

}
