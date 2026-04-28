<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Model;
use doublesecretagency\notifier\models\Dispatch;
use doublesecretagency\notifier\models\Sandbox;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the Dispatch model.
 *
 * Dispatch is the per-event scratch pad: it owns the active Twig
 * sandbox, the collected dynamic recipients, the compiled envelopes,
 * and the queue/in-process decision. These tests verify its public
 * surface and the source-level guards that govern the pipeline.
 */
class DispatchModelTest extends TestCase
{
    private string $dispatchSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/Dispatch.php';
        $this->assertTrue(file_exists($path), "Dispatch.php should exist at: $path");
        $this->dispatchSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(Dispatch::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsModel(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Model::class));
    }

    // ========================================================================= //
    // Public surface
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function publicMethodProvider(): array
    {
        return [
            ['filterByEventType'],
            ['configureByMessageType'],
            ['sendEnvelopes'],
            ['parseDynamicRecipientSnippet'],
        ];
    }

    /**
     * @dataProvider publicMethodProvider
     */
    public function testPublicMethodExists(string $method): void
    {
        // The four pipeline stages Messages::send() walks through must each
        // remain publicly callable.
        $this->assertTrue($this->reflection->hasMethod($method));
        $this->assertTrue($this->reflection->getMethod($method)->isPublic());
    }

    // ========================================================================= //
    // Property defaults
    // ========================================================================= //

    public function testUseQueueDefaultsToTrue(): void
    {
        // By default Dispatch routes envelopes through the queue. The
        // four message-type branches override this for flash / announcement.
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertTrue($defaults['useQueue']);
    }

    public function testEnvelopesDefaultsToEmptyArray(): void
    {
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertSame([], $defaults['envelopes']);
    }

    public function testCollectedDynamicRecipientsDefaultsToEmptyArray(): void
    {
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertSame([], $defaults['collectedDynamicRecipients']);
    }

    public function testSetRecipientsInvokedDefaultsToFalse(): void
    {
        // The flag the {% setRecipients %} tag flips on; must default false
        // so a missing tag is detectable.
        $defaults = $this->reflection->getDefaultProperties();
        $this->assertFalse($defaults['setRecipientsInvoked']);
    }

    // ========================================================================= //
    // Pipeline branches (source-level)
    // ========================================================================= //

    public function testFilterByEventTypeHandlesAllEventTypes(): void
    {
        // The eventType switch must cover entries / users / assets — the
        // three element types Notifier supports.
        $this->assertMatchesRegularExpression(
            "/case\s+'entries'/",
            $this->dispatchSource
        );
        $this->assertMatchesRegularExpression(
            "/case\s+'users'/",
            $this->dispatchSource
        );
        $this->assertMatchesRegularExpression(
            "/case\s+'assets'/",
            $this->dispatchSource
        );
    }

    public function testConfigureByMessageTypeHandlesAllFourChannels(): void
    {
        // The four supported channels must each appear as a case.
        $this->assertMatchesRegularExpression(
            "/case\s+'email':/",
            $this->dispatchSource
        );
        $this->assertMatchesRegularExpression(
            "/case\s+'sms':/",
            $this->dispatchSource
        );
        $this->assertMatchesRegularExpression(
            "/case\s+'announcement':/",
            $this->dispatchSource
        );
        $this->assertMatchesRegularExpression(
            "/case\s+'flash':/",
            $this->dispatchSource
        );
    }

    public function testEmailRespectsEmailQueueConfig(): void
    {
        // emailQueue config defaults to true but must be overridable.
        $this->assertStringContainsString(
            "'emailQueue'",
            $this->dispatchSource
        );
    }

    public function testSmsRespectsSmsQueueConfig(): void
    {
        $this->assertStringContainsString(
            "'smsQueue'",
            $this->dispatchSource
        );
    }

    public function testAnnouncementsAlwaysQueued(): void
    {
        // Announcements have no opt-out — the configureByMessageType branch
        // must hard-set useQueue = true.
        $this->assertMatchesRegularExpression(
            "/case 'announcement':\s*\\\$this->useQueue\s*=\s*true/",
            $this->dispatchSource
        );
    }

    public function testFlashesNeverQueued(): void
    {
        // Flash messages are session-scoped; they must dispatch in-process.
        $this->assertMatchesRegularExpression(
            "/case 'flash':\s*\\\$this->useQueue\s*=\s*false/",
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // Entry-event filtering
    // ========================================================================= //

    public function testEntryFilterChecksSection(): void
    {
        // Section / entry-type / site filters are mandatory short-circuits
        // before the user's filter classes get to run.
        $this->assertStringContainsString('->sectionId', $this->dispatchSource);
    }

    public function testEntryFilterChecksEntryType(): void
    {
        $this->assertStringContainsString('->typeId', $this->dispatchSource);
    }

    public function testEntryFilterChecksSiteOnAfterSave(): void
    {
        // Site filtering only applies to AFTER_SAVE — propagation events
        // produce one save per site, and we want notifications scoped to
        // the user-selected sites.
        $this->assertMatchesRegularExpression(
            "/'after-save'\s*===\s*\\\$this->notification->event/",
            $this->dispatchSource
        );
    }

    public function testEntryFilterRunsConfiguredFilterClasses(): void
    {
        // Filter classes are invoked statically: $filterClass::check($event, $value)
        $this->assertMatchesRegularExpression(
            '/\$filterClass::check\(\$this->event,\s*\$value\)/',
            $this->dispatchSource
        );
    }

    public function testEntryFilterSkipsWhenFilterClassMissing(): void
    {
        // If a referenced filter class no longer exists (e.g. a third-party
        // plugin was uninstalled), the filter should be skipped, not fatal.
        $this->assertStringContainsString(
            'class_exists($filterClass)',
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // Sandbox configuration
    // ========================================================================= //

    public function testSandboxBypassWhenDisabled(): void
    {
        // When sandbox config sets mode === DISABLE, Twig is rendered through
        // Craft's default View, not the secure SandboxView.
        $this->assertStringContainsString('Sandbox::DISABLE', $this->dispatchSource);
    }

    public function testSandboxLoadsConfigFromConfigFile(): void
    {
        // Per-project sandbox config lives in config/notifier-sandbox.php.
        $this->assertStringContainsString("'notifier-sandbox'", $this->dispatchSource);
    }

    public function testSandboxFallsBackToBlacklistDefault(): void
    {
        // If no config is supplied, default to blacklist + ADD mode.
        $this->assertStringContainsString('Sandbox::BLACKLIST', $this->dispatchSource);
        $this->assertStringContainsString('Sandbox::ADD', $this->dispatchSource);
    }

    // ========================================================================= //
    // Queue dispatch
    // ========================================================================= //

    public function testSendEnvelopesPushesToQueue(): void
    {
        // sendEnvelopes uses craft\helpers\Queue::push to enqueue
        // SendMessage jobs.
        $this->assertStringContainsString('Queue::push(new SendMessage', $this->dispatchSource);
    }

    public function testSendEnvelopesBypassesQueueWhenInstructed(): void
    {
        // The non-queued path calls $envelope->send() directly.
        $this->assertStringContainsString('$envelope->send()', $this->dispatchSource);
    }

    // ========================================================================= //
    // Deprecated-config migration
    // ========================================================================= //

    public function testDeprecatedTwigSandboxIsLogged(): void
    {
        // The deprecated `twigSandbox` setting must be migrated AND a
        // deprecator log entry surfaced so users see the upgrade prompt.
        $this->assertStringContainsString('getDeprecator()->log', $this->dispatchSource);
    }

    public function testDeprecatedConfigKnowsAboutSandboxConstants(): void
    {
        // The migration path maps deprecated allow/disallow/override into
        // the new ADD/REMOVE/REPLACE modes — must reference each constant.
        // Imported short-form references in the source.
        $this->assertStringContainsString('Sandbox::ADD', $this->dispatchSource);
        $this->assertStringContainsString('Sandbox::REMOVE', $this->dispatchSource);
        $this->assertStringContainsString('Sandbox::REPLACE', $this->dispatchSource);
    }
}
