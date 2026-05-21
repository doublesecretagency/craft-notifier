<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Structural tests for the schedule controllers' delegation to the RSS runner.
 *
 * Both the web controller and the console controller invoke the schedule
 * runner and the RSS runner on each cron tick and merge their summaries
 * into a single response. Drift in either path -- e.g. dropping the RSS
 * call, or merging only some summary keys -- would silently stop RSS
 * dispatches on the dropped surface.
 */
class ScheduledControllerFeedDelegationTest extends TestCase
{
    private string $webSource;
    private string $consoleSource;

    protected function setUp(): void
    {
        $webPath = dirname(__DIR__, 2) . '/src/controllers/ScheduledController.php';
        $consolePath = dirname(__DIR__, 2) . '/src/console/controllers/ScheduledController.php';
        $this->assertTrue(file_exists($webPath), "Web ScheduledController.php should exist at: $webPath");
        $this->assertTrue(file_exists($consolePath), "Console ScheduledController.php should exist at: $consolePath");
        $this->webSource = file_get_contents($webPath);
        $this->consoleSource = file_get_contents($consolePath);
    }

    // ========================================================================= //
    // Web controller
    // ========================================================================= //

    public function testWebControllerCallsFeedRunner(): void
    {
        $this->assertStringContainsString('feedRunner->run()', $this->webSource);
    }

    public function testWebControllerMergesEverySummaryKey(): void
    {
        // Each key must be merged; missing any one would drop RSS counts
        // (or RSS errors) from the response, hiding failures from cron logs.
        $this->assertStringContainsString("\$summary['notifications'] += \$feed['notifications']", $this->webSource);
        $this->assertStringContainsString("\$summary['sent']", $this->webSource);
        $this->assertStringContainsString("array_merge(\$summary['errors'], \$feed['errors'])", $this->webSource);
    }

    // ========================================================================= //
    // Console controller
    // ========================================================================= //

    public function testConsoleControllerCallsFeedRunner(): void
    {
        $this->assertStringContainsString('feedRunner->run()', $this->consoleSource);
    }

    public function testConsoleControllerMergesEverySummaryKey(): void
    {
        $this->assertStringContainsString("\$summary['notifications'] += \$feed['notifications']", $this->consoleSource);
        $this->assertStringContainsString("\$summary['sent']", $this->consoleSource);
        $this->assertStringContainsString("array_merge(\$summary['errors'], \$feed['errors'])", $this->consoleSource);
    }
}
