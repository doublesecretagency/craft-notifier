<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Component;
use doublesecretagency\notifier\services\ScheduleRunner;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the schedule runner service.
 *
 * ScheduleRunner is the engine behind the time-based trigger events. The
 * console command and web endpoint both call `run()`, so its public surface
 * is the contract verified here.
 */
class ScheduleRunnerServiceTest extends TestCase
{
    private ReflectionClass $reflection;
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/services/ScheduleRunner.php';
        $this->assertTrue(file_exists($path), "ScheduleRunner.php should exist at: $path");
        $this->source = file_get_contents($path);
        $this->reflection = new ReflectionClass(ScheduleRunner::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsComponent(): void
    {
        // Registered as a plugin component, so it must be a Craft Component.
        $this->assertTrue($this->reflection->isSubclassOf(Component::class));
    }

    // ========================================================================= //
    // Public surface
    // ========================================================================= //

    public function testHasRun(): void
    {
        // run() is the single entry point both trigger surfaces call.
        $this->assertTrue($this->reflection->hasMethod('run'));
        $this->assertTrue($this->reflection->getMethod('run')->isPublic());
    }

    public function testTargetDateRangeIsPublicAndStatic(): void
    {
        // targetDateRange() is pure and static so it can be unit-tested directly.
        $this->assertTrue($this->reflection->hasMethod('targetDateRange'));
        $method = $this->reflection->getMethod('targetDateRange');
        $this->assertTrue($method->isPublic());
        $this->assertTrue($method->isStatic());
    }

    public function testTargetDateRangeSignature(): void
    {
        // targetDateRange(string $direction, int $offset, DateTime $lastRunAt, DateTime $now): array
        $params = $this->reflection->getMethod('targetDateRange')->getParameters();
        $this->assertCount(4, $params);
        $this->assertSame('direction', $params[0]->getName());
        $this->assertSame('offset', $params[1]->getName());
        $this->assertSame('lastRunAt', $params[2]->getName());
        $this->assertSame('now', $params[3]->getName());
        $this->assertSame('array', (string) $this->reflection->getMethod('targetDateRange')->getReturnType());
    }

    // ========================================================================= //
    // Timezone and seed-anchor correctness (source-level)
    // ========================================================================= //

    public function testFirstRunSeedsToNotificationCreationTime(): void
    {
        // The first run anchors to the notification's dateCreated, not "now".
        // A crossing between notification creation and the first run would
        // otherwise fall into a blind spot and never fire.
        $this->assertStringContainsString(
            'Db::prepareDateForDb($notification->dateCreated)',
            $this->source
        );
    }

    public function testDateWindowIsConvertedToTheSystemTimezone(): void
    {
        // Craft's element-query date params are parsed as system-timezone
        // values (Db::parseDateParam calls toDateTime with assumeSystemTimeZone
        // = true). The UTC run window must be converted before the query, or
        // it is silently shifted by the server's UTC offset.
        $this->assertStringContainsString('Craft::$app->getTimeZone()', $this->source);
    }
}
