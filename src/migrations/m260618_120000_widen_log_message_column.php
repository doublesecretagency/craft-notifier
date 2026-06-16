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
 * Widens the log `message` column from a string to text.
 *
 * Provider errors (Facebook Graph, Twilio, etc.) can exceed 255 characters,
 * which previously overflowed the column and crashed the log write.
 *
 * @since 3.1.0
 */
class m260618_120000_widen_log_message_column extends Migration
{

    /**
     * @var string The log table name.
     */
    private const LOG = '{{%notifier_log}}';

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // Widen the message column to hold long provider errors
        $this->alterColumn(self::LOG, 'message', $this->text());

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        // Narrow the message column back to a string
        $this->alterColumn(self::LOG, 'message', $this->string());

        return true;
    }

}
