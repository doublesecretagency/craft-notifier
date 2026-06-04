<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\web\twig\nodes\SetDataNode;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Twig\Node\Node;

/**
 * Structural tests for the {% setData %} compiled node.
 *
 * SetDataNode's compile() emits PHP that pushes the tag's keyed values onto the
 * active Dispatch's collectedDynamicData, guarded by the active-dispatch
 * pointer. The compiled shape is what makes the tag a no-op outside a Dynamic
 * Data parse, so it is pinned here via source inspection.
 */
class SetDataNodeTest extends TestCase
{
    private ReflectionClass $reflection;
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/web/twig/nodes/SetDataNode.php';
        $this->assertTrue(file_exists($path), "SetDataNode.php should exist at: $path");
        $this->source = file_get_contents($path);
        $this->reflection = new ReflectionClass(SetDataNode::class);
    }

    public function testExtendsTwigNode(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(Node::class));
    }

    public function testGuardsOnTheActiveDispatchPointer(): void
    {
        // The compiled code reads activeDispatchForData and no-ops when it's null.
        $this->assertStringContainsString('activeDispatchForData', $this->source);
        $this->assertStringContainsString('if (null !== $__notifierDispatch) {', $this->source);
    }

    public function testMarksTheInvocationFlag(): void
    {
        // setDataInvoked records that the snippet actually called the tag.
        $this->assertStringContainsString('$__notifierDispatch->setDataInvoked = true;', $this->source);
    }

    public function testMergesKeyedValuesIntoCollectedData(): void
    {
        // Iterable arguments merge key=>value into collectedDynamicData.
        $this->assertStringContainsString('is_iterable($__notifierData)', $this->source);
        $this->assertStringContainsString('$__notifierDispatch->collectedDynamicData[$__notifierKey] = $__notifierValue;', $this->source);
    }
}
