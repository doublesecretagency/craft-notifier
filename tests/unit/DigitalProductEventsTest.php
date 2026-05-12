<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\digitalproducts\elements\Product;
use doublesecretagency\notifier\helpers\events\DigitalProductEvents;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use yii\base\Event;

/**
 * Structural tests for the DigitalProductEvents helper.
 */
class DigitalProductEventsTest extends TestCase
{
    private string $helperSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/helpers/events/DigitalProductEvents.php';
        $this->assertTrue(file_exists($path), "DigitalProductEvents helper should exist at: $path");
        $this->helperSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(DigitalProductEvents::class);
    }

    public function testLivesInHelpersEventsNamespace(): void
    {
        $this->assertSame(
            'doublesecretagency\notifier\helpers\events',
            $this->reflection->getNamespaceName()
        );
    }

    public function testImportsProductAndEvent(): void
    {
        $this->assertStringContainsString('use ' . Product::class, $this->helperSource);
        $this->assertStringContainsString('use ' . Event::class, $this->helperSource);
    }

    /**
     * @return string[][]
     */
    public static function methodProvider(): array
    {
        return [
            ['afterPropagate', 'after-propagate'],
            ['afterDelete',  'after-delete'],
            ['afterRestore', 'after-restore'],
        ];
    }

    /**
     * @dataProvider methodProvider
     */
    public function testMethodIsPublicStaticVoid(string $method): void
    {
        $this->assertTrue($this->reflection->hasMethod($method));
        $reflection = $this->reflection->getMethod($method);
        $this->assertTrue($reflection->isPublic());
        $this->assertTrue($reflection->isStatic());
        $this->assertSame('void', (string) $reflection->getReturnType());
    }

    public function testAfterSaveGuardsAgainstNonProductSender(): void
    {
        $this->assertStringContainsString(
            '!($event->sender instanceof Product)',
            $this->helperSource
        );
    }

    /**
     * @dataProvider methodProvider
     */
    public function testMethodFiltersNotificationsByCategoryAndEventValue(string $method, string $eventValue): void
    {
        $this->assertStringContainsString("'eventType' => 'digital-products-products'", $this->helperSource);
        $this->assertStringContainsString("'event' => '{$eventValue}'", $this->helperSource);
    }

    public function testAllThreeMethodsDelegateToMessagesService(): void
    {
        $this->assertSame(
            3,
            substr_count($this->helperSource, 'messages->sendAll($notifications, $event'),
            'All three Digital Product helpers must delegate to messages->sendAll(...)'
        );
    }

    // ========================================================================= //
    // beforeSave + Originals registry integration (added in v3.0.0)
    // ========================================================================= //

    public function testHasBeforeSaveHandler(): void
    {
        // The plugin captures a pre-save snapshot via beforeSave so the after-*
        // handlers and the has-changed condition operators can diff against it.
        // Without this method the has-changed operator silently degrades to
        // always-false for this element type.
        $this->assertTrue($this->reflection->hasMethod('beforeSave'));
        $m = $this->reflection->getMethod('beforeSave');
        $this->assertTrue($m->isPublic());
        $this->assertTrue($m->isStatic());
        $this->assertSame('void', (string) $m->getReturnType());
        $params = $m->getParameters();
        $this->assertCount(1, $params);
        $this->assertSame('event', $params[0]->getName());
    }

    public function testBeforeSaveCapturesViaCentralRegistry(): void
    {
        // The captured snapshot must go into the central Originals registry
        // so the polymorphic has-changed operators can find it. A local
        // $_originals static array (the pre-v3.0.0 pattern) wouldn't be
        // reachable from the operator namespace.
        $this->assertMatchesRegularExpression(
            '/Originals::capture\(\$original\)/',
            $this->helperSource
        );
    }

    public function testSaveHandlerLooksUpOriginalViaRegistry(): void
    {
        // The save handler(s) read the captured snapshot back out and pass
        // it via dispatch data as `original`, so Twig message bodies can
        // reference {{ original.* }} for change-detection rendering.
        $this->assertMatchesRegularExpression(
            "/Originals::find\(Product::class/",
            $this->helperSource
        );
    }

    // __BEFORE_SAVE_TESTS_INSERTED__

}
