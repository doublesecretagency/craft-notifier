<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\web\twig\tokenparsers\SetDataTokenParser;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Twig\TokenParser\AbstractTokenParser;

/**
 * Structural tests for the {% setData %} token parser.
 *
 * SetDataTokenParser registers the tag name and produces a SetDataNode. The
 * expression argument is optional: a bare {% setData %} defaults to a null
 * (empty) dataset, while {% setData {...} %} parses the supplied associative
 * array. Mirrors the Dynamic Recipients tag.
 */
class SetDataTokenParserTest extends TestCase
{
    private ReflectionClass $reflection;
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/web/twig/tokenparsers/SetDataTokenParser.php';
        $this->assertTrue(file_exists($path), "SetDataTokenParser.php should exist at: $path");
        $this->source = file_get_contents($path);
        $this->reflection = new ReflectionClass(SetDataTokenParser::class);
    }

    public function testExtendsAbstractTokenParser(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(AbstractTokenParser::class));
    }

    public function testTagNameIsSetData(): void
    {
        $parser = new SetDataTokenParser();
        $this->assertSame('setData', $parser->getTag());
    }

    public function testParseProducesASetDataNode(): void
    {
        // parse() reads the optional expression and returns the compiled node.
        $this->assertStringContainsString('parseExpression()', $this->source);
        $this->assertStringContainsString('new SetDataNode(', $this->source);
        $this->assertStringContainsString('BLOCK_END_TYPE', $this->source);
    }

    public function testBareTagDefaultsToAnEmptyDataset(): void
    {
        // A bare {% setData %} (no argument) falls back to a null constant, which
        // SetDataNode treats as an empty dataset rather than throwing a parse error.
        $this->assertStringContainsString('new ConstantExpression(null', $this->source);
        // The expression is only parsed when an argument precedes the tag's end.
        $this->assertStringContainsString('if (!$stream->test(Token::BLOCK_END_TYPE)) {', $this->source);
    }
}
