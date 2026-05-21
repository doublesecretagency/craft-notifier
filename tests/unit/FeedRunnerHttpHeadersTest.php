<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Source-level tests for the FeedRunner's outgoing HTTP headers.
 *
 * We never rely on Guzzle defaults for the Accept header because some
 * servers content-negotiate across XML and JSON feed variants. We also
 * send a recognizable User-Agent so feed operators can identify our
 * traffic. Both are pinned here so a future refactor cannot silently
 * drop either.
 */
class FeedRunnerHttpHeadersTest extends TestCase
{
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/services/FeedRunner.php';
        $this->assertTrue(file_exists($path), "FeedRunner.php should exist at: $path");
        $this->source = file_get_contents($path);
    }

    public function testGuzzleClientDeclaresAnAcceptHeader(): void
    {
        // The Accept header must be present in the createGuzzleClient call.
        $this->assertMatchesRegularExpression(
            "/createGuzzleClient\([\s\S]*?'Accept'/",
            $this->source
        );
    }

    public function testAcceptHeaderListsJsonFeedFirst(): void
    {
        // JSON Feed comes before plain JSON, which comes before the XML
        // formats. Servers honoring quality-implicit ordering should prefer
        // the cheaper-to-parse format.
        $this->assertMatchesRegularExpression(
            "/application\\/feed\\+json[^']*application\\/json[^']*application\\/atom\\+xml[^']*application\\/rss\\+xml/",
            $this->source
        );
    }

    public function testGuzzleClientDeclaresAUserAgent(): void
    {
        // The User-Agent header must be present in the createGuzzleClient call.
        $this->assertMatchesRegularExpression(
            "/createGuzzleClient\([\s\S]*?'User-Agent'/",
            $this->source
        );
    }

    public function testUserAgentMentionsNotifierAndALinkBack(): void
    {
        // The User-Agent identifies the plugin and points back at the docs.
        $this->assertMatchesRegularExpression(
            "/'Notifier\\/.*plugins\\.doublesecretagency\\.com\\/notifier/",
            $this->source
        );
    }

    public function testContentTypeIsCapturedAndPassedToParseAuto(): void
    {
        // The Content-Type header is what routes XML vs JSON; the runner
        // must read it off the response and hand it to the helper.
        $this->assertStringContainsString(
            "getHeaderLine('Content-Type')",
            $this->source
        );
        $this->assertStringContainsString(
            'Feed::parseAuto(',
            $this->source
        );
    }
}
