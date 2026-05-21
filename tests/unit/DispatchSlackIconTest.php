<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Source-level structural tests for the Slack message plumbing in
 * Dispatch::_compileSlack. Each Twig-templated field (icon URL, icon emoji,
 * username) is parsed alongside the body, and the resulting values plus the
 * bot token, channel ID, and link-unfurl preference flow through to
 * OutboundSlack in the details array.
 */
class DispatchSlackIconTest extends TestCase
{
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/Dispatch.php';
        $this->assertTrue(file_exists($path), "Dispatch.php should exist at: $path");
        $this->source = file_get_contents($path);
    }

    // ========================================================================= //
    // Twig-parsed fields
    // ========================================================================= //

    public function testCompileSlackReadsSlackIconFromMessageConfig(): void
    {
        $this->assertMatchesRegularExpression(
            "/_compileSlack[\s\S]*?\\\$iconUrl\s*=\s*trim\(\\\$this->_parseTwig\(\\\$config,\s*\\\$this->notification->messageConfig\['slackIcon'\]\s*\?\?\s*''\)\)/",
            $this->source
        );
    }

    public function testCompileSlackReadsSlackEmojiFromMessageConfig(): void
    {
        $this->assertMatchesRegularExpression(
            "/_compileSlack[\s\S]*?\\\$iconEmoji\s*=\s*trim\(\\\$this->_parseTwig\(\\\$config,\s*\\\$this->notification->messageConfig\['slackEmoji'\]\s*\?\?\s*''\)\)/",
            $this->source
        );
    }

    public function testCompileSlackReadsSlackUsernameFromMessageConfig(): void
    {
        $this->assertMatchesRegularExpression(
            "/_compileSlack[\s\S]*?\\\$username\s*=\s*trim\(\\\$this->_parseTwig\(\\\$config,\s*\\\$this->notification->messageConfig\['slackUsername'\]\s*\?\?\s*''\)\)/",
            $this->source
        );
    }

    public function testCompileSlackReadsUnfurlLinksFromMessageConfig(): void
    {
        // unfurlLinks is a lightswitch (boolean), not Twig-templated.
        $this->assertMatchesRegularExpression(
            "/_compileSlack[\s\S]*?\\\$unfurlLinks\s*=\s*\(bool\)\s*\(\\\$this->notification->messageConfig\['slackUnfurlLinks'\]\s*\?\?\s*true\)/",
            $this->source
        );
    }

    // ========================================================================= //
    // Details array
    // ========================================================================= //

    public function testCompileSlackPassesBotTokenAndChannelIdInDetails(): void
    {
        $this->assertMatchesRegularExpression(
            "/_compileSlack[\s\S]*?\\\$details\s*=\s*\[[\s\S]*?'botToken'\s*=>\s*\\\$recipient->slackBotToken/",
            $this->source
        );
        $this->assertMatchesRegularExpression(
            "/_compileSlack[\s\S]*?\\\$details\s*=\s*\[[\s\S]*?'channelId'\s*=>\s*\\\$recipient->slackChannelId/",
            $this->source
        );
    }

    public function testCompileSlackPassesIconUrlInDetails(): void
    {
        $this->assertMatchesRegularExpression(
            "/_compileSlack[\s\S]*?\\\$details\s*=\s*\[[\s\S]*?'iconUrl'\s*=>\s*\\\$iconUrl/",
            $this->source
        );
    }

    public function testCompileSlackPassesIconEmojiInDetails(): void
    {
        $this->assertMatchesRegularExpression(
            "/_compileSlack[\s\S]*?\\\$details\s*=\s*\[[\s\S]*?'iconEmoji'\s*=>\s*\\\$iconEmoji/",
            $this->source
        );
    }

    public function testCompileSlackPassesUsernameInDetails(): void
    {
        $this->assertMatchesRegularExpression(
            "/_compileSlack[\s\S]*?\\\$details\s*=\s*\[[\s\S]*?'username'\s*=>\s*\\\$username/",
            $this->source
        );
    }

    public function testCompileSlackPassesUnfurlLinksInDetails(): void
    {
        $this->assertMatchesRegularExpression(
            "/_compileSlack[\s\S]*?\\\$details\s*=\s*\[[\s\S]*?'unfurlLinks'\s*=>\s*\\\$unfurlLinks/",
            $this->source
        );
    }

    // ========================================================================= //
    // Envelope log
    // ========================================================================= //

    public function testCompileSlackLogsIconUrlInEnvelope(): void
    {
        $this->assertMatchesRegularExpression(
            "/_compileSlack[\s\S]*?log->envelope\([\s\S]*?'iconUrl'\s*=>\s*\\\$iconUrl/",
            $this->source
        );
    }

    public function testCompileSlackLogsChannelIdInEnvelope(): void
    {
        $this->assertMatchesRegularExpression(
            "/_compileSlack[\s\S]*?log->envelope\([\s\S]*?'channelId'\s*=>\s*\\\$recipient->slackChannelId/",
            $this->source
        );
    }

    public function testCompileSlackDoesNotLogBotToken(): void
    {
        // Pull the body of _compileSlack and assert the bot token never appears in the envelope log call.
        $matched = preg_match("/_compileSlack[\s\S]*?log->envelope\(([\s\S]*?)\]\);/", $this->source, $matches);
        $this->assertSame(1, $matched, 'Expected to find the envelope log call inside _compileSlack.');
        $this->assertStringNotContainsString('slackBotToken', $matches[1]);
        $this->assertStringNotContainsString('botToken', $matches[1]);
    }
}
