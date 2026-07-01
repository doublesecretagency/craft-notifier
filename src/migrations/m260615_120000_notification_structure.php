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

            // If the structure can't be resolved yet, bail
            if (!$structureId) {
                return true;
            }

            // Backfill any existing notifications into the structure
            NotificationStructure::backfillUnplaced($structureId);

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
