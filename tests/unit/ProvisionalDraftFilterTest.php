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
 * Unit tests for the "is a provisional draft" event filter.
 *
 * Provisional drafts are Craft's autosave mechanism, every keystroke in
 * the entry editor flushes through this state. Notifications should
 * almost never fire on provisional drafts, hence the prohibitive default.
 */
class ProvisionalDraftFilterTest extends TestCase
{
    private string $filterSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/filters/ProvisionalDraftFilter.php';
        $this->assertTrue(file_exists($path));
        $this->filterSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(ProvisionalDraftFilter::class);
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

    public function testDefaultValueProhibitsProvisionalDrafts(): void
    {
        // Critical default, autosaves are noise; notifications must skip.
        $this->assertFalse(ProvisionalDraftFilter::defaultValue());
    }

    public function testDisplayNameIsTranslated(): void
    {
        $this->assertStringContainsString("Craft::t('notifier'", $this->filterSource);
        $this->assertStringContainsString('Element is a provisional draft', $this->filterSource);
    }

    // ========================================================================= //
    // Decision logic (source-level)
    // ========================================================================= //

    public function testChecksProvisionalDraftStateOnRootElement(): void
    {
        // Walk to the root element first, then read isProvisionalDraft.
        $this->assertStringContainsString('ElementHelper::rootElement', $this->filterSource);
        $this->assertMatchesRegularExpression(
            '/\$root->isProvisionalDraft\s*===\s*\$value/',
            $this->filterSource
        );
    }

    // ========================================================================= //
    // Mutual exclusion
    // ========================================================================= //

    public function testExcludesOtherLifecycleFilters(): void
    {
        // Provisional drafts conflict with regular drafts, revisions, and
        // first-save semantics, all three are hidden when this is enabled.
        $excluded = ProvisionalDraftFilter::excludes();

        $this->assertContains(DraftFilter::class, $excluded);
        $this->assertContains(RevisionFilter::class, $excluded);
        $this->assertContains(FirstSaveFilter::class, $excluded);
    }
}
