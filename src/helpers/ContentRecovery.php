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

namespace doublesecretagency\notifier\helpers;

use Craft;
use craft\db\Connection;
use craft\db\Query;
use craft\db\Table;
use craft\helpers\Db;
use craft\models\FieldLayout;
use doublesecretagency\notifier\migrations\Craft5ContentRecovery;
use doublesecretagency\notifier\NotifierPlugin;
use Throwable;
use yii\db\TableSchema;

/**
 * Recovers notification content stranded by the Craft 4 to 5 upgrade.
 *
 * @since 3.2.1
 */
abstract class ContentRecovery
{

    /**
     * @var string The legacy Craft 4 content table.
     */
    private const CONTENT = '{{%content}}';

    /**
     * @var string The notifications table.
     */
    private const NOTIFICATIONS = '{{%notifier_notifications}}';

    /**
     * @var string Mutex lock name held while recovering.
     */
    private const LOCK = 'notifier-content-recovery';

    /**
     * @var bool Whether the recovery has already run this request.
     */
    private static bool $_checked = false;

    // ========================================================================= //

    /**
     * Recover any notification content stranded by the Craft 4 to 5 upgrade.
     *
     * Craft's content refactor migration skips plugin element types and offers no
     * hook, so notifications repair themselves whenever they are next queried.
     *
     * @return void
     */
    public static function run(): void
    {
        // If already checked this request, bail
        if (static::$_checked) {
            return;
        }

        // Mark it checked, so the work happens at most once per request
        static::$_checked = true;

        // If running Craft 4, bail (the content table is still the live store)
        if (Compat::isCraft4()) {
            return;
        }

        try {
            static::_recover();
        } catch (Throwable $e) {
            // Never let a repair break the caller
            Craft::warning("Notifier content recovery skipped: {$e->getMessage()}", __METHOD__);
        }
    }

    // ========================================================================= //

    /**
     * Find and recover the stranded notifications.
     *
     * @return void
     */
    private static function _recover(): void
    {
        // Get the database connection
        $db = Craft::$app->getDb();

        // Get the legacy content table
        $schema = $db->getSchema()->getTableSchema(self::CONTENT);

        // If the legacy table is gone, nothing can be recovered
        if (!$schema) {
            static::_warnUnrecoverable($db);
            return;
        }

        // Get the notifications still stranded in the legacy table
        $ids = (new Query())
            ->select(['c.elementId'])
            ->from(['c' => self::CONTENT])
            ->innerJoin(['n' => self::NOTIFICATIONS], '[[n.id]] = [[c.elementId]]')
            ->column($db);

        // If nothing is stranded, sweep up a fully drained table and bail
        if (!$ids) {
            static::_dropIfEmpty($db);
            return;
        }

        // Reduce to a unique list of element IDs
        $ids = array_values(array_unique(array_map('intval', $ids)));

        // Get the mutex service
        $mutex = Craft::$app->getMutex();

        // If another process is already recovering, bail
        if (!$mutex->acquire(self::LOCK)) {
            return;
        }

        try {
            static::_recoverIds($db, $schema, $ids);
        } finally {
            // Always release the lock
            $mutex->release(self::LOCK);
        }
    }

    /**
     * Move the stranded notifications into the Craft 5 storage.
     *
     * @param Connection $db The database connection.
     * @param TableSchema $schema The legacy content table.
     * @param int[] $ids The stranded notification element IDs.
     * @return void
     */
    private static function _recoverIds(Connection $db, TableSchema $schema, array $ids): void
    {
        // Get the Notification field layout
        $layout = NotifierPlugin::getInstance()->fieldLayouts->getLayout();

        // Get any populated legacy columns the current layout can no longer reach
        $unreachable = static::_unreachableColumns($db, $schema, $layout, $ids);

        // If any are unreachable, warn before their values are touched
        if ($unreachable) {
            static::_warnUnreachable($unreachable);
        }

        // Get any titles retyped since the upgrade, so recovery doesn't clobber them
        $retitled = (new Query())
            ->select(['id', 'title'])
            ->from([Table::ELEMENTS_SITES])
            ->where(['elementId' => $ids])
            ->andWhere(['not', ['title' => null]])
            ->pairs($db);

        // Get the current request
        $request = Craft::$app->getRequest();

        // Whether this context permits dropping a table, which the front end never does
        $allowDrop = ($request->getIsConsoleRequest() || $request->getIsCpRequest());

        // Capture the progress output, which would otherwise print into the response
        ob_start();

        try {

            // Hand the stranded notifications to Craft's own content refactor logic,
            // preserving the legacy rows whenever a column could not be reached
            (new Craft5ContentRecovery(['db' => $db]))
                ->recover($ids, $layout, (bool) $unreachable, $allowDrop);

        } finally {

            // Get the captured progress output
            $output = trim((string) ob_get_clean());

            // If anything was captured, log it
            if ($output) {
                Craft::info("Notifier content recovery:\n{$output}", __METHOD__);
            }
        }

        // Loop through each title retyped since the upgrade
        foreach ($retitled as $id => $title) {
            // Restore it over the legacy value
            Db::update(Table::ELEMENTS_SITES, ['title' => $title], ['id' => $id], updateTimestamp: false, db: $db);
        }
    }

