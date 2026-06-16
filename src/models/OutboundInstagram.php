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
use doublesecretagency\notifier\helpers\MetaGraph;
use doublesecretagency\notifier\helpers\Notifier;

/**
 * Envelope for an outbound Instagram post.
 *
 * @since 3.1.0
 */
class OutboundInstagram extends BaseEnvelope
{

    /**
     * @var int Maximum character count for a caption.
     */
    public const MAX_CAPTION = 2200;

    /**
     * @var int Maximum number of times to poll a media container before publishing.
     */
    private const POLL_ATTEMPTS = 5;

    /**
     * @var int|null Instagram business account ID, resolved from the linked Page.
     */
    public ?string $igUserId = null;

    /**
     * @var string|null Page Access Token. May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $pageAccessToken = null;

    /**
     * @var string|null Friendly label for the account. Used in log messages.
     */
    public ?string $label = null;

    /**
     * @var string Rendered Twig caption. Truncated if it exceeds 2200 characters.
     */
    public string $caption = '';

    /**
     * @var string State of the Image Attachment field: 'set', 'empty', 'unset', or 'error'.
     */
    public string $mediaFieldState = 'set';

    /**
     * Send the Instagram post.
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

        // Resolve the IG user ID and Page Access Token
        $igUserId = (string) App::parseEnv($this->igUserId);
        $token = (string) App::parseEnv($this->pageAccessToken);

        // If the token or IG user ID is missing, log error and bail
        if (!$token || !$igUserId) {
            $notification->log->error(Craft::t('notifier', '[BAD CREDENTIALS] Unable to post, recipient is missing credentials.'), $this->envelopeId);
            return false;
        }

        // Find the first attachable image
        $image = $this->_firstImage($notification);

        // If there is no image, log error and bail (Instagram cannot post text-only)
        if (!$image) {

            // HTML wrapping the setMedia tag
            $setMediaTag = '<code>{% setMedia %}</code>';

            // If the Image Attachment field was left empty, error
            if ('empty' === $this->mediaFieldState) {
                $notification->log->error(Craft::t('notifier', '[MISSING IMAGE] Image Attachment field was empty.'), $this->envelopeId);

            // If the field had content but never called setMedia, error
            } elseif ('unset' === $this->mediaFieldState) {
                $notification->log->error(Craft::t('notifier', '[MISSING IMAGE] Image Attachment field never called the {tag} tag.', ['tag' => $setMediaTag]), $this->envelopeId);

            // Otherwise setMedia ran but resolved to no usable image, error
            } else {
                $notification->log->error(Craft::t('notifier', '[MISSING IMAGE] The {tag} tag was called, but returned an invalid image.', ['tag' => $setMediaTag]), $this->envelopeId);
            }

            // Bail
            return false;
        }

        // If the image has no public URL, log error and bail (Instagram fetches the image by URL)
        if (!$image->url) {
            $notification->log->error(Craft::t('notifier', '[MISSING IMAGE] Unable to send Instagram post, the image needs a public URL.'), $this->envelopeId);
            return false;
        }

        // Truncate the caption to the character limit
        $caption = $this->caption;
        if (mb_strlen($caption) > static::MAX_CAPTION) {
            $caption = mb_substr($caption, 0, static::MAX_CAPTION);
            $notification->log->warning(
                Craft::t('notifier', '[TRUNCATED] Caption exceeded {max} characters.', ['max' => static::MAX_CAPTION]),
                $this->envelopeId
            );
        }

        // Resolve a display label for log lines
        $displayLabel = ($this->label ?: $igUserId);

        // Create the media container
        $container = MetaGraph::createImageContainer($igUserId, $image->url, $caption, $token);

        // If the container failed, log error and bail
        if (!$container['ok'] || !isset($container['data']['id'])) {
            $notification->log->error(Craft::t('notifier', '[REJECTED BY INSTAGRAM] {error}', ['error' => ($container['error'] ?? 'unknown')]), $this->envelopeId);
            return false;
        }

        // Get the container ID
        $creationId = (string) $container['data']['id'];

        // Wait for the container to finish processing
        $this->_awaitContainer($creationId, $token);

        // Publish the container
        $publish = MetaGraph::publishContainer($igUserId, $creationId, $token);

        // If the publish failed, log error and bail
        if (!$publish['ok']) {
            $notification->log->error(Craft::t('notifier', '[REJECTED BY INSTAGRAM] {error}', ['error' => ($publish['error'] ?? 'unknown')]), $this->envelopeId);
            return false;
        }

        // Log success
        $notification->log->success(Craft::t('notifier', 'Successfully posted to "{label}" Instagram account.', ['label' => $displayLabel]), $this->envelopeId);

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
                    Craft::t('notifier', 'Videos are not yet supported on {channel}.', ['channel' => 'Instagram'])
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
     * Poll a media container until it finishes processing.
     *
     * Bounded best-effort. An image container is usually ready immediately, so
     * a poll that never reports FINISHED still falls through to the publish.
     *
     * @param string $creationId
     * @param string $token Page Access Token.
     * @return void
     */
    private function _awaitContainer(string $creationId, string $token): void
    {
        // Poll a bounded number of times
        for ($attempt = 0; $attempt < static::POLL_ATTEMPTS; $attempt++) {

            // Get the container's status
            $status = MetaGraph::getContainerStatus($creationId, $token);

            // If the container is ready, stop polling
            if ('FINISHED' === ($status['data']['status_code'] ?? null)) {
                return;
            }

            // Wait a moment before polling again
            sleep(1);

        }
    }

}
