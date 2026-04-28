<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\filters\BaseElementFilter;
use doublesecretagency\notifier\filters\DraftFilter;
use doublesecretagency\notifier\filters\FirstSaveFilter;
use doublesecretagency\notifier\filters\RevisionFilter;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Unit tests for the "is a draft" event filter.
 *
 * Drafts are prohibited by default — most users authoring notifications
 * want them to fire on the published canonical entry, not on each draft
 * autosave.
 */
class DraftFilterTest extends TestCase
{
    private string $filterSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/filters/DraftFilter.php';
        $this->assertTrue(file_exists($path));
        $this->filterSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(DraftFilter::class);
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

    public function testDefaultValueProhibitsDrafts(): void
    {
        // Drafts default to FALSE — i.e. by default, notifications skip drafts.
        $this->assertFalse(DraftFilter::defaultValue());
    }

    public function testDisplayNameIsTranslated(): void
    {
        $this->assertStringContainsString("Craft::t('notifier'", $this->filterSource);
        $this->assertStringContainsString('Element is a draft', $this->filterSource);
    }

    // ========================================================================= //
    // Decision logic (source-level)
    // ========================================================================= //

    public function testChecksDraftStateOnRootElement(): void
    {
        // Drafts wrap the canonical element, so the filter must walk up to
        // the root before asking about draft-ness. ElementHelper::rootElement
        // is the supported way to do this.
        $this->assertStringContainsString('ElementHelper::rootElement', $this->filterSource);
        $this->assertMatchesRegularExpression(
            '/\$root->getIsDraft\(\)\s*===\s*\$value/',
            $this->filterSource
        );
    }

    // ========================================================================= //
    // Mutual exclusion
    // ========================================================================= //

    public function testExcludesRevisionAndFirstSaveFilters(): void
    {
        // Drafts and revisions are mutually exclusive lifecycle states;
        // FirstSaveFilter is hidden because it implies a publish flow.
        $excluded = DraftFilter::excludes();

        $this->assertContains(RevisionFilter::class, $excluded);
        $this->assertContains(FirstSaveFilter::class, $excluded);
    }
}
