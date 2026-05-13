<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events are triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\helpers;

/**
 * Class BlueskyFacets
 * @since 3.0.0
 *
 * Builds ATProto facet arrays for URLs and `@handle.tld` mentions found in a
 * post's text. Bluesky does not auto-link these on its own; the client posting
 * the record must compute byte offsets and emit facet entries alongside the
 * text. Hashtags are deferred to a future release.
 */
abstract class BlueskyFacets
{

    /**
     * @var string URL detection pattern. Matches http:// or https:// followed by non-whitespace.
     */
    private const URL_REGEX = '/https?:\/\/[^\s<>"\'`\)\]]+/u';

    /**
     * @var string Mention detection pattern. Matches @handle.tld plus dot-separated parts.
     */
    private const MENTION_REGEX = '/@([a-zA-Z0-9](?:[a-zA-Z0-9\-_.]*[a-zA-Z0-9])?\.[a-zA-Z]{2,})/u';

    /**
     * @var string Trailing punctuation we strip from URL captures (Markdown / sentence endings).
     */
    private const URL_TRAILING_TRIM = ".,;:!?)";

    /**
     * Build the full facets array for a given post body.
     *
     * @param string $text Rendered post body in UTF-8.
     * @param callable|null $resolveHandleToDid Optional resolver called with a handle (e.g. "example.bsky.social") returning a DID or null.
     * @return array<int,array> ATProto facet records suitable for inclusion in the post record.
     */
    public static function build(string $text, ?callable $resolveHandleToDid = null): array
    {
        // Collect URL + mention facets
        return array_merge(
            static::detectLinks($text),
            static::detectMentions($text, $resolveHandleToDid),
        );
    }

    /**
     * Detect URL facets in the text.
     *
     * @param string $text
     * @return array<int,array>
     */
    public static function detectLinks(string $text): array
    {
        // Initialize facets array
        $facets = [];

        // Run URL regex over the text
        if (!preg_match_all(static::URL_REGEX, $text, $matches, PREG_OFFSET_CAPTURE)) {
            return $facets;
        }

        // Walk each match
        foreach ($matches[0] as [$url, $charOffset]) {

            // Strip trailing punctuation that shouldn't be part of the link
            $trimmed = rtrim($url, static::URL_TRAILING_TRIM);

            // Compute UTF-8 byte offsets (preg_match offsets are byte offsets already in PHP)
            $byteStart = $charOffset;
            $byteEnd   = $charOffset + strlen($trimmed);

            // Emit facet
            $facets[] = [
                'index' => [
                    'byteStart' => $byteStart,
                    'byteEnd'   => $byteEnd,
                ],
                'features' => [
                    [
                        '$type' => 'app.bsky.richtext.facet#link',
                        'uri'   => $trimmed,
                    ],
                ],
            ];

        }

        return $facets;
    }

    /**
     * Detect mention facets in the text.
     *
     * @param string $text
     * @param callable|null $resolveHandleToDid
     * @return array<int,array>
     */
    public static function detectMentions(string $text, ?callable $resolveHandleToDid = null): array
    {
        // Initialize facets array
        $facets = [];

        // Run mention regex over the text
        if (!preg_match_all(static::MENTION_REGEX, $text, $matches, PREG_OFFSET_CAPTURE)) {
            return $facets;
        }

        // Walk each match - $matches[0] is the full @handle.tld, $matches[1] is the handle
        foreach ($matches[0] as $i => [$fullMatch, $charOffset]) {

            // Extract the bare handle (without leading @)
            $handle = $matches[1][$i][0];

            // Resolve to DID if a resolver was provided; skip silently when unresolved
            $did = ($resolveHandleToDid ? $resolveHandleToDid($handle) : null);
            if (!$did) {
                continue;
            }

            // Compute UTF-8 byte offsets including the leading @
            $byteStart = $charOffset;
            $byteEnd   = $charOffset + strlen($fullMatch);

            // Emit facet
            $facets[] = [
                'index' => [
                    'byteStart' => $byteStart,
                    'byteEnd'   => $byteEnd,
                ],
                'features' => [
                    [
                        '$type' => 'app.bsky.richtext.facet#mention',
                        'did'   => $did,
                    ],
                ],
            ];

        }

        return $facets;
    }

    /**
     * Count graphemes (user-perceived characters) in a string using the intl extension.
     *
     * Falls back to mb_strlen if intl is unavailable, which over-counts combining marks
     * and ZWJ sequences but is acceptable as a defensive fallback.
     *
     * @param string $text
     * @return int
     */
    public static function graphemeCount(string $text): int
    {
        // Prefer grapheme_strlen from intl
        if (function_exists('grapheme_strlen')) {
            $count = grapheme_strlen($text);
            // grapheme_strlen returns false on failure
            if (false !== $count) {
                return $count;
            }
        }

        // Fallback to mb_strlen (approximate)
        return mb_strlen($text);
    }

    /**
     * Truncate a string to a maximum number of graphemes, appending an ellipsis if truncated.
     *
     * @param string $text
     * @param int $maxGraphemes Maximum total grapheme count (including the ellipsis).
     * @return string
     */
    public static function truncateToGraphemes(string $text, int $maxGraphemes): string
    {
        // If already within the limit, return unchanged
        if (static::graphemeCount($text) <= $maxGraphemes) {
            return $text;
        }

        // Reserve one grapheme for the trailing ellipsis
        $keep = max(0, $maxGraphemes - 1);

        // Use grapheme_substr when available
        if (function_exists('grapheme_substr')) {
            $clipped = grapheme_substr($text, 0, $keep);
            if (false !== $clipped) {
                return $clipped.'…';
            }
        }

        // Fallback to mb_substr
        return mb_substr($text, 0, $keep).'…';
    }

}
