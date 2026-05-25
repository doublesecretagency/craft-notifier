<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\SlackMrkdwn;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit tests for the SlackMrkdwn helper, which converts HTML into
 * Slack's mrkdwn dialect for inclusion in chat.postMessage payloads.
 *
 * No Craft bootstrap. The helper is plain PHP wrapping league/html-to-markdown
 * plus a small token-rewrite pass for Slack-specific syntax (bold uses one
 * asterisk, italic uses underscores, links wrap in angle brackets, etc.).
 */
class SlackMrkdwnTest extends TestCase
{
    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testHelperHasFromHtmlMethod(): void
    {
        $reflection = new ReflectionClass(SlackMrkdwn::class);
        $this->assertTrue($reflection->hasMethod('fromHtml'));
        $method = $reflection->getMethod('fromHtml');
        $this->assertTrue($method->isPublic());
        $this->assertTrue($method->isStatic());
    }

    public function testFromHtmlAcceptsAndReturnsString(): void
    {
        $reflection = new ReflectionClass(SlackMrkdwn::class);
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
        $this->assertSame('', SlackMrkdwn::fromHtml(''));
    }

    public function testWhitespaceOnlyReturnsEmpty(): void
    {
        $this->assertSame('', SlackMrkdwn::fromHtml("   \n\t  "));
    }

    // ========================================================================= //
    // Inline formatting
    // ========================================================================= //

    public function testBoldUsesSingleAsterisk(): void
    {
        $this->assertSame('*bold*', SlackMrkdwn::fromHtml('<strong>bold</strong>'));
    }

    public function testBoldViaBTagUsesSingleAsterisk(): void
    {
        $this->assertSame('*bold*', SlackMrkdwn::fromHtml('<b>bold</b>'));
    }

    public function testItalicUsesUnderscore(): void
    {
        $this->assertSame('_italic_', SlackMrkdwn::fromHtml('<em>italic</em>'));
    }

    public function testItalicViaITagUsesUnderscore(): void
    {
        $this->assertSame('_italic_', SlackMrkdwn::fromHtml('<i>italic</i>'));
    }

    public function testInlineCodeUsesBacktick(): void
    {
        $this->assertSame('`code`', SlackMrkdwn::fromHtml('<code>code</code>'));
    }

    public function testBoldInsideItalicSurvivesIntact(): void
    {
        // `<em><strong>x</strong></em>` should produce `_*x*_`, not `**x**` or other corruption
        $result = SlackMrkdwn::fromHtml('<em><strong>x</strong></em>');
        $this->assertStringContainsString('*x*', $result);
        $this->assertStringContainsString('_', $result);
        $this->assertStringNotContainsString('**', $result);
    }

    public function testItalicInsideBoldSurvivesIntact(): void
    {
        // `<strong><em>x</em></strong>` should produce `*_x_*`
        $result = SlackMrkdwn::fromHtml('<strong><em>x</em></strong>');
        $this->assertStringContainsString('_x_', $result);
        $this->assertStringContainsString('*', $result);
        $this->assertStringNotContainsString('**', $result);
    }

    // ========================================================================= //
    // Links
    // ========================================================================= //

    public function testLinkUsesSlackAngleBracketSyntax(): void
    {
        $this->assertSame(
            '<https://example.com|Example>',
            SlackMrkdwn::fromHtml('<a href="https://example.com">Example</a>')
        );
    }

    public function testLinkInsideParagraph(): void
    {
        $result = SlackMrkdwn::fromHtml('<p>Visit <a href="https://example.com">our site</a> today.</p>');
        $this->assertStringContainsString('<https://example.com|our site>', $result);
    }

    // ========================================================================= //
    // Headings
    // ========================================================================= //

    public function testH1RendersAsBoldLine(): void
    {
        $this->assertSame('*Title*', SlackMrkdwn::fromHtml('<h1>Title</h1>'));
    }

    public function testH2RendersAsBoldLine(): void
    {
        $this->assertSame('*Subtitle*', SlackMrkdwn::fromHtml('<h2>Subtitle</h2>'));
    }

    public function testH3RendersAsBoldLine(): void
    {
        $this->assertSame('*Section*', SlackMrkdwn::fromHtml('<h3>Section</h3>'));
    }

    public function testHeadingDoesNotKeepHashCharacters(): void
    {
        $result = SlackMrkdwn::fromHtml('<h3>Section</h3>');
        $this->assertStringNotContainsString('#', $result);
    }

    // ========================================================================= //
    // Lists
    // ========================================================================= //

    public function testUnorderedListUsesBulletCharacter(): void
    {
        $result = SlackMrkdwn::fromHtml('<ul><li>one</li><li>two</li></ul>');
        $this->assertStringContainsString('• one', $result);
        $this->assertStringContainsString('• two', $result);
    }

    public function testOrderedListUsesNumbers(): void
    {
        $result = SlackMrkdwn::fromHtml('<ol><li>one</li><li>two</li></ol>');
        $this->assertStringContainsString('1. one', $result);
        $this->assertStringContainsString('2. two', $result);
    }

