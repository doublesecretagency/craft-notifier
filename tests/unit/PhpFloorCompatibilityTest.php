<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Guards the plugin source against language features newer than PHP 8.0.2.
 *
 * Craft 4 supports PHP 8.0.2+, and the plugin dual-supports Craft 4 and
 * Craft 5. Any construct that requires a newer PHP than 8.0.2 fatals at
 * COMPILE time for a Craft 4 user on PHP 8.0 or 8.1. Because it's a compile
 * error (not a runtime one), it takes the whole request down before any of
 * the plugin's own guards can run, and it can't be caught in a try/catch.
 * "Staying compatible with Craft 4" implicitly means staying compatible with
 * the minimum PHP that Craft 4 relies on, so these are exactly the bugs this
 * test exists to catch.
 *
 * It caught its first one: a `const` declared inside a trait, which fatals
 * with "Traits cannot have constants" on PHP < 8.2. That's why the trait
 * constant now lives on HasChangedOperatorInterface instead.
 *
 * Each check scans every .php file under src/ via the PHP tokenizer, so the
 * keywords never match inside comments or strings (no false positives). The
 * four constructs below are the precise, tokenizer-detectable ones most
 * likely to slip in during future work; all four fatal on PHP 8.0.2:
 *
 *   - constants inside a trait      (needs 8.2)
 *   - `enum` declarations           (needs 8.1)
 *   - `readonly` properties/classes (needs 8.1)
 *   - first-class callable `f(...)` (needs 8.1)
 *
 * If a future edit reintroduces any of them, it breaks here before it can
 * fatal on a real Craft 4 install.
 */
class PhpFloorCompatibilityTest extends TestCase
{
    /**
     * @var string[] Absolute paths to every PHP file under src/.
     */
    private static array $files = [];

    public static function setUpBeforeClass(): void
    {
        $src = dirname(__DIR__, 2) . '/src';
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($src, \FilesystemIterator::SKIP_DOTS)
        );
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                static::$files[] = $file->getPathname();
            }
        }
        sort(static::$files);
    }

    public function testSourceTreeIsNotEmpty(): void
    {
        // Sanity: the scan actually found files. A zero-file scan would let
        // every other test in here pass vacuously.
        $this->assertNotEmpty(static::$files, 'No PHP files found under src/');
    }

    // ========================================================================= //
    // Constants inside a trait - fatal on PHP < 8.2
    // ========================================================================= //

    public function testNoConstantsDeclaredInsideTraits(): void
    {
        $violations = [];
        foreach (static::$files as $file) {
            $depth = 0;
            $traitDepth = null;
            $pendingTrait = false;
            foreach (token_get_all(file_get_contents($file)) as $token) {
                // Track brace depth to know when we're inside a trait body
                if ($token === '{') {
                    $depth++;
                    if ($pendingTrait) {
                        $traitDepth = $depth;
                        $pendingTrait = false;
                    }
                    continue;
                }
                if ($token === '}') {
                    if ($traitDepth !== null && $depth === $traitDepth) {
                        $traitDepth = null;
                    }
                    $depth--;
                    continue;
                }
                if (!is_array($token)) {
                    continue;
                }
                // The `trait` keyword opens a trait body at the next brace
                if ($token[0] === T_TRAIT) {
                    $pendingTrait = true;
                }
                // A const at the trait's own body level (not nested in a method
                // or an anonymous class) is a trait constant
                if ($token[0] === T_CONST && $traitDepth !== null && $depth === $traitDepth) {
                    $violations[] = static::rel($file) . ':' . $token[2];
                }
            }
        }
        $this->assertSame(
            [],
            $violations,
            "Constants declared inside a trait fatal on PHP < 8.2:\n" . implode("\n", $violations)
        );
    }

    // ========================================================================= //
    // enum / readonly / first-class callable - fatal on PHP < 8.1
    // ========================================================================= //

    public function testNoEnumDeclarations(): void
    {
        $violations = static::scan(static function (array $token): bool {
            return $token[0] === T_ENUM;
        });
        $this->assertSame(
            [],
            $violations,
            "`enum` declarations fatal on PHP < 8.1:\n" . implode("\n", $violations)
        );
    }

    public function testNoReadonlyKeyword(): void
    {
        $violations = static::scan(static function (array $token): bool {
            return $token[0] === T_READONLY;
        });
        $this->assertSame(
            [],
            $violations,
            "`readonly` properties/classes fatal on PHP < 8.1:\n" . implode("\n", $violations)
        );
    }

    public function testNoFirstClassCallableSyntax(): void
    {
        $violations = [];
        foreach (static::$files as $file) {
            $tokens = token_get_all(file_get_contents($file));
            $count = count($tokens);
            foreach ($tokens as $i => $token) {
                // First-class callable is `f(...)`: an ellipsis immediately
                // followed by a closing paren. A variadic call `f(...$args)`
                // instead has a T_VARIABLE after the ellipsis, so it's excluded.
                if (!is_array($token) || $token[0] !== T_ELLIPSIS) {
                    continue;
                }
                for ($j = $i + 1; $j < $count; $j++) {
                    $next = $tokens[$j];
                    if (is_array($next) && $next[0] === T_WHITESPACE) {
                        continue;
                    }
                    if ($next === ')') {
                        $violations[] = static::rel($file) . ':' . $token[2];
                    }
                    break;
                }
            }
        }
        $this->assertSame(
            [],
            $violations,
            "First-class callable syntax `f(...)` fatals on PHP < 8.1:\n" . implode("\n", $violations)
        );
    }

    // ========================================================================= //
    // Helpers
    // ========================================================================= //

    /**
     * Scan every source file for tokens matching a predicate.
     *
     * @param callable $matches Receives each array-shaped token, returns true to flag it.
     * @return string[] The `relative/path.php:line` of every match.
     */
    private static function scan(callable $matches): array
    {
        $violations = [];
        foreach (static::$files as $file) {
            foreach (token_get_all(file_get_contents($file)) as $token) {
                if (is_array($token) && $matches($token)) {
                    $violations[] = static::rel($file) . ':' . $token[2];
                }
            }
        }
        return $violations;
    }

    /**
     * Get a source path relative to the plugin root, for readable failures.
     *
     * @param string $file Absolute path to a source file.
     * @return string Path relative to the plugin root.
     */
    private static function rel(string $file): string
    {
        $root = dirname(__DIR__, 2) . '/';
        return str_replace($root, '', $file);
    }
}
