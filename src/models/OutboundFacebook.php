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
use craft\helpers\App;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\Media;
use doublesecretagency\notifier\helpers\MetaGraph;
use doublesecretagency\notifier\helpers\Notifier;

/**
 * Envelope for an outbound Facebook Page post.
 *
 * @since 3.1.0
 */
class OutboundFacebook extends BaseEnvelope
{

    /**
     * @var string|null Facebook page ID.
     */
    public ?string $pageId = null;

    /**
     * @var string|null Page Access Token. May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $pageAccessToken = null;

    /**
     * @var string|null Friendly label for the page. Used in log messages.
     */
    public ?string $label = null;

    /**
     * @var string Rendered Twig body.
     */
    public string $body = '';

    /**
     * @var string Rendered link URL. Attaches a preview card when set on a text post.
     */
    public string $link = '';

    /**
     * Send the Facebook Page post.
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

        // Resolve the Page ID and Page Access Token
        $pageId = (string) App::parseEnv($this->pageId);
        $token = (string) App::parseEnv($this->pageAccessToken);

        // If the token or page ID is missing, log error and bail
        if (!$token || !$pageId) {
            $notification->log->error(Craft::t('notifier', '[BAD CREDENTIALS] The recipient is missing Facebook credentials.'), $this->envelopeId);
            return false;
        }

        // Resolve a display label for log lines
        $displayLabel = ($this->label ?: $pageId);

        // Find the first attachable image, if any
        $image = $this->_firstImage($notification);

        // If an image is present, post it as a photo
        if ($image) {
            $result = $this->_postPhoto($image, $pageId, $token);
        } else {
            // If there is neither body text nor a link, log error and bail
            if ('' === trim($this->body) && '' === trim($this->link)) {
                $notification->log->error(Craft::t('notifier', '[EMPTY BODY] The Facebook post body is empty.'), $this->envelopeId);
                return false;
            }
            // Post the message to the Page feed
            $result = MetaGraph::postPageFeed($pageId, $this->body, ($this->link ?: null), $token);
        }

        // If the post failed, log the error and bail
        if (!$result['ok']) {
            $notification->log->error(Craft::t('notifier', '[REJECTED BY FACEBOOK] {error}', ['error' => $result['error']]), $this->envelopeId);
            return false;
        }

        // Log success
        $notification->log->success(Craft::t('notifier', 'Successfully sent Facebook post to "{label}".', ['label' => $displayLabel]), $this->envelopeId);

        // Return success
        return true;
    }

    // ========================================================================= //

    /**
     * Find the first attachable image among the media descriptors.
     *
     * Logs (but does not fail on) video items, which are not yet supported.
     *
     * @param Notification $notification
     * @return ResolvedMedia|null
     */
    private function _firstImage(Notification $notification): ?ResolvedMedia
    {
        // Loop through each media descriptor
        foreach ($this->media as $descriptor) {

            // If the item is a video, log that it is not yet supported and skip
            if ($descriptor->isVideo()) {
                $this->logUnattached(
                    $notification,
                    Craft::t('notifier', 'Videos are not yet supported on {channel}.', ['channel' => 'Facebook'])
                );
                continue;
            }

            // Return the first image
            return $descriptor;
        }

        // No image found
        return null;
    }

    /**
     * Post a single image as a Facebook photo.
     *
     * Tries the public URL first, then uploads the raw bytes when Facebook can't
     * reach the URL (its photo-by-URL edge rejects a non-public URL with #100).
     *
     * @param ResolvedMedia $image The image to post.
     * @param string $pageId Resolved Page ID.
     * @param string $token Page Access Token.
     * @return array Normalized result (ok, status, data, error).
     */
    private function _postPhoto(ResolvedMedia $image, string $pageId, string $token): array
    {
        // Initialize the URL-post result for fallback error reporting
        $urlResult = null;

        // If the image has a URL, try posting it directly
        if ($image->url) {
            $urlResult = MetaGraph::postPagePhoto($pageId, $image->url, $this->body, $token);
            // If the URL post succeeded, return it
            if ($urlResult['ok']) {
                return $urlResult;
            }
            // Otherwise fall through to the byte upload (the URL may not be publicly reachable)
        }

        // Get the raw image bytes
        $bytes = Media::bytesFor($image);

        // If the bytes were read, upload them
        if ($bytes) {
            return MetaGraph::postPagePhotoBytes($pageId, $bytes['bytes'], $this->body, $token);
        }

        // If the URL post ran and failed, surface its error
        if ($urlResult) {
            return $urlResult;
        }

        // Return a read-failure error
        return [
            'ok' => false,
            'status' => 0,
            'data' => [],
            'error' => Craft::t('notifier', 'the attached image could not be read')
        ];
    }

}
