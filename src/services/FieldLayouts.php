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

namespace doublesecretagency\notifier\services;

use Craft;
use craft\base\Component;
use craft\events\ConfigEvent;
use craft\helpers\ProjectConfig as ProjectConfigHelper;
use craft\models\FieldLayout;
use doublesecretagency\notifier\elements\Notification;

/**
 * Manages the shared field layout for notifications.
 *
 * @since 3.2.0
 */
class FieldLayouts extends Component
{

    /**
     * @var string Project config path to the notification field layout.
     */
    public const PATH = 'notifier.fieldLayout';

    // ========================================================================= //

    /**
     * Get the notification field layout.
     *
     * @return FieldLayout
     */
    public function getLayout(): FieldLayout
    {
        // Get the persisted layout for the Notification element type
        return Craft::$app->getFields()->getLayoutByType(Notification::class);
    }

    /**
     * Save the notification field layout to project config.
     *
     * @param FieldLayout $layout
     * @param bool $runValidation Whether the layout should be validated.
     * @return bool
     */
    public function saveLayout(FieldLayout $layout, bool $runValidation = true): bool
    {
        // Bind the layout to the Notification element type
        $layout->type = Notification::class;

        // If validating and the layout is invalid, bail
        if ($runValidation && !$layout->validate()) {
            Craft::info('Field layout not saved due to validation error.', __METHOD__);
            return false;
        }

        // Write the layout into project config
        Craft::$app->getProjectConfig()->set(self::PATH, [
            $layout->uid => $layout->getConfig(),
        ], 'Save the notification field layout');

        return true;
    }

    /**
     * Rebuild the notification field layout when its project config changes.
     *
     * @param ConfigEvent $event
     * @return void
     */
    public function handleChangedLayout(ConfigEvent $event): void
    {
        // Get the incoming layout config
        $data = $event->newValue;

        // Get the fields service
        $fieldsService = Craft::$app->getFields();

        // If no config remains, delete the layout and bail
        if (empty($data) || empty($config = reset($data))) {
            $fieldsService->deleteLayoutsByType(Notification::class);
            return;
        }

        // Make sure any referenced fields are applied first
        ProjectConfigHelper::ensureAllFieldsProcessed();

        // Rebuild the layout from the incoming config
        $layout = FieldLayout::createFromConfig($config);
        $layout->id = $fieldsService->getLayoutByType(Notification::class)->id;
        $layout->type = Notification::class;
        $layout->uid = key($data);

        // Persist the rebuilt layout
        $fieldsService->saveLayout($layout, false);

        // Invalidate notification caches
        Craft::$app->getElements()->invalidateCachesForElementType(Notification::class);
    }

}
