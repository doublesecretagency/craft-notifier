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
use DateTime;
use DateTimeZone;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\BlueskyFacets;
use doublesecretagency\notifier\helpers\BlueskyLinkCard;
use doublesecretagency\notifier\helpers\BlueskySession;
use doublesecretagency\notifier\helpers\Media;
use doublesecretagency\notifier\helpers\Notifier;
use doublesecretagency\notifier\NotifierPlugin;
use doublesecretagency\notifier\models\Settings;
use GuzzleHttp\Exception\GuzzleException;
use Throwable;

/**
 * Envelope for an outbound Bluesky post.
 *
 * @since 3.0.0
 */
class OutboundBluesky extends BaseEnvelope
{

    /**
     * @var int Maximum grapheme count for a Bluesky post body.
     */
    public const MAX_GRAPHEMES = 300;

    /**
     * @var int Cache TTL for handle->DID resolution (24 hours).
     */
    public const HANDLE_RESOLUTION_TTL = 86400;

    /**
     * @var int Maximum number of images per post.
     */
    public const MAX_IMAGES = 4;

    /**
     * @var int Maximum size for an embedded image blob. A fixed ATProto lexicon constant.
     */
    public const MAX_IMAGE_BYTES = 1000000;

    /**
     * @var string|null Bluesky handle (e.g. "example.bsky.social"). May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $handle = null;

    /**
     * @var string|null App password. May be a $ENV_VAR reference, resolved at send time.
     */
    public ?string $appPassword = null;

    /**
     * @var string|null Friendly label (e.g. "example's account"). Used in log messages.
     */
    public ?string $label = null;

    /**
     * @var string Rendered Twig body. Will be truncated if it exceeds 300 graphemes.
     */
    public string $body = '';

    /**
     * @var string|null Language tag for the post (e.g. "en"), derived from the primary site.
     */
    public ?string $language = null;

    /**
     * @var bool Whether to attach an `app.bsky.embed.external` link-preview card when the body contains a URL.
     */
    public bool $linkCard = true;

    /**
     * Send the Bluesky post.
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

        /** @var Settings $settings */
        $settings = NotifierPlugin::$plugin->getSettings();

        // Resolve PDS URL, falling back to the default Bluesky PDS
        $pdsUrl = App::parseEnv($settings->blueskyPdsUrl) ?: Settings::DEFAULT_PDS_URL;

        // Resolve the handle and app password
        $handle = (string) App::parseEnv($this->handle);
        $appPassword = (string) App::parseEnv($this->appPassword);

        // If recipient is missing required fields, log error and bail
        if (!$handle || !$appPassword) {
            $notification->log->error(Craft::t('notifier', '[BAD CREDENTIALS] The recipient is missing Bluesky credentials.'), $this->envelopeId);
            return false;
        }

        // Get the body
        $body = $this->body;

        // If the body exceeds the grapheme limit, truncate it
        if (BlueskyFacets::graphemeCount($body) > static::MAX_GRAPHEMES) {
            $original = $body;
            $body = BlueskyFacets::truncateToGraphemes($body, static::MAX_GRAPHEMES);
            $notification->log->warning(
                Craft::t('notifier', '[TRUNCATED] Body exceeded {max} characters.', ['max' => $this->getMaxGraphemes()]),
                $this->envelopeId
            );
        }

        // Get a session (cached or fresh)
        $session = $this->_resolveSession($pdsUrl, $handle, $appPassword, $notification);

        // If the session couldn't be resolved, bail
        if (!$session) {
            return false;
        }

        // Build the post record
        $record = $this->_buildPostRecord($body, $pdsUrl);

        // Attach explicit images when present (one embed type; images win over the link card)
        if ($this->media) {
            $this->_attachImages($record, $pdsUrl, $session, $notification);
        }

        // Attach a link-preview card when enabled and no images were attached (best-effort)
        if (!isset($record['embed']) && $this->linkCard) {
            $this->_attachLinkCard($record, $body, $pdsUrl, $session, $notification);
        }

        // Attempt to publish
        $success = $this->_publishRecord($pdsUrl, $session, $record, $notification);

