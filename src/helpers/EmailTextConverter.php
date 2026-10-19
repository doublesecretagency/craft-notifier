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

use League\HTMLToMarkdown\Converter\ConverterInterface;
use League\HTMLToMarkdown\ElementInterface;

/**
 * Writes plain text for the HTML tags that would otherwise become Markdown.
 *
 * @since 3.2.5
 */
class EmailTextConverter implements ConverterInterface
{

    /**
     * @inheritdoc
     */
    public function convert(ElementInterface $element): string
    {
        // Get the tag name
        $tag = $element->getTagName();

        // Route each tag to its plain-text form
        switch ($tag) {
            case '#text':
                return $this->_text($element);
            case 'a':
                return $this->_link($element);
            case 'img':
                return trim($element->getAttribute('alt'));
            case 'code':
                return $element->getValue();
            case 'pre':
                return "\n\n".$this->_preformatted($element)."\n\n";
            case 'thead':
            case 'tbody':
            case 'tfoot':
                return $element->getValue();
            case 'tr':
                return trim($element->getValue())."\n";
            case 'td':
            case 'th':
                return trim($element->getValue()).' ';
        }

        // Put headings and tables on their own block
        return "\n\n".trim($element->getValue())."\n\n";
    }

    /**
     * @inheritdoc
     */
    public function getSupportedTags(): array
    {
        return [
            '#text',
            'a',
            'img',
            'code',
            'pre',
            'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
            'table', 'thead', 'tbody', 'tfoot', 'tr', 'td', 'th',
        ];
    }

    // ========================================================================= //

    /**
     * Get a text node without any Markdown escaping.
     *
     * @param ElementInterface $element
     * @return string
     */
    private function _text(ElementInterface $element): string
    {
        // Collapse whitespace the way a browser does
        $text = preg_replace('~\s+~u', ' ', ltrim($element->getValue(), "\n"));

        // If more than a lone space, return the text
        if (' ' !== $text) {
            return $text;
        }

        // Get whatever follows the space
        $next = $element->getNext();

        // If nothing follows, or a block follows, drop the space
        if (!$next || $next->isBlock()) {
            return '';
        }

        // Return the space
        return $text;
    }

    /**
     * Get a link as its text followed by the URL.
     *
     * @param ElementInterface $element
     * @return string
     */
    private function _link(ElementInterface $element): string
    {
        // Get the link text and URL
        $value = $element->getValue();
        $text  = trim($value);
        $href  = trim($element->getAttribute('href'));

        // Keep any spaces around the link text
        $prefix = (ltrim($value) !== $value ? ' ' : '');
        $suffix = (rtrim($value) !== $value ? ' ' : '');

        // If no real URL, return the text alone
        if ('' === $href || str_starts_with($href, '#')) {
            return $prefix.$text.$suffix;
        }

        // If an email link, show just the address
        if (0 === stripos($href, 'mailto:')) {
            $href = substr($href, 7);
        }

        // If no text, or the text already is the URL, return the URL alone
        if ('' === $text || $text === $href) {
            return $prefix.$href.$suffix;
        }

        // Return the text with the URL beside it
        return "{$prefix}{$text} ({$href}){$suffix}";
    }

    /**
     * Get preformatted text with its spacing intact.
     *
     * @param ElementInterface $element
     * @return string
     */
    private function _preformatted(ElementInterface $element): string
    {
        // Get the raw contents, minus any tags
        $text = strip_tags($element->getChildrenAsString());

        // Decode any entities
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // Return the text without its outer line breaks
        return trim($text, "\r\n");
    }

}
