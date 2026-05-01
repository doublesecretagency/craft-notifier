<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\commerce\elements\Order;
use doublesecretagency\notifier\helpers\events\CommerceOrderEvents;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use yii\base\Event;

/**
 * Structural tests for the CommerceOrderEvents helper.
 *
 * The helper bridges Yii event listeners on the Order element to
 * Notifier's Notification dispatch pipeline. The two static methods
 * are the only entry points Notifier registers for Commerce, so a
 * silent rename or signature change here would drop every Commerce
 * notification on the floor with no other test catching it.
 */
class CommerceOrderEventsTest extends TestCase
{
    private string $helperSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/helpers/events/CommerceOrderEvents.php';
        $this->assertTrue(file_exists($path), "CommerceOrderEvents helper should exist at: $path");
        $this->helperSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(CommerceOrderEvents::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testLivesInHelpersEventsNamespace(): void
    {
        // Sibling of EntryEvents / AssetEvents / UserEvents under the same
        // namespace — keeps the on-disk shape uniform.
        $this->assertSame(
            'doublesecretagency\notifier\helpers\events',
            $this->reflection->getNamespaceName()
        );
    }

    public function testImportsOrderAndEvent(): void
    {
        // Both imports are mandatory: Order for the type guard, Event for
        // the parameter signature.
        $this->assertStringContainsString('use ' . Order::class, $this->helperSource);
        $this->assertStringContainsString('use ' . Event::class, $this->helperSource);
    }

    // ========================================================================= //
    // Public method surface
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function commerceMethodProvider(): array
    {
        return [
            ['afterCompleteOrder', 'after-complete-order'],
            ['afterOrderPaid',     'after-order-paid'],
        ];
    }

    /**
     * @dataProvider commerceMethodProvider
     */
    public function testMethodIsPublicStaticVoid(string $method): void
    {
        // Both helpers are static so Yii's Event::on can reference them as
        // [Class, 'method'] callables, and they return void since dispatch
        // is fire-and-forget.
        $this->assertTrue($this->reflection->hasMethod($method));
        $reflection = $this->reflection->getMethod($method);
        $this->assertTrue($reflection->isPublic());
        $this->assertTrue($reflection->isStatic());
        $this->assertSame('void', (string) $reflection->getReturnType());
    }

    /**
     * @dataProvider commerceMethodProvider
     */
    public function testMethodAcceptsSingleEventParam(string $method): void
    {
        // (Event $event) — a single typed param keeps the callable
        // compatible with Yii's listener invocation.
        $params = $this->reflection->getMethod($method)->getParameters();
        $this->assertCount(1, $params, "$method() should accept exactly one parameter");
        $this->assertSame('event', $params[0]->getName());
        $this->assertSame(Event::class, (string) $params[0]->getType());
    }

    // ========================================================================= //
    // Body shape (source-level)
    // ========================================================================= //

    /**
     * @dataProvider commerceMethodProvider
     */
    public function testMethodGuardsAgainstNonOrderSender(string $method): void
    {
        // Both methods must early-bail when the sender isn't an Order. The
        // single source contains both bodies; presence of the guard shape
        // covers each method.
        $this->assertStringContainsString(
            '!($event->sender instanceof Order)',
            $this->helperSource
        );
    }

    /**
     * @dataProvider commerceMethodProvider
     */
    public function testMethodFiltersNotificationsByCommerceEventType(string $method, string $eventValue): void
    {
        // The Notification::find() call in each body must scope by the
        // 'commerce-orders' eventType plus the per-method event value.
        $this->assertStringContainsString("'eventType' => 'commerce-orders'", $this->helperSource);
        $this->assertStringContainsString("'event' => '{$eventValue}'", $this->helperSource);
    }

    public function testBothMethodsDelegateToMessagesService(): void
    {
        // Each method ends by handing the matched notifications and the
        // event off to the messages service. Two occurrences must exist —
        // one per method.
        $this->assertSame(
            2,
            substr_count($this->helperSource, 'messages->sendAll($notifications, $event)'),
            'Both Commerce helpers must delegate to messages->sendAll(...)'
        );
    }
}
