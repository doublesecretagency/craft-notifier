<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Structural tests for the empty-selector `[NO <THING>]` warnings in Dispatch.
 *
 * Every element-scoping gate (`_filter*()`) treats an empty selector as
 * match-nothing. When the selector is empty, the notification can never be
 * triggered, so the gate logs a `[NO <THING>]` warning and bails. Each of
 * those warnings must nest under the run-level parent envelope
 * (`$this->runEnvelope()`), per the standing rule that no bracketed log
 * message is ever a top-level, parent-less row.
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
     * The six distinct empty-selector warnings, keyed by gate.
     *
     * The two digital-products gates (products + licenses) share the same
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
     * Each warning is logged as a WARNING nested under the run-level parent
     * envelope. The shape is:
     *
     *     $this->notification->log->warning(Craft::t('notifier',
     *         '[NO <THING>] ...'
     *     ), $this->runEnvelope());
     *
     * so the message must be immediately followed by the runEnvelope() parent.
     *
     * @dataProvider warningProvider
     */
    public function testWarningNestsUnderRunEnvelope(string $message): void
    {
        $quoted = preg_quote($message, '/');
        $this->assertMatchesRegularExpression(
            "/'{$quoted}'\s*\),\s*\\\$this->runEnvelope\(\)\)/",
            $this->dispatchSource,
            "The \"{$message}\" warning must nest under \$this->runEnvelope()."
        );
    }

    /**
     * Every element-scoping gate guards on an empty selector, so an unconfigured
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
            'products' => ['productTypes'],   // shared by commerce + both digital gates
            'calendar' => ['calendars'],
        ];
    }

    /**
     * @dataProvider selectorProvider
     */
    public function testGateGuardsOnEmptySelector(string $selectorVar): void
    {
        $this->assertMatchesRegularExpression(
            "/if \(empty\(\\\$$selectorVar\)\)/",
            $this->dispatchSource,
            "The gate for \${$selectorVar} must guard on empty(\${$selectorVar})."
        );
    }
}
