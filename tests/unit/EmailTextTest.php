<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\EmailText;
use doublesecretagency\notifier\helpers\EmailTextConverter;
use League\HTMLToMarkdown\Converter\ConverterInterface;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Pure-unit tests for the EmailText helper, which builds the plain-text part
 * of an outbound email from its HTML body (#35).
 *
 * No Craft bootstrap. The helper wraps league/html-to-markdown with a custom
 * converter (EmailTextConverter) that writes plain text instead of Markdown.
 * Line breaks are the main thing under test, across both editor modes: Trix
 * (rich mode) writes `<div>` blocks with `<br>` line breaks, while code mode
 * holds whatever the author typed, including plain text with no tags at all.
 * Several fixtures are real bodies pulled from the sandbox database.
 */
class EmailTextTest extends TestCase
{
    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testHelperHasStaticFromHtmlMethod(): void
    {
        $method = (new ReflectionClass(EmailText::class))->getMethod('fromHtml');
        $this->assertTrue($method->isPublic());
        $this->assertTrue($method->isStatic());
        $this->assertSame('string', (string) $method->getReturnType());
    }

    public function testConverterImplementsLeagueInterface(): void
    {
        $this->assertTrue(
            (new ReflectionClass(EmailTextConverter::class))->implementsInterface(ConverterInterface::class)
        );
    }

    // ========================================================================= //
    // Empty input
    // ========================================================================= //

    public function testEmptyStringReturnsEmpty(): void
    {
        $this->assertSame('', EmailText::fromHtml(''));
    }

    public function testWhitespaceOnlyReturnsEmpty(): void
    {
        $this->assertSame('', EmailText::fromHtml("  \n\t "));
    }

    public function testImageWithoutAltReturnsEmpty(): void
    {
        // OutboundEmail skips the text part entirely when this is empty
        $this->assertSame('', EmailText::fromHtml('<p><img src="logo.png"></p>'));
    }

    // ========================================================================= //
    // Line breaks: rich mode (Trix)
    // ========================================================================= //

    public function testSingleBrIsOneLineBreak(): void
    {
        $this->assertSame("One\nTwo", EmailText::fromHtml('<div>One<br>Two</div>'));
    }

    public function testDoubleBrIsOneBlankLine(): void
    {
        // Trix makes a paragraph gap with two `<br>` tags
        $this->assertSame("Hi Jane,\n\nThanks", EmailText::fromHtml('<div>Hi Jane,<br><br>Thanks</div>'));
    }

    public function testSiblingDivsAreSeparateBlocks(): void
    {
        $this->assertSame("One\n\nTwo", EmailText::fromHtml('<div>One</div><div>Two</div>'));
    }

    public function testNestedDivsDoNotStackBlankLines(): void
    {
        $html = '<div><div>Hi Bob,</div><div><br></div><div><br></div><div>Bye</div></div>';
        $this->assertSame("Hi Bob,\n\nBye", EmailText::fromHtml($html));
    }

    public function testRealTrixBodyFromSandbox(): void
    {
        // Notification 519 in the sandbox database
        $this->assertSame('Pretty cool I guess.', EmailText::fromHtml('<div>Pretty cool I guess.</div>'));
    }

    // ========================================================================= //
    // Line breaks: code mode
    // ========================================================================= //

    public function testParagraphsAreSeparatedByOneBlankLine(): void
    {
        $this->assertSame("One\n\nTwo", EmailText::fromHtml('<p>One</p><p>Two</p>'));
    }

    public function testSourceNewlinesCollapseLikeABrowser(): void
    {
        // Newlines and indentation in HTML source are just whitespace
        $this->assertSame('One two three', EmailText::fromHtml("<p>One\n    two\n\n three</p>"));
    }

    public function testBrWithSourceNewlinesFromSandbox(): void
    {
        // Notification 553 in the sandbox database (trimmed). The blank
        // source lines after a `<br>` are whitespace, so a browser shows
        // no gap there, and neither does the text part.
        $html = "item.title: T<br>\nitem.link: L<br>\n\nfeed.url: U<br>";
        $this->assertSame("item.title: T\nitem.link: L\nfeed.url: U", EmailText::fromHtml($html));
    }

    public function testRealCodeModeBodyFromSandbox(): void
    {
        // Notification 719 in the sandbox database, with its Twig rendered
        $html = "<p><strong>Ann</strong> just registered and is waiting for approval.</p>\n\n<ul>\n"
            . "    <li>Name: Ann Lee</li>\n    <li>Email: ann@example.com</li>\n</ul>\n\n"
            . "<p><a href=\"https://example.com/admin/users/5\">Review this account</a></p>";

        $expected = "Ann just registered and is waiting for approval.\n\n"
            . "- Name: Ann Lee\n- Email: ann@example.com\n\n"
            . "Review this account (https://example.com/admin/users/5)";

        $this->assertSame($expected, EmailText::fromHtml($html));
    }

    // ========================================================================= //
    // Line breaks: plain text with no tags
    // ========================================================================= //

    public function testTagFreeBodyKeepsLineBreaksAsTyped(): void
    {
        // Notification 804 in the sandbox database, with its Twig rendered
        $text = "A form was submitted.\nForm: Contact\nEmail: a@b.c\nSuccess: 1";
        $this->assertSame($text, EmailText::fromHtml($text));
    }

    public function testTagFreeBodyNormalizesWindowsLineEndings(): void
    {
        $this->assertSame("One\nTwo", EmailText::fromHtml("One\r\nTwo"));
    }

    public function testTagFreeBodyCollapsesExtraBlankLines(): void
    {
        $this->assertSame("One\n\nTwo", EmailText::fromHtml("One\n\n\n\nTwo"));
    }

    public function testTagFreeBodyDecodesEntities(): void
    {
        $this->assertSame('Tom & Jerry', EmailText::fromHtml('Tom &amp; Jerry'));
    }

    // ========================================================================= //
    // Other blocks
    // ========================================================================= //

    public function testHeadingIsPlainLineWithoutMarkers(): void
    {
        $this->assertSame("Title\n\nBody", EmailText::fromHtml('<h1>Title</h1><p>Body</p>'));
    }

    public function testListsKeepTheirMarkers(): void
    {
        $this->assertSame("- a\n- b\n\n1. c\n2. d", EmailText::fromHtml('<ul><li>a</li><li>b</li></ul><ol><li>c</li><li>d</li></ol>'));
    }

    public function testTableRowsAreOneLineEach(): void
    {
        $html = '<table><thead><tr><th>Item</th><th>Price</th></tr></thead>'
            . '<tbody><tr><td>A</td><td>$5</td></tr><tr><td>B</td><td>$6</td></tr></tbody></table><p>After</p>';
        $this->assertSame("Item Price\nA $5\nB $6\n\nAfter", EmailText::fromHtml($html));
    }

    public function testPreformattedKeepsItsSpacing(): void
    {
        $html = "<p>Run:</p><pre><code>line one &lt;x&gt;\n  line two</code></pre><p>After</p>";
        $this->assertSame("Run:\n\nline one <x>\n  line two\n\nAfter", EmailText::fromHtml($html));
    }

    public function testFullHtmlDocumentDropsHeadAndStyles(): void
    {
        $html = '<html><head><title>Subject</title><style>p { color: red; }</style></head>'
            . '<body><p>Hello</p></body></html>';
        $this->assertSame('Hello', EmailText::fromHtml($html));
    }

    public function testScriptIsDropped(): void
    {
        $this->assertSame('Hi', EmailText::fromHtml('<p>Hi</p><script>alert(1)</script>'));
    }

    // ========================================================================= //
    // Inline formatting
    // ========================================================================= //

    public function testEmphasisMarkersAreDropped(): void
    {
        $this->assertSame('Hi Bob and Sue', EmailText::fromHtml('<p>Hi <strong>Bob</strong> and <em>Sue</em></p>'));
    }

    public function testInlineCodeHasNoBackticks(): void
    {
        $this->assertSame('Run a*b now', EmailText::fromHtml('<p>Run <code>a*b</code> now</p>'));
    }

    public function testMarkdownCharactersAreNotEscaped(): void
    {
        $this->assertSame('*shipped* 2_3 [x] a|b # tag', EmailText::fromHtml('<p>*shipped* 2_3 [x] a|b # tag</p>'));
    }

    public function testLeadingHashIsNotEscaped(): void
    {
        $this->assertSame('# 1 fan', EmailText::fromHtml('<p># 1 fan</p>'));
    }

    // ========================================================================= //
    // Entities and spaces
    // ========================================================================= //

    public function testEntitiesAreDecoded(): void
    {
        $this->assertSame("Tom & Jerry's <b>", EmailText::fromHtml('<p>Tom &amp; Jerry&#39;s &lt;b&gt;</p>'));
    }

    public function testNonBreakingSpaceBecomesRegularSpace(): void
    {
        $this->assertSame('a b', EmailText::fromHtml('<p>a&nbsp;b</p>'));
    }

    public function testNoTrailingSpacesOnAnyLine(): void
    {
        $text = EmailText::fromHtml('<div>One <br>Two&nbsp;<br>Three</div>');
        $this->assertDoesNotMatchRegularExpression('/[ \t]$/m', $text);
    }

    // ========================================================================= //
    // Links and images
    // ========================================================================= //

    public function testLinkShowsTextThenUrl(): void
    {
        $this->assertSame(
            'Track here (https://x.com/t?a=1&b=2).',
            EmailText::fromHtml('<p>Track <a href="https://x.com/t?a=1&amp;b=2">here</a>.</p>')
        );
    }

    public function testLinkWhoseTextIsTheUrlShowsOnce(): void
    {
        $this->assertSame('See https://x.y', EmailText::fromHtml('<p>See <a href="https://x.y">https://x.y</a></p>'));
    }

    public function testMailtoShowsTheAddress(): void
    {
        $this->assertSame('Email us (a@b.c)', EmailText::fromHtml('<p>Email <a href="mailto:a@b.c">us</a></p>'));
        $this->assertSame('Email a@b.c', EmailText::fromHtml('<p>Email <a href="mailto:a@b.c">a@b.c</a></p>'));
    }

    public function testAnchorLinkShowsTextOnly(): void
    {
        $this->assertSame('Back to top', EmailText::fromHtml('<p>Back to <a href="#top">top</a></p>'));
    }

    public function testLinkKeepsSurroundingSpaces(): void
    {
        $this->assertSame('a spaced (https://q) b', EmailText::fromHtml('<p>a<a href="https://q"> spaced </a>b</p>'));
    }

    public function testImageShowsAltText(): void
    {
        $this->assertSame('Logo', EmailText::fromHtml('<p><img src="logo.png" alt="Logo"></p>'));
    }

    public function testLinkedImageShowsAltAndUrl(): void
    {
        $this->assertSame('Logo (https://z)', EmailText::fromHtml('<p><a href="https://z"><img src="l.png" alt="Logo"></a></p>'));
    }

    public function testLinkedImageWithoutAltShowsUrl(): void
    {
        $this->assertSame('https://w', EmailText::fromHtml('<p><a href="https://w"><img src="l.png"></a></p>'));
    }
}
