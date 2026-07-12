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
 * Migrates Announcement notifications to the standard recipient type field.
 *
 * @since 3.0.0
 */
class m260508_130000_announcement_recipient_types extends Migration
{

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // Get every existing Announcement notification
        $rows = (new Query())
            ->select(['id', 'recipientsType', 'recipientsConfig'])
            ->from('{{%notifier_notifications}}')
            ->where(['messageType' => 'announcement'])
            ->all();

        // Loop through each Announcement notification
        foreach ($rows as $row) {

            // If recipientsType is already set, skip
            if (!empty($row['recipientsType'])) {
                continue;
            }

            // Decode the existing recipientsConfig
            $recipientsConfig = Json::decode($row['recipientsConfig']) ?? [];

            // Map the legacy adminsOnly value to the standard recipientsType
            $adminsOnly = (bool)($recipientsConfig['adminsOnly'] ?? true);
            $recipientsType = ($adminsOnly ? 'all-admins' : 'all-users');

            // Drop the legacy key from recipientsConfig
            unset($recipientsConfig['adminsOnly']);

            // Save updated row
            $this->update(
                '{{%notifier_notifications}}',
                [
                    'recipientsType' => $recipientsType,
                    'recipientsConfig' => Json::encode($recipientsConfig),
                ],
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
        echo "m260508_130000_announcement_recipient_types cannot be reverted.\n";
        return false;
    }

}
