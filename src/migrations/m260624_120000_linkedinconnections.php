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
 * Creates the table that stores authorized LinkedIn connections.
 *
 * @since 3.1.0
 */
class m260624_120000_linkedinconnections extends Migration
{

    /**
     * @var string The LinkedIn connections table name.
     */
    private const LINKEDIN_CONNECTIONS = '{{%notifier_linkedinconnections}}';

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // If the table already exists, bail
        if ($this->db->tableExists(self::LINKEDIN_CONNECTIONS)) {
            return true;
        }

        // Create the LinkedIn connections table
        $this->createTable(self::LINKEDIN_CONNECTIONS, [
            'id'               => $this->primaryKey(),
            'uid'              => $this->uid(),
            'label'            => $this->string(),
            'authorType'       => $this->string()->notNull(),
            'authorUrn'        => $this->string()->notNull(),
            'accessToken'      => $this->text()->notNull(),
            'accessExpiresAt'  => $this->dateTime()->null(),
            'refreshToken'     => $this->text()->null(),
            'refreshExpiresAt' => $this->dateTime()->null(),
            'dateCreated'      => $this->dateTime()->notNull(),
            'dateUpdated'      => $this->dateTime()->notNull(),
        ]);

        // One row per connection UID
        $this->createIndex(null, self::LINKEDIN_CONNECTIONS, ['uid'], true);

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        $this->dropTableIfExists(self::LINKEDIN_CONNECTIONS);
        return true;
    }

}
