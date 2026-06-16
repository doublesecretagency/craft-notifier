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
use craft\base\ElementInterface;
use craft\elements\Asset;
use doublesecretagency\notifier\models\ResolvedMedia;
use GdImage;
use GuzzleHttp\Exception\GuzzleException;
use Throwable;

/**
 * Resolves and prepares media attachments for outbound posts.
 *
 * @since 3.1.0
 */
abstract class Media
{

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
     * @var array File extensions mapped to their canonical MIME type.
     */
    private const MIME_BY_EXTENSION = [
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png'  => 'image/png',
        'gif'  => 'image/gif',
        'webp' => 'image/webp',
        'mp4'  => 'video/mp4',
        'm4v'  => 'video/x-m4v',
        'mov'  => 'video/quicktime',
        'webm' => 'video/webm',
    ];

    /**
     * @var int Media-fetch timeout in seconds. Kept short so a slow fetch cannot stall the queue worker.
     */
    private const FETCH_TIMEOUT = 15;

    /**
     * Normalize a raw collected item into a light media descriptor.
     *
     * Accepts a Craft Asset, an asset ID, or a URL string. Returns null for
     * anything else (logged by the caller).
     *
     * @param mixed $item A Craft Asset, an asset ID, or a URL string.
     * @return ResolvedMedia|null
     */
    public static function resolve(mixed $item): ?ResolvedMedia
    {
        // If the item is a Craft Asset, describe it directly
        if ($item instanceof Asset) {
            return static::_resolveAsset($item);
        }

        // If the item is an asset ID, load and describe the Asset
        if (is_int($item)) {
            $asset = Craft::$app->getAssets()->getAssetById($item);
            return ($asset ? static::_resolveAsset($asset) : null);
        }

        // If the item is a URL string, describe it from the URL
        if (is_string($item) && '' !== trim($item)) {
            return static::_resolveUrl(trim($item));
        }

        // Unsupported input
        return null;
    }

    /**
     * Explain why a collected item could not be resolved into an image.
     *
     * @param mixed $item The item that `resolve()` rejected.
     * @return string A plain reason for the log line.
     */
    public static function unsupportedReason(mixed $item): string
    {
        // If null, the snippet produced no value here
        if (null === $item) {
            return 'setMedia evaluated to a null value.';
        }

        // If a Craft element, name its class (a non-asset element is not an image)
        if ($item instanceof ElementInterface) {
            return 'setMedia evaluated to a '.$item::class.' element, which is not an image.';
        }

        // If an integer, it was treated as an asset ID with no match
        if (is_int($item)) {
            return "Asset ID {$item} could not be found.";
        }

        // If a string, it was empty (a non-empty string resolves as a URL)
        if (is_string($item)) {
            return 'setMedia evaluated to an empty string.';
        }

        // Otherwise, report the value's PHP type
        return 'setMedia evaluated to an unsupported '.get_debug_type($item).' value.';
    }

    /**
     * Wrap a skip reason as a single inline log line.
     *
     * @param string $reason Plain explanation of why the image was dropped.
     * @return string The translated "[NOT ATTACHED]" line.
     */
    public static function notAttachedLine(string $reason): string
    {
        // Format the dropped attachment as a single inline line
        return Craft::t('notifier', '[NOT ATTACHED] Unable to attach image. {reason}', ['reason' => $reason]);
    }

    /**
     * Read raw bytes for a descriptor at send time.
     *
     * Byte-upload platforms call this to get the actual file contents. Returns
     * `['bytes' => ..., 'mime' => ...]`, or null when the bytes cannot be read.
     *
     * @param ResolvedMedia $media
     * @param string|null $error Set to the literal read error when the bytes cannot be read.
     * @return array|null
     */
    public static function bytesFor(ResolvedMedia $media, ?string &$error = null): ?array
    {
        // If the descriptor points at a Craft Asset, read its bytes
        if (null !== $media->assetId) {
            return static::_bytesFromAsset($media->assetId, $media->mimeType, $error);
        }

        // If the descriptor has a URL, fetch its bytes
        if (null !== $media->url && '' !== $media->url) {
            return static::fetchBytes($media->url, $error);
        }

        // Nothing to read
        $error = 'The media had no asset or URL to read.';
        return null;
    }

    /**
     * Fetch raw bytes from a URL.
     *
     * Guzzle boundary, never throws. Returns null on a network failure, a
     * non-2xx response, or an empty body.
     *
     * @param string $url The URL to fetch.
     * @param string|null $error Set to the literal fetch error when the bytes cannot be read.
     * @return array|null The fetched bytes (bytes, mime), or null.
     */
    public static function fetchBytes(string $url, ?string &$error = null): ?array
    {
        try {

            // Fetch the file, following redirects
            $client = Craft::createGuzzleClient();
            $response = $client->get($url, [
                'allow_redirects' => true,
                'http_errors'     => false,
                'timeout'         => static::FETCH_TIMEOUT,
            ]);

            // On a non-2xx response, bail
            $status = $response->getStatusCode();
            if ($status < 200 || $status >= 300) {
                $error = "HTTP {$status} fetching the media URL.";
                return null;
            }

            // On an empty body, bail
            $bytes = (string) $response->getBody();
            if ('' === $bytes) {
                $error = 'The fetched media was empty.';
                return null;
            }

            // Get the MIME from the response header (drop any charset suffix)
            $mime = strtolower(trim(explode(';', $response->getHeaderLine('Content-Type'))[0]));

            // Return the fetched bytes
            return [
                'bytes' => $bytes,
                'mime' => ($mime ?: null)
            ];

        } catch (GuzzleException|Throwable $e) {
            $error = $e->getMessage();
            return null;
        }
    }

