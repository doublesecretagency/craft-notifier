<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\helpers;

use League\HTMLToMarkdown\HtmlConverter;

/**
 * Converts HTML to Discord markdown.
 *
 * @since 3.1.0
 */
class DiscordMarkdown
{

    /**
     * Convert an HTML string to Discord's markdown dialect.
     *
     * Discord natively renders bold, italic, strike, inline/fenced code, quotes, and
     * `#`/`##`/`###` headers, so most output passes through; only links and whitespace need fixup.
     *
     * @param string $html
     * @return string
     */
    public static function fromHtml(string $html): string
    {
        // If empty input, return empty string
        if ('' === trim($html)) {
            return '';
        }

        // Configure the converter for Discord-friendly output
        // Picking `_` for italic keeps bold on `**` so they never collide
        $converter = new HtmlConverter([
            'strip_tags'      => true,
            'header_style'    => 'atx',
            'hard_break'      => true,
            'italic_style'    => '_',
            'bold_style'      => '**',
            'remove_nodes'    => 'script style',
            'use_autolinks'   => false,
            'suppress_errors' => true,
        ]);

        // Walk the HTML and emit CommonMark
        $markdown = $converter->convert($html);

        // Translate CommonMark conventions into Discord markdown
        return static::_toDiscordMarkdown($markdown);
    }

    // ========================================================================= //

    /**
     * Translate a CommonMark string into Discord's markdown dialect.
     *
     * @param string $markdown
     * @return string
     */
    private static function _toDiscordMarkdown(string $markdown): string
    {
        // Clamp headings deeper than h3 to `###`, which is Discord's deepest
        $markdown = preg_replace('/^#{4,6}(\s+)/m', '###$1', $markdown);

        // Rewrite `[text](url)` links, which Discord does not render in message content
        $markdown = preg_replace('/\[([^\]]+)\]\(([^)\s]+)\)/', '$1 ($2)', $markdown);

        // Drop trailing two-space hard breaks (Discord treats `\n` as a break)
        $markdown = preg_replace('/  +\n/', "\n", $markdown);

        // Collapse three or more blank lines down to two
        $markdown = preg_replace("/\n{3,}/", "\n\n", $markdown);

        // Decode entities the converter left intact (`&amp;`, `&lt;`, etc.)
        $markdown = html_entity_decode($markdown, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // Strip CommonMark backslash escapes (Discord shows `\#16147` literally)
        $markdown = preg_replace('/\\\\([!"#$%&\'()*+,\-.\/:;<=>?@\[\]^_`{|}~])/', '$1', $markdown);

        // Trim trailing whitespace
        return trim($markdown);
    }

}
