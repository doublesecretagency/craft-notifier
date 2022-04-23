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
 * Class MessageController
 * @since 1.0.0
 */
class MessageController extends Controller
{

    /**
     * Save a notification message.
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
        $id        = $request->getBodyParam('id');
        $triggerId = $request->getBodyParam('triggerId');
        $type      = $request->getBodyParam('type');
        $template  = $request->getBodyParam('template');
        $config    = $request->getBodyParam('config');

        // JSON encode config
        $config = Json::encode($config);

        // Set data for Message Record
        $data = [
            'triggerId' => $triggerId,
            'type'      => $type,
            'template'  => $template,
            'config'    => $config,
        ];

        // If an ID exists
        if ($id) {
            // Update the Message Record
            Db::update('{{%notifier_messages}}', $data, ['id' => $id]);
        } else {
            // Insert the Message Record
            Db::insert('{{%notifier_messages}}', $data);
        }

        // Redirect to index of notifications
        return $this->redirect(UrlHelper::cpUrl('notifier'));
    }

    /**
     * Delete a notification message.
     *
     * @return Response
     * @throws BadRequestHttpException
     * @throws Exception
     */
    public function actionDelete(): Response
    {
        $this->requirePostRequest();
        $this->requireAcceptsJson();

        // Get the message ID
        $request = Craft::$app->getRequest();
        $id = $request->getBodyParam('id');

        // Delete the Message Record
        $success = (bool) Db::delete('{{%notifier_messages}}', [
            'id' => $id,
        ]);

        // Return JSON response
        return $this->asJson([
            'id' => $id,
            'success' => $success,
        ]);
    }

}
