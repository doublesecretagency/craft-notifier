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

namespace doublesecretagency\notifier\helpers;

use Craft;
use GdImage;
use GuzzleHttp\Exception\GuzzleException;
use Throwable;

/**
 * Class BlueskyLinkCard
 * @since 3.0.0
 *
 * Builds the data for an `app.bsky.embed.external` link-preview card. Bluesky
 * does not unfurl links server-side; the posting client must scrape the page's
 * OpenGraph metadata itself and attach the embed. This helper owns the scrape
 * (metadata and thumbnail), leaving the PDS blob upload and embed assembly to
 * `OutboundBluesky`. The pure seams (`parseMetadata()`, `resizeToLimit()`) are
 * separated from the Guzzle boundaries (`fetchMetadata()`, `fetchThumbnail()`)
 * so the parsing logic stays unit-testable.
 */
abstract class BlueskyLinkCard
{

    /**
     * @var int Maximum size for an `app.bsky.embed.external` thumbnail blob. A fixed ATProto
     * lexicon constant (`thumb` `maxSize`), enforced at `createRecord`, not discoverable at runtime.
     */
    public const MAX_THUMB_BYTES = 1000000;

    /**
     * @var array Supported raster image types, keyed by short type with their canonical MIME.
     */
    private const RASTER_MIMES = [
        'jpeg' => 'image/jpeg',
        'png'  => 'image/png',
        'gif'  => 'image/gif',
        'webp' => 'image/webp',
    ];

