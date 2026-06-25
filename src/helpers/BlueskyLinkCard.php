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
use GuzzleHttp\Exception\GuzzleException;
use Throwable;

/**
 * Builds the link-preview card for a Bluesky post.
 *
 * @since 3.0.0
 */
abstract class BlueskyLinkCard
{

    /**
     * @var int Maximum size for an `app.bsky.embed.external` thumbnail blob. A fixed ATProto
     * lexicon constant (`thumb` `maxSize`), enforced at `createRecord`, not discoverable at runtime.
     */
    public const MAX_THUMB_BYTES = 1000000;

    /**
     * @var int Page-fetch timeout in seconds. Kept short so a slow scrape cannot stall the queue worker.
     */
    private const FETCH_TIMEOUT = 5;

    /**
     * Find the first URL in a post body.
     *
     * @param string $body Rendered post body in UTF-8.
     * @return string|null The first URL, or null when the body has none.
     */
    public static function firstUrl(string $body): ?string
    {
        // Reuse the facet builder's URL detection (and its trailing-punctuation trim)
        $links = BlueskyFacets::detectLinks($body);

        // Return the first detected URL, if any
        return ($links[0]['features'][0]['uri'] ?? null);
    }

    /**
     * Parse OpenGraph / Twitter / fallback metadata out of a page's HTML.
     *
     * Pure function, no I/O. `title` and `description` always resolve to a string (with
     * sensible fallbacks); `imageUrl` is null when the page exposes no image.
     *
     * @param string $html Raw page HTML.
     * @param string $baseUrl The page's final (post-redirect) URL, used to resolve a relative image.
     * @return array The card metadata (title, description, imageUrl).
     */
    public static function parseMetadata(string $html, string $baseUrl): array
    {
        // Collect every <meta> tag's property/name => content mapping
        $meta = static::_metaTags($html);

        // Get the title, falling back og:title -> twitter:title -> <title> -> host
        $title = (
            $meta['og:title']
            ?? $meta['twitter:title']
            ?? static::_documentTitle($html)
            ?? (parse_url($baseUrl, PHP_URL_HOST) ?: '')
        );

        // Get the description, falling back og:description -> twitter:description -> meta -> empty
        $description = (
            $meta['og:description']
            ?? $meta['twitter:description']
            ?? $meta['description']
            ?? ''
        );

        // Get the image from og:image or twitter:image, against the base URL
        $image = ($meta['og:image'] ?? $meta['twitter:image'] ?? null);
        $imageUrl = ($image ? static::_resolveUrl($baseUrl, $image) : null);

        // Return the normalized metadata
        return [
            'title'       => trim($title),
            'description' => trim($description),
            'imageUrl'    => $imageUrl,
        ];
    }

    /**
     * Fetch a URL and parse its link-card metadata.
     *
     * Guzzle boundary, never throws. Returns null on a network failure, a non-2xx
     * response, or a non-HTML body.
     *
     * @param string $url The URL to scrape.
     * @return array|null The card metadata (uri, title, description, imageUrl), or null on failure.
     */
    public static function fetchMetadata(string $url): ?array
    {
        try {

            // Fetch the page, following redirects and tracking the final URL
            $client = Craft::createGuzzleClient();
            $response = $client->get($url, [
                'allow_redirects' => ['track_redirects' => true],
                'http_errors'     => false,
                'timeout'         => static::FETCH_TIMEOUT,
            ]);

            // Get the response status code
            $status = $response->getStatusCode();

            // If the response is non-2xx, bail
            if ($status < 200 || $status >= 300) {
                return null;
            }

            // Get the response content type
            $contentType = strtolower($response->getHeaderLine('Content-Type'));

            // If the body isn't HTML, bail
            if (!str_contains($contentType, 'text/html') && !str_contains($contentType, 'application/xhtml')) {
                return null;
            }

            // Get the final URL after any redirects
            $redirects = $response->getHeader('X-Guzzle-Redirect-History');
            $finalUrl = (end($redirects) ?: $url);

            // Parse the metadata against the final URL
            $meta = static::parseMetadata((string) $response->getBody(), $finalUrl);

            // Return the card metadata, keyed by the final URL
            return array_merge(['uri' => $finalUrl], $meta);

        } catch (GuzzleException|Throwable) {
            return null;
        }
    }

