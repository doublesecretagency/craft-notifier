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
use craft\helpers\Json;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\Media;
use doublesecretagency\notifier\helpers\Notifier;
use GuzzleHttp\Exception\GuzzleException;
use Throwable;

/**
 * Envelope for an outbound Mastodon post.
 *
 * @since 3.1.0
 */
class OutboundMastodon extends BaseEnvelope
{

    /**
     * @var int Maximum number of images per post.
     */
    public const MAX_IMAGES = 4;

    /**
     * @var string|null Mastodon instance base URL (e.g. "https://mastodon.social"). May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $instanceUrl = null;

    /**
     * @var string|null Mastodon access token. May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $accessToken = null;

    /**
     * @var string|null Friendly name for the account (e.g. "@team@mastodon.social").
     */
    public ?string $label = null;

    /**
     * @var string Rendered Twig body (plain text).
     */
    public string $body = '';

    /**
     * @var string Post visibility (public, unlisted, private, or direct).
     */
    public string $visibility = 'public';

    /**
     * Send the Mastodon post via the statuses API.
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

        // Resolve the instance URL
        $instanceUrl = App::parseEnv($this->instanceUrl);

        // If the instance URL is missing, log error and bail
        if (!$instanceUrl) {
            $notification->log->error(Craft::t('notifier', '[BAD CREDENTIALS] No Mastodon instance URL is configured.'), $this->envelopeId);
            return false;
        }

        // Resolve the access token
        $accessToken = App::parseEnv($this->accessToken);

        // If the access token is missing, log error and bail
        if (!$accessToken) {
            $notification->log->error(Craft::t('notifier', '[BAD CREDENTIALS] No Mastodon access token is configured.'), $this->envelopeId);
            return false;
        }

        // Upload any attached images
        $mediaIds = $this->_uploadImages($instanceUrl, $accessToken, $notification);

        // If there is neither body text nor media, log error and bail
        if ('' === trim($this->body) && !$mediaIds) {
            $notification->log->error(Craft::t('notifier', '[EMPTY BODY] The Mastodon post body is empty.'), $this->envelopeId);
            return false;
        }

        // Resolve a display label for log lines
        $displayLabel = ($this->label ?: $instanceUrl);

        // Attempt to send via Guzzle
        try {

            // Get the Guzzle client
            $client = Craft::createGuzzleClient();

            // Build the status payload
            $payload = [
                'status'     => $this->body,
                'visibility' => $this->visibility,
            ];

            // If images were uploaded, attach them
            if ($mediaIds) {
                $payload['media_ids'] = $mediaIds;
            }

            // POST to the statuses endpoint
            $response = $client->post(rtrim($instanceUrl, '/').'/api/v1/statuses', [
                'headers'     => [
                    'Authorization' => 'Bearer '.$accessToken,
                    'Content-Type'  => 'application/json',
                ],
                'json'        => $payload,
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            // Inspect response
            $status = $response->getStatusCode();
            $decoded = json_decode((string) $response->getBody(), true);

            // If Mastodon rejected the post
            if ($status < 200 || $status >= 300 || !is_array($decoded) || !isset($decoded['id'])) {
                // Get the error message
                $error = (is_array($decoded) ? ($decoded['error'] ?? "HTTP {$status}") : "HTTP {$status}");

                // Log the error
                $notification->log->error(Craft::t('notifier', '[REJECTED BY MASTODON] {error}', ['error' => $error]), $this->envelopeId);

                // Bail
                return false;
            }

        } catch (GuzzleException|Throwable $exception) {

            // Get the error message
            $message = ($exception->getMessage() ?: 'Unknown error: '.Json::encode($exception));

            // Log the error message
            $notification->log->error(Craft::t('notifier', '[SEND FAILED] {reason}', ['reason' => $message]), $this->envelopeId);

            // Return failure
            return false;
        }

        // Log success
        $notification->log->success(Craft::t('notifier', 'Successfully posted to Mastodon as "{label}" account.', ['label' => $displayLabel]), $this->envelopeId);

        // Return success
        return true;
    }

    // ========================================================================= //

    /**
     * Upload attached images and return their media IDs.
     *
     * Best-effort: a failed upload logs a warning and is skipped, so the post
     * still sends with its text. Video items are not yet supported.
     *
     * @param string $instanceUrl
     * @param string $accessToken
     * @param Notification $notification
     * @return array List of media IDs.
     */
    private function _uploadImages(string $instanceUrl, string $accessToken, Notification $notification): array
    {
        // If there is no media, return none
        if (!$this->media) {
            return [];
        }

        // Initialize media IDs
        $mediaIds = [];

        // Loop through each media descriptor
        foreach ($this->media as $descriptor) {

            // If the limit is reached, stop uploading
            if (count($mediaIds) >= static::MAX_IMAGES) {
                break;
            }

            // If the item is a video, log that it is not yet supported and skip
            if ($descriptor->isVideo()) {
                $this->logUnattached(
                    $notification,
                    Craft::t('notifier', 'Videos are not yet supported on {channel}.', ['channel' => 'Mastodon'])
                );
                continue;
            }

            // Read the image bytes
            $bytes = Media::bytesFor($descriptor, $readError);

            // If the bytes could not be read, log the reason and skip
            if (!$bytes) {
                $this->logUnattached($notification, ($readError ?: Craft::t('notifier', 'The image could not be read.')));
                continue;
            }

            // Upload the image
            $mediaId = $this->_uploadImage($instanceUrl, $accessToken, $bytes['bytes'], ($bytes['mime'] ?: 'image/jpeg'), $uploadError);

            // If the upload failed, log the reason and skip
            if (!$mediaId) {
                $this->logUnattached($notification, ($uploadError ?: Craft::t('notifier', 'The image failed to upload.')));
                continue;
            }

            // Add the media ID
            $mediaIds[] = $mediaId;

        }

        // Return all uploaded media IDs
        return $mediaIds;
    }

