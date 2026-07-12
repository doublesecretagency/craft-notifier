<?php
/** @noinspection PhpComposerExtensionStubsInspection */

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

use DateTime;
use DateTimeZone;
use doublesecretagency\notifier\exceptions\FeedParseException;
use SimpleXMLElement;
use Throwable;

/**
 * Parses RSS, JSON, and Atom feeds into a normalized shape.
 *
 * @since 3.0.0
 */
abstract class Feed
{

    /**
     * Route a feed payload to the right parser, based on its content type.
     *
     * @param string $payload The raw feed body.
     * @param string $contentType The response Content-Type header, if any.
     * @return array The normalized feed, with `feed` and `items` keys.
     */
    public static function parseAuto(string $payload, string $contentType = ''): array
    {
        // If the payload looks like JSON, parse it as JSON
        if (!static::needsXmlExtensions($payload, $contentType)) {
            return static::parseJson($payload);
        }

        // Otherwise, parse the payload as XML
        return static::parse($payload);
    }

    /**
     * Check whether a feed payload will be parsed as XML.
     *
     * @param string $payload The raw feed body.
     * @param string $contentType The response Content-Type header, if any.
     * @return bool True if the payload would route to the XML parser.
     */
    public static function needsXmlExtensions(string $payload, string $contentType = ''): bool
    {
        // If the content type says JSON, no XML extensions are needed
        if (false !== stripos($contentType, 'json')) {
            return false;
        }

        // Get the first non-whitespace character
        $trimmed = ltrim($payload);

        // If the first character is "{", no XML extensions are needed
        if ('' !== $trimmed && '{' === $trimmed[0]) {
            return false;
        }

        // Otherwise, the payload will be parsed as XML
        return true;
    }

    /**
     * Parse a raw RSS 2.0 or Atom 1.0 feed string into a normalized array.
     *
     * @param string $xml The feed XML payload.
     * @return array The normalized feed, with `feed` and `items` keys.
     * @throws FeedParseException If the payload is empty, malformed, or has an unknown root element.
     */
    public static function parse(string $xml): array
    {
        // If the payload is empty, bail
        if ('' === trim($xml)) {
            throw new FeedParseException('The feed payload is empty.');
        }

        // Suppress libxml warnings during parsing
        $previous = libxml_use_internal_errors(true);

        // Try to parse the XML
        try {
            $root = new SimpleXMLElement($xml, LIBXML_NOCDATA);
        } catch (Throwable $e) {
            // If parsing fails, bail with a typed exception
            throw new FeedParseException('The feed could not be parsed as XML.', 0, $e);
        } finally {
            // Restore the previous error mode no matter how we exit
            libxml_use_internal_errors($previous);
        }

        // Get the local root element name
        $rootName = $root->getName();

        // If the root is an <rss> element, parse it as RSS 2.0
        if ('rss' === $rootName) {
            return static::_parseRss($root);
        }

        // If the root is a <feed> element, parse it as Atom 1.0
        if ('feed' === $rootName) {
            return static::_parseAtom($root);
        }

        // Otherwise, the root element is unknown
        throw new FeedParseException("Unknown feed root element: <{$rootName}>.");
    }

    /**
     * Parse a raw JSON Feed 1.0 or 1.1 payload into a normalized array.
     *
     * @param string $json The feed JSON payload.
     * @return array The normalized feed, with `feed` and `items` keys.
     * @throws FeedParseException If the payload is empty, malformed, or not a JSON object.
     */
    public static function parseJson(string $json): array
    {
        // Initialize the result shape
        $result = [
            'feed'  => ['url' => '', 'title' => '', 'link' => '', 'description' => ''],
            'items' => [],
        ];

        // If the payload is empty, bail
        if ('' === trim($json)) {
            throw new FeedParseException('The feed payload is empty.');
        }

        // Try to decode the JSON
        try {
            $decoded = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            // If decoding fails, bail with a typed exception
            throw new FeedParseException('The feed could not be parsed as JSON.', 0, $e);
        }

        // If the decoded value isn't an array, bail
        if (!is_array($decoded)) {
            throw new FeedParseException('The JSON feed payload is not an object.');
        }

        // If the decoded array is a non-empty list (JSON array, not object), bail
        if ([] !== $decoded && array_values($decoded) === $decoded) {
            throw new FeedParseException('The JSON feed payload is not an object.');
        }

        // Compose the feed-level metadata
        $result['feed'] = [
            'url'         => '',
            'title'       => trim((string) ($decoded['title'] ?? '')),
            'link'        => trim((string) ($decoded['home_page_url'] ?? '')),
            'description' => trim((string) ($decoded['description'] ?? '')),
        ];

        // Loop through every item in the feed
        foreach (($decoded['items'] ?? []) as $item) {
            // If the item isn't an array, skip it
            if (!is_array($item)) {
                continue;
            }

            // Normalize the item
            $normalized = static::_normalizeJsonItem($item);

            // If no item ID could be derived, skip it
            if ('' === $normalized['guid']) {
                continue;
            }

            // Add the item to the result
            $result['items'][] = $normalized;
        }

        // Return the parsed result
        return $result;
    }

