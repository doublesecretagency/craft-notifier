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
 * Converts an HTML email body into its plain-text version.
 *
 * @since 3.2.5
 */
class EmailText
{

    /**
     * Convert an HTML email body to plain text.
     *
     * Routes the HTML through League\HTMLToMarkdown for the DOM walk, with
     * converters that write plain text instead of Markdown.
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

        // If the body has no tags, keep its line breaks exactly as typed
        if ($html === strip_tags($html)) {
            return static::_tidy(html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        }

        // Configure the converter for plain-text output
        // Empty emphasis styles drop the `**` and `_` markers
        $converter = new HtmlConverter([
            'strip_tags'      => true,
            'hard_break'      => true,
            'italic_style'    => '',
            'bold_style'      => '',
            'remove_nodes'    => 'script style head title',
            'suppress_errors' => true,
        ]);

        // Swap in the plain-text converters
        $converter->getEnvironment()->addConverter(new EmailTextConverter());

        // Walk the HTML and return the tidied text
        return static::_tidy($converter->convert($html));
    }

    // ========================================================================= //

    /**
     * Tidy the spacing and line breaks of plain text.
     *
     * @param string $text
     * @return string
     */
    private static function _tidy(string $text): string
    {
        // Normalize Windows and old Mac line endings
        $text = str_replace(["\r\n", "\r"], "\n", $text);

        // Swap non-breaking spaces for regular spaces
        $text = str_replace("\u{00A0}", ' ', $text);

        // Drop trailing spaces from each line
        $text = preg_replace('/[ \t]+\n/', "\n", $text);

        // Collapse three or more line breaks down to two
        $text = preg_replace("/\n{3,}/", "\n\n", $text);

        // Return the trimmed text
        return trim($text);
    }

}
