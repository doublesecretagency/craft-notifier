<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\web\twig\nodes\SetMediaNode;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Twig\Node\Node;

/**
 * Source-level tests for the {% setMedia %} compiled node.
 *
 * The node compiles to PHP that pushes collected items onto the active
 * Dispatch. Compiling it standalone needs a Twig Compiler and a populated
 * node, so the compiled shape is asserted against the source instead.
 */
class SetMediaNodeTest extends TestCase
{
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/web/twig/nodes/SetMediaNode.php';
        $this->assertTrue(file_exists($path), "SetMediaNode.php should exist at: $path");
        $this->source = file_get_contents($path);
    }

    public function testExtendsTwigNode(): void
    {
        $reflection = new ReflectionClass(SetMediaNode::class);
        $this->assertTrue($reflection->isSubclassOf(Node::class));
        $this->assertTrue($reflection->hasMethod('compile'));
    }

    public function testCompilesAgainstTheActiveMediaDispatch(): void
    {
        $this->assertStringContainsString('activeDispatchForMedia', $this->source);
    }

    public function testGuardsOnANonNullDispatch(): void
    {
        $this->assertStringContainsString('if (null !== $__notifierDispatch)', $this->source);
    }

    public function testMarksTheTagInvoked(): void
    {
        $this->assertStringContainsString('$__notifierDispatch->setMediaInvoked = true;', $this->source);
    }

    public function testAppendsToCollectedMedia(): void
    {
        $this->assertStringContainsString('$__notifierDispatch->collectedMedia[] = $__notifierItem;', $this->source);
    }

    public function testHandlesIterableAndScalarArguments(): void
    {
        // An iterable argument pushes each item; a scalar pushes the single value.
        $this->assertStringContainsString('is_iterable($__notifierItems)', $this->source);
        $this->assertStringContainsString('$__notifierDispatch->collectedMedia[] = $__notifierItems;', $this->source);
    }

    public function testTreatsASingleElementAsOneItemNotAsIterable(): void
    {
        // A single Craft element is iterable (it iterates its attributes), so the
        // guard must exclude ElementInterface and push the element as one item,
        // instead of exploding it into its attribute values.
        $this->assertStringContainsString('is_iterable($__notifierItems) && !(', $this->source);
        $this->assertStringContainsString('ElementInterface)) {', $this->source);
    }

    public function testOnlyEvaluatesAnArgumentWhenOneWasGiven(): void
    {
        // A bare {% setMedia %} has no items node, so the argument evaluation and
        // collection are gated on the node being present.
        $this->assertStringContainsString("if (\$this->hasNode('items')) {", $this->source);
    }

    public function testBareTagStillMarksInvokedWithoutCollecting(): void
    {
        // The else branch marks the tag invoked but pushes nothing onto collectedMedia.
        $this->assertMatchesRegularExpression(
            '/\} else \{[\s\S]{0,200}?setMediaInvoked = true;[\s\S]{0,80}?\}/',
            $this->source
        );
    }
}