    /**
     * @var int Page- and image-fetch timeout in seconds. Kept short so a slow scrape cannot stall the queue worker.
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
     * Pure function, no I/O. The three required card fields are always present:
     * `title` falls back to the page `<title>` then the URL host, `description`
     * falls back to an empty string. `imageUrl` is null when no image is found.
     *
     * @param string $html Raw page HTML.
     * @param string $baseUrl The page's final (post-redirect) URL, used to resolve a relative image.
     * @return array{title: string, description: string, imageUrl: ?string}
     */
    public static function parseMetadata(string $html, string $baseUrl): array
    {
        // Collect every <meta> tag's property/name => content mapping
        $meta = static::_metaTags($html);

        // Resolve the title, falling back og:title -> twitter:title -> <title> -> host
        $title = (
            $meta['og:title']
            ?? $meta['twitter:title']
            ?? static::_documentTitle($html)
            ?? (parse_url($baseUrl, PHP_URL_HOST) ?: '')
        );

        // Resolve the description, falling back og:description -> twitter:description -> meta -> empty
        $description = (
            $meta['og:description']
            ?? $meta['twitter:description']
            ?? $meta['description']
            ?? ''
        );

        // Resolve the image from og:image or twitter:image, against the base URL
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
     * @return array{uri: string, title: string, description: string, imageUrl: ?string}|null
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

            // On a non-2xx response, bail
            $status = $response->getStatusCode();
            if ($status < 200 || $status >= 300) {
                return null;
            }

            // On a non-HTML body, bail
            $contentType = strtolower($response->getHeaderLine('Content-Type'));
            if (!str_contains($contentType, 'text/html') && !str_contains($contentType, 'application/xhtml')) {
                return null;
            }

            // Resolve the final URL after any redirects
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
     * Ensure raw image bytes are a supported raster type within a byte limit.
     *
     * Pure function, no network. An in-limit supported raster passes through
     * untouched. An oversized one is recompressed (and progressively downscaled)
     * to a JPEG under the limit. Returns null for unsupported types (SVG,
     * animated GIF) or when the image cannot be made to fit.
     *
     * @param string $bytes Raw image bytes.
     * @param string $mime The declared MIME type.
     * @param int $maxBytes The maximum allowed byte size.
     * @return array{bytes: string, mime: string}|null
     */
    public static function resizeToLimit(string $bytes, string $mime, int $maxBytes): ?array
    {
        // Determine the raster type, byte-sniffing when the MIME is unhelpful
        $type = static::_rasterType($mime, $bytes);

        // Reject unsupported types (SVG, unknown)
        if (!$type) {
            return null;
        }

        // Reject animated GIFs - a card thumbnail is a single still
        if ('gif' === $type && static::_isAnimatedGif($bytes)) {
            return null;
        }

        // Already within the limit - pass through unchanged
        if (strlen($bytes) <= $maxBytes) {
            return ['bytes' => $bytes, 'mime' => static::RASTER_MIMES[$type]];
        }

        // Decode the raster into a GD image
        $image = @imagecreatefromstring($bytes);
        if (!($image instanceof GdImage)) {
            return null;
        }

        // Recompress, dropping quality then downscaling, until it fits
        $width = imagesx($image);
        $height = imagesy($image);
        $quality = 85;

        for ($attempt = 0; $attempt < 16; $attempt++) {

            // Encode the current image to JPEG
            $encoded = static::_encodeJpeg($image, $quality);

            // Within the limit - done
            if (null !== $encoded && strlen($encoded) <= $maxBytes) {
                imagedestroy($image);
                return ['bytes' => $encoded, 'mime' => 'image/jpeg'];
            }

            // Drop quality first, then start scaling the image down
            if ($quality > 50) {
                $quality -= 15;
                continue;
            }

            // Scale down by 15% and reset quality for the next pass
            $width = (int) round($width * 0.85);
            $height = (int) round($height * 0.85);
            if ($width < 1 || $height < 1) {
                break;
            }
            $scaled = imagescale($image, $width, $height);
            if (!($scaled instanceof GdImage)) {
                break;
            }
            imagedestroy($image);
            $image = $scaled;
            $quality = 85;

        }

        // Could not get the image under the limit
        imagedestroy($image);
        return null;
    }

    /**
     * Fetch an image and prepare it as a link-card thumbnail.
     *
     * Guzzle boundary, never throws. Returns null on a network failure, a
     * non-2xx response, an unsupported type, or when the image cannot be
     * resized under the blob limit.
     *
     * @param string $imageUrl The image URL to fetch.
     * @return array{bytes: string, mime: string}|null
     */
    public static function fetchThumbnail(string $imageUrl): ?array
    {
        try {

            // Fetch the image, following redirects
            $client = Craft::createGuzzleClient();
            $response = $client->get($imageUrl, [
                'allow_redirects' => true,
                'http_errors'     => false,
                'timeout'         => static::FETCH_TIMEOUT,
            ]);

            // On a non-2xx response, bail
            $status = $response->getStatusCode();
            if ($status < 200 || $status >= 300) {
                return null;
            }

            // On an empty body, bail
            $bytes = (string) $response->getBody();
            if ('' === $bytes) {
                return null;
            }

            // Determine the MIME from the response header (drop any charset suffix)
            $mime = strtolower(trim(explode(';', $response->getHeaderLine('Content-Type'))[0]));

            // Resize/recompress to fit the thumbnail blob limit
            return static::resizeToLimit($bytes, $mime, static::MAX_THUMB_BYTES);

        } catch (GuzzleException|Throwable) {
            return null;
        }
    }

    // ========================================================================= //

    /**
     * Map every <meta> tag in the HTML to its property/name => content value.
     *
     * Handles attributes in any order and HTML entities in the content.
     *
     * @param string $html Raw page HTML.
     * @return array<string,string> Map of each meta property/name to its content value.
     */
    private static function _metaTags(string $html): array
    {
        // Initialize the map
        $map = [];

        // Grab every <meta> tag
        if (!preg_match_all('/<meta\b[^>]*>/i', $html, $tags)) {
            return $map;
        }

        // Walk each tag
        foreach ($tags[0] as $tag) {

            // Parse the tag's attributes into a key => value map
            $attrs = [];
            if (preg_match_all('/([a-zA-Z:-]+)\s*=\s*("|\')(.*?)\2/s', $tag, $pairs, PREG_SET_ORDER)) {
                foreach ($pairs as $pair) {
                    $attrs[strtolower($pair[1])] = $pair[3];
                }
            }

            // Use the `property` or `name` attribute as the identifier
            $id = strtolower($attrs['property'] ?? $attrs['name'] ?? '');

            // Skip tags without an identifier or a content value
            if (!$id || !isset($attrs['content'])) {
                continue;
            }

            // Store the decoded content (first occurrence wins)
            if (!isset($map[$id])) {
                $map[$id] = html_entity_decode($attrs['content'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            }

        }

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

        // Skip resolution for an empty or already-absolute URL
        if ('' === $url || preg_match('#^https?://#i', $url)) {
            return $url;
        }

        // Without a base host, return the URL as-is
        $host = parse_url($base, PHP_URL_HOST);
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

    /**
     * Determine the supported raster type for an image.
     *
     * Trusts the declared MIME for known raster types, treats an SVG MIME as
     * unsupported, and byte-sniffs anything else.
     *
     * @param string $mime The declared MIME type.
     * @param string $bytes Raw image bytes.
     * @return string|null Short raster type (jpeg/png/gif/webp), or null when unsupported.
     */
    private static function _rasterType(string $mime, string $bytes): ?string
    {
        // Normalize the declared MIME
        $mime = strtolower(trim($mime));

        // A declared raster MIME is trusted directly
        $byMime = [
            'image/jpeg'  => 'jpeg',
            'image/jpg'   => 'jpeg',
            'image/pjpeg' => 'jpeg',
            'image/png'   => 'png',
            'image/gif'   => 'gif',
            'image/webp'  => 'webp',
        ];
        if (isset($byMime[$mime])) {
            return $byMime[$mime];
        }

        // Reject a declared vector type as unsupported
        if (str_contains($mime, 'svg')) {
            return null;
        }

        // Otherwise sniff the leading bytes
        return static::_sniffRasterType($bytes);
    }

    /**
     * Sniff a raster type from an image's magic-number signature.
     *
     * @param string $bytes Raw image bytes.
     * @return string|null Short raster type (jpeg/png/gif/webp), or null when unrecognized.
     */
    private static function _sniffRasterType(string $bytes): ?string
    {
        // JPEG: FF D8 FF
        if (str_starts_with($bytes, "\xFF\xD8\xFF")) {
            return 'jpeg';
        }

        // PNG: 89 50 4E 47
        if (str_starts_with($bytes, "\x89PNG")) {
            return 'png';
        }

        // GIF: "GIF87a" or "GIF89a"
        if (str_starts_with($bytes, 'GIF87a') || str_starts_with($bytes, 'GIF89a')) {
            return 'gif';
        }

        // WebP: "RIFF" .... "WEBP"
        if (str_starts_with($bytes, 'RIFF') && str_contains(substr($bytes, 0, 16), 'WEBP')) {
            return 'webp';
        }

        return null;
    }

    /**
     * Detect whether GIF bytes contain more than one frame.
     *
     * Counts Graphic Control Extension blocks; a still GIF has at most one.
     *
     * @param string $bytes Raw GIF bytes.
     * @return bool Whether the GIF contains more than one frame.
     */
    private static function _isAnimatedGif(string $bytes): bool
    {
        // Each animated frame is preceded by a Graphic Control Extension block
        return (preg_match_all('/\x00\x21\xF9\x04/s', $bytes) > 1);
    }

    /**
     * Encode a GD image to JPEG, flattened onto a white background.
     *
     * Flattening avoids transparent regions rendering as black in the JPEG.
     *
     * @param GdImage $image
     * @param int $quality JPEG quality (0-100).
     * @return string|null Encoded JPEG bytes, or null on failure.
     */
    private static function _encodeJpeg(GdImage $image, int $quality): ?string
    {
        // Build a white canvas matching the image dimensions
        $width = imagesx($image);
        $height = imagesy($image);
        $canvas = imagecreatetruecolor($width, $height);
        if (!($canvas instanceof GdImage)) {
            return null;
        }

        // Fill the canvas white, then composite the image onto it
        $white = imagecolorallocate($canvas, 255, 255, 255);
        imagefilledrectangle($canvas, 0, 0, $width, $height, $white);
        imagecopy($canvas, $image, 0, 0, 0, 0, $width, $height);

        // Capture the JPEG output
        ob_start();
        $ok = imagejpeg($canvas, null, $quality);
        $data = ob_get_clean();
        imagedestroy($canvas);

        // Return the encoded bytes when the encode succeeded
        return ($ok ? (string) $data : null);
    }

}