    // ========================================================================= //

    /**
     * Parse an RSS 2.0 document.
     *
     * @param SimpleXMLElement $root The <rss> root element.
     * @return array
     */
    private static function _parseRss(SimpleXMLElement $root): array
    {
        // Locate the <channel> wrapper
        $channel = ($root->channel ?? null);

        // If no channel, bail with an empty result
        if (!$channel) {
            return [
                'feed' => [
                    'url' => '',
                    'title' => '',
                    'link' => '',
                    'description' => ''
                ],
                'items' => []
            ];
        }

        // Compose the feed-level metadata
        $feed = [
            'url'         => '',
            'title'       => trim((string) ($channel->title ?? '')),
            'link'        => trim((string) ($channel->link ?? '')),
            'description' => trim((string) ($channel->description ?? '')),
        ];

        // Merge any channel-level namespaced fields
        $feed += static::_extractNamespacedFields($channel);

        // Initialize the items array
        $items = [];

        // Loop through every <item> in the channel
        foreach ($channel->item as $item) {
            // Normalize the item
            $normalized = static::_normalizeRssItem($item);

            // If no item ID could be derived, skip it
            if ('' === $normalized['guid']) {
                continue;
            }

            // Add the item to the array
            $items[] = $normalized;
        }

        // Return the parsed feed
        return [
            'feed' => $feed,
            'items' => $items
        ];
    }

    /**
     * Normalize a single <item> element from an RSS 2.0 feed.
     *
     * @param SimpleXMLElement $item The <item> element.
     * @return array
     */
    private static function _normalizeRssItem(SimpleXMLElement $item): array
    {
        // Get the title
        $title = trim((string) ($item->title ?? ''));

        // Get the link
        $link = trim((string) ($item->link ?? ''));

        // Get the description
        $description = trim((string) ($item->description ?? ''));

        // Get the GUID
        $guid = trim((string) ($item->guid ?? ''));

        // If no GUID was set, fall back to the link
        if ('' === $guid) {
            $guid = $link;
        }

        // Initialize the publication date
        $pubDate = null;

        // Get the publication date
        $rawDate = trim((string) ($item->pubDate ?? ''));

        // If a publication date was found, try to parse it
        if ('' !== $rawDate) {
            try {
                $pubDate = new DateTime($rawDate);
                $pubDate->setTimezone(new DateTimeZone('UTC'));
            } catch (Throwable) {
                // If parsing fails, leave the publication date null
                $pubDate = null;
            }
        }

        // Get the author
        $author = trim((string) ($item->author ?? ''));

        // Initialize the categories array
        $categories = [];

        // Loop through every <category> element
        foreach ($item->category as $category) {
            // Get the category value
            $value = trim((string) $category);

            // If the category isn't empty, add it
            if ('' !== $value) {
                $categories[] = $value;
            }
        }

        // Compose the normalized item
        $normalized = [
            'title'       => $title,
            'link'        => $link,
            'guid'        => $guid,
            'pubDate'     => $pubDate,
            'description' => $description,
            'author'      => ('' !== $author ? $author : null),
            'categories'  => $categories,
            'enclosure'   => static::_rssEnclosure($item),
        ];

        // Merge any namespaced fields (iTunes, podcast, dc, media, etc.) and return
        return $normalized + static::_extractNamespacedFields($item);
    }

    /**
     * Parse an Atom 1.0 document.
     *
     * @param SimpleXMLElement $root The <feed> root element.
     * @return array
     */
    private static function _parseAtom(SimpleXMLElement $root): array
    {
        // Compose the feed-level metadata
        $feed = [
            'url'         => '',
            'title'       => trim((string) ($root->title ?? '')),
            'link'        => static::_atomLink($root),
            'description' => trim((string) ($root->subtitle ?? '')),
        ];

        // Merge any feed-level namespaced fields
        $feed += static::_extractNamespacedFields($root);

        // Initialize the items array
        $items = [];

        // Loop through every <entry> in the feed
        foreach ($root->entry as $entry) {
            // Normalize the entry
            $normalized = static::_normalizeAtomEntry($entry);

            // If no item ID could be derived, skip it
            if ('' === $normalized['guid']) {
                continue;
            }

            // Add the entry to the items array
            $items[] = $normalized;
        }

        // Return the parsed feed
        return [
            'feed' => $feed,
            'items' => $items
        ];
    }

