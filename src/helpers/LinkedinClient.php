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
 * Talks to LinkedIn's OAuth and Posts APIs over Guzzle.
 *
 * @since 3.1.0
 */
abstract class LinkedinClient
{

    /**
     * @var string LinkedIn's OAuth 2.0 authorization endpoint.
     */
    public const AUTHORIZE_URL = 'https://www.linkedin.com/oauth/v2/authorization';

    /**
     * @var string LinkedIn's OAuth 2.0 token endpoint.
     */
    public const TOKEN_URL = 'https://www.linkedin.com/oauth/v2/accessToken';

    /**
     * @var string LinkedIn's OpenID Connect userinfo endpoint.
     */
    public const USERINFO_URL = 'https://api.linkedin.com/v2/userinfo';

    /**
     * @var string LinkedIn's versioned Posts endpoint.
     */
    public const POSTS_URL = 'https://api.linkedin.com/rest/posts';

    /**
     * @var string LinkedIn's versioned Images endpoint (for preview card thumbnails).
     */
    public const IMAGES_URL = 'https://api.linkedin.com/rest/images';

    /**
     * @var string LinkedIn API version pin (YYYYMM). Bump as LinkedIn deprecates older versions.
     */
    public const API_VERSION = '202506';

    /**
     * @var array OAuth scopes requested for member posting.
     */
    public const MEMBER_SCOPES = ['openid', 'profile', 'w_member_social'];

    /**
     * @var string Additional OAuth scope requested for organization posting.
     */
    public const ORGANIZATION_SCOPE = 'w_organization_social';

    // ========================================================================= //

    /**
     * Build the LinkedIn authorize URL to redirect the browser to.
     *
     * @param string $clientId
     * @param string $redirectUri
     * @param array $scopes List of OAuth scopes to request.
     * @param string $state Random CSRF token echoed back to the callback.
     * @return string
     */
    public static function authorizeUrl(string $clientId, string $redirectUri, array $scopes, string $state): string
    {
        // Build the query string
        $query = http_build_query([
            'response_type' => 'code',
            'client_id'     => $clientId,
            'redirect_uri'  => $redirectUri,
            'state'         => $state,
            'scope'         => implode(' ', $scopes),
        ]);

        // Return the full authorize URL
        return static::AUTHORIZE_URL.'?'.$query;
    }

    /**
     * Exchange an authorization code for an access token.
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param string $code The authorization code returned to the callback.
     * @param string $redirectUri The exact redirect URI used in the authorize step.
     * @param string|null $errorOut By-ref error message slot.
     * @return array|null Token payload, or null on failure.
     */
    public static function exchangeCode(string $clientId, string $clientSecret, string $code, string $redirectUri, ?string &$errorOut = null): ?array
    {
        // Exchange the code for a token
        return static::_tokenRequest([
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'redirect_uri'  => $redirectUri,
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
        ], $errorOut);
    }

    /**
     * Exchange a refresh token for a fresh access token.
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param string $refreshToken
     * @param string|null $errorOut By-ref error message slot.
     * @return array|null Token payload, or null on failure.
     */
    public static function refresh(string $clientId, string $clientSecret, string $refreshToken, ?string &$errorOut = null): ?array
    {
        // Exchange the refresh token for a new token
        return static::_tokenRequest([
            'grant_type'    => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
        ], $errorOut);
    }

