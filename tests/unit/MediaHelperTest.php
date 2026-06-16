<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\Media;
use doublesecretagency\notifier\models\ResolvedMedia;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Tests for the Media helper.
 *
 * Covers the pure pieces that run without a Craft bootstrap: the raster
 * primitives moved here from BlueskyLinkCard (resizeToLimit and friends),
 * and the URL kind/MIME inference. Asset resolution and byte fetching touch
 * Craft and Guzzle, so they are only checked at the source/shape level.
 */
class MediaHelperTest extends TestCase
{

    /**
     * @var int A convenient byte cap for the resize tests (matches the Bluesky blob limit).
     */
    private const CAP = 1000000;

    // ========================================================================= //
    // resizeToLimit() - raster format and size handling
    // ========================================================================= //

    public function testResizeToLimitPassesThroughSmallRaster(): void
    {
        // A small in-limit PNG comes back untouched, with its MIME normalized
        $png = $this->makeSolidPng(8, 8);

        $result = Media::resizeToLimit($png, 'image/png', self::CAP);

        $this->assertNotNull($result);
        $this->assertSame($png, $result['bytes']);
        $this->assertSame('image/png', $result['mime']);
    }

    public function testResizeToLimitRejectsSvg(): void
    {
        $svg = '<svg xmlns="http://www.w3.org/2000/svg"><rect width="10" height="10"/></svg>';

        $this->assertNull(Media::resizeToLimit($svg, 'image/svg+xml', self::CAP));
    }

    public function testResizeToLimitRejectsAnimatedGif(): void
    {
        // A still GIF has at most one Graphic Control Extension block; two means animated
        $animated = 'GIF89a' . str_repeat("\x00\x21\xF9\x04\x00\x00\x00\x00", 2) . 'trailing';

        $this->assertNull(Media::resizeToLimit($animated, 'image/gif', self::CAP));
    }

    public function testResizeToLimitPassesThroughWhenExactlyAtLimit(): void
    {
        // Byte count exactly equal to the limit is still within bounds
        $png = $this->makeNoisePng(120, 120);

        $result = Media::resizeToLimit($png, 'image/png', strlen($png));

        $this->assertNotNull($result);
        $this->assertSame($png, $result['bytes']);
    }

    public function testResizeToLimitRecompressesWhenJustOverLimit(): void
    {
        // One byte over the limit forces a recompress to JPEG
        $png = $this->makeNoisePng(300, 300);
        $maxBytes = strlen($png) - 1;

        $result = Media::resizeToLimit($png, 'image/png', $maxBytes);

        $this->assertNotNull($result);
        $this->assertLessThanOrEqual($maxBytes, strlen($result['bytes']));
        $this->assertSame('image/jpeg', $result['mime']);
    }

    public function testResizeToLimitShrinksOversizedRasterUnderTheCap(): void
    {
        // A noise PNG larger than the cap must come back under the cap
        $png = $this->makeNoisePng(700, 700);
        $this->assertGreaterThan(self::CAP, strlen($png), 'fixture should exceed the cap');

        $result = Media::resizeToLimit($png, 'image/png', self::CAP);

        $this->assertNotNull($result);
        $this->assertLessThanOrEqual(self::CAP, strlen($result['bytes']));
    }

    // ========================================================================= //
    // URL kind / MIME inference
    // ========================================================================= //

    public function testMimeFromUrlInfersImageExtensions(): void
    {
        $this->assertSame('image/jpeg', Media::mimeFromUrl('https://example.com/a.jpg'));
        $this->assertSame('image/jpeg', Media::mimeFromUrl('https://example.com/a.jpeg'));
        $this->assertSame('image/png', Media::mimeFromUrl('https://example.com/a.png'));
        $this->assertSame('image/gif', Media::mimeFromUrl('https://example.com/a.gif'));
        $this->assertSame('image/webp', Media::mimeFromUrl('https://example.com/a.webp'));
    }

    public function testMimeFromUrlInfersVideoExtensions(): void
    {
        $this->assertSame('video/mp4', Media::mimeFromUrl('https://example.com/a.mp4'));
        $this->assertSame('video/quicktime', Media::mimeFromUrl('https://example.com/a.mov'));
        $this->assertSame('video/webm', Media::mimeFromUrl('https://example.com/a.webm'));
    }

    public function testMimeFromUrlIgnoresQueryStringAndCase(): void
    {
        $this->assertSame('image/png', Media::mimeFromUrl('https://example.com/a.PNG?v=2'));
    }