    /**
     * Fetch an image and prepare it as a link-card thumbnail.
     *
     * Delegates the byte fetch and raster resize to the shared Media helper, returning
     * null on a network failure, an unsupported type, or an image too large for the blob.
     *
     * @param string $imageUrl The image URL to fetch.
     * @return array|null The thumbnail (bytes, mime), or null.
     */
    public static function fetchThumbnail(string $imageUrl): ?array
    {
        // Fetch the image bytes
        $fetched = Media::fetchBytes($imageUrl);

        // If the fetch failed, bail
        if (!$fetched) {
            return null;
        }

        // Resize/recompress to fit the thumbnail blob limit
        return Media::resizeToLimit($fetched['bytes'], (string) $fetched['mime'], static::MAX_THUMB_BYTES);
    }

    // ========================================================================= //

    /**
     * Map every <meta> tag in the HTML to its property/name => content value.
     *
     * Handles attributes in any order and HTML entities in the content.
     *
     * @param string $html Raw page HTML.
     * @return array Map of each meta property/name to its content value.
     */
    private static function _metaTags(string $html): array
    {
        // Initialize the map
        $map = [];

        // Grab every <meta> tag
        if (!preg_match_all('/<meta\b[^>]*>/i', $html, $tags)) {
            return $map;
        }

        // Loop through each tag
        foreach ($tags[0] as $tag) {

            // Initialize the attributes map
            $attrs = [];

            // Parse the tag's attributes into a key => value map
            if (preg_match_all('/([a-zA-Z:-]+)\s*=\s*("|\')(.*?)\2/s', $tag, $pairs, PREG_SET_ORDER)) {
                foreach ($pairs as $pair) {
                    $attrs[strtolower($pair[1])] = $pair[3];
                }
            }

            // Use the `property` or `name` attribute as the identifier
            $id = strtolower($attrs['property'] ?? $attrs['name'] ?? '');

            // If a tag has no identifier or content value, skip
            if (!$id || !isset($attrs['content'])) {
                continue;
            }

            // Store the decoded content (first occurrence wins)
            if (!isset($map[$id])) {
                $map[$id] = html_entity_decode($attrs['content'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            }

        }

        // Return the meta map
        return $map;
    }

    /**
     * Extract the document <title>, decoded and whitespace-collapsed.
     *
     * @param string $html Raw page HTML.
     * @return string|null The decoded title, or null when absent or empty.
     */
    private static function _documentTitle(string $html): ?string
    {
        // Match the first <title> element
        if (!preg_match('/<title\b[^>]*>(.*?)<\/title>/is', $html, $match)) {
            return null;
        }

        // Decode entities and collapse whitespace
        $title = html_entity_decode($match[1], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $title = trim(preg_replace('/\s+/', ' ', $title));

        // Treat an empty <title> as absent
        return ($title ?: null);
    }

    /**
     * Resolve a possibly-relative URL against a base URL.
     *
     * Handles absolute, protocol-relative, root-relative, and document-relative
     * forms. Returns the input unchanged when the base URL has no host.
     *
     * @param string $base The base URL to resolve against.
     * @param string $url The possibly-relative URL to resolve.
     * @return string The resolved absolute URL.
     */
    private static function _resolveUrl(string $base, string $url): string
    {
        // Normalize the candidate URL
        $url = trim($url);

        // If empty or already absolute, return it as-is
        if ('' === $url || preg_match('#^https?://#i', $url)) {
            return $url;
        }

        // Get the base host
        $host = parse_url($base, PHP_URL_HOST);

        // If there's no base host, return the URL as-is
        if (!$host) {
            return $url;
        }

        // Build the base authority (host plus optional port)
        $scheme = (parse_url($base, PHP_URL_SCHEME) ?: 'https');
        $port = parse_url($base, PHP_URL_PORT);
        $authority = $host.($port ? ":{$port}" : '');

        // Protocol-relative: borrow the base scheme
        if (str_starts_with($url, '//')) {
            return "{$scheme}:{$url}";
        }

        // Root-relative: anchor at the base authority
        if (str_starts_with($url, '/')) {
            return "{$scheme}://{$authority}{$url}";
        }

        // Document-relative: anchor at the base path's directory
        $path = (parse_url($base, PHP_URL_PATH) ?: '/');
        $dir = rtrim(substr($path, 0, strrpos($path, '/') + 1), '/');

        return "{$scheme}://{$authority}{$dir}/{$url}";
    }

}
