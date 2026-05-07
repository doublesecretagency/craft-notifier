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

namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Structural tests for the plugin's translation files.
 *
 * Notifier ships translations for eighteen locales under
 * src/translations/<locale>/notifier.php. These tests guard against
 * three classes of drift:
 *
 *   1. A locale file goes out of sync with the canonical key set
 *      (extra keys, missing keys, misspelled keys).
 *   2. A new Craft::t('notifier', ...) or |t('notifier') call site
 *      lands in source without anyone updating the locale files.
 *   3. A translation accidentally drops or renames a {placeholder}
 *      or breaks the [text]({url}) markdown-link structure.
 *
 * No Craft bootstrap. Each locale file is loaded directly with require,
 * and source strings are extracted via regex from src/.
 *
 * @since 3.0.0
 */
class TranslationsTest extends TestCase
{
    /**
     * @var string Absolute path to the plugin root.
     */
    private static string $pluginRoot;

    /**
     * @var string Absolute path to the translations folder.
     */
    private static string $translationsDir;

    /**
     * @var string[] List of locale codes (folder names) discovered in src/translations/.
     */
    private static array $locales = [];

    /**
     * @var array<string, array<string, string>> Loaded translations, keyed by locale.
     */
    private static array $translations = [];

    /**
     * @var string[] Source strings extracted from src/ (deduplicated).
     */
    private static array $sourceStrings = [];

    /**
     * @inheritdoc
     */
    public static function setUpBeforeClass(): void
    {
        static::$pluginRoot = dirname(__DIR__, 2);
        static::$translationsDir = static::$pluginRoot . '/src/translations';

        // Discover locales by listing the translations directory
        static::$locales = static::discoverLocales();

        // Load each locale's translation array
        foreach (static::$locales as $locale) {
            $path = static::$translationsDir . '/' . $locale . '/notifier.php';
            $loaded = require $path;
            static::$translations[$locale] = $loaded;
        }

        // Extract every translatable source string from src/
        static::$sourceStrings = static::extractSourceStrings();
    }

    /**
     * Discover locale folders under src/translations/.
     *
     * @return string[]
     */
    private static function discoverLocales(): array
    {
        $locales = [];
        foreach (scandir(static::$translationsDir) as $entry) {
            if ($entry === '.' || $entry === '..') {
                continue;
            }
            $path = static::$translationsDir . '/' . $entry;
            if (is_dir($path) && file_exists($path . '/notifier.php')) {
                $locales[] = $entry;
            }
        }
        sort($locales);
        return $locales;
    }

    /**
     * Extract every translatable source string from src/.
     *
     * Scans .php files for Craft::t('notifier', '...') / Craft::t('notifier', "...")
     * and .twig / .html files for '...'|t('notifier') / "..."|t('notifier').
     * The leading quote in each match must also close the literal, so
     * apostrophes inside values force the source to use double quotes
     * (the regex handles both forms).
     *
     * @return string[]
     */
    private static function extractSourceStrings(): array
    {
        $strings = [];
        $iter = new \RecursiveIteratorIterator(
            new \RecursiveCallbackFilterIterator(
                new \RecursiveDirectoryIterator(
                    static::$pluginRoot . '/src',
                    \RecursiveDirectoryIterator::SKIP_DOTS
                ),
                static fn($f) => $f->isDir()
                    ? !in_array($f->getFilename(), ['node_modules', 'vendor', 'dist'], true)
                    : true
            )
        );

        // PHP: Craft::t('notifier', 'msg') or Craft::t('notifier', "msg")
        $phpRe = "/Craft::t\(\s*'notifier'\s*,\s*(['\"])((?:\\\\.|(?!\\1).)*)\\1/s";

        // Twig: 'msg'|t('notifier') or "msg"|t('notifier')
        // Allow trailing , or ) so calls like |t('notifier', {param: ...}) match.
        $twigRe = "/(['\"])((?:\\\\.|(?!\\1).)*)\\1\s*\|\s*t\(\s*'notifier'\s*[,)]/s";

        foreach ($iter as $file) {
            if (!$file->isFile()) {
                continue;
            }
            $name = $file->getFilename();
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            if (!in_array($ext, ['php', 'twig', 'html'], true)) {
                continue;
            }
            $contents = file_get_contents($file->getPathname());

            $re = ($ext === 'php' ? $phpRe : $twigRe);
            if (!preg_match_all($re, $contents, $matches, PREG_SET_ORDER)) {
                continue;
            }

            foreach ($matches as $m) {
                $quote = $m[1];
                $raw = $m[2];
                // Unescape the matched literal back to its runtime value
                if ($quote === "'") {
                    $value = str_replace(['\\\'', '\\\\'], ["'", '\\'], $raw);
                } else {
                    $value = str_replace(['\\"', '\\\\'], ['"', '\\'], $raw);
                }
                $strings[$value] = true;
            }
        }
        return array_keys($strings);
    }

    /**
     * Provide every locale code as its own test row.
     *
     * @return iterable<string, array{string}>
     */
    public static function localesProvider(): iterable
    {
        $root = dirname(__DIR__, 2) . '/src/translations';
        if (!is_dir($root)) {
            return;
        }
        foreach (scandir($root) as $entry) {
            if ($entry === '.' || $entry === '..') {
                continue;
            }
            if (is_dir($root . '/' . $entry) && file_exists($root . '/' . $entry . '/notifier.php')) {
                yield $entry => [$entry];
            }
        }
    }

