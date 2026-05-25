<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS
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
use doublesecretagency\notifier\helpers\Notifier;
use doublesecretagency\notifier\NotifierPlugin;
use doublesecretagency\notifier\models\Settings;
use GuzzleHttp\Exception\GuzzleException;
use Throwable;

/**
 * Class OutboundBluesky
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
     * @var string|null Bluesky handle (e.g. "example.bsky.social").
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

        // Resolve the app password (supports a $ENV_VAR reference)
        $appPassword = (string) App::parseEnv($this->appPassword);

        // If recipient is missing required fields, log error and bail
        if (!$this->handle || !$appPassword) {
            $notification->log->error(Craft::t('notifier', 'Unable to send Bluesky post, recipient is missing credentials.'), $this->envelopeId);
            return false;
        }

        // Pre-flight grapheme guard
        $body = $this->body;
        if (BlueskyFacets::graphemeCount($body) > static::MAX_GRAPHEMES) {
            $original = $body;
            $body = BlueskyFacets::truncateToGraphemes($body, static::MAX_GRAPHEMES);
            $notification->log->warning(
                Craft::t('notifier', 'Body exceeded {max} characters, truncated.', ['max' => $this->getMaxGraphemes()]),
                $this->envelopeId
            );
        }

        // Resolve a session (cached or fresh)
        $session = $this->_resolveSession($pdsUrl, $appPassword, $notification);
        if (!$session) {
            return false;
        }

        // Build the post record
        $record = $this->_buildPostRecord($body, $pdsUrl);

        // Attach a link-preview card when enabled (best-effort, never fails the post)
        if ($this->linkCard) {
            $this->_attachLinkCard($record, $body, $pdsUrl, $session, $notification);
        }

        // Attempt to publish
        $success = $this->_publishRecord($pdsUrl, $session, $record, $notification);

        // Retry-once on 401 (session may have expired between cache get and publish)
        if (!$success && $this->_lastStatus === 401) {
            // Invalidate cached session and try fresh
            BlueskySession::invalidate($pdsUrl, $this->handle);
            $session = $this->_resolveSession($pdsUrl, $appPassword, $notification, force: true);
            if (!$session) {
                return false;
            }
            $success = $this->_publishRecord($pdsUrl, $session, $record, $notification);
        }

        // Log success when the publish call returned true
        if ($success) {
            $displayLabel = ($this->label ?: $this->handle);
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
     * Stash for the most recent publish status code (used by retry-on-401 path).
     *
     * @var int|null
     */
    private ?int $_lastStatus = null;

    /**
     * Resolve a session payload (cached or freshly created).
     *
     * @param string $pdsUrl
     * @param string $appPassword Resolved app password.
     * @param Notification $notification
     * @param bool $force Skip the cache and force a fresh createSession.
     * @return array|null
     */
    private function _resolveSession(string $pdsUrl, string $appPassword, Notification $notification, bool $force = false): ?array
    {
        // Try the cache first unless caller forced refresh
        if (!$force) {
            $cached = BlueskySession::get($pdsUrl, $this->handle);
            if ($cached) {
                return $cached;
            }
        }

        // Hit createSession
        $err = null;
        $session = BlueskySession::createSession($pdsUrl, $this->handle, $appPassword, $err);

        // If createSession failed, log and bail
        if (!$session) {
            $notification->log->error(Craft::t('notifier', 'Bluesky auth failed for {handle}: {reason}', ['handle' => $this->handle, 'reason' => $err]), $this->envelopeId);
            return null;
        }

        // Cache for next time
        BlueskySession::put($pdsUrl, $this->handle, $session);

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

        // Check cache
        $cached = Craft::$app->getCache()->get($cacheKey);
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

            if (200 !== $response->getStatusCode()) {
                return null;
            }

            $payload = Json::decodeIfJson((string) $response->getBody());
            $did = (is_array($payload) ? ($payload['did'] ?? null) : null);

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

                // For 401, surface as auth failure for log clarity
                if (401 === $status) {
                    $notification->log->error(Craft::t('notifier', 'Bluesky auth failed: {reason}', ['reason' => $reason]), $this->envelopeId);
                } else {
                    $notification->log->error(Craft::t('notifier', 'Bluesky post failed: {reason}', ['reason' => $reason]), $this->envelopeId);
                }

                return false;
            }

            return true;

        } catch (GuzzleException|Throwable $exception) {
            $message = ($exception->getMessage() ?: 'Unknown error: '.Json::encode($exception));
            $notification->log->error(Craft::t('notifier', 'Bluesky post failed: {reason}', ['reason' => $message]), $this->envelopeId);
            return false;
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

            // Find the first URL in the body, if any
            $url = BlueskyLinkCard::firstUrl($body);
            if (!$url) {
                return;
            }

            // Scrape the linked page's metadata
            $meta = BlueskyLinkCard::fetchMetadata($url);

            // If the page could not be read, log and bail without an embed
            if (!$meta) {
                $notification->log->warning(
                    Craft::t('notifier', 'Bluesky link preview skipped: {reason}', ['reason' => "could not read {$url}"]),
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
                $thumb = BlueskyLinkCard::fetchThumbnail($meta['imageUrl']);
                if ($thumb) {
                    $blob = $this->_uploadBlob($pdsUrl, $session, $thumb['bytes'], $thumb['mime']);
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
                Craft::t('notifier', 'Bluesky link preview skipped: {reason}', ['reason' => $exception->getMessage()]),
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
    private function _uploadBlob(string $pdsUrl, array $session, string $bytes, string $mime): ?array
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

            // Only a 200 carries a usable blob object
            if (200 !== $response->getStatusCode()) {
                return null;
            }

            // Extract the blob object from the response payload
            $payload = Json::decodeIfJson((string) $response->getBody());
            $blob = (is_array($payload) ? ($payload['blob'] ?? null) : null);

            return (is_array($blob) ? $blob : null);

        } catch (GuzzleException|Throwable) {
            return null;
        }
    }

}