    /**
     * Normalize a single <entry> element from an Atom 1.0 feed.
     *
     * @param SimpleXMLElement $entry The <entry> element.
     * @return array
     */
    private static function _normalizeAtomEntry(SimpleXMLElement $entry): array
    {
        // Get the title
        $title = trim((string) ($entry->title ?? ''));

        // Get the link
        $link = static::_atomLink($entry);

        // Get the <id>, which is Atom's main item identifier
        $guid = trim((string) ($entry->id ?? ''));

        // If no <id> was set, fall back to the link
        if ('' === $guid) {
            $guid = $link;
        }

        // Get the <summary>
        $description = trim((string) ($entry->summary ?? ''));

        // If no <summary> was set, fall back to <content>
        if ('' === $description) {
            $description = trim((string) ($entry->content ?? ''));
        }

        // Initialize the publication date
        $pubDate = null;

        // Try to read a publication date from <published>, then <updated>
        foreach (['published', 'updated'] as $tag) {
            // Get the tag value
            $raw = trim((string) ($entry->{$tag} ?? ''));

            // If the tag is empty, try the next one
            if ('' === $raw) {
                continue;
            }

            // Try to parse the value
            try {
                $pubDate = new DateTime($raw);
                $pubDate->setTimezone(new DateTimeZone('UTC'));
                break;
            } catch (Throwable) {
                // If parsing fails, try the next tag
            }
        }

        // Initialize the author
        $author = null;

        // If an <author><name> is present, read it
        if (isset($entry->author->name)) {
            $value = trim((string) $entry->author->name);
            $author = ('' !== $value ? $value : null);
        }

        // Initialize the categories array
        $categories = [];

        // Loop through every <category> element
        foreach ($entry->category as $category) {
            // Get the term attribute
            $term = trim((string) ($category['term'] ?? ''));

            // If the term isn't empty, add it
            if ('' !== $term) {
                $categories[] = $term;
            }
        }

        // Compose the normalized entry
        $normalized = [
            'title'       => $title,
            'link'        => $link,
            'guid'        => $guid,
            'pubDate'     => $pubDate,
            'description' => $description,
            'author'      => $author,
            'categories'  => $categories,
            'enclosure'   => static::_atomEnclosure($entry),
        ];

        // Merge any namespaced fields (iTunes, podcast, dc, media, etc.) and return
        return $normalized + static::_extractNamespacedFields($entry);
    }

    /**
     * Extract a single href from an Atom <link> set.
     *
     * @param SimpleXMLElement $node The wrapping element (<feed> or <entry>).
     * @return string The resolved href, or empty string when none is present.
     */
    private static function _atomLink(SimpleXMLElement $node): string
    {
        // Initialize the fallback link
        $fallback = '';

        // Loop through every <link> child
        foreach ($node->link as $link) {
            // Get the href and rel attributes
            $href = trim((string) ($link['href'] ?? ''));
            $rel  = trim((string) ($link['rel']  ?? ''));

            // If this is the "alternate" link, return it immediately
            if ('alternate' === $rel) {
                return $href;
            }

            // If no rel was set and no fallback exists yet, remember this href as the fallback
            if ('' === $rel && '' === $fallback) {
                $fallback = $href;
            }
        }

        // Return the fallback
        return $fallback;
    }

    /**
     * Extract the first <enclosure> from an RSS item.
     *
     * @param SimpleXMLElement $item The <item> element.
     * @return array|null The enclosure, or null when none is present.
     */
    private static function _rssEnclosure(SimpleXMLElement $item): ?array
    {
        // Loop through every <enclosure> child
        foreach ($item->enclosure as $enclosure) {
            // Get the URL
            $url = trim((string) ($enclosure['url'] ?? ''));

            // If no URL, skip this enclosure
            if ('' === $url) {
                continue;
            }

            // Return the normalized enclosure, where the first one wins
            return static::_normalizeEnclosure(
                $url,
                trim((string) ($enclosure['type'] ?? '')),
                trim((string) ($enclosure['length'] ?? ''))
            );
        }

        // No enclosure found
        return null;
    }

