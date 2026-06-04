<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\helpers\SystemSnapshot;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the System Snapshot compiler.
 *
 * SystemSnapshot::compile() dereferences Craft::$app heavily (updates, plugins,
 * db, sites), so it cannot run under the no-bootstrap protocol. These tests pin
 * the compiler's public surface, its per-section isolation, the force-refresh
 * fallback, and the report's documented key shape via source inspection.
 */
class SystemSnapshotTest extends TestCase
{
    private ReflectionClass $reflection;
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/helpers/SystemSnapshot.php';
        $this->assertTrue(file_exists($path), "SystemSnapshot.php should exist at: $path");
        $this->source = file_get_contents($path);
        $this->reflection = new ReflectionClass(SystemSnapshot::class);
    }

    public function testCompileIsPublicStaticReturningArray(): void
    {
        $this->assertTrue($this->reflection->hasMethod('compile'));
        $method = $this->reflection->getMethod('compile');
        $this->assertTrue($method->isPublic());
        $this->assertTrue($method->isStatic());
        $this->assertSame('array', (string) $method->getReturnType());
    }

    public function testReportCarriesEveryTopLevelSection(): void
    {
        // The documented report shape: compiledAt + five sections.
        foreach (["'compiledAt'", "'craft'", "'sites'", "'plugins'", "'system'", "'queue'"] as $key) {
            $this->assertStringContainsString($key, $this->source);
        }
    }

    public function testSitesSectionCoversEverySiteKeyedByHandle(): void
    {
        // Sites are reported for every site (not just the primary), keyed by handle.
        $this->assertStringContainsString('getAllSites()', $this->source);
        $this->assertStringContainsString('$sites[$site->handle]', $this->source);
        $this->assertStringContainsString("'primary'", $this->source);
    }

    public function testEachSectionIsCompiledInIsolation(): void
    {
        // _section() wraps each compiler in try/catch so one failure nulls only
        // that section rather than the whole snapshot.
        $this->assertMatchesRegularExpression(
            "/private static function _section\([\s\S]*?try[\s\S]*?catch\s*\(\s*Throwable/",
            $this->source
        );
    }

    public function testForcesAnUpdateRefreshWithCachedFallback(): void
    {
        // Every compile forces a fresh check, falling back to cached data and
        // flagging refreshFailed when the network check throws.
        $this->assertStringContainsString('getUpdates(true)', $this->source);
        $this->assertStringContainsString('getUpdates(false)', $this->source);
        $this->assertStringContainsString("'refreshFailed' => true", $this->source);
    }

    public function testCraftSectionExposesNewFlags(): void
    {
        // The craft section carries the system name + status and the
        // maintenance / devMode / license fields.
        $this->assertStringContainsString("'systemName'", $this->source);
        $this->assertStringContainsString('getSystemName()', $this->source);
        $this->assertStringContainsString("'live'", $this->source);
        $this->assertStringContainsString('getIsLive()', $this->source);
        $this->assertStringContainsString("'maintenanceMode'", $this->source);
        $this->assertStringContainsString("'devMode'", $this->source);
        $this->assertStringContainsString("'licensed'", $this->source);
    }

    public function testQueueSectionReportsPendingFailedDelayed(): void
    {
        // Queue health is surfaced as three counts from the queue table.
        $this->assertStringContainsString("'pending'", $this->source);
        $this->assertStringContainsString("'failed'", $this->source);
        $this->assertStringContainsString("'delayed'", $this->source);
        $this->assertStringContainsString("'{{%queue}}'", $this->source);
    }

    public function testPluginSectionReportsLicenseAndUpdateStatus(): void
    {
        // Each plugin carries its license status and an update sub-array.
        $this->assertStringContainsString('licenseKeyStatus', $this->source);
        $this->assertStringContainsString("'abandoned'", $this->source);
    }
}