    /**
     * Upload a single image and return its media ID.
     *
     * @param string $instanceUrl
     * @param string $accessToken
     * @param string $bytes Raw image bytes.
     * @param string $mime The image MIME type.
     * @return string|null The media ID, or null on failure.
     */
    private function _uploadImage(string $instanceUrl, string $accessToken, string $bytes, string $mime, ?string &$error = null): ?string
    {
        // Pick a filename extension matching the MIME
        $ext = match ($mime) {
            'image/png'  => 'png',
            'image/gif'  => 'gif',
            'image/webp' => 'webp',
            default      => 'jpg',
        };

        try {

            // POST the raw image bytes as multipart form data
            $client = Craft::createGuzzleClient();
            $response = $client->post(rtrim($instanceUrl, '/').'/api/v2/media', [
                'headers'     => ['Authorization' => 'Bearer '.$accessToken],
                'multipart'   => [[
                    'name'     => 'file',
                    'contents' => $bytes,
                    'filename' => "image.{$ext}",
                    'headers'  => ['Content-Type' => $mime],
                ]],
                'http_errors' => false,
                'timeout'     => 30,
            ]);

            // Get the response status code
            $status = $response->getStatusCode();

            // If the response is non-2xx, bail
            if ($status < 200 || $status >= 300) {
                // A 403 means the token can post statuses but lacks the media scope
                $error = (403 === $status)
                    ? 'HTTP 403 from the media upload. The access token is likely missing the "write:media" scope.'
                    : "HTTP {$status} from the media upload.";
                return null;
            }

            // Extract the media ID from the response
            $decoded = json_decode((string) $response->getBody(), true);
            $mediaId = (is_array($decoded) ? ($decoded['id'] ?? null) : null);

            // If the response carried no media ID, bail
            if (!$mediaId) {
                $error = Craft::t('notifier', 'The upload response had no media ID.');
                return null;
            }

            // Return the media ID
            return $mediaId;

        } catch (GuzzleException|Throwable $e) {
            $error = $e->getMessage();
            return null;
        }
    }

}
