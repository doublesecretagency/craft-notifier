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
use craft\errors\ElementNotFoundException;
use craft\errors\MissingComponentException;
use craft\helpers\Json;
use craft\helpers\UrlHelper;
use craft\web\Controller;
use doublesecretagency\notifier\elements\Notification;
use Throwable;
use yii\base\Exception;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Notifications controller
 * @since 1.0.0
 */
class NotificationsController extends Controller
{

    /**
     * Save a notification.
     *
     * @return Response|null
     * @throws BadRequestHttpException
     * @throws Throwable
     * @throws ElementNotFoundException
     * @throws MissingComponentException
     * @throws Exception
     */
    public function actionSave(): ?Response
    {
        $this->requirePostRequest();
        $this->requireLogin();

        // Get request service
        $request = Craft::$app->getRequest();

        // Get session service
        $session = Craft::$app->getSession();

        // Get POST values
        $id              = $request->getBodyParam('id') ?: null;
        $title           = $request->getBodyParam('title');
        $event           = $request->getBodyParam('event');
        $eventConfig     = $request->getBodyParam('eventConfig');
        $messageType     = $request->getBodyParam('messageType');
        $messageTemplate = $request->getBodyParam('messageTemplate');
        $messageConfig   = $request->getBodyParam('messageConfig');

        // Create the notification model
        $notification = $this->_getNotificationModel($id);

        // Set model values
        $notification->id              = $id              ?? $notification->id;
        $notification->title           = $title           ?? $notification->title;
        $notification->event           = $event           ?? $notification->event;
        $notification->eventConfig     = $eventConfig     ?? $notification->eventConfig;
        $notification->messageType     = $messageType     ?? $notification->messageType;
        $notification->messageTemplate = $messageTemplate ?? $notification->messageTemplate;
        $notification->messageConfig   = $messageConfig   ?? $notification->messageConfig;

        // Save the notification
        $success = Craft::$app->getElements()->saveElement($notification);

        // Set flash message
        if ($success) {
            $session->setNotice(Craft::t('notifier', 'Notification saved.'));
        } else {
            $session->setError(Craft::t('notifier', 'Couldn’t save notification.'));
        }

        // Redirect to index of notifications
        return $this->redirect(UrlHelper::cpUrl('notifications'));
    }

//    /**
//     * Delete a notification.
//     *
//     * @return Response
//     * @throws BadRequestHttpException
//     * @throws Exception
//     */
//    public function actionDelete(): Response
//    {
//        $this->requirePostRequest();
//        $this->requireAcceptsJson();
//
//        // Get the trigger ID
//        $request = Craft::$app->getRequest();
//        $id = $request->getBodyParam('id');
//
//        // Delete the Trigger Record
//        $success = (bool) Db::delete('{{%notifier_triggers}}', [
//            'id' => $id,
//        ]);
//
//        // Return JSON response
//        return $this->asJson([
//            'id' => $id,
//            'success' => $success,
//        ]);
//    }

    /**
     * Fetches or creates a Notification.
     *
     * @param int|null $id
     * @return Notification
     * @throws NotFoundHttpException if the requested entry cannot be found
     */
    private function _getNotificationModel(?int $id): Notification
    {
        // If an ID was specified
        if ($id) {

            // Get the existing notification
            /** @var Notification|null $notification */
            $notification = Notification::find()
                ->id($id)
                ->status(null)
                ->one();

            // If a notification was found, return it
            if ($notification) {
                return $notification;
            }

            // Throw error message
            throw new NotFoundHttpException('Notification not found');
        }

        // Return a fresh notification
        return new Notification();
    }

}
