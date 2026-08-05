<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Component;
use doublesecretagency\notifier\services\ReportRunner;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the shared report runner base class.
 *
 * ReportRunner holds the run loop, the tracking-row seed, and the
 * concurrency-guarded fire window shared by SystemSnapshotRunner and
 * DynamicDataRunner. The subclasses only declare their event type and how a
 * single fire dispatches, so the load-bearing mechanics are pinned here.
 */
class ReportRunnerTest extends TestCase
{
    private ReflectionClass $reflection;
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/services/ReportRunner.php';
        $this->assertTrue(file_exists($path), "ReportRunner.php should exist at: $path");
        $this->source = file_get_contents($path);
        $this->reflection = new ReflectionClass(ReportRunner::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testIsAbstract(): void
    {
        // The base is never instantiated directly; each event type subclasses it.
        $this->assertTrue($this->reflection->isAbstract());
    }

    public function testExtendsComponent(): void
    {
        // Subclasses register as plugin components, so the base is a Component.
        $this->assertTrue($this->reflection->isSubclassOf(Component::class));
    }

    public function testDeclaresAbstractExtensionPoints(): void
    {
        // The differing bits each subclass must supply.
        foreach (['eventType', 'dispatch', 'notifications'] as $method) {
            $this->assertTrue($this->reflection->hasMethod($method));
            $this->assertTrue($this->reflection->getMethod($method)->isAbstract(), "{$method}() must be abstract");
        }
    }

    // ========================================================================= //
    // Public surface
    // ========================================================================= //

    public function testHasRunReturningArray(): void
    {
        // run() is the per-tick entry point both controllers merge.
        $this->assertTrue($this->reflection->hasMethod('run'));
        $this->assertSame('array', (string) $this->reflection->getMethod('run')->getReturnType());
    }

    public function testHasSeedNotification(): void
    {
        // The afterSave hook calls seedNotification() to upsert the tracking row.
        $this->assertTrue($this->reflection->hasMethod('seedNotification'));
        $this->assertTrue($this->reflection->getMethod('seedNotification')->isPublic());
        $params = $this->reflection->getMethod('seedNotification')->getParameters();
        $this->assertSame('notification', $params[0]->getName());
    }

    public function testHasWipeTracking(): void
    {
        // Switching away from a recurring type wipes the stale tracking row.
        $this->assertTrue($this->reflection->hasMethod('wipeTracking'));
        $this->assertTrue($this->reflection->getMethod('wipeTracking')->isPublic());
    }

    public function testHasPrivateRunNotificationAcceptingNotificationAndDateTime(): void
    {
        // _runNotification(Notification, DateTime) does the cadence + dispatch dance.
        $this->assertTrue($this->reflection->hasMethod('_runNotification'));
        $params = $this->reflection->getMethod('_runNotification')->getParameters();
        $this->assertCount(2, $params);
        $this->assertSame('notification', $params[0]->getName());
        $this->assertSame('now', $params[1]->getName());
    }

    // ========================================================================= //
    // Source-level invariants
    // ========================================================================= //

    public function testReadsNextRunAtFromTheTrackingTable(): void
    {
        // The runner's source of truth for "is it due" is the tracking row.
        $this->assertStringContainsString("'{{%notifier_trackreports}}'", $this->source);
        $this->assertMatchesRegularExpression('/select\(\[\'nextRunAt\'\]\)/', $this->source);
    }

    public function testUsesTheSharedScheduleHelper(): void
    {
        // Cadence math is delegated to RecurringSchedule, never recomputed inline.
        $this->assertStringContainsString('RecurringSchedule::nextRunAfter(', $this->source);
    }

    public function testRequiresTheRecurringFlag(): void
    {
        // Whether a notification fires on a schedule is driven by the
        // eventConfig.recurring lightswitch, not by the event value.
        $this->assertMatchesRegularExpression(
            "/_handles[\s\S]*?eventConfig\['recurring'\]/",
            $this->source
        );
    }

    public function testFireWindowIsCompareAndSwapped(): void
    {
        // The update is conditioned on the previously-read nextRunAt so concurrent
        // ticks cannot double-fire the same window.
        $this->assertMatchesRegularExpression(
            "/->update\([\s\S]*?'nextRunAt' => \\\$nextRunAtRaw/",
            $this->source
        );
    }

    public function testPerNotificationDispatchIsTryCatchWrapped(): void
    {
        // One bad notification's exception cannot abort the whole run.
        $this->assertMatchesRegularExpression(
            "/foreach[\s\S]*?try[\s\S]*?catch\s*\(\s*Throwable[\s\S]*?summary\['errors'\]/",
            $this->source
        );
    }
}