    // ========================================================================= //

    /**
     * Sanity check: at least one locale folder exists.
     *
     * @return void
     */
    public function testAtLeastOneLocaleIsShipped(): void
    {
        static::assertNotEmpty(
            static::$locales,
            'No locale folders found under src/translations/.'
        );
    }

    /**
     * Each locale file must return a PHP array.
     *
     * @dataProvider localesProvider
     * @param string $locale
     * @return void
     */
    public function testLocaleFileReturnsArray(string $locale): void
    {
        static::assertIsArray(
            static::$translations[$locale],
            "Locale `{$locale}` must return an array from notifier.php."
        );
    }

    /**
     * All locale files must share an identical key set.
     *
     * Picks the union of keys across every locale, then asserts each
     * locale contains every key in the union. Drift in either direction
     * (extra key in one locale, missing key in another) fails with a
     * locale-specific diff.
     *
     * @dataProvider localesProvider
     * @param string $locale
     * @return void
     */
    public function testLocaleHasCanonicalKeySet(string $locale): void
    {
        // Build the union of keys across every locale
        $union = [];
        foreach (static::$translations as $entries) {
            foreach (array_keys($entries) as $k) {
                $union[$k] = true;
            }
        }
        $union = array_keys($union);

        $localeKeys = array_keys(static::$translations[$locale]);
        $missing = array_diff($union, $localeKeys);
        $extra = array_diff($localeKeys, $union);

        static::assertSame(
            [],
            array_values($missing),
            "Locale `{$locale}` is missing " . count($missing) . " key(s)."
        );
        static::assertSame(
            [],
            array_values($extra),
            "Locale `{$locale}` has " . count($extra) . " unexpected key(s)."
        );
    }

    // ========================================================================= //

    /**
     * Every translatable source string must appear as a key in every locale.
     *
     * Catches the case where a developer adds a new Craft::t(...) call
     * without updating the locale files. Reports the missing keys per
     * locale so the fix is obvious.
     *
     * @dataProvider localesProvider
     * @param string $locale
     * @return void
     */
    public function testSourceStringsAreCoveredByLocale(string $locale): void
    {
        $localeKeys = array_keys(static::$translations[$locale]);
        $missing = array_diff(static::$sourceStrings, $localeKeys);

        static::assertSame(
            [],
            array_values($missing),
            "Locale `{$locale}` is missing translation(s) for source string(s): "
            . implode(', ', array_map(static fn($s) => '"' . $s . '"', $missing))
        );
    }

    // ========================================================================= //

    /**
     * Every {placeholder} in a source string must survive in every locale.
     *
     * Catches translations that accidentally drop, rename, or duplicate
     * a {placeholder} token. The set of tokens in each locale's value
     * must match the set of tokens in the source key exactly.
     *
     * @dataProvider localesProvider
     * @param string $locale
     * @return void
     */
    public function testPlaceholdersArePreserved(string $locale): void
    {
        $entries = static::$translations[$locale];
        $mismatches = [];

        foreach ($entries as $source => $translation) {
            preg_match_all('/\{[^}]+\}/', $source, $sourceTokens);
            preg_match_all('/\{[^}]+\}/', $translation, $translationTokens);

            $expected = $sourceTokens[0];
            $actual = $translationTokens[0];

            sort($expected);
            sort($actual);

            if ($expected !== $actual) {
                $mismatches[] = sprintf(
                    "  source: %s\n    expected tokens: [%s]\n    found tokens:    [%s]",
                    $source,
                    implode(', ', $expected),
                    implode(', ', $actual)
                );
            }
        }

        static::assertSame(
            [],
            $mismatches,
            "Locale `{$locale}` has placeholder mismatches:\n" . implode("\n", $mismatches)
        );
    }

    /**
     * Markdown-link structure [text]({placeholder}) must survive in every locale.
     *
     * Catches translations that broke the link by translating the URL
     * placeholder, dropping the parentheses, or removing the brackets.
     * For each source value containing [text]({placeholder}), the
     * translated value must contain ({placeholder}) as a substring.
     *
     * @dataProvider localesProvider
     * @param string $locale
     * @return void
     */
    public function testMarkdownLinksPreserveStructure(string $locale): void
    {
        $entries = static::$translations[$locale];
        $mismatches = [];

        foreach ($entries as $source => $translation) {
            // Find every [text]({placeholder}) pattern in source
            if (!preg_match_all('/\[[^\]]+\]\((\{[^}]+\})\)/', $source, $matches)) {
                continue;
            }
            foreach ($matches[1] as $placeholder) {
                $needle = '(' . $placeholder . ')';
                if (!str_contains($translation, $needle)) {
                    $mismatches[] = sprintf(
                        "  source: %s\n    missing link target: %s",
                        $source,
                        $needle
                    );
                }
            }
        }

        static::assertSame(
            [],
            $mismatches,
            "Locale `{$locale}` has broken markdown-link structure:\n" . implode("\n", $mismatches)
        );
    }
}
