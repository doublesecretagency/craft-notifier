<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\services\FeedRunner;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

/**
 * Pure-unit tests for the feed fetch-timeout resolution.
 *
 * A notification may set a per-feed timeout via `eventConfig['feedTimeout']`.
 * `_resolveTimeout()` turns that free-form value into a safe integer: a blank
 * or invalid value falls back to the 10-second default, and a valid value is
 * floored at 1 and capped at 60 so a slow feed can never hang a queue worker.
 * The method is pure and static, so we invoke it directly via reflection
 * without booting Craft.
 */
class FeedRunnerTimeoutTest extends TestCase
{
    private ReflectionMethod $method;

    protected function setUp(): void
    {
        // Get an accessible handle on the private static resolver
        $this->method = new ReflectionMethod(FeedRunner::class, '_resolveTimeout');
        $this->method->setAccessible(true);
    }

    /**
     * Invoke the private static resolver with a given eventConfig.
     */
    private function _resolve(array $eventConfig): int
    {
        return $this->method->invoke(null, $eventConfig);
    }

    // ========================================================================= //
    // Fallback to the default
    // ========================================================================= //

    public function testMissingKeyUsesTheDefault(): void
    {
        // No feedTimeout key at all falls back to 10
        $this->assertSame(10, $this->_resolve([]));
    }

    public function testBlankValueUsesTheDefault(): void
    {
        // An empty string (the blank form field) falls back to 10
        $this->assertSame(10, $this->_resolve(['feedTimeout' => '']));
    }

    public function testZeroUsesTheDefault(): void
    {
        // Zero is not a usable timeout, so it falls back to 10
        $this->assertSame(10, $this->_resolve(['feedTimeout' => 0]));
    }

    public function testNegativeUsesTheDefault(): void
    {
        // A negative value falls back to 10
        $this->assertSame(10, $this->_resolve(['feedTimeout' => -5]));
    }

    public function testNonNumericUsesTheDefault(): void
    {
        // A non-numeric string casts to 0, so it falls back to 10
        $this->assertSame(10, $this->_resolve(['feedTimeout' => 'abc']));
    }

    // ========================================================================= //
    // Valid values pass through
    // ========================================================================= //

    public function testValidValuePassesThrough(): void
    {
        // A sensible value is used as-is
        $this->assertSame(25, $this->_resolve(['feedTimeout' => 25]));
    }

    public function testNumericStringPassesThrough(): void
    {
        // A numeric string (as POSTed by the form) is coerced to an int
        $this->assertSame(15, $this->_resolve(['feedTimeout' => '15']));
    }

    public function testMinimumValueIsOne(): void
    {
        // One second is the smallest usable timeout
        $this->assertSame(1, $this->_resolve(['feedTimeout' => 1]));
    }

    // ========================================================================= //
    // Cap at the maximum
    // ========================================================================= //

    public function testValueAtTheMaximumIsAllowed(): void
    {
        // Exactly 60 is the ceiling and passes through
        $this->assertSame(60, $this->_resolve(['feedTimeout' => 60]));
    }

    public function testValueOverTheMaximumIsCapped(): void
    {
        // Anything above 60 is capped at 60
        $this->assertSame(60, $this->_resolve(['feedTimeout' => 120]));
    }
}