    public function testMimeFromUrlReturnsNullForUnknownExtension(): void
    {
        $this->assertNull(Media::mimeFromUrl('https://example.com/a.xyz'));
        $this->assertNull(Media::mimeFromUrl('https://example.com/no-extension'));
    }

    public function testKindFromUrlClassifiesImagesAndVideos(): void
    {
        $this->assertSame(ResolvedMedia::KIND_IMAGE, Media::kindFromUrl('https://example.com/a.jpg'));
        $this->assertSame(ResolvedMedia::KIND_VIDEO, Media::kindFromUrl('https://example.com/a.mp4'));
    }

    public function testKindFromUrlDefaultsToImageForUnknownExtension(): void
    {
        // An unknown or extensionless URL is assumed to be an image
        $this->assertSame(ResolvedMedia::KIND_IMAGE, Media::kindFromUrl('https://example.com/no-extension'));
    }

    // ========================================================================= //
    // unsupportedReason() - the reason an item resolve() rejected was dropped
    // ========================================================================= //

    public function testUnsupportedReasonExplainsNull(): void
    {
        // null is the common case (an empty field, or `field()` with parens)
        $this->assertSame('setMedia evaluated to a null value.', Media::unsupportedReason(null));
    }

    public function testUnsupportedReasonExplainsAnUnmatchedAssetId(): void
    {
        // An integer is reported as an asset ID with no match (no Craft lookup happens here)
        $this->assertSame('Asset ID 7 could not be found.', Media::unsupportedReason(7));
    }

    public function testUnsupportedReasonExplainsAnEmptyString(): void
    {
        // A non-empty string resolves as a URL, so any string reaching here was empty/whitespace
        $this->assertSame('setMedia evaluated to an empty string.', Media::unsupportedReason(''));
        $this->assertSame('setMedia evaluated to an empty string.', Media::unsupportedReason('   '));
    }

    public function testUnsupportedReasonFallsBackToThePhpType(): void
    {
        // Anything else reports its PHP type
        $this->assertSame('setMedia evaluated to an unsupported bool value.', Media::unsupportedReason(true));
        $this->assertSame('setMedia evaluated to an unsupported array value.', Media::unsupportedReason([]));
        $this->assertSame('setMedia evaluated to an unsupported float value.', Media::unsupportedReason(1.5));
    }

    // ========================================================================= //
    // Shape / source guards (resolve + bytesFor touch Craft and Guzzle)
    // ========================================================================= //

    public function testResolveAndBytesForMethodsExist(): void
    {
        $reflection = new ReflectionClass(Media::class);
        $this->assertTrue($reflection->hasMethod('resolve'));
        $this->assertTrue($reflection->hasMethod('bytesFor'));
        $this->assertTrue($reflection->hasMethod('fetchBytes'));
    }

    public function testFetchBytesNeverThrows(): void
    {
        // The Guzzle boundary swallows both Guzzle and generic throwables
        $source = file_get_contents(dirname(__DIR__, 2) . '/src/helpers/Media.php');
        $this->assertStringContainsString('GuzzleException|Throwable', $source);
    }

    // ========================================================================= //
    // Fixture helpers
    // ========================================================================= //

    /**
     * Skip the calling test when the GD extension is unavailable.
     *
     * @return void
     */
    private function requireGd(): void
    {
        if (!function_exists('imagecreatetruecolor')) {
            $this->markTestSkipped('The GD extension is required to generate image fixtures.');
        }
    }

    /**
     * Generate a small solid-color PNG of the given dimensions.
     *
     * @param int $width
     * @param int $height
     * @return string PNG bytes.
     */
    private function makeSolidPng(int $width, int $height): string
    {
        $this->requireGd();

        // Build a solid blue canvas
        $image = imagecreatetruecolor($width, $height);
        imagefill($image, 0, 0, imagecolorallocate($image, 30, 90, 200));

        // Capture the PNG output
        ob_start();
        imagepng($image);
        $bytes = (string) ob_get_clean();
        imagedestroy($image);

        return $bytes;
    }

    /**
     * Generate a random-noise PNG, which compresses poorly and so grows large fast.
     *
     * @param int $width
     * @param int $height
     * @return string PNG bytes.
     */
    private function makeNoisePng(int $width, int $height): string
    {
        $this->requireGd();

        // Fill every pixel with a random color so the PNG barely compresses
        $image = imagecreatetruecolor($width, $height);
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                imagesetpixel($image, $x, $y, mt_rand(0, 0xFFFFFF));
            }
        }

        // Capture the PNG output
        ob_start();
        imagepng($image);
        $bytes = (string) ob_get_clean();
        imagedestroy($image);

        return $bytes;
    }

}
