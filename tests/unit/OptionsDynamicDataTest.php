<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\enums\Options;
use PHPUnit\Framework\TestCase;

/**
 * Coverage tests for the Dynamic Data event type in the Options enum.
 *
 * Mirrors System Snapshot: a single 'compile' sentinel event (scheduling is
 * driven by the eventConfig.recurring lightswitch).
 */
class OptionsDynamicDataTest extends TestCase
{
    public function testEventTypeLabel(): void
    {
        $this->assertSame('Dynamic Data', Options::EVENT_TYPE['dynamic-data']);
        $this->assertSame('Dynamic Data', Options::EVENT_TYPE_GROUPED['dynamic-data']);
    }

    public function testShipsExactlyOneSentinelEvent(): void
    {
        $values = array_column(Options::ALL_EVENTS['dynamic-data'], 'value');
        $this->assertSame(['compile'], $values);
    }

    public function testCompileEventHasNoEventClass(): void
    {
        foreach (Options::ALL_EVENTS['dynamic-data'] as $event) {
            $this->assertArrayNotHasKey('class', $event);
        }
    }
}
