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
use craft\fieldlayoutelements\CustomField;
use craft\fields\PlainText;
use craft\helpers\ArrayHelper;
use craft\models\FieldLayoutTab;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\Compat;
use doublesecretagency\notifier\NotifierPlugin;
use doublesecretagency\notifier\services\FieldLayouts;
use Throwable;

/**
 * Converts the native `description` column into a `notifierDescription` custom field.
 *
 * @since 3.2.0
 */
class m260711_120000_description_to_custom_field extends Migration
{

    /**
     * @var string The notifications table name.
     */
    private const TABLE = '{{%notifier_notifications}}';

    /**
     * @var string The handle of the converted Description field.
     */
    private const FIELD_HANDLE = 'notifierDescription';

    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
        // Capture the existing descriptions before changing the schema
        $descriptions = $this->_captureDescriptions();

        // Make sure the Description field and layout exist
        $this->_ensureDescriptionField();

        // Get the saved layout
        $layout = NotifierPlugin::getInstance()->fieldLayouts->getLayout();

        // If the layout or its field isn't ready, bail
        if (!$layout->id || !$layout->getFieldByHandle(self::FIELD_HANDLE)) {
            Craft::warning(
                'Notifier: notifierDescription field/layout not ready; skipping backfill and column drop.',
                __METHOD__
            );
            // Return, never throw, so a failed migration can't wipe data
            return true;
        }

        // Backfill the captured descriptions into the new field
        $this->_backfillDescriptions($descriptions, $layout->id);

        // If the native column still exists, drop it
        if ($this->db->columnExists(self::TABLE, 'description')) {
            $this->dropColumn(self::TABLE, 'description');
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        echo "m260711_120000_description_to_custom_field cannot be reverted.\n";
        return false;
    }

    // ========================================================================= //

    /**
     * Capture every notification's non-empty description before the column is dropped.
     *
     * @return array The descriptions, keyed by notification ID.
     */
    private function _captureDescriptions(): array
    {
        // If the column is already gone, bail
        if (!$this->db->columnExists(self::TABLE, 'description')) {
            return [];
        }

        // Get every id + description
        $rows = (new Query())
            ->select(['id', 'description'])
            ->from(self::TABLE)
            ->all();

        // Initialize the captured descriptions
        $descriptions = [];

        // Loop through each row
        foreach ($rows as $row) {

            // Get the description
            $description = (string) ($row['description'] ?? '');

            // If the description is empty, skip
            if ('' === trim($description)) {
                continue;
            }

            // Capture the description
            $descriptions[(int) $row['id']] = $description;
        }

        // Return the captured descriptions
        return $descriptions;
    }

    /**
     * Make sure the Description field and layout exist for this environment.
     *
     * When the field is already defined in the deployed project config (a
     * staging/production deploy), apply it. Otherwise create it (a fresh run). This
     * discriminates on config presence, not `readOnly`, because Craft lifts `readOnly`
     * during migrations whenever config changes are pending, which is exactly the
     * deploy case. Either way the layout is applied so it has an id before the backfill.
     *
     * @return void
     */
    private function _ensureDescriptionField(): void
    {
        // Get the project config service
        $pc = Craft::$app->getProjectConfig();

        // Look for the Description field in the deployed project config
        $incomingUid = null;
        $incomingData = null;
        foreach (($pc->get('fields', true) ?? []) as $uid => $data) {
            // If this is our Description field, remember it and stop scanning
            if (self::FIELD_HANDLE === ($data['handle'] ?? null)) {
                $incomingUid = $uid;
                $incomingData = $data;
                break;
            }
        }

        // If the field is already in project config, apply it instead of creating a duplicate
        if (null !== $incomingUid) {

            // Craft 4: apply the field's group first, so the field lands with a groupId
            if (Compat::isCraft4() && !empty($incomingData['fieldGroup'])) {
                $pc->processConfigChanges('fieldGroups.'.$incomingData['fieldGroup'], true);
            }

            // Apply the field, then the layout
            $pc->processConfigChanges('fields.'.$incomingUid, true);
            $pc->processConfigChanges(FieldLayouts::PATH, true);
            return;
        }

        // Otherwise, create the field and layout
        $fieldsService = Craft::$app->getFields();

        // If the Description field doesn't exist yet, create it
        if (!$fieldsService->getFieldByHandle(self::FIELD_HANDLE)) {

            // Build a single-line, non-searchable PlainText field
            $field = new PlainText();
            $field->name = 'Description';
            $field->handle = self::FIELD_HANDLE;
            $field->searchable = false;

            // Craft 4 requires a groupId for a global field; Craft 5 removed groups
            if (Compat::isCraft4()) {
                // Get the "Notifier" field group
                $group = ArrayHelper::firstWhere($fieldsService->getAllGroups(), 'name', 'Notifier');

                // If it doesn't exist yet, create it
                if (!$group) {
                    $group = new \craft\models\FieldGroup(['name' => 'Notifier']);
                    $fieldsService->saveGroup($group);
                }
                $field->groupId = $group->id;
            }

            // Save the field
            $fieldsService->saveField($field);
        }

        // Get the field layouts service + current layout
        $layoutsService = NotifierPlugin::getInstance()->fieldLayouts;
        $layout = $layoutsService->getLayout();

        // If the layout doesn't yet carry the field, add it and save
        if (!$layout->getFieldByHandle(self::FIELD_HANDLE)) {

            // Get the field
            $field = $fieldsService->getFieldByHandle(self::FIELD_HANDLE);

            // Get the existing tabs
            $tabs = $layout->getTabs();

            // If there are none, start a Content tab
            if (!$tabs) {
                $tab = new FieldLayoutTab();
                $tab->name = Craft::t('notifier', 'Meta');
                $tabs = [$tab];
            }

            // Attach the tabs before setting their elements
            $layout->setTabs($tabs);

            // Append the Description field to the first tab
            $firstTab = $tabs[0];
            $firstTab->setElements(array_merge($firstTab->getElements(), [new CustomField($field)]));

            // Save the layout
            $layoutsService->saveLayout($layout, false);
        }

        // Apply the layout config now, so it has an id in the database
        // before the backfill runs
        $pc->processConfigChanges(FieldLayouts::PATH, true);
    }

    /**
     * Backfill the captured descriptions into the new field.
     *
     * Each row runs in its own try/catch, so one bad element can't abort the
     * migration and wipe data through Craft's restore-on-failure.
     *
     * @param array $descriptions The descriptions, keyed by notification ID.
     * @param int $layoutId The saved field layout ID.
     * @return void
     */
    private function _backfillDescriptions(array $descriptions, int $layoutId): void
    {
        // Loop through each captured description
        foreach ($descriptions as $id => $description) {
            try {
                // Get the notification, including disabled and trashed ones
                $notification = Notification::find()->id($id)->status(null)->trashed(null)->one();

                // If it can't be loaded, skip
                if (!$notification) {
                    continue;
                }

                // Set the layout id so the value gets saved
                $notification->fieldLayoutId = $layoutId;

                // Set the description on the new field
                $notification->setFieldValue(self::FIELD_HANDLE, $description);

                // Save the element
                Craft::$app->getElements()->saveElement($notification, false, false, false);
            } catch (Throwable $e) {
                // Log and skip, so one bad row can't abort the migration
                Craft::warning("Notifier: could not migrate description for notification {$id}: {$e->getMessage()}", __METHOD__);
            }
        }
    }

}