    /**
     * Drop the legacy content table once it holds nothing at all.
     *
     * Craft drops it the moment the last row leaves, but only while its own migration
     * runs, so anything recovered afterward leaves the drained table standing forever.
     *
     * @param Connection $db The database connection.
     * @return void
     */
    private static function _dropIfEmpty(Connection $db): void
    {
        // Get the current request
        $request = Craft::$app->getRequest();

        // If this isn't an admin context, bail
        if (!$request->getIsConsoleRequest() && !$request->getIsCpRequest()) {
            return;
        }

        // Whether the table still holds any rows at all
        $rowsExist = (new Query())
            ->from([self::CONTENT])
            ->limit(1)
            ->exists($db);

        // If anything remains, bail so its owner can still recover it
        if ($rowsExist) {
            return;
        }

        // Get the mutex service
        $mutex = Craft::$app->getMutex();

        // If another process is already working the table, bail
        if (!$mutex->acquire(self::LOCK)) {
            return;
        }

        try {

            // Drop the drained table, tolerating a process which got there first
            $db->createCommand()->dropTableIfExists(self::CONTENT)->execute();

            Craft::info('Notifier dropped the drained legacy `content` table.', __METHOD__);

        } finally {
            // Always release the lock
            $mutex->release(self::LOCK);
        }
    }

    // ========================================================================= //

    /**
     * Get the populated legacy columns which the current field layout can no longer reach.
     *
     * A column the layout cannot name is never read, so its values would be lost
     * once the legacy row is deleted.
     *
     * @param Connection $db The database connection.
     * @param TableSchema $schema The legacy content table.
     * @param FieldLayout|null $layout The Notification field layout, if any.
     * @param int[] $ids The stranded notification element IDs.
     * @return array The affected element IDs, keyed by unreachable column name.
     */
    private static function _unreachableColumns(Connection $db, TableSchema $schema, ?FieldLayout $layout, array $ids): array
    {
        // Initialize the field columns
        $fieldColumns = [];

        // Loop through every column of the legacy table
        foreach ($schema->getColumnNames() as $column) {
            // If it holds a custom field value, collect it
            if (str_starts_with($column, 'field_')) {
                $fieldColumns[] = $column;
            }
        }

        // If the legacy table has no field columns, bail
        if (!$fieldColumns) {
            return [];
        }

        // Get the legacy rows for the stranded notifications
        $rows = (new Query())
            ->select(['elementId', ...$fieldColumns])
            ->from([self::CONTENT])
            ->where(['elementId' => $ids])
            ->all($db);

        // Get the columns the current layout can still reach
        $reachable = static::_reachableColumns($layout);

        // Initialize the unreachable columns
        $unreachable = [];

        // Loop through each legacy row
        foreach ($rows as $row) {

            // Get the element this row belongs to
            $elementId = (int) $row['elementId'];
            unset($row['elementId']);

            // Loop through each field column of the row
            foreach ($row as $column => $value) {

                // If the column holds no value, skip
                if (null === $value || '' === $value) {
                    continue;
                }

                // If the layout can still reach the column, skip
                if (static::_isReachable($column, $reachable)) {
                    continue;
                }

                // Collect the element against the column it's stranded in
                $unreachable[$column][$elementId] = true;
            }
        }

        // Reduce each column's elements to a plain list
        foreach ($unreachable as $column => $elementIds) {
            $unreachable[$column] = array_keys($elementIds);
        }

        // Return the affected elements, keyed by column
        return $unreachable;
    }

