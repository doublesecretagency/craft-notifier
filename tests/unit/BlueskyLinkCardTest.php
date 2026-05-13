<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\BlueskyLinkCard;
use PHPUnit\Framework\TestCase;

/**
 * Pure-unit + source-level tests for the Bluesky link-card helper.
 *
 * parseMetadata() is the pure seam and gets exercised against fixed HTML
 * strings. The Guzzle boundaries (fetchMetadata / fetchThumbnail) are not
 * unit-testable; source-level assertions pin their HTTP behavior.
 */
class BlueskyLinkCardTest extends TestCase
{
    private string $helperSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/helpers/BlueskyLinkCard.php';
        $this->assertTrue(file_exists($path), "BlueskyLinkCard.php should exist at: $path");
        $this->helperSource = file_get_contents($path);
    }

    // ========================================================================= //
    // firstUrl()
    // ========================================================================= //

    public function testFirstUrlReturnsNullWhenBodyHasNoUrl(): void
    {
        $this->assertNull(BlueskyLinkCard::firstUrl('Just plain text, no links here.'));
        $this->assertNull(BlueskyLinkCard::firstUrl(''));
    }

    public function testFirstUrlReturnsTheSingleUrl(): void
    {
        $this->assertSame(
            'https://example.com/article',
            BlueskyLinkCard::firstUrl('Read this: https://example.com/article today.')
        );
    }

    public function testFirstUrlReturnsTheFirstOfSeveral(): void
    {
        $body = 'First https://a.test/one then https://b.test/two and https://c.test/three';
        $this->assertSame('https://a.test/one', BlueskyLinkCard::firstUrl($body));
    }

    // ========================================================================= //
    // parseMetadata() - happy path and fallback chains
    // ========================================================================= //

    public function testParseMetadataExtractsOpenGraphTags(): void
    {
        $html = '<head>'
            . '<meta property="og:title" content="OG Title">'
            . '<meta property="og:description" content="OG Description">'
            . '<meta property="og:image" content="https://example.com/og.png">'
            . '</head>';

        $meta = BlueskyLinkCard::parseMetadata($html, 'https://example.com/article');

        $this->assertSame('OG Title', $meta['title']);
        $this->assertSame('OG Description', $meta['description']);
        $this->assertSame('https://example.com/og.png', $meta['imageUrl']);
    }

    public function testParseMetadataFallsBackToTwitterTags(): void
    {
        // No og:* tags present, twitter:* should be used
        $html = '<head>'
            . '<meta name="twitter:title" content="Twitter Title">'
            . '<meta name="twitter:description" content="Twitter Description">'
            . '<meta name="twitter:image" content="https://example.com/tw.jpg">'
            . '</head>';

        $meta = BlueskyLinkCard::parseMetadata($html, 'https://example.com/article');

        $this->assertSame('Twitter Title', $meta['title']);
        $this->assertSame('Twitter Description', $meta['description']);
        $this->assertSame('https://example.com/tw.jpg', $meta['imageUrl']);
    }

    public function testParseMetadataFallsBackToDocumentTitleAndMetaDescription(): void
    {
        // Neither og:* nor twitter:* present
        $html = '<head>'
            . '<title>Plain Document Title</title>'
            . '<meta name="description" content="Plain meta description.">'
            . '</head>';

        $meta = BlueskyLinkCard::parseMetadata($html, 'https://example.com/article');

        $this->assertSame('Plain Document Title', $meta['title']);
        $this->assertSame('Plain meta description.', $meta['description']);
        $this->assertNull($meta['imageUrl']);
    }

    public function testParseMetadataPrefersOpenGraphOverTwitterAndTitle(): void
    {
        // All three sources present - og:* wins
        $html = '<head>'
            . '<title>Doc Title</title>'
            . '<meta name="twitter:title" content="Tw Title">'
            . '<meta property="og:title" content="OG Wins">'
            . '</head>';

        $meta = BlueskyLinkCard::parseMetadata($html, 'https://example.com/x');

        $this->assertSame('OG Wins', $meta['title']);
    }

    // ========================================================================= //
    // parseMetadata() - required-field guarantees
    // ========================================================================= //

    public function testParseMetadataFallsBackToHostWhenNoTitleAnywhere(): void
    {
        $html = '<head><meta name="keywords" content="nothing useful"></head>';

        $meta = BlueskyLinkCard::parseMetadata($html, 'https://news.example.org/story/42');

        $this->assertSame('news.example.org', $meta['title']);
    }

    public function testParseMetadataDescriptionDefaultsToEmptyString(): void
    {
        $html = '<head><title>Only A Title</title></head>';

        $meta = BlueskyLinkCard::parseMetadata($html, 'https://example.com/');

        $this->assertSame('', $meta['description']);
    }

    // ========================================================================= //
    // parseMetadata() - image URL resolution
    // ========================================================================= //

    public function testParseMetadataResolvesRootRelativeImage(): void
    {
        $html = '<head><meta property="og:image" content="/img/cover.png"></head>';

        $meta = BlueskyLinkCard::parseMetadata($html, 'https://example.com/blog/article');

        $this->assertSame('https://example.com/img/cover.png', $meta['imageUrl']);
    }

    public function testParseMetadataResolvesProtocolRelativeImage(): void
    {
        $html = '<head><meta property="og:image" content="//cdn.example.net/cover.png"></head>';

        $meta = BlueskyLinkCard::parseMetadata($html, 'https://example.com/article');

        $this->assertSame('https://cdn.example.net/cover.png', $meta['imageUrl']);
    }

    public function testParseMetadataResolvesDocumentRelativeImage(): void
    {
        $html = '<head><meta property="og:image" content="cover.png"></head>';

        $meta = BlueskyLinkCard::parseMetadata($html, 'https://example.com/blog/article');

        $this->assertSame('https://example.com/blog/cover.png', $meta['imageUrl']);
    }

    public function testParseMetadataLeavesAbsoluteImageUntouched(): void
    {
        $html = '<head><meta property="og:image" content="https://other.test/x.png"></head>';

        $meta = BlueskyLinkCard::parseMetadata($html, 'https://example.com/article');

        $this->assertSame('https://other.test/x.png', $meta['imageUrl']);
    }

    // ========================================================================= //
    // parseMetadata() - attribute order and entities
    // ========================================================================= //

    public function testParseMetadataHandlesContentBeforeProperty(): void
    {
        // Attributes in either order must both resolve
        $html = '<head><meta content="Reversed Order" property="og:title"></head>';

        $meta = BlueskyLinkCard::parseMetadata($html, 'https://example.com/');

        $this->assertSame('Reversed Order', $meta['title']);
    }

    public function testParseMetadataDecodesHtmlEntities(): void
    {
        $html = '<head><meta property="og:title" content="Tom &amp; Jerry &#39;95"></head>';

        $meta = BlueskyLinkCard::parseMetadata($html, 'https://example.com/');

        $this->assertSame("Tom & Jerry '95", $meta['title']);
    }

    // ========================================================================= //
    // resizeToLimit() - thumbnail format and size handling
    // ========================================================================= //

    public function testMaxThumbBytesMatchesAtprotoLexicon(): void
    {
        // The ATProto `thumb` blob lexicon caps at exactly 1,000,000 bytes
        $this->assertSame(1000000, BlueskyLinkCard::MAX_THUMB_BYTES);
    }

    public function testResizeToLimitPassesThroughSmallRaster(): void
    {
        // A small in-limit PNG comes back untouched, with its MIME normalized
        $png = $this->makeSolidPng(8, 8);

        $result = BlueskyLinkCard::resizeToLimit($png, 'image/png', BlueskyLinkCard::MAX_THUMB_BYTES);

        $this->assertNotNull($result);
        $this->assertSame($png, $result['bytes']);
        $this->assertSame('image/png', $result['mime']);
    }

    public function testResizeToLimitRejectsSvg(): void
    {
        $svg = '<svg xmlns="http://www.w3.org/2000/svg"><rect width="10" height="10"/></svg>';

        $this->assertNull(BlueskyLinkCard::resizeToLimit($svg, 'image/svg+xml', BlueskyLinkCard::MAX_THUMB_BYTES));
    }

    public function testResizeToLimitRejectsAnimatedGif(): void
    {
        // A still GIF has at most one Graphic Control Extension block; two means animated
        $animated = 'GIF89a' . str_repeat("\x00\x21\xF9\x04\x00\x00\x00\x00", 2) . 'trailing';

        $this->assertNull(BlueskyLinkCard::resizeToLimit($animated, 'image/gif', BlueskyLinkCard::MAX_THUMB_BYTES));
    }

    public function testResizeToLimitPassesThroughWhenExactlyAtLimit(): void
    {
        // Byte count exactly equal to the limit is still within bounds
        $png = $this->makeNoisePng(120, 120);

        $result = BlueskyLinkCard::resizeToLimit($png, 'image/png', strlen($png));

        $this->assertNotNull($result);
        $this->assertSame($png, $result['bytes']);
    }

    public function testResizeToLimitRecompressesWhenJustOverLimit(): void
    {
        // One byte over the limit forces a recompress to JPEG
        $png = $this->makeNoisePng(300, 300);
        $maxBytes = strlen($png) - 1;

        $result = BlueskyLinkCard::resizeToLimit($png, 'image/png', $maxBytes);

        $this->assertNotNull($result);
        $this->assertLessThanOrEqual($maxBytes, strlen($result['bytes']));
        $this->assertSame('image/jpeg', $result['mime']);
    }

    public function testResizeToLimitShrinksOversizedRasterUnderMaxThumbBytes(): void
    {
        // A noise PNG larger than 1,000,000 bytes must come back under the limit
        $png = $this->makeNoisePng(700, 700);
        $this->assertGreaterThan(BlueskyLinkCard::MAX_THUMB_BYTES, strlen($png), 'fixture should exceed the limit');

        $result = BlueskyLinkCard::resizeToLimit($png, 'image/png', BlueskyLinkCard::MAX_THUMB_BYTES);

        $this->assertNotNull($result);
        $this->assertLessThanOrEqual(BlueskyLinkCard::MAX_THUMB_BYTES, strlen($result['bytes']));
    }

    // ========================================================================= //
    // Source-level guards (fetchMetadata / fetchThumbnail are the HTTP boundaries)
    // ========================================================================= //

    public function testFetchMetadataUsesCraftGuzzleClient(): void
    {
        $this->assertStringContainsString('Craft::createGuzzleClient()', $this->helperSource);
    }

    public function testFetchMetadataFollowsRedirectsAndSuppressesHttpErrors(): void
    {
        $this->assertStringContainsString("'allow_redirects'", $this->helperSource);
        $this->assertMatchesRegularExpression("/'http_errors'\s*=>\s*false/", $this->helperSource);
    }

    public function testFetchMetadataNeverThrows(): void
    {
        // The Guzzle boundary swallows both Guzzle and generic throwables
        $this->assertStringContainsString('GuzzleException|Throwable', $this->helperSource);
    }

    public function testFetchThumbnailResizesAgainstTheThumbnailLimit(): void
    {
        // fetchThumbnail() hands the fetched bytes to resizeToLimit() with the blob cap
        $this->assertMatchesRegularExpression(
            '/resizeToLimit\([^;]*MAX_THUMB_BYTES/s',
            $this->helperSource
        );
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