    /**
     * Extract the first <link rel="enclosure"> from an Atom entry.
     *
     * @param SimpleXMLElement $entry The <entry> element.
     * @return array|null The enclosure, or null when none is present.
     */
    private static function _atomEnclosure(SimpleXMLElement $entry): ?array
    {
        // Loop through every <link> child
        foreach ($entry->link as $link) {
            // If this isn't an enclosure link, skip
            if ('enclosure' !== trim((string) ($link['rel'] ?? ''))) {
                continue;
            }

            // Get the href
            $href = trim((string) ($link['href'] ?? ''));

            // If no href, skip this link
            if ('' === $href) {
                continue;
            }

            // Return the normalized enclosure, where the first one wins
            return static::_normalizeEnclosure(
                $href,
                trim((string) ($link['type'] ?? '')),
                trim((string) ($link['length'] ?? ''))
            );
        }

        // No enclosure found
        return null;
    }

    /**
     * Extract the first attachment from a JSON Feed item.
     *
     * @param array $item The raw item array.
     * @return array|null The enclosure, or null when none is present.
     */
    private static function _jsonEnclosure(array $item): ?array
    {
        // Loop through every attachment
        foreach (($item['attachments'] ?? []) as $attachment) {
            // If the attachment isn't an array, skip it
            if (!is_array($attachment)) {
                continue;
            }

            // Get the URL
            $url = trim((string) ($attachment['url'] ?? ''));

            // If no URL, skip this attachment
            if ('' === $url) {
                continue;
            }

            // Return the normalized enclosure, where the first one wins
            return static::_normalizeEnclosure(
                $url,
                trim((string) ($attachment['mime_type'] ?? '')),
                trim((string) ($attachment['size_in_bytes'] ?? ''))
            );
        }

        // No attachment found
        return null;
    }

    /**
     * Compose a normalized enclosure array from raw attribute strings.
     *
     * @param string $url The enclosure URL (required, already trimmed).
     * @param string $type The MIME type (may be empty).
     * @param string $length The byte size as a string (may be empty).
     * @return array The normalized enclosure (url, type, length).
     */
    private static function _normalizeEnclosure(string $url, string $type, string $length): array
    {
        // Compose the normalized enclosure
        return [
            'url'    => $url,
            'type'   => $type,
            'length' => ('' !== $length && ctype_digit($length) ? (int) $length : null),
        ];
    }

    /**
     * Extract an XML element's namespaced children into a prefix-keyed map.
     *
     * No per-namespace allowlist; new feed extensions (Podcasting 2.0,
     * Dublin Core, Media RSS, etc.) flow through without code changes.
     *
     * @param SimpleXMLElement $element The wrapping element (channel, item, feed root, or entry).
     * @return array Map of `prefix => [tagName => value, ...]`. Empty namespaces are omitted.
     */
    private static function _extractNamespacedFields(SimpleXMLElement $element): array
    {
        // Initialize the result map
        $result = [];

        // Get every namespace declared anywhere in the document
        $namespaces = $element->getDocNamespaces(true);

        // Loop through every prefix => uri pair
        foreach ($namespaces as $prefix => $uri) {
            // If it's the default (no-prefix) namespace, skip
            if ('' === $prefix) {
                continue;
            }

            // Collect every child of this element in this namespace
            $bucket = static::_collectChildren($element->children($uri), $uri);

            // If the namespace had no children on this element, skip it
            if ([] === $bucket) {
                continue;
            }

            // Add the bucket under its prefix
            $result[$prefix] = $bucket;
        }

        // Return the namespace map
        return $result;
    }

    /**
     * Collect a SimpleXMLElement child set into a tag-name-keyed array,
     * collapsing repeated tag names into a numerically-indexed list.
     *
     * @param SimpleXMLElement $children The result of `$element->children(...)`.
     * @param string $ns The namespace URI to recurse into for nested children.
     * @return array
     */
    private static function _collectChildren(SimpleXMLElement $children, string $ns): array
    {
        // Initialize the collected bucket
        $bucket = [];

        // Initialize the per-tag-name occurrence counter
        $counts = [];

        // Loop through every child element
        foreach ($children as $name => $child) {
            // Convert the child to a scalar or hash
            $value = static::_xmlNodeToValue($child, $ns);

            // If this tag name hasn't appeared yet, store the value directly
            if (!isset($counts[$name])) {
                $bucket[$name] = $value;
                $counts[$name] = 1;
                continue;
            }

            // If this is the second occurrence, promote the existing value to a list
            if (1 === $counts[$name]) {
                $bucket[$name] = [$bucket[$name], $value];
                $counts[$name] = 2;
                continue;
            }

            // Otherwise, append to the existing list
            $bucket[$name][] = $value;
            $counts[$name]++;
        }

        // Return the collected bucket
        return $bucket;
    }

