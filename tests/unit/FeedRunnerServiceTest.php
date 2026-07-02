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

    // ========================================================================= //
    // getRandomItem, test-send Twig context provider
    // ========================================================================= //

    public function testHasGetRandomItemMethod(): void
    {
        // Messages::sendTest depends on this method for the feed branch.
        $this->assertTrue($this->reflection->hasMethod('getRandomItem'));
        $this->assertTrue($this->reflection->getMethod('getRandomItem')->isPublic());
    }

    public function testGetRandomItemSignature(): void
    {
        // getRandomItem(Notification $notification): ?array
        $method = $this->reflection->getMethod('getRandomItem');
        $params = $method->getParameters();
        $this->assertCount(1, $params);
        $this->assertSame('notification', $params[0]->getName());
        // Nullable array return because every failure path returns null
        $returnType = $method->getReturnType();
        $this->assertNotNull($returnType);
        $this->assertSame('array', (string) $returnType->getName());
        $this->assertTrue($returnType->allowsNull());
    }

    public function testGetRandomItemReusesFetchAndParse(): void
    {
        // The fetch / parse / logging behavior must not be duplicated; the
        // test path delegates to the same private helper the live runner uses.
        $this->assertMatchesRegularExpression(
            '/getRandomItem[\s\S]*?\$this->_fetchAndParse\(/',
            $this->source
        );
    }

    public function testGetRandomItemPicksFromItemsArray(): void
    {
        // PHP's array_rand on $parsed['items'] is the chosen randomization.
        $this->assertMatchesRegularExpression(
            "/getRandomItem[\s\S]*?array_rand\(\\\$parsed\['items'\]\)/",
            $this->source
        );
    }

    public function testGetRandomItemReturnsItemAndFeedKeys(): void
    {
        // The return tuple mirrors FeedRunner::_send's payload so the test
        // Twig context matches what a real dispatch would see.
        $this->assertMatchesRegularExpression(
            "/getRandomItem[\s\S]*?'item'\s*=>[\s\S]*?'feed'\s*=>/",
            $this->source
        );
    }

    // ========================================================================= //
    // Feed failure logging
    // ========================================================================= //

    public function testFeedFailuresNestUnderScanParent(): void
    {
        // Every fetch/parse failure seeds a scan parent, so the feed error
        // never floats as an independent top-level row again.
        $this->assertStringContainsString('->feedScan($feedUrl)', $this->source);
    }

    public function testFeedFailuresLogAsWarningsNotErrors(): void
    {
        // Feed failures are transient (timeouts, upstream 5xx), so they log
        // as warnings nested under the scan parent, never as bare errors.
        $this->assertStringNotContainsString('log->error(', $this->source);
        $this->assertMatchesRegularExpression('/log->warning\([\s\S]*?\$envelopeId\)/', $this->source);
    }
}
