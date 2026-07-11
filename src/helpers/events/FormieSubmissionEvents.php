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
use verbb\formie\events\SubmissionEvent;

/**
 * Registers Formie Submission event handlers with Notifier.
 *
 * @since 3.2.0
 */
class FormieSubmissionEvents
{

    /**
     * When a Formie form is submitted.
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
            'success' => (bool) $event->success,
        ];

        // Send all matching notifications
        NotifierPlugin::getInstance()->messages->sendAll($notifications, $event, $data);
    }

}
