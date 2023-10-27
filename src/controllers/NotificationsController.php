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
        $id               = $request->getBodyParam('id') ?: null;
        $enabled          = $request->getBodyParam('enabled');
        $title            = $request->getBodyParam('title');
        $description      = $request->getBodyParam('description');
        $useQueue         = $request->getBodyParam('useQueue');
        $eventType        = $request->getBodyParam('eventType');
        $event            = $request->getBodyParam('event');
        $eventConfig      = $request->getBodyParam('eventConfig');
        $messageType      = $request->getBodyParam('messageType');
        $messageConfig    = $request->getBodyParam('messageConfig');
        $messageBody      = $request->getBodyParam('messageBody');
        $recipientsType   = $request->getBodyParam('recipientsType');
        $recipientsConfig = $request->getBodyParam('recipientsConfig');

        // Create the notification model
        $notification = $this->_getNotificationModel($id);

        // Set model values
        $notification->id               = $id               ?? $notification->id;
        $notification->enabled          = $enabled          ?? $notification->enabled;
        $notification->title            = $title            ?? $notification->title;
        $notification->description      = $description      ?? $notification->description;
        $notification->useQueue         = $useQueue         ?? $notification->useQueue;
        $notification->eventType        = $eventType        ?? $notification->eventType;
        $notification->event            = $event            ?? $notification->event;
        $notification->eventConfig      = $eventConfig      ?? $notification->eventConfig;
        $notification->messageType      = $messageType      ?? $notification->messageType;
        $notification->messageConfig    = $messageConfig    ?? $notification->messageConfig;
        $notification->messageBody      = $messageBody      ?? $notification->messageBody;
        $notification->recipientsType   = $recipientsType   ?? $notification->recipientsType;
        $notification->recipientsConfig = $recipientsConfig ?? $notification->recipientsConfig;

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

    /**
     * Delete a Notification.
     *
     * @return Response|null
     * @throws BadRequestHttpException
     * @throws Exception
     */
    public function actionDelete(): ?Response
    {
        $this->requirePostRequest();

        // Get specified ID
        $id = $this->request->getRequiredBodyParam('id');

        // Get Notification by ID
        $notification = Craft::$app->getElements()->getElementById($id, Notification::class);

        // If no matching Notification
        if (!$notification) {
            // Display error message
            $this->setFailFlash(Craft::t('app', '{type} could not be found.', [
                'type' => Notification::displayName(),
            ]));
            return null;
        }

        // Attempt to delete the Notification
        $success = Craft::$app->getElements()->deleteElement($notification);

        // If unable to delete the Notification
        if (!$success) {
            // Display error message
            $this->setFailFlash(Craft::t('app', 'Couldn’t delete {type}.', [
                'type' => Notification::lowerDisplayName(),
            ]));
            return null;
        }

        // Display success message
        $this->setSuccessFlash(Craft::t('app', '{type} deleted.', [
            'type' => Notification::displayName(),
        ]));

        // Redirect to specified URL
        return $this->redirectToPostedUrl();
    }

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
