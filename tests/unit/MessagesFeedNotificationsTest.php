<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\services\Messages;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the RSS-notification listing on the Messages service.
 *
 * The RSS runner cannot reach into the DB on its own; it asks the Messages
 * service for the set of notifications it should scan. This pins the public
 * shape of that helper and the predicate it uses.
 */
class MessagesFeedNotificationsTest extends TestCase
{
    private ReflectionClass $reflection;
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/services/Messages.php';
        $this->assertTrue(file_exists($path), "Messages.php should exist at: $path");
        $this->source = file_get_contents($path);
        $this->reflection = new ReflectionClass(Messages::class);
    }

    public function testHasGetRssNotifications(): void
    {
        // The runner calls `getFeedNotifications()` once per tick.
        $this->assertTrue($this->reflection->hasMethod('getFeedNotifications'));
        $this->assertTrue($this->reflection->getMethod('getFeedNotifications')->isPublic());
    }

    public function testGetRssNotificationsReturnsArray(): void
    {
        // The runner foreach-loops the result, so an array is the contract.
        $this->assertSame('array', (string) $this->reflection->getMethod('getFeedNotifications')->getReturnType());
    }

    public function testGetRssNotificationsQueriesOnRssFeedEventType(): void
    {
        // The predicate must scope the query to the RSS Feed event type
        // exactly; an `event` predicate (used by the schedule runner) is
        // the wrong layer and would miss notifications.
        $this->assertMatchesRegularExpression(
            "/function getFeedNotifications\(\)[\s\S]*?'eventType' => 'feed'/",
            $this->source
        );
    }
}
