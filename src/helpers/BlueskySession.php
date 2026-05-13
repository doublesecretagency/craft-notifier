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

namespace doublesecretagency\notifier\helpers;

use Craft;
use craft\helpers\Json;
use GuzzleHttp\Exception\GuzzleException;
use Throwable;

/**
 * Class BlueskySession
 * @since 3.0.0
 *
 * Caches Bluesky session JWTs in Craft's cache. Each cache entry holds the
 * access JWT, refresh JWT, DID, and expiry; the app password is never cached.
 * Cache key is derived from the PDS URL + handle so multiple accounts on the
 * same PDS don't collide.
 */
abstract class BlueskySession
{

    /**
     * @var string Cache key prefix.
     */
    public const CACHE_KEY_PREFIX = 'notifier.bluesky.session.';

    /**
     * @var int Default safety margin: refresh sessions when fewer than 5 minutes remain.
     */
    public const REFRESH_MARGIN_SECONDS = 300;

    /**
     * Derive a cache key for a (PDS URL, handle) pair.
     *
     * @param string $pdsUrl
     * @param string $handle
     * @return string
     */
    public static function cacheKey(string $pdsUrl, string $handle): string
    {
        // Normalize the PDS URL (drop trailing slash and lowercase scheme/host)
        $normalized = rtrim($pdsUrl, '/');

        // Hash to keep the cache key short and predictable
        return static::CACHE_KEY_PREFIX.sha1($normalized.':'.$handle);
    }

    /**
     * Get the cached session payload for a handle (decoded array) or null if missing.
     *
     * @param string $pdsUrl
     * @param string $handle
     * @return array|null Session payload with keys: accessJwt, refreshJwt, did, expiresAt (unix ts)
     */
    public static function get(string $pdsUrl, string $handle): ?array
    {
        // Get from cache
        $cached = Craft::$app->getCache()->get(static::cacheKey($pdsUrl, $handle));

        // Cache miss
        if (!$cached) {
            return null;
        }

        // Decode if stored as JSON
        if (is_string($cached)) {
            $cached = Json::decodeIfJson($cached);
        }

        // Return only when we have the expected keys
        if (is_array($cached) && isset($cached['accessJwt'], $cached['did'])) {
            return $cached;
        }

        return null;
    }

    /**
     * Persist a session payload to the cache.
     *
     * The payload must contain `accessJwt`, `refreshJwt`, `did`. The `appPassword`
     * is NEVER cached - only the JWTs and DID. TTL is derived from the JWT's
     * stored expiry, minus a safety margin to avoid mid-request expiry.
     *
     * @param string $pdsUrl
     * @param string $handle
     * @param array $payload
     * @return void
     */
    public static function put(string $pdsUrl, string $handle, array $payload): void
    {
        // Defensive: strip any password-like keys before caching
        unset($payload['password'], $payload['appPassword']);

        // Derive TTL: prefer explicit expiresAt, else default to 50 minutes
        $now = time();
        $expiresAt = ($payload['expiresAt'] ?? ($now + 3000));
        $ttl = max(60, $expiresAt - $now - static::REFRESH_MARGIN_SECONDS);

        // Write to cache
        Craft::$app->getCache()->set(
            static::cacheKey($pdsUrl, $handle),
            $payload,
            $ttl
        );
    }

    /**
     * Invalidate the cached session for a handle.
     *
     * @param string $pdsUrl
     * @param string $handle
     * @return void
     */
    public static function invalidate(string $pdsUrl, string $handle): void
    {
        Craft::$app->getCache()->delete(static::cacheKey($pdsUrl, $handle));
    }

    /**
     * Create a fresh session against the PDS by hitting com.atproto.server.createSession.
     *
     * Returns a payload array on success, or null on failure. Never throws.
     *
     * @param string $pdsUrl
     * @param string $handle
     * @param string $appPassword
     * @param string|null $errorOut By-ref error message slot for callers that want to surface failure detail.
     * @return array|null
     */
    public static function createSession(string $pdsUrl, string $handle, string $appPassword, ?string &$errorOut = null): ?array
    {
        // Normalize endpoint
        $endpoint = rtrim($pdsUrl, '/').'/xrpc/com.atproto.server.createSession';

        // Attempt to POST credentials
        try {

            $client = Craft::createGuzzleClient();
            $response = $client->post($endpoint, [
                'headers'     => ['Content-Type' => 'application/json'],
                'json'        => [
                    'identifier' => $handle,
                    'password'   => $appPassword,
                ],
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            $status = $response->getStatusCode();
            $body = Json::decodeIfJson((string) $response->getBody());

            // ATProto returns 200 with accessJwt + refreshJwt + did on success
            if (200 !== $status || !is_array($body) || !isset($body['accessJwt'], $body['did'])) {
                $errorOut = (is_array($body) ? ($body['message'] ?? "HTTP {$status}") : "HTTP {$status}");
                return null;
            }

            // Derive an expiry timestamp from the access JWT (ATProto JWTs encode exp in the payload)
            $expiresAt = static::_decodeJwtExpiry($body['accessJwt']);

            // Build the payload (strip any password echo defensively)
            return [
                'accessJwt'  => $body['accessJwt'],
                'refreshJwt' => $body['refreshJwt'] ?? null,
                'did'        => $body['did'],
                'handle'     => $body['handle'] ?? $handle,
                'expiresAt'  => $expiresAt,
            ];

        } catch (GuzzleException|Throwable $exception) {
            $errorOut = $exception->getMessage();
            return null;
        }
    }

    /**
     * Decode a JWT's `exp` claim without verifying signature (caller controls trust).
     *
     * Returns a unix timestamp, defaulting to `now + 50min` when the claim is unreadable.
     *
     * @param string $jwt
     * @return int
     */
    private static function _decodeJwtExpiry(string $jwt): int
    {
        // Split the JWT
        $parts = explode('.', $jwt);
        if (count($parts) < 2) {
            return time() + 3000;
        }

        // Base64URL-decode the payload
        $payload = strtr($parts[1], '-_', '+/');
        $payload = base64_decode($payload, true);
        if (false === $payload) {
            return time() + 3000;
        }

        // Decode JSON
        $claims = Json::decodeIfJson($payload);
        if (!is_array($claims) || !isset($claims['exp'])) {
            return time() + 3000;
        }

        // Return the exp claim as an int
        return (int) $claims['exp'];
    }

}
