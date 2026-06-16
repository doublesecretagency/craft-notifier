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

namespace doublesecretagency\notifier\helpers;

use Craft;
use craft\helpers\Json;
use GuzzleHttp\Exception\GuzzleException;
use Throwable;

/**
 * Talks to the Meta Graph API for Facebook and Instagram posts.
 *
 * @since 3.1.0
 */
abstract class MetaGraph
{

    /**
     * @var string Pinned Meta Graph API version.
     */
    public const GRAPH_VERSION = 'v25.0';

    /**
     * @var string Base URL for the Meta Graph API.
     */
    public const BASE_URL = 'https://graph.facebook.com';

    /**
     * @var int Request timeout in seconds.
     */
    private const TIMEOUT = 15;

    /**
     * Build a version-pinned Graph API endpoint URL.
     *
     * @param string $path The path after the version segment.
     * @return string
     */
    public static function endpoint(string $path): string
    {
        // Join the base URL, version, and path
        return static::BASE_URL.'/'.static::GRAPH_VERSION.'/'.ltrim($path, '/');
    }

    /**
     * Build the payload for a Facebook Page feed post.
     *
     * @param string $message
     * @param string|null $link Optional link to attach a preview card.
     * @param string $token Page Access Token.
     * @return array
     */
    public static function feedPayload(string $message, ?string $link, string $token): array
    {
        // Build the base payload
        $payload = [
            'message'      => $message,
            'access_token' => $token,
        ];

        // If a link is set, attach it for a preview card
        if ($link) {
            $payload['link'] = $link;
        }

        // Return the payload
        return $payload;
    }

    /**
     * Build the payload for a Facebook Page photo post.
     *
     * @param string $imageUrl Public image URL.
     * @param string $caption
     * @param string $token Page Access Token.
     * @return array
     */
    public static function photoPayload(string $imageUrl, string $caption, string $token): array
    {
        // Return the photo payload
        return [
            'url'          => $imageUrl,
            'caption'      => $caption,
            'access_token' => $token,
        ];
    }

    /**
     * Build the payload for an Instagram media container.
     *
     * @param string $imageUrl Public JPEG URL.
     * @param string $caption
     * @param string $token Page Access Token.
     * @return array
     */
    public static function imageContainerPayload(string $imageUrl, string $caption, string $token): array
    {
        // Return the container payload
        return [
            'image_url'    => $imageUrl,
            'caption'      => $caption,
            'access_token' => $token,
        ];
    }

    /**
     * Build the payload for an Instagram media publish.
     *
     * @param string $creationId The container ID returned by the container step.
     * @param string $token Page Access Token.
     * @return array
     */
    public static function publishPayload(string $creationId, string $token): array
    {
        // Return the publish payload
        return [
            'creation_id'  => $creationId,
            'access_token' => $token,
        ];
    }

    // ========================================================================= //

    /**
     * Post a message to a Facebook Page's feed.
     *
     * @param string $pageId
     * @param string $message
     * @param string|null $link
     * @param string $token Page Access Token.
     * @return array Normalized result (ok, status, data, error).
     */
    public static function postPageFeed(string $pageId, string $message, ?string $link, string $token): array
    {
        // POST to the Page's feed edge
        $url = static::endpoint("{$pageId}/feed");
        return static::_request('POST', $url, ['form_params' => static::feedPayload($message, $link, $token)]);
    }

    /**
     * Post a photo to a Facebook Page.
     *
     * @param string $pageId
     * @param string $imageUrl Public image URL.
     * @param string $caption
     * @param string $token Page Access Token.
     * @return array Normalized result (ok, status, data, error).
     */
    public static function postPagePhoto(string $pageId, string $imageUrl, string $caption, string $token): array
    {
        // POST to the Page's photos edge
        $url = static::endpoint("{$pageId}/photos");
        return static::_request('POST', $url, ['form_params' => static::photoPayload($imageUrl, $caption, $token)]);
    }

