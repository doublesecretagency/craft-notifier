<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\DiscordMarkdown;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit tests for the DiscordMarkdown helper, which converts HTML into
 * Discord's markdown dialect for inclusion in a webhook's content field.
 *
 * No Craft bootstrap. The helper is plain PHP wrapping league/html-to-markdown
 * plus a small post-pass for Discord-specific rules (bold keeps two asterisks,
 * italic uses underscores, links flatten to `text (url)`, headings clamp to
 * three hashes).
 */
class DiscordMarkdownTest extends TestCase
{
    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testHelperHasFromHtmlMethod(): void
    {
        $reflection = new ReflectionClass(DiscordMarkdown::class);
        $this->assertTrue($reflection->hasMethod('fromHtml'));
        $method = $reflection->getMethod('fromHtml');
        $this->assertTrue($method->isPublic());
        $this->assertTrue($method->isStatic());
    }

    public function testFromHtmlAcceptsAndReturnsString(): void
    {
        $reflection = new ReflectionClass(DiscordMarkdown::class);
        $method = $reflection->getMethod('fromHtml');
        $params = $method->getParameters();
        $this->assertCount(1, $params);
        $this->assertSame('html', $params[0]->getName());
        $this->assertSame('string', (string) $params[0]->getType());
        $this->assertSame('string', (string) $method->getReturnType());
    }

    // ========================================================================= //
    // Empty / whitespace handling
    // ========================================================================= //

    public function testEmptyStringReturnsEmpty(): void
    {
        $this->assertSame('', DiscordMarkdown::fromHtml(''));
    }

    public function testWhitespaceOnlyReturnsEmpty(): void
    {
        $this->assertSame('', DiscordMarkdown::fromHtml("   \n\t  "));
    }

    // ========================================================================= //
    // Inline formatting
    // ========================================================================= //

    public function testBoldKeepsDoubleAsterisk(): void
    {
        // Unlike Slack, Discord uses standard `**bold**`, so it passes through.
        $this->assertSame('**bold**', DiscordMarkdown::fromHtml('<strong>bold</strong>'));
    }

    public function testItalicUsesUnderscore(): void
    {
        $this->assertSame('_italic_', DiscordMarkdown::fromHtml('<em>italic</em>'));
    }

    public function testInlineCodeUsesBacktick(): void
    {
        $this->assertSame('`code`', DiscordMarkdown::fromHtml('<code>code</code>'));
    }

    // ========================================================================= //
    // Links
    // ========================================================================= //

    public function testLinkFlattensToTextThenUrl(): void
    {
        // Discord does not render [text](url) in message content, so the helper
        // rewrites it to a plain "text (url)" form.
        $this->assertSame(
            'Example (https://example.com)',
            DiscordMarkdown::fromHtml('<a href="https://example.com">Example</a>')
        );
    }

    public function testLinkInsideParagraph(): void
    {
        $result = DiscordMarkdown::fromHtml('<p>Visit <a href="https://example.com">our site</a> today.</p>');
        $this->assertStringContainsString('our site (https://example.com)', $result);
        $this->assertStringNotContainsString('](', $result);
    }

    // ========================================================================= //
    // Headings
    // ========================================================================= //

    public function testH1KeepsSingleHash(): void
    {
        // Discord renders `# Heading`, so headings pass through.
        $this->assertSame('# Title', DiscordMarkdown::fromHtml('<h1>Title</h1>'));
    }

    public function testH3KeepsTripleHash(): void
    {
        $this->assertSame('### Section', DiscordMarkdown::fromHtml('<h3>Section</h3>'));
    }

    public function testDeeperHeadingsClampToTripleHash(): void
    {
        // Discord supports headings only through `###`, so h4-h6 clamp down.
        $this->assertSame('### Deep', DiscordMarkdown::fromHtml('<h4>Deep</h4>'));
        $this->assertSame('### Deeper', DiscordMarkdown::fromHtml('<h6>Deeper</h6>'));
    }

    // ========================================================================= //
    // Entities
    // ========================================================================= //

    public function testHtmlEntitiesAreDecoded(): void
    {
        $result = DiscordMarkdown::fromHtml('<p>A &amp; B &lt; C</p>');
        $this->assertStringContainsString('A & B < C', $result);
    }

    // ========================================================================= //
    // Stripping
    // ========================================================================= //

    public function testScriptTagIsStripped(): void
    {
        $result = DiscordMarkdown::fromHtml('<p>Hello</p><script>alert(1);</script>');
        $this->assertStringNotContainsString('alert', $result);
        $this->assertStringContainsString('Hello', $result);
    }

    // ========================================================================= //
    // CommonMark backslash escapes
    // ========================================================================= //

    public function testStripsBackslashEscapeBeforePunctuation(): void
    {
        // CommonMark escapes parens, brackets, dots, etc. in prose; Discord
        // shows backslashes literally, so strip them all.
        $result = DiscordMarkdown::fromHtml('<p>See (note 1.2) and [section 3]</p>');
        $this->assertStringNotContainsString('\\(', $result);
        $this->assertStringNotContainsString('\\)', $result);
        $this->assertStringNotContainsString('\\[', $result);
        $this->assertStringNotContainsString('\\.', $result);
    }

    public function testPreservesBackslashesInsideInlineCode(): void
    {
        // Literal backslashes inside code spans must survive intact.
        $result = DiscordMarkdown::fromHtml('<p>Pass to <code>craft\\services\\Assets::deleteFoldersByIds()</code></p>');
        $this->assertStringContainsString('`craft\\services\\Assets::deleteFoldersByIds()`', $result);
    }
}
