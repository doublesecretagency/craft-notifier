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
use craft\db\Query;
use craft\helpers\Json;

/**
 * Adds a top-level `queue` column and backfills it from the per-type queue settings.
 *
 * @since 3.2.0
 */
class m260610_120000_queue_column extends Migration
{

    /**
     * @var string The notifications table name.
     */
    private const NOTIFICATIONS = '{{%notifier_notifications}}';

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // If the column does not yet exist, add it after recipientsConfig
        if (!$this->db->columnExists(self::NOTIFICATIONS, 'queue')) {
            $this->addColumn(self::NOTIFICATIONS, 'queue', $this->boolean()->defaultValue(true)->after('recipientsConfig'));
        }

        // Backfill the new column from each notification's per-type queue setting
        $this->_backfillQueue();

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        // If the column exists, drop it
        if ($this->db->columnExists(self::NOTIFICATIONS, 'queue')) {
            $this->dropColumn(self::NOTIFICATIONS, 'queue');
        }

        return true;
    }

    // ========================================================================= //

    /**
     * Carry each notification's per-type queue value into the `queue` column,
     * then strip the orphaned `*Queue` keys from `messageConfig`.
     *
     * @return void
     */
    private function _backfillQueue(): void
    {
        // Get every notification's id, type, and message config
        $rows = (new Query())
            ->select(['id', 'messageType', 'messageConfig'])
            ->from(self::NOTIFICATIONS)
            ->all($this->db);

        // Loop through every notification
        foreach ($rows as $row) {

            // Get the decoded message config
            $config = Json::decodeIfJson($row['messageConfig']);

            // If the config isn't an array, reset it
            if (!is_array($config)) {
                $config = [];
            }

            // Get the per-type queue value (defaults to queued when absent)
            $key = ((string) $row['messageType']).'Queue';
            $queue = (bool) ($config[$key] ?? true);

            // Strip every per-type queue key from the config
            foreach (['email', 'sms', 'slack', 'pushover', 'ntfy', 'bluesky', 'mqtt'] as $type) {
                unset($config["{$type}Queue"]);
            }

            // Write the top-level queue value and the cleaned config
            $this->update(self::NOTIFICATIONS, [
                'queue'         => $queue,
                'messageConfig' => Json::encode($config),
            ], ['id' => $row['id']], [], false);
        }
    }

}