    /**
     * Post a photo to a Facebook Page from raw bytes.
     *
     * Used when the image has no public URL (e.g. a private-volume asset).
     *
     * @param string $pageId
     * @param string $bytes Raw image bytes.
     * @param string $caption
     * @param string $token Page Access Token.
     * @return array Normalized result (ok, status, data, error).
     */
    public static function postPagePhotoBytes(string $pageId, string $bytes, string $caption, string $token): array
    {
        // POST the raw bytes to the Page's photos edge as multipart form data
        $url = static::endpoint("{$pageId}/photos");
        return static::_request('POST', $url, ['multipart' => [
            ['name' => 'source', 'contents' => $bytes, 'filename' => 'image.jpg'],
            ['name' => 'caption', 'contents' => $caption],
            ['name' => 'access_token', 'contents' => $token],
        ]]);
    }

    /**
     * Get the Instagram business account linked to a Facebook Page.
     *
     * @param string $pageId
     * @param string $token Page Access Token.
     * @return array|null The IG account (id, username), or null when none is linked.
     */
    public static function resolveIgUserId(string $pageId, string $token): ?array
    {
        // GET the Page's linked Instagram business account
        $url = static::endpoint($pageId);
        $result = static::_request('GET', $url, ['query' => [
            'fields'       => 'instagram_business_account{id,username}',
            'access_token' => $token,
        ]]);

        // If the request failed, bail
        if (!$result['ok']) {
            return null;
        }

        // Return the linked account, or null when none is linked
        $account = ($result['data']['instagram_business_account'] ?? null);
        return (is_array($account) ? $account : null);
    }

    /**
     * Create an Instagram image media container.
     *
     * @param string $igUserId
     * @param string $imageUrl Public JPEG URL.
     * @param string $caption
     * @param string $token Page Access Token.
     * @return array Normalized result (ok, status, data, error).
     */
    public static function createImageContainer(string $igUserId, string $imageUrl, string $caption, string $token): array
    {
        // POST to the IG user's media edge
        $url = static::endpoint("{$igUserId}/media");
        return static::_request('POST', $url, ['form_params' => static::imageContainerPayload($imageUrl, $caption, $token)]);
    }

    /**
     * Get the processing status of an Instagram media container.
     *
     * @param string $containerId
     * @param string $token Page Access Token.
     * @return array Normalized result (ok, status, data, error). The status code is in data.status_code.
     */
    public static function getContainerStatus(string $containerId, string $token): array
    {
        // GET the container's status code
        $url = static::endpoint($containerId);
        return static::_request('GET', $url, ['query' => [
            'fields'       => 'status_code',
            'access_token' => $token,
        ]]);
    }

    /**
     * Publish a prepared Instagram media container.
     *
     * @param string $igUserId
     * @param string $creationId The container ID.
     * @param string $token Page Access Token.
     * @return array Normalized result (ok, status, data, error).
     */
    public static function publishContainer(string $igUserId, string $creationId, string $token): array
    {
        // POST to the IG user's media_publish edge
        $url = static::endpoint("{$igUserId}/media_publish");
        return static::_request('POST', $url, ['form_params' => static::publishPayload($creationId, $token)]);
    }

    // ========================================================================= //

    /**
     * Run a Graph API request and normalize the response.
     *
     * Guzzle boundary, never throws. Returns `ok` plus the decoded `data` and,
     * on failure, the Graph `error.message` (or an HTTP status fallback).
     *
     * @param string $method HTTP method.
     * @param string $url
     * @param array $options Guzzle request options.
     * @return array Normalized result (ok, status, data, error).
     */
    private static function _request(string $method, string $url, array $options): array
    {
        try {

            // Send the request, never throwing on HTTP errors
            $client = Craft::createGuzzleClient();
            $response = $client->request($method, $url, array_merge([
                'http_errors' => false,
                'timeout'     => static::TIMEOUT,
            ], $options));

            // Get the response status
            $status = $response->getStatusCode();

            // Decode the response body
            $data = Json::decodeIfJson((string) $response->getBody());
            $data = (is_array($data) ? $data : []);

            // Get a success flag and any error message
            $ok = ($status >= 200 && $status < 300 && !isset($data['error']));
            $error = ($ok ? null : ($data['error']['message'] ?? "HTTP {$status}"));

            // Return the normalized result
            return [
                'ok' => $ok,
                'status' => $status,
                'data' => $data,
                'error' => $error
            ];

        } catch (GuzzleException|Throwable $exception) {
            // Surface the transport error
            return [
                'ok' => false,
                'status' => 0,
                'data' => [],
                'error' => $exception->getMessage()
            ];
        }
    }

}
