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

use craft\base\Model;

/**
 * Light, serializable descriptor for a single media attachment.
 *
 * @since 3.1.0
 */
class ResolvedMedia extends Model
{

    /**
     * @var string Media kind for a still image.
     */
    public const KIND_IMAGE = 'image';

    /**
     * @var string Media kind for a video.
     */
    public const KIND_VIDEO = 'video';

    /**
     * @var string Media kind, either "image" or "video".
     */
    public string $kind = self::KIND_IMAGE;

    /**
     * @var string|null Public URL for the media, when one is available.
     */
    public ?string $url = null;

    /**
     * @var int|null Craft Asset ID, when the item came from an Assets field.
     */
    public ?int $assetId = null;

    /**
     * @var string|null MIME type (e.g. "image/jpeg"), when known.
     */
    public ?string $mimeType = null;

    /**
     * @var int|null Pixel width, when known.
     */
    public ?int $width = null;

    /**
     * @var int|null Pixel height, when known.
     */
    public ?int $height = null;

    /**
     * Whether this descriptor is a still image.
     *
     * @return bool
     */
    public function isImage(): bool
    {
        return (self::KIND_IMAGE === $this->kind);
    }

    /**
     * Whether this descriptor is a video.
     *
     * @return bool
     */
    public function isVideo(): bool
    {
        return (self::KIND_VIDEO === $this->kind);
    }

    /**
     * Describe this attachment for the log detail.
     *
     * @return string A short identifier (asset ID, URL, or kind).
     */
    public function describe(): string
    {
        // If from a Craft asset, identify it by ID
        if (null !== $this->assetId) {
            return "asset ID {$this->assetId}";
        }

        // If it has a URL, identify it by URL
        if ($this->url) {
            return $this->url;
        }

        // Otherwise, fall back to the kind
        return $this->kind;
    }

    /**
     * Structured fields describing this attachment, for the log detail panel.
     *
     * @return array
     */
    public function detailFields(): array
    {
        // Identify the attachment by kind and source
        $fields = [
            'Kind'   => $this->kind,
            'Source' => $this->describe(),
        ];

        // Include the MIME type when known
        if ($this->mimeType) {
            $fields['MIME'] = $this->mimeType;
        }

        // Return the fields
        return $fields;
    }

}
