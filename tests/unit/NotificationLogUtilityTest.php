<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\base\Utility;
use doublesecretagency\notifier\utilities\NotificationLog;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the Notification Log CP utility.
 *
 * The utility renders one calendar day of envelope/log rows, so the
 * day-boundary query is the load-bearing piece — it must convert the
 * user's selected date from the system timezone into UTC before hitting
 * the database, otherwise late-evening events get filed under the wrong
 * day on the user's screen. These tests pin the post-PR-#30 timezone
 * shape and the half-open `>=`/`<` bounds.
 */
class NotificationLogUtilityTest extends TestCase
{
    private string $utilitySource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/utilities/NotificationLog.php';
        $this->assertTrue(file_exists($path), "NotificationLog utility should exist at: $path");
        $this->utilitySource = file_get_contents($path);
        $this->reflection = new ReflectionClass(NotificationLog::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testExtendsUtility(): void
    {
        // The class must remain a Craft Utility so it appears in the CP
        // utilities sidebar.
        $this->assertTrue($this->reflection->isSubclassOf(Utility::class));
    }

    public function testIdMatchesUtilityHandle(): void
    {
        // The id() return must stay 'notification-log' — the permission
        // gating in NotifierPlugin reads it to scope visibility.
        $this->assertSame('notification-log', NotificationLog::id());
    }

    public function testHasDisplayName(): void
    {
        // displayName() drives the sidebar label.
        $this->assertTrue($this->reflection->hasMethod('displayName'));
        $this->assertTrue(
            $this->reflection->getMethod('displayName')->isStatic()
        );
    }

    // ========================================================================= //
    // Day-query timezone handling (PR #30 cleanup)
    // ========================================================================= //

    public function testImportsDateTimeZone(): void
    {
        // The day-boundary code must use DateTimeZone — the PR #30 refactor
        // replaced the previous CONVERT_TZ SQL with PHP-side conversion.
        $this->assertStringContainsString('use DateTimeZone;', $this->utilitySource);
    }

    public function testNoConvertTzReference(): void
    {
        // CONVERT_TZ was the pre-PR-#30 form; it required the MySQL timezone
        // tables to be loaded and silently mis-bucketed rows on installs that
        // hadn't loaded them. Confirm the regression is gone.
        $this->assertStringNotContainsString('CONVERT_TZ', $this->utilitySource);
    }

    public function testDayBoundariesConvertToUtc(): void
    {
        // The day boundaries must be built in the system timezone and
        // converted to UTC before being passed to the query.
        $this->assertStringContainsString("new DateTimeZone('UTC')", $this->utilitySource);
        $this->assertStringContainsString('->setTimezone($utc)', $this->utilitySource);
    }

    public function testDayBoundariesUseSystemTimezone(): void
    {
        // The starting timezone for both bounds must be the system tz so the
        // user-entered date matches what they see in the CP.
        $this->assertStringContainsString(
            'new DateTimeZone(Craft::$app->timeZone)',
            $this->utilitySource
        );
    }

    public function testHalfOpenLowerBoundOnDateCreated(): void
    {
        // Inclusive lower bound on dateCreated.
        $this->assertStringContainsString(
            "['>=', 'dateCreated', \$startOfDay]",
            $this->utilitySource
        );
    }

    public function testHalfOpenUpperBoundOnDateCreated(): void
    {
        // Exclusive upper bound on dateCreated — using `<` against the next
        // day's start avoids the off-by-one millisecond gap that a `<=`
        // against end-of-day would leak.
        $this->assertStringContainsString(
            "['<',  'dateCreated', \$startOfNextDay]",
            $this->utilitySource
        );
    }

    public function testNextDayBoundUsesPlusOneDayModifier(): void
    {
        // The upper bound is derived by adding one day to the lower bound,
        // not by computing it independently — keeps the two bounds exactly
        // 24h apart even across DST transitions.
        $this->assertMatchesRegularExpression(
            "/\\\$startOfNextDay[\s\S]*?->modify\\('\\+1 day'\\)/",
            $this->utilitySource
        );
    }

    // ========================================================================= //
    // Private helpers
    // ========================================================================= //

    public function testGetLogsIsPrivateStatic(): void
    {
        $this->assertTrue($this->reflection->hasMethod('_getLogs'));
        $method = $this->reflection->getMethod('_getLogs');
        $this->assertTrue($method->isPrivate());
        $this->assertTrue($method->isStatic());
    }

    public function testIconPathIsPrivateStaticHelper(): void
    {
        // Both Craft 4 (iconPath) and Craft 5 (icon) hooks delegate to a
        // single private resolver — keeps the dual-hook surface honest.
        $this->assertTrue($this->reflection->hasMethod('_iconPath'));
        $method = $this->reflection->getMethod('_iconPath');
        $this->assertTrue($method->isPrivate());
        $this->assertTrue($method->isStatic());
    }
}
