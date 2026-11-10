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
 * Source-level guards on the welcome screen icon.
 *
 * Craft Cloud only serves asset folders that an asset bundle declares at
 * build time, and no bundle declares `src/`. So publishing `icon.svg` at
 * runtime returns a CDN URL that 404s on Cloud. The icon is inlined with
 * `svg()` instead, which needs no URL at all.
 */
class WelcomeIconTemplateTest extends TestCase
{
    private function _root(): string
    {
        return dirname(__DIR__, 2);
    }

    public function testWelcomeIconIsInlinedRatherThanPublished(): void
    {
        $twig = file_get_contents($this->_root() . '/src/templates/notifications/_index.twig');

        $this->assertStringContainsString("svg('@doublesecretagency/notifier/icon.svg', namespace=true)", $twig);
        $this->assertStringNotContainsString("icon.svg', true)", $twig);
    }

    public function testTheInlinedIconIsDecorative(): void
    {
        $twig = file_get_contents($this->_root() . '/src/templates/notifications/_index.twig');

        $this->assertStringContainsString("'aria-hidden': 'true'", $twig);
    }

    public function testNoTemplatePublishesTheIconAtRuntime(): void
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->_root() . '/src/templates'));

        foreach ($iterator as $file) {
            if (!str_ends_with($file->getFilename(), '.twig')) {
                continue;
            }
            $this->assertDoesNotMatchRegularExpression(
                '/getPublishedUrl\([^)]*icon\.svg/',
                file_get_contents($file->getPathname()),
                $file->getFilename() . ' publishes icon.svg at runtime, which 404s on Craft Cloud.'
            );
        }
    }
}
