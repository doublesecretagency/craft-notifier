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
 * Converts HTML to Slack mrkdwn.
 *
 * @since 3.0.0
 */
class SlackMrkdwn
{

    /**
     * Convert an HTML string to Slack's mrkdwn dialect.
     *
     * Routes the HTML through League\HTMLToMarkdown for the DOM walk, then
     * post-processes the CommonMark output to Slack's mrkdwn rules.
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

        // Configure the converter for Slack-friendly output
        // Picking `_` for italic up front means bold can stay as `**`
        // and the two never collide on a shared asterisk
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

        // Translate CommonMark conventions into Slack mrkdwn
        return static::_toSlackMrkdwn($markdown);
    }

    // ========================================================================= //

    /**
     * Translate a CommonMark string into Slack's mrkdwn dialect.
     *
     * Italic already lands as `_x_` from the converter config, so this only
     * needs to rewrite bold, headings, links, list markers, and a few
     * whitespace quirks.
     *
     * @param string $markdown
     * @return string
     */
    private static function _toSlackMrkdwn(string $markdown): string
    {
        // Rewrite bold from `**x**` to Slack's `*x*`
        $markdown = preg_replace('/\*\*(.+?)\*\*/s', '*$1*', $markdown);

        // Rewrite ATX headings as a bold line, since Slack has no headings
        $markdown = preg_replace('/^#{1,6}\s+(.+?)\s*$/m', '*$1*', $markdown);

        // Rewrite `[text](url)` links to Slack's `<url|text>` format
        $markdown = preg_replace('/\[([^\]]+)\]\(([^)\s]+)\)/', '<$2|$1>', $markdown);

        // Replace `-` and `*` list markers with a bullet character
        $markdown = preg_replace('/^([ \t]*)[-*] /m', '$1• ', $markdown);

        // Drop trailing two-space hard breaks (Slack treats `\n` as a break)
        $markdown = preg_replace('/  +\n/', "\n", $markdown);

        // Collapse three or more blank lines down to two
        $markdown = preg_replace("/\n{3,}/", "\n\n", $markdown);

        // Decode entities the converter left intact (`&amp;`, `&lt;`, etc.)
        $markdown = html_entity_decode($markdown, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // Strip CommonMark backslash escapes (Slack doesn't recognize `\` as
        // an escape character, so `\#16147` displays as literal `\#16147`)
        $markdown = preg_replace('/\\\\([!"#$%&\'()*+,\-.\/:;<=>?@\[\]^_`{|}~])/', '$1', $markdown);

        // Trim trailing whitespace
        return trim($markdown);
    }

}