    public function testListWithInlineLink(): void
    {
        $result = SlackMrkdwn::fromHtml('<ul><li><a href="https://example.com">Visit</a></li></ul>');
        $this->assertStringContainsString('• <https://example.com|Visit>', $result);
    }

    // ========================================================================= //
    // Blockquotes
    // ========================================================================= //

    public function testBlockquotePrefixesEachLine(): void
    {
        $result = SlackMrkdwn::fromHtml('<blockquote><p>Quoted text.</p></blockquote>');
        $this->assertStringStartsWith('>', $result);
        $this->assertStringContainsString('Quoted text.', $result);
    }

    // ========================================================================= //
    // Code blocks
    // ========================================================================= //

    public function testCodeBlockUsesTripleBacktickFence(): void
    {
        $result = SlackMrkdwn::fromHtml('<pre><code>echo "hi";</code></pre>');
        $this->assertStringContainsString('```', $result);
        $this->assertStringContainsString('echo "hi";', $result);
    }

    // ========================================================================= //
    // Entities
    // ========================================================================= //

    public function testHtmlEntitiesAreDecoded(): void
    {
        $result = SlackMrkdwn::fromHtml('<p>A &amp; B &lt; C</p>');
        $this->assertStringContainsString('A & B < C', $result);
    }

    // ========================================================================= //
    // Stripping
    // ========================================================================= //

    public function testScriptTagIsStripped(): void
    {
        $result = SlackMrkdwn::fromHtml('<p>Hello</p><script>alert(1);</script>');
        $this->assertStringNotContainsString('alert', $result);
        $this->assertStringContainsString('Hello', $result);
    }

    public function testStyleTagIsStripped(): void
    {
        $result = SlackMrkdwn::fromHtml('<style>p { color: red; }</style><p>Hello</p>');
        $this->assertStringNotContainsString('color: red', $result);
        $this->assertStringContainsString('Hello', $result);
    }

    // ========================================================================= //
    // CommonMark backslash escapes
    // ========================================================================= //

    public function testStripsBackslashEscapeBeforeHash(): void
    {
        // `<a href="...">#16147</a>` → CommonMark `[\#16147](...)` because `#`
        // would otherwise be interpreted as a heading prefix; Slack mrkdwn has
        // no such ambiguity, so the backslash must go
        $result = SlackMrkdwn::fromHtml('<a href="https://github.com/craftcms/cms/pull/16147">#16147</a>');
        $this->assertStringContainsString('<https://github.com/craftcms/cms/pull/16147|#16147>', $result);
        $this->assertStringNotContainsString('\\#', $result);
    }

    public function testStripsBackslashEscapeBeforePunctuation(): void
    {
        // CommonMark escapes parens, brackets, dots, etc. in prose; Slack
        // shows backslashes literally so strip them all
        $result = SlackMrkdwn::fromHtml('<p>See (note 1.2) and [section 3]</p>');
        $this->assertStringNotContainsString('\\(', $result);
        $this->assertStringNotContainsString('\\)', $result);
        $this->assertStringNotContainsString('\\[', $result);
        $this->assertStringNotContainsString('\\]', $result);
        $this->assertStringNotContainsString('\\.', $result);
    }

    public function testPreservesBackslashesInsideInlineCode(): void
    {
        // PHP namespaces and similar literal backslashes inside code spans
        // must survive intact — CommonMark doesn't escape inside code, so the
        // strip pass naturally leaves them alone
        $result = SlackMrkdwn::fromHtml('<p>Pass to <code>craft\\services\\Assets::deleteFoldersByIds()</code></p>');
        $this->assertStringContainsString('`craft\\services\\Assets::deleteFoldersByIds()`', $result);
    }

    // ========================================================================= //
    // Realistic fixture
    // ========================================================================= //

    public function testChangelogFixtureFromBlitzPost(): void
    {
        // Compressed version of the user-supplied Blitz changelog screenshot
        $html = <<<HTML
<blockquote class="note warning"><p>Update notice. Read <a href="https://putyourlightson.com/articles/critical-update-for-a-blitz-blunder">this post</a> for details.</p></blockquote>
<h3>Added</h3>
<ul>
<li>Added a check for whether the cache should be refreshed after every request.</li>
</ul>
<h3>Changed</h3>
<ul>
<li>Blitz now requires Craft CMS 4.5.11 or later.</li>
</ul>
HTML;

        $result = SlackMrkdwn::fromHtml($html);

        // Slack-flavored heading
        $this->assertStringContainsString('*Added*', $result);
        $this->assertStringContainsString('*Changed*', $result);

        // Bullet character
        $this->assertStringContainsString('• Added a check', $result);
        $this->assertStringContainsString('• Blitz now requires', $result);

        // Slack-flavored link
        $this->assertStringContainsString(
            '<https://putyourlightson.com/articles/critical-update-for-a-blitz-blunder|this post>',
            $result
        );

        // No raw HTML survived
        $this->assertStringNotContainsString('<h3>', $result);
        $this->assertStringNotContainsString('<ul>', $result);
        $this->assertStringNotContainsString('<li>', $result);
        $this->assertStringNotContainsString('<a ', $result);
        $this->assertStringNotContainsString('</', $result);
    }
}
