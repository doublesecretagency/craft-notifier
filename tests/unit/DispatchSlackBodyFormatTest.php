<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Source-level checks that Dispatch wires the SlackMrkdwn helper into the
 * Slack compile path correctly and only when the author opted into HTML mode.
 *
 * No Craft bootstrap. Reads Dispatch.php as text and asserts the wiring
 * constraints by regex, since instantiating Dispatch would require the full
 * Notifier runtime.
 */
class DispatchSlackBodyFormatTest extends TestCase
{
    private string $dispatchSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/Dispatch.php';
        $this->assertTrue(file_exists($path), "Dispatch.php should exist at: $path");
        $this->dispatchSource = file_get_contents($path);
    }

    // ========================================================================= //
    // Import
    // ========================================================================= //

    public function testImportsSlackMrkdwnHelper(): void
    {
        $this->assertStringContainsString(
            'use doublesecretagency\notifier\helpers\SlackMrkdwn;',
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // Conversion call
    // ========================================================================= //

    public function testCallsSlackMrkdwnFromHtml(): void
    {
        $this->assertStringContainsString('SlackMrkdwn::fromHtml(', $this->dispatchSource);
    }

    public function testConversionIsGatedOnSlackBodyFormatHtml(): void
    {
        // The conversion call must sit behind a check that slackBodyFormat === 'html'
        $this->assertMatchesRegularExpression(
            "/'html'\s*===\s*\(\\\$this->notification->messageConfig\['slackBodyFormat'\]\s*\?\?\s*'markdown'\)/",
            $this->dispatchSource
        );
    }

    public function testConversionHappensAfterTwigParse(): void
    {
        // Body parse must appear before the SlackMrkdwn call so we convert the
        // rendered output, not the raw template source
        $parsePos = strpos($this->dispatchSource, "messageConfig['slackBody']");
        $convertPos = strpos($this->dispatchSource, 'SlackMrkdwn::fromHtml');
        $this->assertNotFalse($parsePos);
        $this->assertNotFalse($convertPos);
        $this->assertLessThan($convertPos, $parsePos);
    }

    public function testConversionHappensInsideTheTrySuccessBranch(): void
    {
        // The conversion sits between the four Twig parses and the parseError
        // assignment, so a Twig failure skips conversion and keeps the raw
        // template source visible in the error log
        $this->assertMatchesRegularExpression(
            '/\$username\s*=\s*trim\(\$this->_parseTwig.+?SlackMrkdwn::fromHtml.+?\$parseError\s*=\s*null/s',
            $this->dispatchSource
        );
    }
}
