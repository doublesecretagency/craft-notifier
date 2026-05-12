<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\filters\BaseElementFilter;
use doublesecretagency\notifier\filters\DraftFilter;
use doublesecretagency\notifier\filters\FirstSaveFilter;
use doublesecretagency\notifier\filters\ProvisionalDraftFilter;
use doublesecretagency\notifier\filters\RevisionFilter;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Unit tests for the "first save" event filter.
 *
 * "First save" means Craft's $element->firstSave flag aligned with the
 * desired value AND the element is not currently a revision. This filter
 * is also exclusive, if it's enabled, several lifecycle filters become
 * meaningless and should be hidden in the UI.
 */
class FirstSaveFilterTest extends TestCase
{
    private string $filterSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/filters/FirstSaveFilter.php';
        $this->assertTrue(file_exists($path));
        $this->filterSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(FirstSaveFilter::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsBaseElementFilter(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(BaseElementFilter::class));
    }

    // ========================================================================= //
    // Decision logic
    // ========================================================================= //

    public function testCheckElementComparesFirstSaveAndExcludesRevisions(): void
    {
        // Two conditions: the firstSave flag must equal $value AND the
        // element must NOT be a revision (revisions don't count as first
        // saves of the canonical element).
        $this->assertMatchesRegularExpression(
            '/\$element->firstSave\s*===\s*\$value/',
            $this->filterSource
        );
        $this->assertMatchesRegularExpression(
            '/!\s*\$element->getIsRevision\(\)/',
            $this->filterSource
        );
    }

    // ========================================================================= //
    // Mutual exclusion
    // ========================================================================= //

    public function testExcludesAllLifecycleSiblings(): void
    {
        // When this filter is enabled, related lifecycle filters become
        // redundant or contradictory; the CP must hide them. The exclusion
        // list must therefore name each one explicitly.
        $excluded = FirstSaveFilter::excludes();

        $this->assertContains(DraftFilter::class, $excluded);
        $this->assertContains(ProvisionalDraftFilter::class, $excluded);
        $this->assertContains(RevisionFilter::class, $excluded);
    }

    // ========================================================================= //
    // Static metadata
    // ========================================================================= //

    public function testDisplayNameIsTranslated(): void
    {
        $this->assertStringContainsString("Craft::t('notifier'", $this->filterSource);
        $this->assertStringContainsString(
            'Element is being saved for the first time',
            $this->filterSource
        );
    }

    public function testDefaultValueDefersToBaseClass(): void
    {
        // FirstSaveFilter does not override defaultValue(), so it inherits
        // BaseElementFilter's null (= "no preference"). If a future change
        // makes it required-by-default, this test should be updated knowingly.
        $this->assertNull(FirstSaveFilter::defaultValue());
    }
}
