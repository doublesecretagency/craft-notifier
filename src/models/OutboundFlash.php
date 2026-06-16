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

namespace doublesecretagency\notifier\models;

use Craft;
use craft\errors\MissingComponentException;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\Notifier;
use yii\helpers\Markdown;

/**
 * Envelope for an outbound flash message.
 *
 * @since 1.0.0
 */
class OutboundFlash extends BaseEnvelope
{

    /**
     * @var string Flash type ('success', 'notice', or 'error').
     */
    public string $type = 'notice';

    /**
     * @var string Flash title.
     */
    public string $title = '';

    /**
     * @var string Flash message body.
     */
    public string $message = '';

    /**
     * Send the flash message.
     *
     * @return bool
     * @throws MissingComponentException
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

        // Get session services
        $session = Craft::$app->getSession();

        // Set message details
        $details = ['details' => Markdown::process($this->message)];

        // Set flash message according to type
        switch ($this->type) {
            case 'success':
                $session->setSuccess($this->title, $details);
                break;
            case 'notice':
                $session->setNotice($this->title, $details);
                break;
            case 'error':
                $session->setError($this->title, $details);
                break;
            default:
                $notification->log->error(Craft::t('notifier', '[INVALID TYPE] The flash message type is invalid.'), $this->envelopeId);
                return false;
        }

        // Log success message
        $notification->log->success(Craft::t('notifier', 'Successfully sent flash message!'), $this->envelopeId);

        // Return successfully
        return true;
    }

}
