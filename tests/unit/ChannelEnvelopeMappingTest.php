<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Source-level tests for the channel-to-envelope mapping in Dispatch.
 *
 * Each of the four message types (email, sms, announcement, flash) must
 * map to exactly one OutboundXxx envelope class via Dispatch's
 * configureByMessageType() switch. These tests guard against a channel
 * accidentally landing in the wrong envelope or being silently dropped.
 *
 * The actual switch lives in Dispatch::configureByMessageType(); each
 * branch then calls a private compiler that instantiates the right
 * envelope class. We verify both halves below.
 */
class ChannelEnvelopeMappingTest extends TestCase
{
    private string $dispatchSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/Dispatch.php';
        $this->assertTrue(file_exists($path), "Dispatch.php should exist at: $path");
        $this->dispatchSource = file_get_contents($path);
    }

    // ========================================================================= //
    // Switch coverage
    // ========================================================================= //

    public function testSwitchCoversAllFourteenMessageTypes(): void
    {
        // The fourteen message types must each have a dedicated case branch.
        $this->assertMatchesRegularExpression("/case\s+'email':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'sms':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'announcement':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'flash':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'pushover':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'ntfy':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'slack':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'discord':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'facebook':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'instagram':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'x-twitter':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'bluesky':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'mastodon':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'mqtt':/", $this->dispatchSource);
    }

    public function testNoOrphanedChannelsBeyondTheKnownFourteen(): void
    {
        // The switch is on $this->notification->messageType. Any case beyond
        // the canonical fourteen would indicate a half-implemented channel.
        // Isolate the configureByMessageType() body so cases from other
        // switches (filterByEventType, etc.) don't leak into the match.
        preg_match(
            '/function configureByMessageType\(\)[\s\S]*?\n    }/',
            $this->dispatchSource,
            $body
        );
        preg_match_all(
            "/case\s+'([a-z-]+)':/",
            $body[0] ?? '',
            $matches
        );

        $cases = $matches[1];
        sort($cases);

        $this->assertSame(
            ['announcement', 'bluesky', 'discord', 'email', 'facebook', 'flash', 'instagram', 'mastodon', 'mqtt', 'ntfy', 'pushover', 'slack', 'sms', 'x-twitter'],
            $cases,
            'Dispatch::configureByMessageType should switch on exactly the fourteen canonical channels'
        );
    }

    // ========================================================================= //
    // Compiler → envelope wiring
    // ========================================================================= //

    public function testEmailCaseDelegatesToEmailCompiler(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'email':[\s\S]*?\\\$this->_compileEmail\(\)/",
            $this->dispatchSource
        );
    }

    public function testSmsCaseDelegatesToSmsCompiler(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'sms':[\s\S]*?\\\$this->_compileSms\(\)/",
            $this->dispatchSource
        );
    }

    public function testAnnouncementCaseDelegatesToAnnouncementCompiler(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'announcement':[\s\S]*?\\\$this->_compileAnnouncement\(\)/",
            $this->dispatchSource
        );
    }

    public function testFlashCaseDelegatesToFlashCompiler(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'flash':[\s\S]*?\\\$this->_compileFlash\(\)/",
            $this->dispatchSource
        );
    }

    public function testPushoverCaseDelegatesToPushoverCompiler(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'pushover':[\s\S]*?\\\$this->_compilePushover\(\)/",
            $this->dispatchSource
        );
    }

    public function testNtfyCaseDelegatesToNtfyCompiler(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'ntfy':[\s\S]*?\\\$this->_compileNtfy\(\)/",
            $this->dispatchSource
        );
    }

    public function testSlackCaseDelegatesToSlackCompiler(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'slack':[\s\S]*?\\\$this->_compileSlack\(\)/",
            $this->dispatchSource
        );
    }

    public function testBlueskyCaseDelegatesToBlueskyCompiler(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'bluesky':[\s\S]*?\\\$this->_compileBluesky\(\)/",
            $this->dispatchSource
        );
    }

    public function testMqttCaseDelegatesToMqttCompiler(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'mqtt':[\s\S]*?\\\$this->_compileMqtt\(\)/",
            $this->dispatchSource
        );
    }

    public function testDiscordCaseDelegatesToDiscordCompiler(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'discord':[\s\S]*?\\\$this->_compileDiscord\(\)/",
            $this->dispatchSource
        );
    }

    public function testMastodonCaseDelegatesToMastodonCompiler(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'mastodon':[\s\S]*?\\\$this->_compileMastodon\(\)/",
            $this->dispatchSource
        );
    }

    public function testFacebookCaseDelegatesToFacebookCompiler(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'facebook':[\s\S]*?\\\$this->_compileFacebook\(\)/",
            $this->dispatchSource
        );
    }

    public function testInstagramCaseDelegatesToInstagramCompiler(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'instagram':[\s\S]*?\\\$this->_compileInstagram\(\)/",
            $this->dispatchSource
        );
    }

    public function testXTwitterCaseDelegatesToXTwitterCompiler(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'x-twitter':[\s\S]*?\\\$this->_compileXTwitter\(\)/",
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // Each compiler must instantiate its envelope class
    // ========================================================================= //

    public function testEmailCompilerInstantiatesOutboundEmail(): void
    {
        // _compileEmail() must call `new OutboundEmail(...)` so the queue job
        // gets the right envelope subtype.
        $this->assertMatchesRegularExpression(
            '/_compileEmail[\s\S]*?new OutboundEmail/',
            $this->dispatchSource
        );
    }

    public function testSmsCompilerInstantiatesOutboundSms(): void
    {
        $this->assertMatchesRegularExpression(
            '/_compileSms[\s\S]*?new OutboundSms/',
            $this->dispatchSource
        );
    }

    public function testAnnouncementCompilerInstantiatesOutboundAnnouncement(): void
    {
        $this->assertMatchesRegularExpression(
            '/_compileAnnouncement[\s\S]*?new OutboundAnnouncement/',
            $this->dispatchSource
        );
    }

    public function testFlashCompilerInstantiatesOutboundFlash(): void
    {
        $this->assertMatchesRegularExpression(
            '/_compileFlash[\s\S]*?new OutboundFlash/',
            $this->dispatchSource
        );
    }

    public function testPushoverCompilerInstantiatesOutboundPushover(): void
    {
        $this->assertMatchesRegularExpression(
            '/_compilePushover[\s\S]*?new OutboundPushover/',
            $this->dispatchSource
        );
    }

    public function testNtfyCompilerInstantiatesOutboundNtfy(): void
    {
        $this->assertMatchesRegularExpression(
            '/_compileNtfy[\s\S]*?new OutboundNtfy/',
            $this->dispatchSource
        );
    }

    public function testSlackCompilerInstantiatesOutboundSlack(): void
    {
        $this->assertMatchesRegularExpression(
            '/_compileSlack[\s\S]*?new OutboundSlack/',
            $this->dispatchSource
        );
    }

    public function testBlueskyCompilerInstantiatesOutboundBluesky(): void
    {
        $this->assertMatchesRegularExpression(
            '/_compileBluesky[\s\S]*?new OutboundBluesky/',
            $this->dispatchSource
        );
    }

    public function testMqttCompilerInstantiatesOutboundMqtt(): void
    {
        $this->assertMatchesRegularExpression(
            '/_compileMqtt[\s\S]*?new OutboundMqtt/',
            $this->dispatchSource
        );
    }

    public function testDiscordCompilerInstantiatesOutboundDiscord(): void
    {
        $this->assertMatchesRegularExpression(
            '/_compileDiscord[\s\S]*?new OutboundDiscord/',
            $this->dispatchSource
        );
    }

    public function testMastodonCompilerInstantiatesOutboundMastodon(): void
    {
        $this->assertMatchesRegularExpression(
            '/_compileMastodon[\s\S]*?new OutboundMastodon/',
            $this->dispatchSource
        );
    }

    public function testFacebookCompilerInstantiatesOutboundFacebook(): void
    {
        $this->assertMatchesRegularExpression(
            '/_compileFacebook[\s\S]*?new OutboundFacebook/',
            $this->dispatchSource
        );
    }

    public function testInstagramCompilerInstantiatesOutboundInstagram(): void
    {
        $this->assertMatchesRegularExpression(
            '/_compileInstagram[\s\S]*?new OutboundInstagram/',
            $this->dispatchSource
        );
    }

    public function testXTwitterCompilerInstantiatesOutboundXTwitter(): void
    {
        $this->assertMatchesRegularExpression(
            '/_compileXTwitter[\s\S]*?new OutboundXTwitter/',
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // Queue policy per channel
    // ========================================================================= //

    public function testConfigurableChannelsShareTopLevelQueueColumn(): void
    {
        // The per-type messageConfig[<type>Queue] keys were collapsed into a
        // single top-level `queue` column, read once before the switch and
        // shared by every configurable channel.
        $this->assertMatchesRegularExpression(
            '/\$this->useQueue\s*=\s*\(bool\)\s*\$this->notification->queue/',
            $this->dispatchSource
        );
    }

    public function testNoPerTypeQueueKeysRemainInDispatch(): void
    {
        // None of the old per-channel queue keys should survive the collapse.
        foreach (['emailQueue', 'smsQueue', 'pushoverQueue', 'ntfyQueue', 'slackQueue', 'blueskyQueue', 'mqttQueue', 'discordQueue', 'mastodonQueue', 'facebookQueue', 'instagramQueue', 'xTwitterQueue'] as $key) {
            $this->assertStringNotContainsString("messageConfig['{$key}']", $this->dispatchSource);
        }
    }

    public function testAnnouncementsAreAlwaysQueued(): void
    {
        // No opt-out, announcements always queue regardless of the column.
        $this->assertMatchesRegularExpression(
            "/case 'announcement':[\s\S]*?\\\$this->useQueue\s*=\s*true/",
            $this->dispatchSource
        );
    }

    public function testFlashesAreNeverQueued(): void
    {
        // Flash messages need the active session, so they always run inline.
        $this->assertMatchesRegularExpression(
            "/case 'flash':[\s\S]*?\\\$this->useQueue\s*=\s*false/",
            $this->dispatchSource
        );
    }
}