    /**
     * Get the legacy columns which the current field layout can reach.
     *
     * Mirrors how Craft derives a column name from the field handle and suffix,
     * since the method which does it is private and cannot be reused.
     *
     * @param FieldLayout|null $layout The Notification field layout, if any.
     * @return array Primary column names, plus prefix and suffix pairs for multi-column fields.
     */
    private static function _reachableColumns(?FieldLayout $layout): array
    {
        // Initialize the reachable columns
        $reachable = ['primary' => [], 'multi' => []];

        // If there's no field layout, bail
        if (!$layout) {
            return $reachable;
        }

        // Loop through each custom field on the layout
        foreach ($layout->getCustomFieldElements() as $layoutElement) {

            // Get the underlying field
            $field = $layoutElement->getField();

            // Get the column suffix, if the field carries one
            $suffix = ($field->columnSuffix ? "_{$field->columnSuffix}" : '');

            // The field's primary column
            $reachable['primary'][] = "field_{$field->handle}{$suffix}";

            // A multi-column field spreads across columns sharing this handle and suffix
            $reachable['multi'][] = ["field_{$field->handle}_", ($suffix ?: '_')];
        }

        // Return the reachable columns
        return $reachable;
    }

    /**
     * Whether the current field layout can reach the given legacy column.
     *
     * @param string $column The legacy column name.
     * @param array $reachable The reachable columns.
     * @return bool
     */
    private static function _isReachable(string $column, array $reachable): bool
    {
        // If it's a field's primary column, it's reachable
        if (in_array($column, $reachable['primary'], true)) {
            return true;
        }

        // Loop through each multi-column field
        foreach ($reachable['multi'] as $pair) {

            // If the column belongs to that field, it's reachable
            if (str_starts_with($column, $pair[0]) && str_ends_with($column, $pair[1])) {
                return true;
            }
        }

        // Otherwise the layout has no way to name it
        return false;
    }

    // ========================================================================= //

    /**
     * Warn that some legacy values can't be reached by the current field layout.
     *
     * @param array $unreachable The affected element IDs, keyed by column name.
     * @return void
     */
    private static function _warnUnreachable(array $unreachable): void
    {
        // Initialize the affected columns
        $affected = [];

        // Loop through each unreachable column
        foreach ($unreachable as $column => $elementIds) {
            // Pair the column with the elements stranded in it
            $affected[] = "{$column} (elements: " . implode(', ', $elementIds) . ')';
        }

        // Get the affected columns
        $columnList = implode('; ', $affected);

        // Warn, and note that the values are being kept rather than deleted
        Craft::warning(
            "Notifier could not map these `content` columns to the current Notification field layout: {$columnList}."
            . " Their values were left in place rather than deleted, and can still be recovered by hand.",
            __METHOD__
        );
    }

    /**
     * Warn that stranded notifications exist but the legacy table is already gone.
     *
     * Restricted to admin contexts, since the warning only serves diagnostics and
     * the query would otherwise run on every front-end request.
     *
     * @param Connection $db The database connection.
     * @return void
     */
    private static function _warnUnrecoverable(Connection $db): void
    {
        // Get the current request
        $request = Craft::$app->getRequest();

        // If this isn't an admin context, bail
        if (!$request->getIsConsoleRequest() && !$request->getIsCpRequest()) {
            return;
        }

        // Get any canonical notifications left without a title
        $ids = (new Query())
            ->select(['es.elementId'])
            ->from(['es' => Table::ELEMENTS_SITES])
            ->innerJoin(['n' => self::NOTIFICATIONS], '[[n.id]] = [[es.elementId]]')
            ->innerJoin(['e' => Table::ELEMENTS], '[[e.id]] = [[es.elementId]]')
            ->where(['es.title' => null])
            ->andWhere(['e.draftId' => null])
            ->andWhere(['e.revisionId' => null])
            ->column($db);

        // If every notification has a title, bail
        if (!$ids) {
            return;
        }

        // Get the affected notifications
        $idList = implode(', ', $ids);

        // Warn that the original values are gone for good
        Craft::warning(
            "Notifier found notifications with no title, but the legacy `content` table has already been dropped,"
            . " so the original values can't be recovered. Affected element IDs: {$idList}.",
            __METHOD__
        );
    }

}
