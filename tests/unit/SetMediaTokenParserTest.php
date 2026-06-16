<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\web\twig\nodes\SetMediaNode;
use doublesecretagency\notifier\web\twig\tokenparsers\SetMediaTokenParser;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Twig\TokenParser\AbstractTokenParser;

/**
 * Tests for the {% setMedia %} token parser.
 *
 * The parser registers the tag name and builds a SetMediaNode from one
 * expression argument. getTag() is callable without a Twig parser; the
 * node-construction shape is checked at the source level.
 */
class SetMediaTokenParserTest extends TestCase
{
    public function testExtendsAbstractTokenParser(): void
    {
        $reflection = new ReflectionClass(SetMediaTokenParser::class);
        $this->assertTrue($reflection->isSubclassOf(AbstractTokenParser::class));
    }

    public function testTagNameIsSetMedia(): void
    {
        $parser = new SetMediaTokenParser();
        $this->assertSame('setMedia', $parser->getTag());
    }

    public function testParseReturnsASetMediaNode(): void
    {
        // parse() builds and returns a SetMediaNode (verified at the source level,
        // since exercising parse() requires a live Twig parser/token stream).
        $source = file_get_contents(dirname(__DIR__, 2) . '/src/web/twig/tokenparsers/SetMediaTokenParser.php');
        $this->assertMatchesRegularExpression('/return\s+new\s+SetMediaNode\(/', $source);
        $this->assertTrue((new ReflectionClass(SetMediaNode::class))->isInstantiable());
    }

    public function testParseReadsOneExpressionArgument(): void
    {
        $source = file_get_contents(dirname(__DIR__, 2) . '/src/web/twig/tokenparsers/SetMediaTokenParser.php');
        $this->assertStringContainsString('parseExpression()', $source);
        $this->assertStringContainsString('Token::BLOCK_END_TYPE', $source);
    }

    public function testAllowsABareTagWithNoArgument(): void
    {
        // A bare {% setMedia %} is valid: when the next token is the block end, the
        // parser skips the expression (passing no items node) instead of throwing.
        $source = file_get_contents(dirname(__DIR__, 2) . '/src/web/twig/tokenparsers/SetMediaTokenParser.php');
        $this->assertMatchesRegularExpression(
            '/if\s*\(\s*\$stream->test\(Token::BLOCK_END_TYPE\)\s*\)\s*\{\s*\$nodes = \[\];/',
            $source
        );
    }
}
