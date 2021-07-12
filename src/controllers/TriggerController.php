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
use doublesecretagency\notifier\records\Trigger;
use Throwable;
use yii\base\Exception;
use yii\db\Transaction;

/**
 * Class TriggerController
 * @since 1.0.0
 */
class TriggerController extends Controller
{

    /**
     * Save a notification trigger.
     */
    public function actionSaveTrigger()
    {
        $this->requirePostRequest();
        $this->requireLogin();

        // Get request
        $request = Craft::$app->getRequest();

        // Get POST values
        $id     = $request->getBodyParam('id');
        $event  = $request->getBodyParam('event');
        $config = $request->getBodyParam('config');


//        Craft::dd($config);




        // If an ID exists
        if ($id) {

            // Get existing record
            $trigger = Trigger::findOne($id);

            // If bad ID, throw an error
            if (!$trigger) {
                throw new Exception("No trigger exists with the ID '{$id}'");
            }

        } else {

            // Create new trigger
            $trigger = new Trigger();
            $trigger->id = $id;

        }

        $trigger->event  = $event;
        $trigger->config = $config;

        /** @var Transaction $transaction */
        $transaction = Craft::$app->getDb()->beginTransaction();

        try {
            // Save it!
            $trigger->save(false);

            $transaction->commit();
        } catch (Throwable $e) {
            $transaction->rollBack();

            throw $e;
        }



        // Redirect to index of notifications
        return $this->redirect(UrlHelper::cpUrl('notifier'));
    }

}