        // Retry-once on 401 (session may have expired between cache get and publish)
        if (!$success && $this->_lastStatus === 401) {
            // Invalidate the cached session
            BlueskySession::invalidate($pdsUrl, $handle);

            // Get a fresh session
            $session = $this->_resolveSession($pdsUrl, $handle, $appPassword, $notification, force: true);

            // If the fresh session couldn't be resolved, bail
            if (!$session) {
                return false;
            }
            $success = $this->_publishRecord($pdsUrl, $session, $record, $notification);
        }

        // Log success when the publish call returned true
        if ($success) {
            $displayLabel = ($this->label ?: $handle);
            $notification->log->success(Craft::t('notifier', 'Successfully posted to Bluesky as "{label}".', ['label' => $displayLabel]), $this->envelopeId);
        }

        return $success;
    }

    /**
     * Expose the grapheme limit for testing.
     *
     * @return int
     */
    public function getMaxGraphemes(): int
    {
        return static::MAX_GRAPHEMES;
    }

    // ========================================================================= //

    /**
     * @var int|null Most recent publish status code (used by the retry-on-401 path).
     */
    private ?int $_lastStatus = null;

    /**
     * Resolve a session payload (cached or freshly created).
     *
     * @param string $pdsUrl
     * @param string $handle Resolved Bluesky handle.
     * @param string $appPassword Resolved app password.
     * @param Notification $notification
     * @param bool $force Skip the cache and force a fresh createSession.
     * @return array|null
     */
    private function _resolveSession(string $pdsUrl, string $handle, string $appPassword, Notification $notification, bool $force = false): ?array
    {
        // Try the cache first unless caller forced refresh
        if (!$force) {
            // Get the cached session
            $cached = BlueskySession::get($pdsUrl, $handle);

            // If a cached session exists, return it
            if ($cached) {
                return $cached;
            }
        }

        // Hit createSession
        $err = null;
        $session = BlueskySession::createSession($pdsUrl, $handle, $appPassword, $err);

        // If createSession failed, log and bail
        if (!$session) {
            $notification->log->error(Craft::t('notifier', '[SEND FAILED] Authentication failed for {handle}: {reason}', ['handle' => $handle, 'reason' => $err]), $this->envelopeId);
            return null;
        }

        // Cache for next time
        BlueskySession::put($pdsUrl, $handle, $session);

        return $session;
    }

    /**
     * Build the ATProto post record payload.
     *
     * @param string $body
     * @param string $pdsUrl
     * @return array
     */
    private function _buildPostRecord(string $body, string $pdsUrl): array
    {
        // Build base record
        $record = [
            'text'      => $body,
            'createdAt' => (new DateTime('now', new DateTimeZone('UTC')))->format('Y-m-d\TH:i:s.v\Z'),
        ];

        // Attach the post language
        if ($this->language) {
            $record['langs'] = [$this->language];
        }

        // Build facets for URLs and mentions
        $facets = BlueskyFacets::build($body, function (string $handle) use ($pdsUrl): ?string {
            return $this->_resolveHandleToDid($handle, $pdsUrl);
        });

        // If any facets were built, attach them
        if ($facets) {
            $record['facets'] = $facets;
        }

        return $record;
    }

    /**
     * Resolve a Bluesky handle (e.g. "example.bsky.social") to its DID, with caching.
     *
     * @param string $handle
     * @param string $pdsUrl
     * @return string|null
     */
    private function _resolveHandleToDid(string $handle, string $pdsUrl): ?string
    {
        // Build cache key
        $cacheKey = 'notifier.bluesky.handleDid.'.sha1($handle);

        // Get the cached DID
        $cached = Craft::$app->getCache()->get($cacheKey);

        // If a cached DID exists, return it
        if ($cached) {
            return (string) $cached;
        }

        // Hit identity.resolveHandle on the public network
        try {
            $client = Craft::createGuzzleClient();
            $endpoint = rtrim($pdsUrl, '/').'/xrpc/com.atproto.identity.resolveHandle';
            $response = $client->get($endpoint, [
                'query'       => ['handle' => $handle],
                'http_errors' => false,
                'timeout'     => 10,
            ]);

            // If the handle lookup failed, bail
            if (200 !== $response->getStatusCode()) {
                return null;
            }

            $payload = Json::decodeIfJson((string) $response->getBody());
            $did = (is_array($payload) ? ($payload['did'] ?? null) : null);

            // If no DID was returned, bail
            if (!$did) {
                return null;
            }

            // Cache the resolved DID
            Craft::$app->getCache()->set($cacheKey, $did, static::HANDLE_RESOLUTION_TTL);

            return $did;

        } catch (Throwable) {
            return null;
        }
    }

    /**
     * POST the post record to com.atproto.repo.createRecord.
     *
     * Returns true on success, false on failure. The most-recent status code is
     * cached in `$_lastStatus` so the caller can decide whether to retry on 401.
     *
     * @param string $pdsUrl
     * @param array $session
     * @param array $record
     * @param Notification $notification
     * @return bool
     */
    private function _publishRecord(string $pdsUrl, array $session, array $record, Notification $notification): bool
    {
        // Reset last status
        $this->_lastStatus = null;

        // Normalize endpoint
        $endpoint = rtrim($pdsUrl, '/').'/xrpc/com.atproto.repo.createRecord';

        try {
            $client = Craft::createGuzzleClient();
            $response = $client->post($endpoint, [
                'headers'     => [
                    'Content-Type'  => 'application/json',
                    'Authorization' => "Bearer {$session['accessJwt']}",
                ],
                'json'        => [
                    'repo'       => $session['did'],
                    'collection' => 'app.bsky.feed.post',
                    'record'     => $record,
                ],
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            $status = $response->getStatusCode();
            $this->_lastStatus = $status;

            // ATProto returns 200 with a uri + cid on success
            if (200 !== $status) {
                $body = (string) $response->getBody();
                $payload = Json::decodeIfJson($body);
                $reason = (is_array($payload) ? ($payload['message'] ?? "HTTP {$status}") : "HTTP {$status}");

                // For 401, log as an auth failure for clarity
                if (401 === $status) {
                    $notification->log->error(Craft::t('notifier', '[SEND FAILED] Authentication failed: {reason}', ['reason' => $reason]), $this->envelopeId);
                } else {
                    $notification->log->error(Craft::t('notifier', '[SEND FAILED] {reason}', ['reason' => $reason]), $this->envelopeId);
                }

                return false;
            }

            return true;

        } catch (GuzzleException|Throwable $exception) {
            $message = ($exception->getMessage() ?: 'Unknown error: '.Json::encode($exception));
            $notification->log->error(Craft::t('notifier', '[SEND FAILED] {reason}', ['reason' => $message]), $this->envelopeId);
            return false;
        }
    }

    /**
     * Upload attached images and attach them to the post record.
     *
     * Best-effort: a failed image logs a warning and is skipped. Video items
     * are not yet supported. Sets an `app.bsky.embed.images` embed when at
     * least one image uploads successfully.
     *
     * @param array $record The post record, modified in place.
     * @param string $pdsUrl
     * @param array $session
     * @param Notification $notification
     * @return void
     */
    private function _attachImages(array &$record, string $pdsUrl, array $session, Notification $notification): void
    {
        // Initialize the embed images
        $images = [];

        // Loop through each media descriptor
        foreach ($this->media as $descriptor) {

            // If the limit is reached, stop uploading
            if (count($images) >= static::MAX_IMAGES) {
                break;
            }

            // If the item is a video, log that it is not yet supported and skip
            if ($descriptor->isVideo()) {
                $this->logUnattached(
                    $notification,
                    Craft::t('notifier', 'Videos are not yet supported on {channel}.', ['channel' => 'Bluesky'])
                );
                continue;
            }

            // Get the image bytes
            $bytes = Media::bytesFor($descriptor, $readError);

            // If the bytes couldn't be read, log and skip
            if (!$bytes) {
                $this->logUnattached($notification, ($readError ?: Craft::t('notifier', 'The image could not be read.')));
                continue;
            }

            // Resize the image to fit the blob limit
            $resized = Media::resizeToLimit($bytes['bytes'], (string) ($bytes['mime'] ?? ''), static::MAX_IMAGE_BYTES);

            // If the image couldn't be resized, log and skip
            if (!$resized) {
                $this->logUnattached(
                    $notification,
                    Craft::t('notifier', 'The image could not be resized to fit.')
                );
                continue;
            }

            // Upload the blob
            $blob = $this->_uploadBlob($pdsUrl, $session, $resized['bytes'], $resized['mime'], $uploadError);

            // If the upload failed, log and skip
            if (!$blob) {
                $this->logUnattached($notification, ($uploadError ?: Craft::t('notifier', 'The image failed to upload.')));
                continue;
            }

            // Add the uploaded image
            $images[] = ['alt' => '', 'image' => $blob];

        }

        // If any images uploaded, attach them as the post embed
        if ($images) {
            $record['embed'] = [
                '$type'  => 'app.bsky.embed.images',
                'images' => $images,
            ];
        }
    }

    /**
     * Build a link-preview card and attach it to the post record.
     *
     * Best-effort and never throws. Any failure (no URL, an unreadable page, a
     * thumbnail that cannot be fetched or uploaded) logs a warning and leaves
     * the record without an embed, or with a text-only card. The post itself
     * always proceeds.
     *
     * @param array $record The post record, modified in place.
     * @param string $body The rendered post body.
     * @param string $pdsUrl
     * @param array $session
     * @param Notification $notification
     * @return void
     */
    private function _attachLinkCard(array &$record, string $body, string $pdsUrl, array $session, Notification $notification): void
    {
        try {

            // Get the first URL in the body, if any
            $url = BlueskyLinkCard::firstUrl($body);

            // If there is no URL, bail without an embed
            if (!$url) {
                return;
            }

            // Scrape the linked page's metadata
            $meta = BlueskyLinkCard::fetchMetadata($url);

            // If the page could not be read, log and bail without an embed
            if (!$meta) {
                $notification->log->warning(
                    Craft::t('notifier', '[LINK PREVIEW SKIPPED] {reason}', ['reason' => "could not read {$url}"]),
                    $this->envelopeId
                );
                return;
            }

            // Build the external embed (uri, title, description are required fields)
            $external = [
                'uri'         => $meta['uri'],
                'title'       => $meta['title'],
                'description' => $meta['description'],
            ];

            // Attach a thumbnail blob when the page exposes a usable image
            if ($meta['imageUrl']) {
                // Get the thumbnail
                $thumb = BlueskyLinkCard::fetchThumbnail($meta['imageUrl']);

                // If a thumbnail was fetched, upload it as a blob
                if ($thumb) {
                    // Upload the thumbnail blob
                    $blob = $this->_uploadBlob($pdsUrl, $session, $thumb['bytes'], $thumb['mime']);

                    // If the blob uploaded, attach it as the card thumbnail
                    if ($blob) {
                        $external['thumb'] = $blob;
                    }
                }
            }

            // Attach the assembled embed to the post record
            $record['embed'] = [
                '$type'    => 'app.bsky.embed.external',
                'external' => $external,
            ];

        } catch (Throwable $exception) {
            // Card-building is an enhancement, never a gate - log and move on
            $notification->log->warning(
                Craft::t('notifier', '[LINK PREVIEW SKIPPED] {reason}', ['reason' => $exception->getMessage()]),
                $this->envelopeId
            );
        }
    }

    /**
     * Upload raw image bytes to the PDS as a blob.
     *
     * Returns the response `blob` object (ready to drop into an embed's `thumb`
     * slot), or null on any non-200 or error. Never throws.
     *
     * @param string $pdsUrl
     * @param array $session
     * @param string $bytes Raw image bytes.
     * @param string $mime The image MIME type.
     * @return array|null
     */
    private function _uploadBlob(string $pdsUrl, array $session, string $bytes, string $mime, ?string &$error = null): ?array
    {
        // Normalize endpoint
        $endpoint = rtrim($pdsUrl, '/').'/xrpc/com.atproto.repo.uploadBlob';

        try {

            // POST the raw image bytes with the real image MIME as Content-Type
            $client = Craft::createGuzzleClient();
            $response = $client->post($endpoint, [
                'headers'     => [
                    'Content-Type'  => $mime,
                    'Authorization' => "Bearer {$session['accessJwt']}",
                ],
                'body'        => $bytes,
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            // Get the response status code
            $status = $response->getStatusCode();

            // If the response isn't a 200, no usable blob was returned, so bail
            if (200 !== $status) {
                $error = "HTTP {$status} from the blob upload.";
                return null;
            }

            // Extract the blob object from the response payload
            $payload = Json::decodeIfJson((string) $response->getBody());
            $blob = (is_array($payload) ? ($payload['blob'] ?? null) : null);

            // If the response carried no blob, bail
            if (!is_array($blob)) {
                $error = Craft::t('notifier', 'The upload response had no blob.');
                return null;
            }

            // Return the blob object
            return $blob;

        } catch (GuzzleException|Throwable $e) {
            $error = $e->getMessage();
            return null;
        }
    }

}
