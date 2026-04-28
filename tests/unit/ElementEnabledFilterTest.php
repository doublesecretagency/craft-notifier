<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\filters\BaseElementFilter;
use doublesecretagency\notifier\filters\ElementEnabledFilter;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Unit tests for the "element is enabled" event filter.
 *
 * Each filter exposes a small public surface (display labels, default
 * value, exclusivity rules) plus a protected check() method that runs
 * inside Dispatch::_filterEntries. The check() implementation reads
 * Element properties that aren't easily synthesized without Craft —
 * those are covered via source-level assertions.
 */
class ElementEnabledFilterTest extends TestCase
{
    private string $filterSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/filters/ElementEnabledFilter.php';
        $this->assertTrue(file_exists($path));
        $this->filterSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(ElementEnabledFilter::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsBaseElementFilter(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(BaseElementFilter::class));
    }

    // ========================================================================= //
    // Static metadata
    // ========================================================================= //

    public function testDefaultValueRequiresEnabled(): void
    {
        // Element-enabled filter defaults to required — i.e. by default,
        // notifications only fire for enabled elements. This is the safer
        // default; users opt in to disabled-element notifications explicitly.
        $this->assertTrue(ElementEnabledFilter::defaultValue());
    }

    public function testDisplayNameIsTranslated(): void
    {
        // Source must funnel display names through Craft::t() so they are
        // localizable.
        $this->assertStringContainsString("Craft::t('notifier'", $this->filterSource);
        $this->assertStringContainsString('Element is enabled', $this->filterSource);
    }

    public function testTitleVariantsArePresent(): void
    {
        // The three CP UI labels each filter must surface.
        $this->assertStringContainsString('Must be enabled', $this->filterSource);
        $this->assertStringContainsString('Must be disabled', $this->filterSource);
        $this->assertStringContainsString('Can be enabled or disabled', $this->filterSource);
    }

    // ========================================================================= //
    // Decision logic (source-level)
    // ========================================================================= //

    public function testCheckElementComparesEnabledAndSiteEnabledAgainstValue(): void
    {
        // The filter must require BOTH the global `enabled` flag and the
        // per-site `getEnabledForSite()` flag to align with $value, so a
        // notification doesn't fire from a propagated save into a site
        // where the element is hidden.
        $this->assertMatchesRegularExpression(
            '/\$value\s*===\s*\(\$element->enabled\s*&&\s*\$element->getEnabledForSite\(\)\)/',
            $this->filterSource
        );
    }

    public function testCheckElementIsProtected(): void
    {
        // checkElement() is invoked through BaseElementFilter::check(),
        // which already routed the event to the right element. It should
        // remain protected to keep the contract internal.
        $this->assertTrue($this->reflection->hasMethod('checkElement'));
        $this->assertTrue($this->reflection->getMethod('checkElement')->isProtected());
    }
}
