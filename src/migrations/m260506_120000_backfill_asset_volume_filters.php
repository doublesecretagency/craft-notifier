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

use Craft;
use craft\db\Migration;
use craft\db\Query;
use craft\helpers\Json;

/**
 * m260506_120000_backfill_asset_volume_filters migration
 *
 * Backfills the new mandatory `volumes` gate for any pre-existing
 * Asset notification. Without this, notifications saved before the
 * Volume Filter UI shipped would silently stop firing on upgrade
 * because their eventConfig JSON has no `volumes` key.
 *
 * Idempotent: rows that already carry a `volumes` key are skipped.
 *
 * @since 3.0.0
 */
class m260506_120000_backfill_asset_volume_filters extends Migration
{

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // Get every current volume ID
        $allVolumeIds = [];
        foreach (Craft::$app->getVolumes()->getAllVolumes() as $volume) {
            $allVolumeIds[] = $volume->id;
        }

        // If no volumes exist, there is nothing to backfill
        if (!$allVolumeIds) {
            return true;
        }

        // Get every existing Asset notification
        $rows = (new Query())
            ->select(['id', 'eventConfig'])
            ->from('{{%notifier_notifications}}')
            ->where(['eventType' => 'assets'])
            ->all();

        // Loop through each Asset notification
        foreach ($rows as $row) {

            // Decode the existing eventConfig
            $eventConfig = Json::decode($row['eventConfig']) ?? [];

            // If volumes key already exists, skip
            if (isset($eventConfig['volumes'])) {
                continue;
            }

            // Backfill with every current volume ID
            $eventConfig['volumes'] = $allVolumeIds;

            // Persist updated eventConfig
            $this->update(
                '{{%notifier_notifications}}',
                ['eventConfig' => Json::encode($eventConfig)],
                ['id' => $row['id']],
                [],
                false
            );
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        echo "m260506_120000_backfill_asset_volume_filters cannot be reverted.\n";
        return false;
    }

}
