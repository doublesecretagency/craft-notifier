<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\web\assets\MessageEditorAsset;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the MessageEditorAsset bundle.
 *
 * The bundle ships Trix (vendored from npm) plus the Notifier-authored
 * controller that swaps between Monaco (code) and Trix (rich text) on the
 * email message body. Drift in the file list or the source path breaks the
 * editor toggle silently. The bundle still loads, but the wrong files (or
 * none) get included.
 */
class MessageEditorAssetTest extends TestCase
{
    private string $assetSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/web/assets/MessageEditorAsset.php';
        $this->assertTrue(file_exists($path), "MessageEditorAsset.php should exist at: $path");
        $this->assetSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(MessageEditorAsset::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsAssetBundle(): void
    {
        // Must extend Craft's AssetBundle so registerAssetBundle() resolves it
        $this->assertTrue($this->reflection->isSubclassOf(\craft\web\AssetBundle::class));
    }

    public function testHasInitMethod(): void
    {
        $this->assertTrue($this->reflection->hasMethod('init'));
        $this->assertTrue($this->reflection->getMethod('init')->isPublic());
    }

    // ========================================================================= //
    // Source path
    // ========================================================================= //

    public function testSourcePathPointsAtSharedDistFolder(): void
    {
        // All Notifier asset bundles share the same dist folder; drift here
        // means the css/js paths below resolve relative to the wrong root.
        $this->assertStringContainsString(
            "'@doublesecretagency/notifier/web/assets/dist'",
            $this->assetSource
        );
    }

    // ========================================================================= //
    // Dependencies
    // ========================================================================= //

    public function testDependsOnCpAsset(): void
    {
        // Without CpAsset, jQuery / Garnish / Craft.t aren't on the page.
        $this->assertStringContainsString(
            'CpAsset::class',
            $this->assetSource
        );
        $this->assertStringContainsString(
            'use craft\web\assets\cp\CpAsset;',
            $this->assetSource
        );
    }

    // ========================================================================= //
    // CSS / JS file lists
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function cssFileProvider(): array
    {
        return [
            // Trix's distributed stylesheet, vendored verbatim from npm
            ['css/trix.css'],
            // Plugin overrides that fit Trix into Craft's CP visual idiom
            ['css/message-editor.css'],
        ];
    }

    /**
     * @dataProvider cssFileProvider
     */
    public function testRegistersCssFile(string $file): void
    {
        $this->assertStringContainsString("'$file'", $this->assetSource);
    }

    /**
     * @return string[][]
     */
    public static function jsFileProvider(): array
    {
        return [
            // Trix's UMD bundle, vendored verbatim from npm
            ['js/trix.umd.min.js'],
            // The toggle controller that swaps Monaco / Trix on click
            ['js/message-editor.js'],
        ];
    }

    /**
     * @dataProvider jsFileProvider
     */
    public function testRegistersJsFile(string $file): void
    {
        $this->assertStringContainsString("'$file'", $this->assetSource);
    }

    // ========================================================================= //
    // Vendored files actually exist on disk
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function vendoredFileProvider(): array
    {
        return [
            ['dist/css/trix.css'],
            ['dist/css/message-editor.css'],
            ['dist/js/trix.umd.min.js'],
            ['dist/js/message-editor.js'],
        ];
    }

    /**
     * @dataProvider vendoredFileProvider
     */
    public function testVendoredFileExists(string $relative): void
    {
        // The asset bundle lists files; if the files aren't on disk Craft 404s
        // the request and the editor silently fails to upgrade.
        $path = dirname(__DIR__, 2) . '/src/web/assets/' . $relative;
        $this->assertTrue(
            file_exists($path),
            "Vendored asset should exist at: $path"
        );
    }
}
