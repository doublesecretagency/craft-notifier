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
 * Renames the date-reached tracking table from trackscheduled to trackdates.
 *
 * @since 3.1.0
 */
class m260604_130000_rename_trackscheduled_to_trackdates extends Migration
{

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // Rename the date-reached tracking table
        if ($this->db->tableExists('{{%notifier_trackscheduled}}') && !$this->db->tableExists('{{%notifier_trackdates}}')) {
            $this->renameTable('{{%notifier_trackscheduled}}', '{{%notifier_trackdates}}');
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        // Reverse the date-reached rename
        if ($this->db->tableExists('{{%notifier_trackdates}}') && !$this->db->tableExists('{{%notifier_trackscheduled}}')) {
            $this->renameTable('{{%notifier_trackdates}}', '{{%notifier_trackscheduled}}');
        }

        return true;
    }

}
