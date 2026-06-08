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

    public function testSwitchCoversAllNineMessageTypes(): void
    {
        // The nine message types must each have a dedicated case branch.
        $this->assertMatchesRegularExpression("/case\s+'email':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'sms':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'announcement':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'flash':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'pushover':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'ntfy':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'slack':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'bluesky':/", $this->dispatchSource);
        $this->assertMatchesRegularExpression("/case\s+'mqtt':/", $this->dispatchSource);
    }

    public function testNoOrphanedChannelsBeyondTheKnownNine(): void
    {
        // The switch is on $this->notification->messageType. Any case beyond
        // the canonical nine would indicate a half-implemented channel.
        preg_match_all(
            "/case\s+'([a-z]+)':\s*\\\$this->useQueue/",
            $this->dispatchSource,
            $matches
        );

        $cases = $matches[1];
        sort($cases);

        $this->assertSame(
            ['announcement', 'bluesky', 'email', 'flash', 'mqtt', 'ntfy', 'pushover', 'slack', 'sms'],
            $cases,
            'Dispatch::configureByMessageType should switch on exactly the nine canonical channels'
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

    // ========================================================================= //
    // Queue policy per channel
    // ========================================================================= //

    public function testEmailRespectsConfigurableQueueOptIn(): void
    {
        // Emails default to queued but are user-configurable.
        $this->assertMatchesRegularExpression(
            "/case 'email':[\s\S]*?messageConfig\['emailQueue'\]/",
            $this->dispatchSource
        );
    }

    public function testSmsRespectsConfigurableQueueOptIn(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'sms':[\s\S]*?messageConfig\['smsQueue'\]/",
            $this->dispatchSource
        );
    }

    public function testAnnouncementsAreAlwaysQueued(): void
    {
        // No opt-out, announcements always queue.
        $this->assertMatchesRegularExpression(
            "/case 'announcement':\s*\\\$this->useQueue\s*=\s*true/",
            $this->dispatchSource
        );
    }

    public function testFlashesAreNeverQueued(): void
    {
        // Flash messages need the active session, so they always run inline.
        $this->assertMatchesRegularExpression(
            "/case 'flash':\s*\\\$this->useQueue\s*=\s*false/",
            $this->dispatchSource
        );
    }

    public function testPushoverRespectsConfigurableQueueOptIn(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'pushover':[\s\S]*?messageConfig\['pushoverQueue'\]/",
            $this->dispatchSource
        );
    }

    public function testNtfyRespectsConfigurableQueueOptIn(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'ntfy':[\s\S]*?messageConfig\['ntfyQueue'\]/",
            $this->dispatchSource
        );
    }

    public function testSlackRespectsConfigurableQueueOptIn(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'slack':[\s\S]*?messageConfig\['slackQueue'\]/",
            $this->dispatchSource
        );
    }

    public function testBlueskyRespectsConfigurableQueueOptIn(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'bluesky':[\s\S]*?messageConfig\['blueskyQueue'\]/",
            $this->dispatchSource
        );
    }

    public function testMqttRespectsConfigurableQueueOptIn(): void
    {
        $this->assertMatchesRegularExpression(
            "/case 'mqtt':[\s\S]*?messageConfig\['mqttQueue'\]/",
            $this->dispatchSource
        );
    }
}
