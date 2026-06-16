<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Source-level guards on the shared notification-log details-table partial.
 *
 * Social envelopes store a nested media summary (`{count, items}`) in their
 * log details. The details table previously echoed every value raw, so the
 * media array hit "Array to string conversion" and crashed the whole log
 * utility. The partial now renders the media count and guards any remaining
 * array value with json_encode. These regex assertions pin that shape against
 * future regression.
 */
class LogEnvelopeDetailsTemplateTest extends TestCase
{
    private string $source;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/templates/_utility/log/details-table.twig';
        $this->assertTrue(file_exists($path), "details-table.twig should exist at: $path");
        $this->source = file_get_contents($path);
    }

    public function testRendersMediaAsCount(): void
    {
        // The media branch pulls the count off the nested summary rather than echoing the array.
        $this->assertMatchesRegularExpression('/key\s*==\s*\'media\'/', $this->source);
        $this->assertStringContainsString('value.count', $this->source);
    }

    public function testGuardsIterableValues(): void
    {
        // Any unexpected array value is json-encoded so an echo never crashes the log.
        $this->assertMatchesRegularExpression('/value\s+is\s+iterable/', $this->source);
        $this->assertStringContainsString('value|json_encode', $this->source);
    }
}
