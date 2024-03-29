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

namespace doublesecretagency\notifier\models;

use Craft;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\Notifier;

/**
 * Class OutboundAnnouncement
 * @since 1.0.0
 */
class OutboundAnnouncement extends BaseEnvelope
{

    /**
     * @var string
     */
    public string $title = '';

    /**
     * @var string
     */
    public string $message = '';

    /**
     * @var bool
     */
    public bool $adminsOnly = false;

    /**
     * Send the announcement.
     *
     * @return bool
     */
    public function send(): bool
    {
        // Get original notification
        /** @var Notification $notification */
        $notification = Notifier::getNotification($this->notificationId);

        // If invalid notification, bail (unable to log)
        if (!$notification) {
            return false;
        }

        // Send the announcement
        Craft::$app->getAnnouncements()->push(
            $this->title,
            $this->message,
            'notifier',
            $this->adminsOnly
        );

        // Log success message
        $notification->log->success("Successfully sent announcement!", $this->envelopeId);

        // Return successfully
        return true;
    }

}
