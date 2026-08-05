<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Structural tests for the empty-selector `[NO <THING>]` warnings in Dispatch.
 *
 * Every element-scoping filter (`_filter*()`) treats an empty selector as
 * match-nothing. When the selector is empty, the notification can never be
 * triggered, so the filter logs a `[NO <THING>]` warning and bails. Each of
 * those warnings must nest under the run-level parent envelope
 * (`$this->runEnvelope()`), per the standing rule that no bracketed log
 * message is ever a top-level, parent-less row.
 *
 * As of 2026-08-04 the warnings route through `_filterWarning()` rather than
 * calling the log directly. The helper both nests the row and honors the
 * `checkOnly` flag, so a manual-trigger visibility check can run the same
 * filter without writing anything.
 *
 * These are source-level regex checks: the real per-element logging behavior
 * is exercised manually in the sandbox (misconfigure a notification with no
 * sections/volumes/groups/etc, run the schedule, confirm one warning nests
 * under a `Sending "{title}".` parent).
 */
class DispatchEmptySelectorWarningTest extends TestCase
{
    private string $dispatchSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/models/Dispatch.php';
        $this->assertTrue(file_exists($path), "Dispatch.php should exist at: $path");
        $this->dispatchSource = file_get_contents($path);
    }

    /**
     * The six distinct empty-selector warnings, keyed by filter.
     *
     * The two digital-products filters (products + licenses) share the same
     * `digitalProductTypes` selector, so they share one message.
     *
     * @return array<string, array{0: string}>
     */
    public static function warningProvider(): array
    {
        return [
            'entries'          => ['[NO ENTRY TYPE] No sections or entry types are selected, this notification will never be triggered.'],
            'assets'           => ['[NO VOLUME] No volumes are selected, this notification will never be triggered.'],
            'users'            => ['[NO USER GROUP] No user groups are selected, this notification will never be triggered.'],
            'commerce'         => ['[NO PRODUCT TYPE] No product types are selected, this notification will never be triggered.'],
            'digital-products' => ['[NO DIGITAL PRODUCT TYPE] No digital product types are selected, this notification will never be triggered.'],
            'calendar'         => ['[NO CALENDAR] No calendars are selected, this notification will never be triggered.'],
        ];
    }

    /**
     * Each warning message is present in the source, exactly as written, so
     * the translation keys stay in sync with the strings passed to Craft::t().
     *
     * @dataProvider warningProvider
     */
    public function testWarningMessageIsPresent(string $message): void
    {
        $this->assertStringContainsString($message, $this->dispatchSource);
    }

    /**
     * Each warning is routed through the `_filterWarning()` helper. The shape is:
     *
     *     $this->_filterWarning(Craft::t('notifier',
     *         '[NO <THING>] ...'
     *     ));
     *
     * The helper is what nests the row under the run-level parent envelope, and
     * what honors the `checkOnly` flag so a visibility check writes nothing.
     * A direct `log->warning(..., $this->runEnvelope())` call would still nest
     * correctly but would bypass that suppression, so the indirection is the
     * thing worth pinning. See `testHelperNestsUnderRunEnvelope()` below for the
     * nesting guarantee itself.
     *
     * @dataProvider warningProvider
     */
    public function testWarningRoutesThroughFilterWarningHelper(string $message): void
    {
        $quoted = preg_quote($message, '/');
        $this->assertMatchesRegularExpression(
            "/\\\$this->_filterWarning\(Craft::t\('notifier',\s*\n\s*'{$quoted}'\s*\n\s*\)\);/",
            $this->dispatchSource,
            "The \"{$message}\" warning must route through \$this->_filterWarning()."
        );
    }

    /**
     * The helper carries the nesting guarantee for every empty-selector warning:
     * one place passes `$this->runEnvelope()`, so no bracketed log message can
     * become a top-level, parent-less row.
     */
    public function testHelperNestsUnderRunEnvelope(): void
    {
        $this->assertMatchesRegularExpression(
            '/private function _filterWarning\(string \$message\): void\s*\{[\s\S]*?'
            . '\$this->notification->log->warning\(\$message, \$this->runEnvelope\(\)\);/',
            $this->dispatchSource
        );
    }

    /**
     * Every element-scoping filter guards on an empty selector, so an unconfigured
     * notification bails (and now warns) rather than silently matching nothing.
     *
     * @return array<string, array{0: string}>
     */
    public static function selectorProvider(): array
    {
        return [
            'entries'  => ['sectionEntryTypes'],
            'assets'   => ['volumes'],
            'users'    => ['userGroups'],
            'products' => ['productTypes'],   // shared by commerce + both digital filters
            'calendar' => ['calendars'],
        ];
    }

    /**
     * @dataProvider selectorProvider
     */
    public function testFilterGuardsOnEmptySelector(string $selectorVar): void
    {
        $this->assertMatchesRegularExpression(
            "/if \(empty\(\\\$$selectorVar\)\)/",
            $this->dispatchSource,
            "The filter for \${$selectorVar} must guard on empty(\${$selectorVar})."
        );
    }
}
