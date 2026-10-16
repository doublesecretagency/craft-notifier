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

namespace doublesecretagency\notifier\helpers\events;

use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\NotifierPlugin;
use verbb\formie\elements\Submission;
use verbb\formie\events\SubmissionCompleteEvent;
use verbb\formie\events\SubmissionEvent;
use yii\base\Event;

/**
 * Registers Formie Submission event handlers with Notifier.
 *
 * @since 3.2.0
 */
class FormieSubmissionEvents
{

    /**
     * When a Formie form is submitted (Formie 3 and earlier).
     *
     * @param SubmissionEvent $event
     * @return void
     */
    public static function afterSubmission(SubmissionEvent $event): void
    {
        // Get the submission
        $submission = $event->submission;

        // If sender isn't a Submission, bail
        if (!($submission instanceof Submission)) {
            return;
        }

        // Send with Formie's own success flag
        static::_sendAll($event, $submission, (bool) $event->success);
    }

    /**
     * When a Formie submission is completed (Formie 4 and later).
     *
     * Formie 4 only completes a submission once its payment clears, so spam is the only failure.
     *
     * @param SubmissionCompleteEvent $event
     * @return void
     */
    public static function afterComplete(SubmissionCompleteEvent $event): void
    {
        // Get the submission
        $submission = $event->submission;

        // If sender isn't a Submission, bail
        if (!($submission instanceof Submission)) {
            return;
        }

        // If completed by a CP save or import, bail
        if (!$event->context) {
            return;
        }

        // Send as a failure if the submission was flagged as spam
        static::_sendAll($event, $submission, !$submission->isSpam);
    }

    // ========================================================================= //

    /**
     * Send all notifications for a submitted form.
     *
     * @param Event $event
     * @param Submission $submission
     * @param bool $success
     * @return void
     */
    private static function _sendAll(Event $event, Submission $submission, bool $success): void
    {
        // Get all notifications for this event
        $notifications = Notification::find()
            ->where([
                'eventType' => 'formie-submissions',
                'event' => 'after-submission',
            ])
            ->all();

        // Pass the submission, its form, and success flag to the message
        $data = [
            'object'  => $submission,
            'form'    => $submission->getForm(),
            'success' => $success,
        ];

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
    }

}
