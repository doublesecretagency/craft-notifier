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
use doublesecretagency\notifier\helpers\OAuth1Signer;
use GuzzleHttp\Exception\GuzzleException;
use Throwable;

/**
 * Envelope for an outbound X (Twitter) post.
 *
 * @since 3.1.0
 */
class OutboundXTwitter extends BaseEnvelope
{

    /**
     * @var int Maximum character count for a post body.
     */
    public const MAX_LENGTH = 280;

    /**
     * @var int Maximum number of images per post.
     */
    public const MAX_IMAGES = 4;

    /**
     * @var string|null X (Twitter) API key (consumer key). May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $consumerKey = null;

    /**
     * @var string|null X (Twitter) API secret (consumer secret). May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $consumerKeySecret = null;

    /**
     * @var string|null X (Twitter) access token. May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $accessToken = null;

    /**
     * @var string|null X (Twitter) access token secret. May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $accessTokenSecret = null;

    /**
     * @var string|null Friendly label for the account. Used in log messages.
     */
    public ?string $label = null;

    /**
     * @var string Rendered Twig body. Truncated if it exceeds 280 characters.
     */
    public string $body = '';

    /**
     * @var string Endpoint for creating a post.
     */
    private const TWEETS_ENDPOINT = 'https://api.x.com/2/tweets';

    /**
     * @var string Endpoint for uploading media.
     */
    private const MEDIA_UPLOAD_ENDPOINT = 'https://upload.twitter.com/1.1/media/upload.json';

