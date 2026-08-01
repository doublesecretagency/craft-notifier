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

use craft\migrations\BaseContentRefactorMigration;
use craft\models\FieldLayout;

/**
 * Moves orphaned notification content into the Craft 5 storage (Craft 5 only).
 *
 * Craft's `m230511_215903_content_refactor` only migrates native element types,
 * so this reuses the same base class to finish the job for notifications.
 *
 * @since 3.2.1
 */
class Craft5ContentRecovery extends BaseContentRefactorMigration
{

    /**
     * @var bool Whether the legacy content table may be dropped once empty.
     */
    private bool $_allowDrop = true;

    // ========================================================================= //

    /**
     * Move specified notifications out of the legacy content table.
     *
     * @param int[] $ids The orphaned notification element IDs.
     * @param FieldLayout|null $fieldLayout The Notification field layout, if any.
     * @param bool $preserveOldData Whether to leave the legacy rows in place.
     * @param bool $allowDrop Whether the content table may be dropped once empty.
     * @return void
     */
    public function recover(array $ids, ?FieldLayout $fieldLayout, bool $preserveOldData, bool $allowDrop): void
    {
        // Whether to leave the legacy rows in place
        $this->preserveOldData = $preserveOldData;

        // Whether the content table may be dropped once empty
        $this->_allowDrop = $allowDrop;

        // Hand off to Craft's own content refactor logic
        $this->updateElements($ids, $fieldLayout);
    }

    // ========================================================================= //

    /**
     * @inheritdoc
     */
    public function dropTable($table)
    {
        // If dropping isn't allowed in this context, skip
        if (!$this->_allowDrop) {
            return;
        }

        parent::dropTable($table);
    }

}
