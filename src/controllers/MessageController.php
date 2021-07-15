<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Get notified when things happen.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\controllers;

use Craft;
use craft\helpers\UrlHelper;
use craft\web\Controller;
use doublesecretagency\notifier\records\Message;
use Throwable;
use yii\base\Exception;
use yii\db\Transaction;

/**
 * Class MessageController
 * @since 1.0.0
 */
class MessageController extends Controller
{

    /**
     * Save a notification message.
     */
    public function actionSaveMessage()
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
        $subject   = $request->getBodyParam('subject');


//        Craft::dd($config);




        // If an ID exists
        if ($id) {

            // Get existing record
            $message = Message::findOne($id);

            // If bad ID, throw an error
            if (!$message) {
                throw new Exception("No message exists with the ID '{$id}'");
            }

        } else {

            // Create new message
            $message = new Message();
            $message->id = $id;
            $message->triggerId = $triggerId;

        }

        $message->type     = $type;
        $message->template = $template;
        $message->subject  = $subject;

        /** @var Transaction $transaction */
        $transaction = Craft::$app->getDb()->beginTransaction();

        try {
            // Save it!
            $message->save(false);

            $transaction->commit();
        } catch (Throwable $e) {
            $transaction->rollBack();

            throw $e;
        }



        // Redirect to index of notifications
        return $this->redirect(UrlHelper::cpUrl('notifier'));
    }

}