    /**
     * Convert an XML node into a Twig-friendly value.
     *
     * Recursion follows the supplied namespace; cross-namespace children
     * are not exposed under the parent.
     *
     * @param SimpleXMLElement $node The XML node to convert.
     * @param string $ns The namespace URI to recurse into for nested children.
     * @return string|array Scalar text when the node is bare, or a hash with attribute / child / `_text` keys when it has attributes or same-namespace children.
     */
    private static function _xmlNodeToValue(SimpleXMLElement $node, string $ns): string|array
    {
        // Initialize the attributes
        $attributes = [];

        // Get every attribute on the node
        foreach ($node->attributes() as $key => $value) {
            $attributes[(string) $key] = trim((string) $value);
        }

        // Collect any same-namespace child elements
        $childData = static::_collectChildren($node->children($ns), $ns);

        // Get the node's trimmed text content
        $text = trim((string) $node);

        // If the node has no attributes and no children, return the text as a scalar
        if ([] === $attributes && [] === $childData) {
            return $text;
        }

        // Otherwise, build the hash representation
        $result = [];

        // Merge in every attribute
        foreach ($attributes as $key => $value) {
            $result[$key] = $value;
        }

        // Merge in every same-namespace child
        foreach ($childData as $key => $value) {
            $result[$key] = $value;
        }

        // If text content is present alongside other data, expose it under `_text`
        if ('' !== $text) {
            $result['_text'] = $text;
        }

        // Return the composed hash
        return $result;
    }

    /**
     * Normalize a single item from a JSON Feed payload.
     *
     * @param array $item The raw item array.
     * @return array
     */
    private static function _normalizeJsonItem(array $item): array
    {
        // Get the item's main identifier
        $id = trim((string) ($item['id'] ?? ''));

        // Get the title
        $title = trim((string) ($item['title'] ?? ''));

        // Get the URL
        $link = trim((string) ($item['url'] ?? ''));

        // If no URL was set, fall back to external_url
        if ('' === $link) {
            $link = trim((string) ($item['external_url'] ?? ''));
        }

        // If still no link, fall back to the id when it looks like a URL
        if ('' === $link && (str_starts_with($id, 'http://') || str_starts_with($id, 'https://'))) {
            $link = $id;
        }

        // Use the id as the GUID, or the link when no id was set
        $guid = ('' !== $id ? $id : $link);

        // Get the description
        $description = trim((string) ($item['content_html'] ?? ''));

        // If no content_html, fall back to content_text
        if ('' === $description) {
            $description = trim((string) ($item['content_text'] ?? ''));
        }

        // If still no description, fall back to summary
        if ('' === $description) {
            $description = trim((string) ($item['summary'] ?? ''));
        }

        // Initialize the publication date
        $pubDate = null;

        // Get the date_published value
        $rawDate = trim((string) ($item['date_published'] ?? ''));

        // If a publication date was found, try to parse it
        if ('' !== $rawDate) {
            try {
                $pubDate = new DateTime($rawDate);
                $pubDate->setTimezone(new DateTimeZone('UTC'));
            } catch (Throwable) {
                // If parsing fails, leave the publication date null
                $pubDate = null;
            }
        }

        // Initialize the author
        $author = null;

        // If the JSON Feed 1.1 plural authors[0].name is present, read it
        if (isset($item['authors'][0]['name'])) {
            $value = trim((string) $item['authors'][0]['name']);
            $author = ('' !== $value ? $value : null);

        // Otherwise fall back to the JSON Feed 1.0 singular author.name
        } elseif (isset($item['author']['name'])) {
            $value = trim((string) $item['author']['name']);
            $author = ('' !== $value ? $value : null);
        }

        // Initialize the categories array
        $categories = [];

        // Loop through every tag
        foreach (($item['tags'] ?? []) as $tag) {
            // Get the tag value
            $value = trim((string) $tag);

            // If the tag isn't empty, add it
            if ('' !== $value) {
                $categories[] = $value;
            }
        }

        // Return the normalized item
        return [
            'title'       => $title,
            'link'        => $link,
            'guid'        => $guid,
            'pubDate'     => $pubDate,
            'description' => $description,
            'author'      => $author,
            'categories'  => $categories,
            'enclosure'   => static::_jsonEnclosure($item),
        ];
    }

}
