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
use craft\base\Element;
use craft\helpers\Json;
use craft\helpers\StringHelper;
use craft\helpers\UrlHelper;
use craft\web\Controller;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\exceptions\TestPreflightException;
use doublesecretagency\notifier\helpers\Compat;
use doublesecretagency\notifier\helpers\Notifier;
use doublesecretagency\notifier\helpers\SystemSnapshot;
use doublesecretagency\notifier\NotifierPlugin;
use Throwable;
use yii\base\Event;
use yii\base\InvalidConfigException;
use yii\base\InvalidRouteException;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Controller for the notification CP screens.
 *
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
            throw new ForbiddenHttpException(Craft::t('notifier', 'User not authorized to save this notification.'));
        }

        // Set the essentials scenario for the draft save
        $notification->setScenario(Element::SCENARIO_ESSENTIALS);

        // If the draft couldn't be saved, return the failure
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

        // If the request doesn't accept JSON, redirect to the edit screen
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
     * View-only users (those who hold `notifier-viewNotifications` but not
     * `notifier-saveNotifications`) land on a read-only rendering of the
     * edit screen rather than a 403. The submit button, all save-and-X alt
     * actions, and the delete action are suppressed; the content template
     * wraps its form in a disabled fieldset to neutralize every input.
     *
     * The element-level `canSave()` gate still enforces server-side write
     * protection on the actual elements/save POST endpoint, so a read-only
     * user who crafts a manual POST is still rejected.
     *
     * @param Notification|null $notification
     * @param int|null $notificationId
     * @return Response
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionEdit(?Notification $notification = null, ?int $notificationId = null): Response
    {
        // If notification isn't already present
        if (!$notification) {
            // Create the notification model
            $notification = $this->_getNotificationModel($notificationId);
        }

        // Get the elements service
        $elementsService = Craft::$app->getElements();

        // Whether the user can save / delete this notification
        $canSave = $elementsService->canSave($notification);
        $canDelete = $elementsService->canDelete($notification);

        // If the user can neither view nor save, bail
        if (!$canSave && !$elementsService->canView($notification)) {
            throw new ForbiddenHttpException(Craft::t('notifier', 'User not authorized to view this notification.'));
        }

        // If the user cannot save, render the screen in read-only mode
        $readOnly = !$canSave;

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

        // If slug doesn't yet exist and the user can edit, initialize the slug generator
        if (!$notification->slug && !$readOnly) {
            $this->_slugGenerator($notification);
        }

        // Get element type
        $type = $notification::lowerDisplayName();

        // Whether the Notification is a draft
        $isDraft = $notification->getIsDraft();

        // Configure based on draft state
        if ($isDraft) {
            // Draft
            $action = 'elements/apply-draft';
            $buttonLabel = 'Create {type}';
        } else {
            // Published
            $action = 'elements/save';
            $buttonLabel = 'Save {type}';
        }

        // Build the CP screen response
        $response = $this->asCpScreen()
            ->title($title)
            ->crumbs($crumbs)
            ->tabs($tabs)
            ->redirectUrl('notifications')
            ->editUrl($notification->getCpEditUrl())
            ->contentTemplate('notifier/notifications/_edit', [
                'notification' => $notification,
                'readOnly' => $readOnly,
            ]);

        // Get sidebar method based on Craft major version
        $sidebarMethod = Compat::metaSidebarMethodName();

        // Set the sidebar
        $response->{$sidebarMethod}('notifier/notifications/_edit/details', [
            'notification' => $notification,
            'readOnly' => $readOnly,
        ]);

        // Whether this notification is a report type
        $isReport = $notification->isReportType();

        // Determine which button template to use
        $buttonTemplate = ($isReport ? 'send-report' : 'send-test');

        // Set the "Send" button
        $response->additionalButtonsTemplate("notifier/notifications/_edit/{$buttonTemplate}", [
            'notification' => $notification,
        ]);

        // If the user can save, attach all of the save-side affordances
        if (!$readOnly) {
            $response
                ->action($action)
                ->submitButtonLabel(Craft::t('app', $buttonLabel, [
                    'type' => $type,
                ]))
                ->addAltAction(Craft::t('app', 'Save and continue editing'), [
                    'redirect' => 'notifications/{id}',
                    'shortcut' => true,
                    'retainScroll' => true,
                ])
                ->addAltAction(Craft::t('app', 'Save and add another'), [
                    'redirect' => 'notifications/new',
                ])
                ->saveShortcutRedirectUrl('notifications/{id}');
        }

        // If the user can delete, attach the destructive Delete alt-action
        if ($canDelete) {
            $response->addAltAction(Craft::t('app', 'Delete {type}', [
                'type' => $type,
            ]), [
                'destructive' => true,
                'action' => $isDraft ? 'elements/delete-draft' : 'elements/delete',
                'redirect' => 'notifications',
                'confirm' => Craft::t('app', 'Are you sure you want to delete this {type}?', [
                    'type' => $type,
                ]),
            ]);
        }

        return $response;
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

        // Make sure the user is allowed to delete this notification
        if (!Craft::$app->getElements()->canDelete($notification)) {
            throw new ForbiddenHttpException(Craft::t('notifier', 'User not authorized to delete this notification.'));
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
     * Send a test of a Notification.
     *
     * Bypasses event-type filters so the operator can verify the configured
     * message body and recipient strategy without waiting for a real Craft
     * event to fire. The message body, recipients, queue setting, and channel
     * all use the live Notification configuration.
     *
     * @return Response
     * @throws BadRequestHttpException
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionTest(): Response
    {
        $this->requirePostRequest();
        $this->requireAcceptsJson();

        // Require the test permission
        $this->requirePermission('notifier-testNotifications');

        // Get the specified Notification ID
        $notificationId = (int) $this->request->getRequiredBodyParam('notificationId');

        // Get the Notification
        /** @var Notification|null $notification */
        $notification = Craft::$app->getElements()->getElementById($notificationId, Notification::class);

        // If no matching Notification, 404
        if (!$notification) {
            throw new NotFoundHttpException(Craft::t('notifier', 'Notification not found'));
        }

        // Dispatch the test, aborting cleanly if the preflight fails
        try {
            $dispatch = NotifierPlugin::getInstance()->messages->sendTest($notification);
        } catch (TestPreflightException $e) {
            // Return the reason as a CP error toast via the existing JS handler
            return $this->asJson([
                'success' => false,
                'message' => $e->getMessage(),
                'envelopeCount' => 0,
            ]);
        }

        // Count compiled envelopes
        $envelopeCount = count(array_filter($dispatch->envelopes));

        // If no envelopes were compiled, return a soft warning
        if (0 === $envelopeCount) {
            return $this->asJson([
                'success' => false,
                'message' => Craft::t('notifier', 'No messages were dispatched. Check the recipient configuration.'),
                'envelopeCount' => 0,
            ]);
        }

        // Otherwise, report success
        return $this->asJson([
            'success' => true,
            'message' => Craft::t('notifier', 'Test notification dispatched.'),
            'envelopeCount' => $envelopeCount,
        ]);
    }

    /**
     * Manually trigger a Notification for a specific element.
     *
     * Fired from the element edit screen's action menu. Re-validates membership
     * server-side, so a stale page or crafted POST can't fire a mismatched Notification.
     *
     * @return Response
     * @throws BadRequestHttpException
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionSendManual(): Response
    {
        $this->requirePostRequest();
        $this->requireAcceptsJson();

        // Require the manual-send permission
        $this->requirePermission('notifier-sendManualNotifications');

        // Get the specified notification and element IDs
        $notificationId = (int) $this->request->getRequiredBodyParam('notificationId');
        $elementId      = (int) $this->request->getRequiredBodyParam('elementId');

        // Get the Notification
        $notification = Notifier::getNotification($notificationId);

        // If no matching Notification, 404
        if (!$notification) {
            throw new NotFoundHttpException(Craft::t('notifier', 'Notification not found'));
        }

        // If the Notification isn't manually triggerable, bail
        if ('manually-triggered' !== $notification->event) {
            throw new BadRequestHttpException(Craft::t('notifier', 'This notification cannot be triggered manually.'));
        }

        // Get the element
        $element = Craft::$app->getElements()->getElementById($elementId);

        // If no matching element, 404
        if (!$element) {
            throw new NotFoundHttpException(Craft::t('notifier', 'Element not found'));
        }

        // Re-validate that the Notification still applies to this element
        $applicable = NotifierPlugin::getInstance()->messages->getManualNotifications($element);
        $stillApplies = array_filter(
            $applicable,
            static fn(Notification $n): bool => ((int) $n->id === $notificationId)
        );

        // If the Notification no longer applies, return a soft failure
        if (!$stillApplies) {
            return $this->asJson([
                'success' => false,
                'message' => Craft::t('notifier', 'This notification no longer applies to the selected element.'),
            ]);
        }

        // Send the Notification for the element
        $event = new Event(['sender' => $element]);
        $count = NotifierPlugin::getInstance()->messages->send($notification, $event, ['object' => $element]);

        // If nothing actually went out, report it
        if (0 === $count) {
            return $this->asJson([
                'success' => false,
                'message' => Craft::t('notifier',
                    'Notification was not sent. Check the Notification Log for details.'
                ),
            ]);
        }

        // Report success
        return $this->asJson([
            'success' => true,
            'message' => Craft::t('notifier', 'Notification sent.'),
        ]);
    }

    /**
     * Send a report-type Notification on demand.
     *
     * Fired from the "Send" button on the edit screen
     * of a System Snapshot or Dynamic Data notification.
     *
     * @return Response
     * @throws BadRequestHttpException
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionSendReport(): Response
    {
        $this->requirePostRequest();
        $this->requireAcceptsJson();

        // Require the manual-send permission
        $this->requirePermission('notifier-sendManualNotifications');

        // Get the specified notification ID
        $notificationId = (int) $this->request->getRequiredBodyParam('notificationId');

        // Get the Notification
        $notification = Notifier::getNotification($notificationId);

        // If no matching Notification, 404
        if (!$notification) {
            throw new NotFoundHttpException(Craft::t('notifier', 'Notification not found'));
        }

        // If the Notification isn't a report event type, bail
        if (!$notification->isReportType()) {
            throw new BadRequestHttpException(Craft::t('notifier', 'This notification cannot be triggered manually.'));
        }

        // If Notification is a System Snapshot
        if ('system-snapshot' === $notification->eventType) {
            // Compile the report
            $data = ['report' => SystemSnapshot::compile()];
        } else {
            // Empty data
            $data = [];
        }

        // Build an event with no sender
        $event = new Event(['sender' => null]);

        // Send the Notification
        $count = NotifierPlugin::getInstance()->messages->send($notification, $event, $data);

        // If nothing actually went out, report it
        if (0 === $count) {
            return $this->asJson([
                'success' => false,
                'message' => Craft::t('notifier',
                    'Notification was not sent. Check the Notification Log for details.'
                ),
            ]);
        }

        // Report success
        return $this->asJson([
            'success' => true,
            'message' => Craft::t('notifier', 'Notification sent.'),
        ]);
    }

    // ========================================================================= //

    /**
     * Get or create a Notification.
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
            throw new NotFoundHttpException(Craft::t('notifier', 'Notification not found'));
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
