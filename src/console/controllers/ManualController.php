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

namespace doublesecretagency\notifier\console\controllers;

use Craft;
use craft\console\Controller;
use craft\helpers\Console;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\Notifier;
use doublesecretagency\notifier\NotifierPlugin;
use yii\base\Event;
use yii\console\ExitCode;

/**
 * Manually trigger notifications from the command line.
 * @since 3.0.0
 */
class ManualController extends Controller
{

    /**
     * Manually trigger a notification for a specific element.
     *
     * Usage:
     *   craft notifier/manual/send <notificationId> <elementId>
     *
     * @param int $notificationId ID of the notification to send.
     * @param int $elementId ID of the element to send the notification for.
     * @return int Exit code.
     */
    public function actionSend(int $notificationId, int $elementId): int
    {
        // Load the Notification
        $notification = Notifier::getNotification($notificationId);

        // If no matching Notification, bail
        if (!$notification) {
            $this->stderr("Notification {$notificationId} not found." . PHP_EOL, Console::FG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        // If the Notification isn't manually triggerable, bail
        if ('manually-triggered' !== $notification->event) {
            $this->stderr("Notification {$notificationId} cannot be triggered manually." . PHP_EOL, Console::FG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        // Load the element
        $element = Craft::$app->getElements()->getElementById($elementId);

        // If no matching element, bail
        if (!$element) {
            $this->stderr("Element {$elementId} not found." . PHP_EOL, Console::FG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        // Re-validate that the Notification applies to this element
        $applicable = NotifierPlugin::getInstance()->messages->getManualNotifications($element);
        $stillApplies = array_filter(
            $applicable,
            static fn(Notification $n): bool => ((int) $n->id === $notificationId)
        );

        // If the Notification doesn't apply, bail
        if (!$stillApplies) {
            $this->stderr("Notification {$notificationId} does not apply to element {$elementId}." . PHP_EOL, Console::FG_RED);
            return ExitCode::UNSPECIFIED_ERROR;
        }

        // Send the Notification for the element
        $event = new Event(['sender' => $element]);
        NotifierPlugin::getInstance()->messages->send($notification, $event, ['object' => $element]);

        // Report success
        $this->stdout("Notification sent." . PHP_EOL, Console::FG_GREEN);
        return ExitCode::OK;
    }

}
