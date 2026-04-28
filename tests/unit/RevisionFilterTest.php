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
 * Unit tests for the "is a revision" event filter.
 *
 * Revisions are Craft's audit-trail snapshots; notifications should not
 * normally fire when a revision is saved (the canonical entry already
 * fired its own notification). Hence the prohibitive default.
 */
class RevisionFilterTest extends TestCase
{
    private string $filterSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/filters/RevisionFilter.php';
        $this->assertTrue(file_exists($path));
        $this->filterSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(RevisionFilter::class);
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

    public function testDefaultValueProhibitsRevisions(): void
    {
        $this->assertFalse(RevisionFilter::defaultValue());
    }

    public function testDisplayNameIsTranslated(): void
    {
        $this->assertStringContainsString("Craft::t('notifier'", $this->filterSource);
        $this->assertStringContainsString('Element is a revision', $this->filterSource);
    }

    // ========================================================================= //
    // Decision logic (source-level)
    // ========================================================================= //

    public function testChecksRevisionStateOnRootElement(): void
    {
        // Revisions wrap the canonical element, so walk to the root first.
        $this->assertStringContainsString('ElementHelper::rootElement', $this->filterSource);
        $this->assertMatchesRegularExpression(
            '/\$root->getIsRevision\(\)\s*===\s*\$value/',
            $this->filterSource
        );
    }

    // ========================================================================= //
    // Mutual exclusion
    // ========================================================================= //

    public function testExcludesOtherLifecycleFilters(): void
    {
        // Revisions are mutually exclusive with the other lifecycle states
        // — drafts, provisional drafts, and the first-save semantics.
        $excluded = RevisionFilter::excludes();

        $this->assertContains(DraftFilter::class, $excluded);
        $this->assertContains(ProvisionalDraftFilter::class, $excluded);
        $this->assertContains(FirstSaveFilter::class, $excluded);
    }
}
