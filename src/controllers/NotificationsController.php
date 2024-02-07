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
use craft\helpers\StringHelper;
use craft\helpers\UrlHelper;
use craft\web\Controller;
use doublesecretagency\notifier\elements\Notification;
use Throwable;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Notifications controller
 * @since 1.0.0
 */
class NotificationsController extends Controller
{

    /**
     * Edit a Notification.
     *
     * @param int|null $notificationId
     * @param Notification|null $notification
     * @return Response
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionEdit(?int $notificationId = null, ?Notification $notification = null): Response
    {
        $this->requireAdmin();

        // If notification isn't already present
        if (!$notification) {
            // Create the notification model
            $notification = $this->_getNotificationModel($notificationId);
        }

        // Whether the notification is new
        $isNewNotification = !$notification->id;

        // Set page title
        $title = ($notification->title ?? Craft::t('notifier', 'Add a New Notification'));

        // Set breadcrumbs
        $crumbs = [
            [
                'label' => Craft::t('notifier', 'Notifications'),
                'url'   => 'notifications',
            ],
        ];

        // Set tabs
        $tabs = [
            'meta' => [
                'label' => Craft::t('notifier', 'Meta'),
                'url'   => '#meta',
            ],
            'event' => [
                'label' => Craft::t('notifier', 'Event'),
                'url'   => '#event',
            ],
            'message' => [
                'label' => Craft::t('notifier', 'Message'),
                'url'   => '#message',
            ],
            'recipients' => [
                'label' => Craft::t('notifier', 'Recipients'),
                'url'   => '#recipients',
            ],
        ];

        // If slug doesn't yet exist
        if (!$notification->slug) {
            // Initialize the slug generator
            $this->_slugGenerator($notification);
        }

        // Returns a CP screen response
        return $this->asCpScreen()
            ->title($title)
            ->crumbs($crumbs)
            ->tabs($tabs)
            ->action('notifier/notifications/save')
            ->addAltAction(Craft::t('app', 'Save and continue editing'), [
                'redirect' => 'notifier/notifications/{id}',
                'shortcut' => true,
                'retainScroll' => true,
            ])
            ->redirectUrl('notifier/notifications')
            ->saveShortcutRedirectUrl('notifier/notifications/{id}')
//            ->editUrl($notification->id ? "notifier/notifications/{$notification->id}" : null)
            ->editUrl($notification->getCpEditUrl())
            ->contentTemplate('notifier/notifications/_edit', [
                'notificationId' => $notificationId,
                'notification' => $notification,
                'isNewNotification' => $isNewNotification,
            ])
            ->sidebarTemplate('notifier/notifications/_edit/details', [
                'notification' => $notification,
            ]);
    }

    /**
     * Save a Notification.
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
        $notificationId   = $request->getBodyParam('notificationId') ?: null;
        $enabled          = $request->getBodyParam('enabled');
        $title            = $request->getBodyParam('title');
        $slug             = $request->getBodyParam('slug');
        $description      = $request->getBodyParam('description');
        $eventType        = $request->getBodyParam('eventType');
        $event            = $request->getBodyParam('event');
        $eventConfig      = $request->getBodyParam('eventConfig');
        $messageType      = $request->getBodyParam('messageType');
        $messageConfig    = $request->getBodyParam('messageConfig');
        $recipientsType   = $request->getBodyParam('recipientsType');
        $recipientsConfig = $request->getBodyParam('recipientsConfig');

        // Extract specific event
        $event = ($event[$eventType] ?? null);

        // Create the notification model
        $notification = $this->_getNotificationModel($notificationId);

        // Set model values
        $notification->id               = $notificationId   ?? $notification->id;
        $notification->enabled          = $enabled          ?? $notification->enabled;
        $notification->title            = $title            ?? $notification->title;
        $notification->slug             = $slug             ?? $notification->slug;
        $notification->description      = $description      ?? $notification->description;
        $notification->eventType        = $eventType        ?? $notification->eventType;
        $notification->event            = $event            ?? $notification->event;
        $notification->eventConfig      = $eventConfig      ?? $notification->eventConfig;
        $notification->messageType      = $messageType      ?? $notification->messageType;
        $notification->messageConfig    = $messageConfig    ?? $notification->messageConfig;
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
     * @throws Throwable
     */
    public function actionDelete(): ?Response
    {
        $this->requirePostRequest();

        // Get specified ID
        $notificationId = $this->request->getRequiredBodyParam('id');

        // Get Notification by ID
        $notification = Craft::$app->getElements()->getElementById($notificationId, Notification::class);

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

    // ========================================================================= //

    /**
     * Fetches or creates a Notification.
     *
     * @param int|null $notificationId
     * @return Notification
     * @throws NotFoundHttpException if the requested entry cannot be found
     */
    private function _getNotificationModel(?int $notificationId): Notification
    {
        // If an ID was specified
        if ($notificationId) {

            // Get the existing notification
            /** @var Notification|null $notification */
            $notification = Notification::find()
                ->id($notificationId)
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

    // ========================================================================= //

    /**
     * Dynamically generate the slug.
     *
     * Snippet borrowed from:
     * https://github.com/craftcms/cms/blob/4f96c7e83201316c3e37832ece10dcc5d35b46ab/src/base/Element.php#L4907-L4924
     *
     * @param Notification $notification
     * @return void
     */
    private function _slugGenerator(Notification $notification): void
    {
        try {

            $view = Craft::$app->getView();
            $site = $notification->getSite();
            $charMapJs = Json::encode($site->language !== Craft::$app->language
                ? StringHelper::asciiCharMap(true, $site->language)
                : null
            );

            Craft::$app->getView()->registerJsWithVars(
                fn($titleSelector, $slugSelector) => <<<JS
new Craft.SlugGenerator($titleSelector, $slugSelector, {
    charMap: $charMapJs,
})
JS,
                [
                    sprintf('#%s', $view->namespaceInputId('title')),
                    sprintf('#%s', $view->namespaceInputId('slug')),
                ]
            );

        } catch (InvalidConfigException $exception) {
            // Don't bother with slug generator
        }
    }

}
