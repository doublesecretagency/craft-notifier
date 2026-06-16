<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Source-level tests for the UID-based credential lookup in Recipients service.
 *
 * Confirms each of ntfy / Slack / Bluesky resolves UIDs against the named-list
 * in plugin settings, warns when a UID can't be found, and feeds the row into
 * a factory that builds a Recipient.
 */
class CredentialUidLookupTest extends TestCase
{
    private string $recipientsSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/services/Recipients.php';
        $this->assertTrue(file_exists($path), "Recipients.php should exist at: $path");
        $this->recipientsSource = file_get_contents($path);
    }

    public function testNtfyTopicsResolverExists(): void
    {
        $this->assertMatchesRegularExpression(
            '/private function _ntfyTopics\s*\(/',
            $this->recipientsSource
        );
    }

    public function testSlackWebhooksResolverExists(): void
    {
        $this->assertMatchesRegularExpression(
            '/private function _slackChannels\s*\(/',
            $this->recipientsSource
        );
    }

    public function testBlueskyAccountsResolverExists(): void
    {
        $this->assertMatchesRegularExpression(
            '/private function _blueskyAccounts\s*\(/',
            $this->recipientsSource
        );
    }

    public function testSwitchDispatchesToNewResolvers(): void
    {
        $this->assertMatchesRegularExpression("/case\s+'ntfy-topics':[^\n]*_ntfyTopics/", $this->recipientsSource);
        $this->assertMatchesRegularExpression("/case\s+'slack-channels':[^\n]*_slackChannels/", $this->recipientsSource);
        $this->assertMatchesRegularExpression("/case\s+'bluesky-accounts':[^\n]*_blueskyAccounts/", $this->recipientsSource);
    }

    public function testResolverWarnsWhenUidMissingFromSettings(): void
    {
        // _resolveByUid should warn-and-continue when a configured UID is gone
        $this->assertMatchesRegularExpression(
            "/no longer exists in the plugin settings/",
            $this->recipientsSource
        );
    }

    public function testNtfyResolverPopulatesTopicProperty(): void
    {
        // The factory closure for ntfy should set `topic` on the Recipient
        $this->assertMatchesRegularExpression(
            "/'topic'\s*=>\s*\\\$row\['topic'\]/",
            $this->recipientsSource
        );
    }

    public function testSlackResolverPopulatesBotTokenAndChannelId(): void
    {
        $this->assertMatchesRegularExpression(
            "/'slackBotToken'\s*=>\s*\\\$row\['botToken'\]/",
            $this->recipientsSource
        );
        $this->assertMatchesRegularExpression(
            "/'slackChannelId'\s*=>\s*\\\$row\['channelId'\]/",
            $this->recipientsSource
        );
    }

    public function testBlueskyResolverPopulatesHandleAndPassword(): void
    {
        $this->assertMatchesRegularExpression(
            "/'blueskyHandle'\s*=>\s*\\\$row\['handle'\]/",
            $this->recipientsSource
        );
        $this->assertMatchesRegularExpression(
            "/'blueskyAppPassword'\s*=>\s*\\\$row\['appPassword'\]/",
            $this->recipientsSource
        );
    }

    public function testResolverReadsUidsFromRecipientsConfig(): void
    {
        $this->assertStringContainsString("ntfyTopicUids", $this->recipientsSource);
        $this->assertStringContainsString("slackChannelUids", $this->recipientsSource);
        $this->assertStringContainsString("blueskyAccountUids", $this->recipientsSource);
    }
}
