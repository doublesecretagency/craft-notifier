<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\web\twig\nodes\SetRecipientsNode;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Twig\Node\Node;

/**
 * Source-level tests for the {% setRecipients %} compiled node.
 *
 * The node compiles to PHP that pushes collected recipients onto the active
 * Dispatch. Compiling it standalone needs a Twig Compiler and a populated
 * node, so the compiled shape is asserted against the source instead.
 *
 * Mirrors SetMediaNodeTest, which covers the sibling {% setMedia %} tag.
 */
class SetRecipientsNodeTest extends TestCase
{
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/web/twig/nodes/SetRecipientsNode.php';
        $this->assertTrue(file_exists($path), "SetRecipientsNode.php should exist at: $path");
        $this->source = file_get_contents($path);
    }

    public function testExtendsTwigNode(): void
    {
        $reflection = new ReflectionClass(SetRecipientsNode::class);
        $this->assertTrue($reflection->isSubclassOf(Node::class));
        $this->assertTrue($reflection->hasMethod('compile'));
    }

    public function testCompilesAgainstTheActiveRecipientsDispatch(): void
    {
        $this->assertStringContainsString('activeDispatchForRecipients', $this->source);
    }

    public function testGuardsOnANonNullDispatch(): void
    {
        $this->assertStringContainsString('if (null !== $__notifierDispatch)', $this->source);
    }

    public function testMarksTheTagInvoked(): void
    {
        $this->assertStringContainsString('$__notifierDispatch->setRecipientsInvoked = true;', $this->source);
    }

    public function testPushesOntoTheCollectedDynamicRecipients(): void
    {
        // An iterable argument pushes each item; a single value pushes directly.
        $this->assertStringContainsString('is_iterable($__notifierItems)', $this->source);
        $this->assertStringContainsString('$__notifierDispatch->collectedDynamicRecipients[] = $__notifierItems;', $this->source);
    }

    public function testTreatsASingleElementAsOneRecipientNotAsIterable(): void
    {
        // A single Craft element is iterable (it iterates its attributes), so the
        // guard must exclude ElementInterface and push the element as one recipient,
        // instead of exploding it into its attribute values.
        //
        // Regression test for the 2026-08-04 bug: {% setRecipients user %} walked the
        // User's attributes and logged one "[SKIPPED] Unrecognized recipient" per
        // attribute (the fullName string, the bool flags, the many nulls), while the
        // actual User never became a recipient and no message was ever sent.
        $this->assertStringContainsString('is_iterable($__notifierItems) && !(', $this->source);
        $this->assertStringContainsString('ElementInterface)) {', $this->source);
    }
}
