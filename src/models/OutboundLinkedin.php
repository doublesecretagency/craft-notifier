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
use craft\helpers\Json;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\LinkedinClient;
use doublesecretagency\notifier\helpers\Notifier;
use doublesecretagency\notifier\NotifierPlugin;

/**
 * Envelope for an outbound LinkedIn post.
 *
 * @since 3.1.0
 */
class OutboundLinkedin extends BaseEnvelope
{

    /**
     * @var string|null UID of the LinkedIn connection to post as.
     */
    public ?string $connectionUid = null;

    /**
     * @var string|null Author URN (urn:li:person:... or urn:li:organization:...).
     */
    public ?string $authorUrn = null;

    /**
     * @var string|null Friendly name for the connection.
     */
    public ?string $label = null;

    /**
     * @var string Rendered Twig body (plain text).
     */
    public string $body = '';

    /**
     * @var string Rendered link URL. Empty when no preview link is set.
     */
    public string $link = '';

    /**
     * Send the LinkedIn post via the Posts API.
     *
     * @return bool
     */
    public function send(): bool
    {
        // Get original notification
        /** @var Notification $notification */
        $notification = Notifier::getNotification($this->notificationId);

        // If invalid notification, bail
        if (!$notification) {
            return false;
        }

        // If the connection UID is missing, log error and bail
        if (!$this->connectionUid || !$this->authorUrn) {
            $notification->log->error(Craft::t('notifier', '[NO RECIPIENT] No LinkedIn connection was specified.'), $this->envelopeId);
            return false;
        }

        // If body is empty, log error and bail
        if ('' === trim($this->body)) {
            $notification->log->error(Craft::t('notifier', '[EMPTY BODY] The LinkedIn post body is empty.'), $this->envelopeId);
            return false;
        }

        // Get a fresh, decrypted access token
        $tokenError = null;
        $accessToken = NotifierPlugin::getInstance()->linkedinConnections->getSendableToken($this->connectionUid, $tokenError);

        // If no usable token is available, log error and bail
        if (!$accessToken) {
            $notification->log->error(Craft::t('notifier', '[RECONNECT REQUIRED] {reason}', ['reason' => ($tokenError ?: 'No valid LinkedIn token.')]), $this->envelopeId);
            return false;
        }

        // Resolve a display label for log lines
        $displayLabel = ($this->label ?: $this->authorUrn);

        // Attempt to publish the post
        $postError = null;
        $success = LinkedinClient::post($accessToken, $this->authorUrn, $this->body, ($this->link ?: null), $postError);

        // If LinkedIn rejected the post, log the error and bail
        if (!$success) {
            $notification->log->error(Craft::t('notifier', '[REJECTED BY LINKEDIN] {error}', ['error' => ($postError ?: 'Unknown error: '.Json::encode($postError))]), $this->envelopeId);
            return false;
        }

        // Log success
        $notification->log->success(Craft::t('notifier', 'Successfully posted to LinkedIn as "{label}" account.', ['label' => $displayLabel]), $this->envelopeId);

        // Return success
        return true;
    }

}
