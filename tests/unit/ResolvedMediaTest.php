<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Model;
use doublesecretagency\notifier\models\ResolvedMedia;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit tests for the ResolvedMedia descriptor.
 *
 * A light, serializable value object that carries a media item's kind, URL,
 * asset ID, MIME, and dimensions, but never its bytes (so it survives the
 * queue cheaply).
 */
class ResolvedMediaTest extends TestCase
{
    public function testExtendsModel(): void
    {
        $this->assertTrue((new ReflectionClass(ResolvedMedia::class))->isSubclassOf(Model::class));
    }

    public function testKindConstants(): void
    {
        $this->assertSame('image', ResolvedMedia::KIND_IMAGE);
        $this->assertSame('video', ResolvedMedia::KIND_VIDEO);
    }

    public function testDefaultsToAnEmptyImageDescriptor(): void
    {
        $media = new ResolvedMedia();

        $this->assertSame(ResolvedMedia::KIND_IMAGE, $media->kind);
        $this->assertNull($media->url);
        $this->assertNull($media->assetId);
        $this->assertNull($media->mimeType);
        $this->assertNull($media->width);
        $this->assertNull($media->height);
    }

    public function testCarriesNoBytesProperty(): void
    {
        // The descriptor is intentionally byte-free so queued jobs stay small.
        $defaults = (new ReflectionClass(ResolvedMedia::class))->getDefaultProperties();
        $this->assertArrayNotHasKey('bytes', $defaults);
    }

    public function testConstructorHydratesAllProperties(): void
    {
        $media = new ResolvedMedia([
            'kind'     => ResolvedMedia::KIND_VIDEO,
            'url'      => 'https://example.com/a.mp4',
            'assetId'  => 42,
            'mimeType' => 'video/mp4',
            'width'    => 1920,
            'height'   => 1080,
        ]);

        $this->assertSame('video/mp4', $media->mimeType);
        $this->assertSame(42, $media->assetId);
        $this->assertSame(1920, $media->width);
        $this->assertSame(1080, $media->height);
    }

    public function testIsImageAndIsVideo(): void
    {
        $image = new ResolvedMedia(['kind' => ResolvedMedia::KIND_IMAGE]);
        $this->assertTrue($image->isImage());
        $this->assertFalse($image->isVideo());

        $video = new ResolvedMedia(['kind' => ResolvedMedia::KIND_VIDEO]);
        $this->assertTrue($video->isVideo());
        $this->assertFalse($video->isImage());
    }

    public function testDescribePrefersAssetIdThenUrlThenKind(): void
    {
        // An asset is identified by ID, even when it also carries a URL
        $asset = new ResolvedMedia(['assetId' => 6, 'url' => 'https://example.com/a.jpg']);
        $this->assertSame('asset ID 6', $asset->describe());

        // A URL-only item is identified by its URL
        $url = new ResolvedMedia(['url' => 'https://example.com/a.jpg']);
        $this->assertSame('https://example.com/a.jpg', $url->describe());

        // With neither an asset ID nor a URL, fall back to the kind
        $bare = new ResolvedMedia(['kind' => ResolvedMedia::KIND_VIDEO]);
        $this->assertSame('video', $bare->describe());
    }

    public function testDetailFieldsReportKindSourceAndMime(): void
    {
        // An asset descriptor reports kind, source (asset ID), and MIME
        $asset = new ResolvedMedia(['kind' => ResolvedMedia::KIND_VIDEO, 'assetId' => 6, 'mimeType' => 'video/mp4']);
        $fields = $asset->detailFields();
        $this->assertSame('video', $fields['Kind']);
        $this->assertSame('asset ID 6', $fields['Source']);
        $this->assertSame('video/mp4', $fields['MIME']);

        // Without a MIME type, the MIME field is omitted
        $bare = new ResolvedMedia(['url' => 'https://example.com/a.jpg']);
        $fields = $bare->detailFields();
        $this->assertSame('https://example.com/a.jpg', $fields['Source']);
        $this->assertArrayNotHasKey('MIME', $fields);
    }
}
