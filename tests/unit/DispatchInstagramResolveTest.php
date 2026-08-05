<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Structural tests for the on-demand Instagram account resolution in Dispatch.
 *
 * Instagram dispatch needs the IG business account ID, which is normally
 * resolved and cached when the settings are saved (_resolveInstagramIgUserIds).
 * That cache can be stale or empty (e.g. the row was saved before the env
 * credentials were valid), which used to make every send bail with
 * "has no Instagram credentials" even though the Test button resolved the
 * account fine. To close that Test-passes-but-Send-fails gap, _compileInstagram
 * must resolve the IG user ID on the fly when it isn't already cached, before
 * the credential check runs.
 */
class DispatchInstagramResolveTest extends TestCase
{
    private string $dispatchSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/Dispatch.php';
        $this->assertTrue(file_exists($path), "Dispatch.php should exist at: $path");
        $this->dispatchSource = file_get_contents($path);
    }

    public function testImportsAppAndMetaGraph(): void
    {
        // The fallback parses env references and calls the Graph helper.
        $this->assertStringContainsString('use craft\helpers\App;', $this->dispatchSource);
        $this->assertStringContainsString('use doublesecretagency\notifier\helpers\MetaGraph;', $this->dispatchSource);
    }

    public function testResolvesIgUserIdOnDemandBeforeTheCredentialCheck(): void
    {
        // Inside _compileInstagram, the fallback must: check for an empty
        // instagramIgUserId, resolve via MetaGraph::resolveIgUserId(), assign
        // the resolved id back, and do all of it BEFORE the "has no Instagram
        // credentials" guard that would otherwise skip the recipient.
        $this->assertMatchesRegularExpression(
            '/function _compileInstagram\(\)[\s\S]*?'
            . '!\$recipient->instagramIgUserId[\s\S]*?'
            . 'MetaGraph::resolveIgUserId\([\s\S]*?'
            . '\$recipient->instagramIgUserId = \$account\[\x27id\x27\];[\s\S]*?'
            . 'has no Instagram credentials/',
            $this->dispatchSource
        );
    }

    public function testFallbackParsesEnvReferences(): void
    {
        // The page ID and token may be $ENV_VAR references, so the fallback
        // must parse them before hitting the Graph API (same as the Test action).
        $this->assertMatchesRegularExpression(
            '/App::parseEnv\(\$recipient->instagramPageId\)/',
            $this->dispatchSource
        );
        $this->assertMatchesRegularExpression(
            '/App::parseEnv\(\$recipient->instagramPageAccessToken\)/',
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // Media field classification + required-media handling
    // ========================================================================= //

    public function testResolveMediaTakesRequiresMediaFlag(): void
    {
        // _resolveMedia must accept the flag so a required-media channel (Instagram)
        // is handled differently from optional-media ones.
        $this->assertStringContainsString('private function _resolveMedia(string $mediaKey, bool $requiresMedia = false): array', $this->dispatchSource);
    }

    public function testInstagramResolvesAsRequiredMedia(): void
    {
        // Instagram cannot post text-only, so it resolves media as required.
        $this->assertStringContainsString("_resolveMedia('instagramMedia', true)", $this->dispatchSource);
    }

    public function testOptionalChannelWarnsWhenSetMediaNeverInvoked(): void
    {
        // For an optional-media channel, a non-empty field that forgot setMedia gets
        // a warning (the post still sends without media).
        $this->assertMatchesRegularExpression(
            '/!\$requiresMedia && \x27unset\x27 === \$this->_mediaFieldState[\s\S]{0,200}?_mediaFieldNotice = Craft::t\(/',
            $this->dispatchSource
        );
    }

    public function testMediaSkipsLogEmitsTheFieldNotice(): void
    {
        // The pending field notice is logged under each envelope alongside item skips.
        $this->assertMatchesRegularExpression(
            '/function _logMediaSkips[\s\S]*?\$this->_mediaFieldNotice[\s\S]{0,120}?log->warning\(/',
            $this->dispatchSource
        );
    }

    public function testInstagramEnvelopeCarriesMediaFieldState(): void
    {
        // _compileInstagram passes the field state to the envelope so send() can
        // explain a missing image precisely.
        $this->assertStringContainsString("'mediaFieldState' => \$mediaFieldState,", $this->dispatchSource);
    }
}
