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

use Craft;
use craft\db\Migration;
use craft\db\Query;
use craft\db\Table;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\NotificationStructure;
use Throwable;

/**
 * Backfills existing notifications into the manual-order Structure.
 *
 * @since 3.1.0
 */
class m260615_120000_notification_structure extends Migration
{

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // Wrap the backfill so it can never fail the migration and trigger Craft's data-wiping restore
        try {

            // Ensure the manual-order structure exists
            $structureId = NotificationStructure::getStructureId();

            // If the structure can't be resolved, bail
            if (!$structureId) {
                return true;
            }

            // Get the structures service
            $structures = Craft::$app->getStructures();

            // Get the element IDs already placed in the structure
            $placed = (new Query())
                ->select(['elementId'])
                ->from([Table::STRUCTUREELEMENTS])
                ->where(['structureId' => $structureId])
                ->column($this->db);

            // Flip to a lookup of element IDs already placed
            $placed = array_flip(array_map('intval', $placed));

            // Get every canonical notification in creation order (oldest first)
            $notifications = Notification::find()
                ->status(null)
                ->orderBy(['id' => SORT_ASC])
                ->all();

            // Loop through each notification
            foreach ($notifications as $notification) {

                // If it's already placed in the structure, skip
                if (isset($placed[(int) $notification->id])) {
                    continue;
                }

                // Append it, preserving the existing creation order top-to-bottom
                $structures->appendToRoot($structureId, $notification);
            }

        } catch (Throwable $e) {
            // If the backfill fails, log it instead of failing the migration
            Craft::warning("Notifier structure backfill skipped: {$e->getMessage()}", __METHOD__);
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        // The structure placement is not reverted
        return false;
    }

}
