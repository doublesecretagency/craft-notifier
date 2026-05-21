<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Component;
use doublesecretagency\notifier\services\FeedRunner;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the RSS runner service.
 *
 * FeedRunner is the engine behind the RSS Feed event type. The console
 * command and the web endpoint each call `run()` once per tick, so its
 * public surface and summary shape are pinned here against drift.
 */
class FeedRunnerServiceTest extends TestCase
{
    private ReflectionClass $reflection;
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/services/FeedRunner.php';
        $this->assertTrue(file_exists($path), "FeedRunner.php should exist at: $path");
        $this->source = file_get_contents($path);
        $this->reflection = new ReflectionClass(FeedRunner::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsComponent(): void
    {
        // Registered as a plugin component, so it must be a Craft Component.
        $this->assertTrue($this->reflection->isSubclassOf(Component::class));
    }

    // ========================================================================= //
    // Public surface
    // ========================================================================= //

    public function testHasRun(): void
    {
        // run() is the single entry point both controllers call each tick.
        $this->assertTrue($this->reflection->hasMethod('run'));
        $this->assertTrue($this->reflection->getMethod('run')->isPublic());
    }

    public function testRunReturnsArray(): void
    {
        // The controllers merge the array summary, so the return type is part of the contract.
        $this->assertSame('array', (string) $this->reflection->getMethod('run')->getReturnType());
    }

    public function testRunInitializesEveryKeyOfTheSummaryShape(): void
    {
        // ScheduledController merges three specific keys; missing any of them
        // would crash the merge with a null+int or array_merge(null, ...) error.
        $this->assertStringContainsString("'notifications' => 0", $this->source);
        $this->assertStringContainsString("'sent' => 0", $this->source);
        $this->assertStringContainsString("'errors' => []", $this->source);
    }

    // ========================================================================= //
    // Source-level invariants
    // ========================================================================= //

    public function testPerNotificationDispatchIsTryCatchWrapped(): void
    {
        // One bad feed's exception cannot abort the whole run.
        $this->assertMatchesRegularExpression(
            "/foreach[\s\S]*?try[\s\S]*?catch\s*\(\s*Throwable[\s\S]*?summary\['errors'\]/",
            $this->source
        );
    }

    public function testGuzzleClientUsesAFiniteTimeout(): void
    {
        // No timeout means a slow feed can block the entire cron tick.
        $this->assertMatchesRegularExpression(
            "/createGuzzleClient\([\s\S]*?'timeout'/",
            $this->source
        );
    }

    public function testRunReadsRssNotificationsFromTheMessagesService(): void
    {
        // The runner does not maintain its own queue of work; the source of
        // truth is the Messages service's `getFeedNotifications()` helper.
        $this->assertStringContainsString(
            'messages->getFeedNotifications()',
            $this->source
        );
    }
}
