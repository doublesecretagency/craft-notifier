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
use craft\errors\MissingComponentException;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\Notifier;
use yii\helpers\Markdown;

/**
 * Class OutboundFlash
 * @since 1.0.0
 */
class OutboundFlash extends BaseEnvelope
{

    /**
     * @var string
     */
    public string $type = 'notice';

    /**
     * @var string
     */
    public string $title = '';

    /**
     * @var string
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
                $notification->log->warning("Unable to send the flash message, invalid flash type.", $this->envelopeId);
                return false;
        }

        // Log success message
        $notification->log->success("Successfully sent flash message!", $this->envelopeId);

        // Return successfully
        return true;
    }

}