    /**
     * Fetch the authenticated member's URN and display name via the OpenID userinfo endpoint.
     *
     * @param string $accessToken
     * @param string|null $errorOut By-ref error message slot.
     * @return array|null The member as ['urn' => string, 'name' => string], or null on failure.
     */
    public static function fetchMember(string $accessToken, ?string &$errorOut = null): ?array
    {
        // Attempt to read the userinfo
        try {

            // GET the userinfo
            $client = Craft::createGuzzleClient();
            $response = $client->get(static::USERINFO_URL, [
                'headers'     => ['Authorization' => 'Bearer '.$accessToken],
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            // Decode the response
            $status = $response->getStatusCode();
            $decoded = Json::decodeIfJson((string) $response->getBody());

            // If the subject is missing, bail
            if ($status < 200 || $status >= 300 || !is_array($decoded) || empty($decoded['sub'])) {
                $errorOut = (is_array($decoded) ? ($decoded['message'] ?? "HTTP {$status}") : "HTTP {$status}");
                return null;
            }

            // Return the member URN and display name (the profile scope provides the name)
            return [
                'urn'  => 'urn:li:person:'.$decoded['sub'],
                'name' => (string) ($decoded['name'] ?? ''),
            ];

        } catch (GuzzleException|Throwable $e) {
            $errorOut = $e->getMessage();
            return null;
        }
    }

    /**
     * Publish a post to the member feed or organization page.
     *
     * When a link is set, it is sent as a structured article so LinkedIn renders
     * a preview card. LinkedIn no longer scrapes URLs, so the card's title,
     * description, and thumbnail are resolved from the page's Open Graph tags.
     *
     * @param string $accessToken
     * @param string $authorUrn The author URN (urn:li:person:... or urn:li:organization:...).
     * @param string $body The post commentary.
     * @param string|null $link Optional URL to render as a preview card.
     * @param string|null $errorOut By-ref error message slot.
     * @return bool Whether the post succeeded.
     */
    public static function post(string $accessToken, string $authorUrn, string $body, ?string $link = null, ?string &$errorOut = null): bool
    {
        // Build the base post payload
        $payload = [
            'author'                    => $authorUrn,
            'commentary'                => $body,
            'visibility'                => 'PUBLIC',
            'distribution'              => [
                'feedDistribution'               => 'MAIN_FEED',
                'targetEntities'                 => [],
                'thirdPartyDistributionChannels' => [],
            ],
            'lifecycleState'            => 'PUBLISHED',
            'isReshareDisabledByAuthor' => false,
        ];

        // If a link is set, attach it as an article so LinkedIn renders a preview card
        if ($link) {
            $payload['content'] = [
                'article' => static::_buildArticle($accessToken, $authorUrn, $link),
            ];
        }

        // Attempt to publish the post
        try {

            // POST to the versioned Posts endpoint
            $client = Craft::createGuzzleClient();
            $response = $client->post(static::POSTS_URL, [
                'headers'     => static::_apiHeaders($accessToken),
                'json'        => $payload,
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            // Inspect the response
            $status = $response->getStatusCode();

            // If LinkedIn rejected the post, surface the error and bail
            if ($status < 200 || $status >= 300) {
                $decoded = Json::decodeIfJson((string) $response->getBody());
                $errorOut = (is_array($decoded) ? ($decoded['message'] ?? "HTTP {$status}") : "HTTP {$status}");
                return false;
            }

            // Success
            return true;

        } catch (GuzzleException|Throwable $e) {
            $errorOut = $e->getMessage();
            return false;
        }
    }

    /**
     * Upload an external image to LinkedIn and return its image URN.
     *
     * Best-effort: any failure (initialize, download, or upload) returns null so
     * the post can still publish without a thumbnail.
     *
     * @param string $accessToken
     * @param string $authorUrn The owner of the uploaded image.
     * @param string $imageUrl The external image URL to upload.
     * @return string|null The urn:li:image URN, or null on any failure.
     */
    public static function uploadImage(string $accessToken, string $authorUrn, string $imageUrl): ?string
    {
        // If the image is not an absolute http(s) URL, bail
        if (!preg_match('/^https?:\/\//i', $imageUrl)) {
            return null;
        }

        // Attempt the upload
        try {

            $client = Craft::createGuzzleClient();

            // Initialize the upload to get an upload URL and image URN
            $init = $client->post(static::IMAGES_URL.'?action=initializeUpload', [
                'headers'     => static::_apiHeaders($accessToken),
                'json'        => ['initializeUploadRequest' => ['owner' => $authorUrn]],
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            // If initialization failed, bail
            if ($init->getStatusCode() >= 300) {
                return null;
            }

            // Get the upload URL and image URN
            $decoded = Json::decodeIfJson((string) $init->getBody());
            $value = (is_array($decoded) ? ($decoded['value'] ?? []) : []);
            $uploadUrl = ($value['uploadUrl'] ?? null);
            $imageUrn  = ($value['image']     ?? null);

            // If either is missing, bail
            if (!$uploadUrl || !$imageUrn) {
                return null;
            }

            // Download the external image
            $download = $client->get($imageUrl, ['http_errors' => false, 'timeout' => 15]);

            // If the image could not be read, bail
            if ($download->getStatusCode() >= 300) {
                return null;
            }

            // Get the image bytes
            $bytes = (string) $download->getBody();

            // If the image is empty, bail
            if ('' === $bytes) {
                return null;
            }

            // Upload the image bytes to LinkedIn
            $upload = $client->put($uploadUrl, [
                'headers'     => ['Authorization' => 'Bearer '.$accessToken],
                'body'        => $bytes,
                'http_errors' => false,
                'timeout'     => 30,
            ]);

            // If the upload failed, bail
            if ($upload->getStatusCode() >= 300) {
                return null;
            }

            // Return the image URN
            return $imageUrn;

        } catch (GuzzleException|Throwable $e) {
            return null;
        }
    }

    // ========================================================================= //

    /**
     * Build the standard headers for a versioned LinkedIn REST request.
     *
     * @param string $accessToken
     * @return array
     */
    private static function _apiHeaders(string $accessToken): array
    {
        return [
            'Authorization'             => 'Bearer '.$accessToken,
            'X-Restli-Protocol-Version' => '2.0.0',
            'LinkedIn-Version'          => static::API_VERSION,
            'Content-Type'              => 'application/json',
        ];
    }

    /**
     * Build an article (preview card) from a URL's Open Graph tags.
     *
     * Always returns at least a source and title; the description and thumbnail
     * are best-effort, since LinkedIn does not scrape URLs itself.
     *
     * @param string $accessToken
     * @param string $authorUrn
     * @param string $url The link to render as a preview card.
     * @return array The article object for content.article.
     */
    private static function _buildArticle(string $accessToken, string $authorUrn, string $url): array
    {
        // Get the page's Open Graph metadata
        $og = static::_fetchOpenGraph($url);

        // Start the article with the source and a title (fall back to the host)
        $article = [
            'source' => $url,
            'title'  => ($og['title'] ?: (parse_url($url, PHP_URL_HOST) ?: $url)),
        ];

        // If a description was found, add it
        if ($og['description']) {
            $article['description'] = $og['description'];
        }

        // If the page has an image, upload it and attach the thumbnail
        if ($og['image']) {
            $thumbnail = static::uploadImage($accessToken, $authorUrn, $og['image']);
            if ($thumbnail) {
                $article['thumbnail'] = $thumbnail;
            }
        }

        // Return the assembled article
        return $article;
    }

    /**
     * Fetch a URL's Open Graph metadata (title, description, image).
     *
     * @param string $url
     * @return array The resolved title, description, and image (each nullable).
     */
    private static function _fetchOpenGraph(string $url): array
    {
        // Default to an empty result
        $empty = ['title' => null, 'description' => null, 'image' => null];

        // Attempt to fetch the page HTML
        try {

            // Request the page
            $client = Craft::createGuzzleClient();
            $response = $client->get($url, [
                'http_errors'     => false,
                'timeout'         => 10,
                'allow_redirects' => true,
                'headers'         => ['User-Agent' => 'NotifierBot/1.0 (+https://plugins.doublesecretagency.com/notifier)'],
            ]);

            // If the page could not be read, return empty
            if ($response->getStatusCode() >= 300) {
                return $empty;
            }

            // Parse the Open Graph tags from the HTML
            return static::_parseOpenGraph((string) $response->getBody());

        } catch (GuzzleException|Throwable $e) {
            return $empty;
        }
    }

    /**
     * Parse Open Graph tags (with fallbacks) out of an HTML document.
     *
     * @param string $html
     * @return array The title, description, and image (each nullable), capped to LinkedIn's limits.
     */
    private static function _parseOpenGraph(string $html): array
    {
        // Prefer og: tags, falling back to the title tag and meta description
        $title       = (static::_metaContent($html, 'og:title')      ?: static::_htmlTitle($html));
        $description = (static::_metaContent($html, 'og:description') ?: static::_metaContent($html, 'description'));
        $image       = static::_metaContent($html, 'og:image');

        // Cap the text to LinkedIn's article limits
        return [
            'title'       => ($title       ? mb_substr($title, 0, 400)        : null),
            'description' => ($description ? mb_substr($description, 0, 4086) : null),
            'image'       => ($image ?: null),
        ];
    }

    /**
     * Read a meta tag's content by its property or name attribute.
     *
     * @param string $html
     * @param string $key The og: property or name attribute to match.
     * @return string|null
     */
    private static function _metaContent(string $html, string $key): ?string
    {
        // Escape the key for the pattern
        $k = preg_quote($key, '/');

        // Match both attribute orders (content after the key, and key after content)
        $patterns = [
            '/<meta[^>]+(?:property|name)\s*=\s*["\']'.$k.'["\'][^>]+content\s*=\s*["\']([^"\']*)["\']/i',
            '/<meta[^>]+content\s*=\s*["\']([^"\']*)["\'][^>]+(?:property|name)\s*=\s*["\']'.$k.'["\']/i',
        ];

        // Return the first match
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $html, $m)) {
                return html_entity_decode(trim($m[1]), ENT_QUOTES | ENT_HTML5);
            }
        }

        // No match
        return null;
    }

    /**
     * Read the document title tag.
     *
     * @param string $html
     * @return string|null
     */
    private static function _htmlTitle(string $html): ?string
    {
        // Match the title tag contents
        if (preg_match('/<title[^>]*>(.*?)<\/title>/is', $html, $m)) {
            return html_entity_decode(trim($m[1]), ENT_QUOTES | ENT_HTML5);
        }

        // No title
        return null;
    }

    /**
     * Fetch the organizations the authenticated member administers.
     *
     * Best-effort: requires the granted `w_organization_social` scope and an app
     * with Community Management API approval. A 403 (no approval) returns an
     * empty list rather than an error.
     *
     * @param string $accessToken
     * @param string|null $errorOut By-ref error message slot.
     * @return array List of ['urn' => string, 'name' => string].
     */
    public static function fetchAdministeredOrganizations(string $accessToken, ?string &$errorOut = null): array
    {
        // Attempt to read the member's organization ACLs
        try {

            // GET the organizations where the member is an ADMINISTRATOR
            $client = Craft::createGuzzleClient();
            $response = $client->get('https://api.linkedin.com/rest/organizationAcls', [
                'headers'     => [
                    'Authorization'             => 'Bearer '.$accessToken,
                    'X-Restli-Protocol-Version' => '2.0.0',
                    'LinkedIn-Version'          => static::API_VERSION,
                ],
                'query'       => [
                    'q'    => 'roleAssignee',
                    'role' => 'ADMINISTRATOR',
                    'state' => 'APPROVED',
                ],
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            // Decode the response
            $status = $response->getStatusCode();
            $decoded = Json::decodeIfJson((string) $response->getBody());

            // If the request was rejected (e.g. no Community Management approval), return none
            if ($status < 200 || $status >= 300 || !is_array($decoded)) {
                $errorOut = (is_array($decoded) ? ($decoded['message'] ?? "HTTP {$status}") : "HTTP {$status}");
                return [];
            }

            // Initialize the organizations
            $organizations = [];

            // Loop through each ACL element
            foreach (($decoded['elements'] ?? []) as $element) {

                // Get the organization URN
                $urn = ($element['organization'] ?? null);

                // If no URN, skip
                if (!$urn) {
                    continue;
                }

                // Resolve a friendly name, falling back to the URN
                $name = static::_fetchOrganizationName($accessToken, $urn) ?: $urn;

                // Add the organization
                $organizations[] = ['urn' => $urn, 'name' => $name];

            }

            // Return the administered organizations
            return $organizations;

        } catch (GuzzleException|Throwable $e) {
            $errorOut = $e->getMessage();
            return [];
        }
    }

    // ========================================================================= //

    /**
     * Fetch an organization's localized name.
     *
     * @param string $accessToken
     * @param string $urn The organization URN (urn:li:organization:{id}).
     * @return string|null The localized name, or null on failure.
     */
    private static function _fetchOrganizationName(string $accessToken, string $urn): ?string
    {
        // Pull the numeric ID off the end of the URN
        $id = substr($urn, strrpos($urn, ':') + 1);

        // Attempt to read the organization's localized name
        try {

            // GET the organization record
            $client = Craft::createGuzzleClient();
            $response = $client->get('https://api.linkedin.com/rest/organizations/'.$id, [
                'headers'     => [
                    'Authorization'             => 'Bearer '.$accessToken,
                    'X-Restli-Protocol-Version' => '2.0.0',
                    'LinkedIn-Version'          => static::API_VERSION,
                ],
                'query'       => ['fields' => 'localizedName'],
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            // Decode the response
            $decoded = Json::decodeIfJson((string) $response->getBody());

            // Return the localized name, if present
            return (is_array($decoded) ? ($decoded['localizedName'] ?? null) : null);

        } catch (GuzzleException|Throwable) {
            return null;
        }
    }

    /**
     * Perform a token request against LinkedIn's token endpoint.
     *
     * @param array $form The form parameters for the grant.
     * @param string|null $errorOut By-ref error message slot.
     * @return array|null Token payload, or null on failure.
     */
    private static function _tokenRequest(array $form, ?string &$errorOut = null): ?array
    {
        // Attempt the token exchange
        try {

            // POST the form-encoded grant
            $client = Craft::createGuzzleClient();
            $response = $client->post(static::TOKEN_URL, [
                'headers'     => ['Content-Type' => 'application/x-www-form-urlencoded'],
                'form_params' => $form,
                'http_errors' => false,
                'timeout'     => 15,
            ]);

            // Decode the response
            $status = $response->getStatusCode();
            $decoded = Json::decodeIfJson((string) $response->getBody());

            // If the access token is missing, bail
            if ($status < 200 || $status >= 300 || !is_array($decoded) || empty($decoded['access_token'])) {
                $errorOut = (is_array($decoded) ? ($decoded['error_description'] ?? $decoded['error'] ?? "HTTP {$status}") : "HTTP {$status}");
                return null;
            }

            // Return the token payload
            return $decoded;

        } catch (GuzzleException|Throwable $e) {
            $errorOut = $e->getMessage();
            return null;
        }
    }

}
