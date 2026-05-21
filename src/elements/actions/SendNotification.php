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

namespace doublesecretagency\notifier\elements\actions;

use Craft;
use craft\base\ElementAction;
use craft\elements\db\ElementQueryInterface;
use craft\helpers\Html;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\Notifier;
use doublesecretagency\notifier\NotifierPlugin;
use yii\base\Event;

/**
 * Class SendNotification
 * @since 3.0.0
 */
class SendNotification extends ElementAction
{

    /**
     * @var string|null Notifier event type of the element index this action serves.
     */
    public ?string $notifierEventType = null;

    /**
     * @var int|null ID of the Notification to send, set by the trigger picker.
     */
    public ?int $notificationId = null;

    /**
     * @inheritdoc
     */
    public function getTriggerLabel(): string
    {
        return Craft::t('notifier', 'Send Notification');
    }

    /**
     * @inheritdoc
     */
    public function getTriggerHtml(): ?string
    {
        // Get all manually triggered Notifications for this element type
        $notifications = $this->_manualNotifications();

        // If none are available, render no trigger
        if (!$notifications) {
            return null;
        }

        // Bind the action into Craft's element-index action system
        Craft::$app->getView()->registerJsWithVars(static fn($type) => <<<JS
(() => {
    new Craft.ElementActionTrigger({type: $type});
})();
JS, [static::class]);

        // Confirmation shown before any notification is dispatched
        $confirm = Html::encode(Craft::t('notifier', 'Are you sure you want to send this notification?'));

        // If only one Notification applies, render a plain button which fires it directly
        if (1 === count($notifications)) {
            $notification = reset($notifications);
            return '<button type="button" class="btn formsubmit"'
                . ' data-param="notificationId"'
                . ' data-value="' . (int) $notification->id . '"'
                . ' data-confirm="' . $confirm . '">'
                . Html::encode($notification->getManualTriggerLabel())
                . '</button>';
        }

        // Otherwise, build one picker row per available Notification
        $rows = '';
        foreach ($notifications as $notification) {
            $rows .= '<li><a class="formsubmit"'
                . ' data-param="notificationId"'
                . ' data-value="' . (int) $notification->id . '"'
                . ' data-confirm="' . $confirm . '">'
                . Html::encode($notification->getManualTriggerLabel())
                . '</a></li>';
        }

        // Render the menu button and its picker
        $label = Html::encode(Craft::t('notifier', 'Send Notification'));
        return '<button type="button" class="btn menubtn" aria-label="' . $label . '">' . $label . '</button>'
            . '<div class="menu"><ul>' . $rows . '</ul></div>';
    }

    /**
     * @inheritdoc
     */
    public function performAction(ElementQueryInterface $query): bool
    {
        // Get the current user
        $user = Craft::$app->getUser()->getIdentity();

        // If no user, or user can't send manual notifications, bail
        if (!$user || !$user->can('notifier-sendManualNotifications')) {
            return false;
        }

        // Load the chosen Notification
        $notification = ($this->notificationId ? Notifier::getNotification((int) $this->notificationId) : null);

        // If Notification doesn't exist or can't be triggered manually, bail
        if (!$notification || 'manually-triggered' !== $notification->event) {
            $this->setMessage(Craft::t('notifier', 'This notification cannot be triggered manually.'));
            return false;
        }

        // Get the messages service
        $messages = NotifierPlugin::getInstance()->messages;

        // Accumulate the envelope count across every selected element
        $totalSent = 0;

        // Loop over selected elements
        foreach ($query->all() as $element) {
            // Send the notification, summing the envelope count
            $totalSent += $messages->send($notification, new Event(['sender' => $element]), ['object' => $element]);
        }

        // If nothing actually went out, surface that explicitly
        if (0 === $totalSent) {
            $this->setMessage(Craft::t('notifier',
                'Notification was not sent. Check the Notification Log for details.'
            ));
            return false;
        }

        // Report success
        $this->setMessage(Craft::t('notifier', 'Notification sent.'));
        return true;
    }

    // ========================================================================= //

    /**
     * Get all manually triggered Notifications for this action's event type.
     *
     * @return Notification[]
     */
    private function _manualNotifications(): array
    {
        // If no event type is bound, there's nothing to send
        if (!$this->notifierEventType) {
            return [];
        }

        // Get all enabled Notifications manually triggered for this event type
        return Notification::find()
            ->where([
                'eventType' => $this->notifierEventType,
                'event' => 'manually-triggered',
            ])
            ->all();
    }

}
