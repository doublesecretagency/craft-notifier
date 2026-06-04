<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\enums\Options;
use PHPUnit\Framework\TestCase;

/**
 * Coverage tests for the System Snapshot event type in the Options enum.
 *
 * The CP dropdown and the table-attribute renderer both read these constants,
 * so the slug and the single sentinel event are pinned against drift.
 */
class OptionsSystemSnapshotTest extends TestCase
{
    public function testEventTypeLabel(): void
    {
        $this->assertSame('System Snapshot', Options::EVENT_TYPE['system-snapshot']);
        $this->assertSame('System Snapshot', Options::EVENT_TYPE_GROUPED['system-snapshot']);
    }

    public function testShipsExactlyOneSentinelEvent(): void
    {
        // Scheduling is driven by the eventConfig.recurring lightswitch, not by
        // the event value, so a single 'compile' sentinel keeps the model valid.
        $values = array_column(Options::ALL_EVENTS['system-snapshot'], 'value');
        $this->assertSame(['compile'], $values);
    }

    public function testCompileEventHasNoEventClass(): void
    {
        // The event is poll/manual driven, not backed by a Yii event.
        foreach (Options::ALL_EVENTS['system-snapshot'] as $event) {
            $this->assertArrayNotHasKey('class', $event);
        }
    }
}