    /**
     * Ensure raw image bytes are a supported raster type within a byte limit.
     *
     * Pure function, no network. An in-limit raster passes through untouched; an
     * oversized one is recompressed and downscaled to a JPEG under the limit.
     *
     * @param string $bytes Raw image bytes.
     * @param string $mime The declared MIME type.
     * @param int $maxBytes The maximum allowed byte size.
     * @return array|null The resized image (bytes, mime), or null when unsupported (SVG, animated GIF) or it cannot be made to fit.
     */
    public static function resizeToLimit(string $bytes, string $mime, int $maxBytes): ?array
    {
        // Get the raster type, byte-sniffing when the MIME is unhelpful
        $type = static::_rasterType($mime, $bytes);

        // If the type is unsupported, bail (SVG, unknown)
        if (!$type) {
            return null;
        }

        // If the GIF is animated, bail (an attachment is a single still)
        if ('gif' === $type && static::_isAnimatedGif($bytes)) {
            return null;
        }

        // If already within the limit, pass through unchanged
        if (strlen($bytes) <= $maxBytes) {
            return [
                'bytes' => $bytes,
                'mime' => static::RASTER_MIMES[$type]
            ];
        }

        // Decode the raster into a GD image
        $image = @imagecreatefromstring($bytes);
        if (!($image instanceof GdImage)) {
            return null;
        }

        // Get the image dimensions and starting quality
        $width = imagesx($image);
        $height = imagesy($image);
        $quality = 85;

        // Recompress, dropping quality then downscaling, until it fits
        for ($attempt = 0; $attempt < 16; $attempt++) {

            // Encode the current image to JPEG
            $encoded = static::_encodeJpeg($image, $quality);

            // If it fits, return the encoded JPEG
            if (null !== $encoded && strlen($encoded) <= $maxBytes) {
                imagedestroy($image);
                return [
                    'bytes' => $encoded,
                    'mime' => 'image/jpeg'
                ];
            }

            // If quality can still drop, lower it and retry
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
     * Infer a media kind ("image" or "video") from a URL.
     *
     * @param string $url
     * @return string
     */
    public static function kindFromUrl(string $url): string
    {
        // Get the MIME from the URL extension
        $mime = static::mimeFromUrl($url);

        // A video MIME is a video; everything else defaults to image
        return ($mime && str_starts_with($mime, 'video/') ? ResolvedMedia::KIND_VIDEO : ResolvedMedia::KIND_IMAGE);
    }

    /**
     * Infer a MIME type from a URL extension.
     *
     * @param string $url
     * @return string|null The MIME type, or null when the extension is unknown.
     */
    public static function mimeFromUrl(string $url): ?string
    {
        // Get the lowercased path extension (ignore any query string)
        $path = (parse_url($url, PHP_URL_PATH) ?: $url);
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        // Map the extension to a known MIME, or null
        return (static::MIME_BY_EXTENSION[$extension] ?? null);
    }

    // ========================================================================= //

    /**
     * Describe a Craft Asset as a media descriptor.
     *
     * @param Asset $asset
     * @return ResolvedMedia
     */
    private static function _resolveAsset(Asset $asset): ResolvedMedia
    {
        // Build the descriptor from the Asset
        return new ResolvedMedia([
            'kind'     => (Asset::KIND_VIDEO === $asset->kind ? ResolvedMedia::KIND_VIDEO : ResolvedMedia::KIND_IMAGE),
            'url'      => $asset->getUrl(),
            'assetId'  => $asset->id,
            'mimeType' => $asset->getMimeType(),
            'width'    => $asset->getWidth(),
            'height'   => $asset->getHeight(),
        ]);
    }

    /**
     * Describe a URL string as a media descriptor.
     *
     * @param string $url
     * @return ResolvedMedia
     */
    private static function _resolveUrl(string $url): ResolvedMedia
    {
        // Build the descriptor from the URL
        return new ResolvedMedia([
            'kind'     => static::kindFromUrl($url),
            'url'      => $url,
            'mimeType' => static::mimeFromUrl($url),
        ]);
    }

    /**
     * Read raw bytes from a Craft Asset.
     *
     * @param int $assetId
     * @param string|null $fallbackMime MIME to use when the Asset's own MIME is unavailable.
     * @param string|null $error Set to the literal read error when the bytes cannot be read.
     * @return array|null
     */
    private static function _bytesFromAsset(int $assetId, ?string $fallbackMime, ?string &$error = null): ?array
    {
        // Get the Asset
        $asset = Craft::$app->getAssets()->getAssetById($assetId);

        // If the Asset is gone, bail
        if (!$asset) {
            $error = "Asset ID {$assetId} no longer exists.";
            return null;
        }

        try {

            // Read the Asset's bytes off its stream
            $stream = $asset->getStream();
            $bytes = stream_get_contents($stream);
            fclose($stream);

            // If the stream produced nothing, bail
            if (false === $bytes || '' === $bytes) {
                $error = "Asset ID {$assetId} produced no data.";
                return null;
            }

            // Return the bytes with the Asset's MIME (falling back to the descriptor's)
            return [
                'bytes' => $bytes,
                'mime'  => ($asset->getMimeType() ?: $fallbackMime),
            ];

        } catch (Throwable $e) {
            $error = $e->getMessage();
            return null;
        }
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

        // If the MIME is a vector type, bail
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
