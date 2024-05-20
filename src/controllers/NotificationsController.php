<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events are triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\controllers;

use Craft;
use craft\base\Element;
use craft\helpers\Json;
use craft\helpers\StringHelper;
use craft\helpers\UrlHelper;
use craft\web\Controller;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\Notifier;
use Throwable;
use yii\base\InvalidConfigException;
use yii\base\InvalidRouteException;
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
     * Create a Notification.
     *
     * @return Response
     * @throws ForbiddenHttpException
     * @throws InvalidConfigException
     * @throws Throwable
     * @throws InvalidRouteException
     */
    public function actionCreate(): Response
    {
        $notification = Craft::createObject(Notification::class);

        // Make sure the user is allowed to create this notification
        if (!Craft::$app->getElements()->canSave($notification)) {
            throw new ForbiddenHttpException('User not authorized to save this notification.');
        }

        $notification->setScenario(Element::SCENARIO_ESSENTIALS);
        if (!Craft::$app->getDrafts()->saveElementAsDraft($notification, Craft::$app->getUser()->getId(), null, null, false)) {
            return $this->asModelFailure($notification, Craft::t('app', 'Couldn’t create {type}.', [
                'type' => Notification::lowerDisplayName(),
            ]), 'notification');
        }

        $editUrl = $notification->getCpEditUrl();

        $response = $this->asModelSuccess($notification, Craft::t('app', '{type} created.', [
            'type' => Notification::displayName(),
        ]), 'notification', array_filter([
            'cpEditUrl' => $this->request->getIsCpRequest() ? $editUrl : null,
        ]));

        if (!$this->request->getAcceptsJson()) {
            $response->redirect(UrlHelper::urlWithParams($editUrl, [
                'fresh' => 1,
            ]));
        }

        return $response;
    }

    /**
     * Edit a Notification.
     *
     * @param Notification|null $notification
     * @param int|null $notificationId
     * @return Response
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionEdit(?Notification $notification = null, ?int $notificationId = null): Response
    {
        $this->requireAdmin();

        // If notification isn't already present
        if (!$notification) {
            // Create the notification model
            $notification = $this->_getNotificationModel($notificationId);
        }

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

        // Set action and button label based on draft state
        if ($notification->getIsDraft()) {
            // Draft
            $action = 'elements/apply-draft';
            $buttonLabel = 'Create {type}';
        } else {
            // Published
            $action = 'elements/save';
            $buttonLabel = 'Save {type}';
        }

        // Returns a CP screen response
        return $this->asCpScreen()
            ->title($title)
            ->crumbs($crumbs)
            ->tabs($tabs)
            ->action($action)
            ->submitButtonLabel(Craft::t('app', $buttonLabel, [
                'type' => $notification::lowerDisplayName(),
            ]))
            ->addAltAction(Craft::t('app', 'Save and continue editing'), [
                'redirect' => 'notifications/{id}',
                'shortcut' => true,
                'retainScroll' => true,
            ])
            ->addAltAction(Craft::t('app', 'Save and add another'), [
                'redirect' => 'notifications/new',
            ])
            ->redirectUrl('notifications')
            ->saveShortcutRedirectUrl('notifications/{id}')
            ->editUrl($notification->getCpEditUrl())
            ->contentTemplate('notifier/notifications/_edit', [
                'notification' => $notification,
            ])
            ->sidebarTemplate('notifier/notifications/_edit/details', [
                'notification' => $notification,
            ]);
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
            /** @var Notification $notification */
            $notification = Notifier::getNotification($notificationId, true);

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
