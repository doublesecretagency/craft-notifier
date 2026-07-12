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

namespace doublesecretagency\notifier\controllers;

use Craft;
use craft\web\Controller;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\NotifierPlugin;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

/**
 * Manages the notification field layout.
 *
 * @since 3.2.0
 */
class SettingsFieldsController extends Controller
{

    /**
     * @inheritdoc
     */
    public array|bool|int $allowAnonymous = false;

    /**
     * Require admin access for every action in this controller.
     *
     * @inheritdoc
     */
    public function beforeAction($action): bool
    {
        // If the parent rejects, bail
        if (!parent::beforeAction($action)) {
            return false;
        }

        // Only admins can manage the notification field layout
        $this->requireAdmin();

        return true;
    }

    // ========================================================================= //

    /**
     * Render the Notification Fields sub-page.
     *
     * @return Response
     */
    public function actionFields(): Response
    {
        // Render the shared settings layout with the field layout designer
        return $this->renderTemplate('notifier/_settings/_layout', [
            'section'     => 'fields',
            'fieldLayout' => NotifierPlugin::getInstance()->fieldLayouts->getLayout(),
        ]);
    }

    // ========================================================================= //

    /**
     * Save the notification field layout.
     *
     * @return Response|null
     * @throws BadRequestHttpException
     * @throws ForbiddenHttpException
     */
    public function actionSaveFieldLayout(): ?Response
    {
        $this->requirePostRequest();

        // If project config is read-only, the layout can't be saved from here
        if (Craft::$app->getProjectConfig()->readOnly) {
            throw new ForbiddenHttpException(Craft::t('notifier', 'Notification fields can’t be edited when admin changes are disabled.'));
        }

        // Assemble the field layout from the designer POST
        $layout = Craft::$app->getFields()->assembleLayoutFromPost();
        $layout->type = Notification::class;

        // Reserve the notification's own attribute handles so a custom field can't use them
        $layout->reservedFieldHandles = Notification::reservedFieldHandles();

        // If the layout couldn't be saved, return the failure
        if (!NotifierPlugin::getInstance()->fieldLayouts->saveLayout($layout)) {
            Craft::$app->getUrlManager()->setRouteParams([
                'variables' => ['fieldLayout' => $layout],
            ]);
            $this->setFailFlash(Craft::t('notifier', 'Couldn’t save fields.'));
            return null;
        }

        // Flash success
        $this->setSuccessFlash(Craft::t('notifier', 'Fields saved.'));

        // Redirect back to the field layout designer
        return $this->redirectToPostedUrl();
    }

}