    /**
     * Send the X (Twitter) post.
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

        // Resolve all four OAuth credentials
        $consumerKey       = (string) App::parseEnv($this->consumerKey);
        $consumerKeySecret = (string) App::parseEnv($this->consumerKeySecret);
        $accessToken       = (string) App::parseEnv($this->accessToken);
        $accessTokenSecret = (string) App::parseEnv($this->accessTokenSecret);

        // If any credential is missing, log error and bail
        if (!$consumerKey || !$consumerKeySecret || !$accessToken || !$accessTokenSecret) {
            $notification->log->error(Craft::t('notifier', '[BAD CREDENTIALS] The recipient is missing X (Twitter) credentials.'), $this->envelopeId);
            return false;
        }

        // Truncate the body to the character limit
        $body = $this->body;
        if (mb_strlen($body) > static::MAX_LENGTH) {
            $body = mb_substr($body, 0, static::MAX_LENGTH);
            $notification->log->warning(
                Craft::t('notifier', '[TRUNCATED] Body exceeded {max} characters.', ['max' => static::MAX_LENGTH]),
                $this->envelopeId
            );
        }

        // Upload any attached images (best-effort)
        $mediaIds = $this->_uploadImages($consumerKey, $consumerKeySecret, $accessToken, $accessTokenSecret, $notification);

        // If there is neither body text nor media, log error and bail
        if ('' === trim($body) && !$mediaIds) {
            $notification->log->error(Craft::t('notifier', '[EMPTY BODY] The X (Twitter) post body is empty.'), $this->envelopeId);
            return false;
        }

        // Resolve a display label for log lines
        $displayLabel = ($this->label ?: 'X (Twitter)');

        // Build the post payload
        $payload = ['text' => $body];
        if ($mediaIds) {
            $payload['media'] = ['media_ids' => $mediaIds];
        }

        // Attempt to send via Guzzle
        try {

            // The JSON body does not participate in the OAuth signature
            $authHeader = OAuth1Signer::authorizationHeader(
                'POST',
                static::TWEETS_ENDPOINT,
                $consumerKey,
                $consumerKeySecret,
                $accessToken,
                $accessTokenSecret
            );

            // POST the new tweet
            $client = Craft::createGuzzleClient();
            $response = $client->post(static::TWEETS_ENDPOINT, [
                'headers'     => [
                    'Authorization' => $authHeader,
                    'Content-Type'  => 'application/json',
                ],
                'json'        => $payload,
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            // Inspect response
            $status = $response->getStatusCode();
            $decoded = json_decode((string) $response->getBody(), true);

            // If X (Twitter) rejected the post
            if ($status < 200 || $status >= 300 || !is_array($decoded) || !isset($decoded['data']['id'])) {
                // Get the error message
                $error = (is_array($decoded) ? ($decoded['detail'] ?? $decoded['title'] ?? "HTTP {$status}") : "HTTP {$status}");
                // Log the error
                $notification->log->error(Craft::t('notifier', '[REJECTED BY X (TWITTER)] {error}', ['error' => $error]), $this->envelopeId);
                // Bail
                return false;
            }

        } catch (GuzzleException|Throwable $exception) {

            // Get the error message (or fall back to a JSON encoded version)
            $message = ($exception->getMessage() ?: 'Unknown error: '.Json::encode($exception));

            // Log the error message
            $notification->log->error(Craft::t('notifier', '[SEND FAILED] {reason}', ['reason' => $message]), $this->envelopeId);

            // Return failure
            return false;
        }

        // Log success
        $notification->log->success(Craft::t('notifier', 'Successfully sent X (Twitter) post as "{label}".', ['label' => $displayLabel]), $this->envelopeId);

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
     * @param string $consumerKey
     * @param string $consumerKeySecret
     * @param string $accessToken
     * @param string $accessTokenSecret
     * @param Notification $notification
     * @return array List of media ID strings.
     */
    private function _uploadImages(string $consumerKey, string $consumerKeySecret, string $accessToken, string $accessTokenSecret, Notification $notification): array
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
                    Craft::t('notifier', 'Videos are not yet supported on {channel}.', ['channel' => 'X (Twitter)'])
                );
                continue;
            }

            // Read the image bytes
            $bytes = Media::bytesFor($descriptor, $readError);

            // If the bytes could not be read, log the reason and skip
            if (!$bytes) {
                $this->logUnattached($notification, ($readError ?: 'The image could not be read.'));
                continue;
            }

            // Upload the image
            $mediaId = $this->_uploadImage($bytes['bytes'], $consumerKey, $consumerKeySecret, $accessToken, $accessTokenSecret, $uploadError);

            // If the upload failed, log the reason and skip
            if (!$mediaId) {
                $this->logUnattached($notification, ($uploadError ?: 'The image failed to upload.'));
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
     * @param string $bytes Raw image bytes.
     * @param string $consumerKey
     * @param string $consumerKeySecret
     * @param string $accessToken
     * @param string $accessTokenSecret
     * @return string|null The media ID, or null on failure.
     */
    private function _uploadImage(string $bytes, string $consumerKey, string $consumerKeySecret, string $accessToken, string $accessTokenSecret, ?string &$error = null): ?string
    {
        try {

            // The multipart body does not participate in the OAuth signature
            $authHeader = OAuth1Signer::authorizationHeader(
                'POST',
                static::MEDIA_UPLOAD_ENDPOINT,
                $consumerKey,
                $consumerKeySecret,
                $accessToken,
                $accessTokenSecret
            );

            // POST the raw image bytes as multipart form data
            $client = Craft::createGuzzleClient();
            $response = $client->post(static::MEDIA_UPLOAD_ENDPOINT, [
                'headers'     => ['Authorization' => $authHeader],
                'multipart'   => [['name' => 'media', 'contents' => $bytes]],
                'http_errors' => false,
                'timeout'     => 30,
            ]);

            // On a non-2xx response, bail
            $status = $response->getStatusCode();
            if ($status < 200 || $status >= 300) {
                $error = "HTTP {$status} from the media upload.";
                return null;
            }

            // Extract the media ID from the response
            $decoded = json_decode((string) $response->getBody(), true);
            $mediaId = (is_array($decoded) ? ($decoded['media_id_string'] ?? null) : null);

            // If the response carried no media ID, bail
            if (!$mediaId) {
                $error = 'The upload response had no media ID.';
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
