<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events get triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\controllers;

use Craft;
use craft\helpers\Db;
use craft\helpers\Json;
use craft\helpers\UrlHelper;
use craft\web\Controller;
use yii\db\Exception;
use yii\web\BadRequestHttpException;
use yii\web\Response;

/**
 * Class TriggerController
 * @since 1.0.0
 */
class TriggerController extends Controller
{

    /**
     * Save a notification trigger.
     *
     * @return Response
     * @throws Exception
     * @throws BadRequestHttpException
     */
    public function actionSave(): Response
    {
        $this->requirePostRequest();
        $this->requireLogin();

        // Get request
        $request = Craft::$app->getRequest();

        // Get POST values
        $id     = $request->getBodyParam('id');
        $event  = $request->getBodyParam('event');
        $config = $request->getBodyParam('config');

        // JSON encode config
        $config = Json::encode($config);

        // Set data for Trigger Record
        $data = [
            'event'  => $event,
            'config' => $config,
        ];

        // If an ID exists
        if ($id) {
            // Update the Trigger Record
            Db::update('{{%notifier_triggers}}', $data, ['id' => $id]);
        } else {
            // Insert the Trigger Record
            Db::insert('{{%notifier_triggers}}', $data);
        }

        // Redirect to index of notifications
        return $this->redirect(UrlHelper::cpUrl('notifier'));
    }

    /**
     * Delete a notification trigger.
     *
     * @return Response
     * @throws BadRequestHttpException
     * @throws Exception
     */
    public function actionDelete(): Response
    {
        $this->requirePostRequest();
        $this->requireAcceptsJson();

        // Get the trigger ID
        $request = Craft::$app->getRequest();
        $id = $request->getBodyParam('id');

        // Delete the Trigger Record
        $success = (bool) Db::delete('{{%notifier_triggers}}', [
            'id' => $id,
        ]);

        // Return JSON response
        return $this->asJson([
            'id' => $id,
            'success' => $success,
        ]);
    }

}
