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

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Source-level guards on the read-only edit screen.
 *
 * The view-only mode wraps the edit form in `<fieldset disabled>`. Native
 * form controls inherit `:disabled` and reject input. Three categories of
 * UI need explicit guards because the cascade does not reach them:
 *
 * 1. The tri-state filter button group (`<div class="btn">` siblings of a
 *    `<div class="btngroup">`) accepts clicks via JS handlers. The readonly
 *    stylesheet blocks those clicks at the CSS layer with `pointer-events: none`.
 * 2. The "Select all / Deselect all" affordance in nested-checkbox UIs is a
 *    `<div class="select-all" onclick="...">` and must be guarded out of the
 *    DOM in read-only mode (zero informational value when the user can not edit).
 * 3. The legacy `.checkbox { position: absolute; right: 0 }` rule in
 *    `nested-checkboxes.scss` was a Craft-3-era hack. Under Craft 5 it is dead
 *    code (the visible checkbox is a `::before` on the label, and the native
 *    input is hidden via global `opacity: 0`). Pinning its absence stops it
 *    from being reintroduced and exposing ghost native checkboxes on the right.
 *
 * @since 3.0.0
 */
class NotificationEditReadOnlyTest extends TestCase
{

    private static function pluginRoot(): string
    {
        return dirname(__DIR__, 2);
    }

    private static function read(string $relPath): string
    {
        $path = self::pluginRoot() . '/' . $relPath;
        if (!file_exists($path)) {
            throw new \RuntimeException("Missing file: $path");
        }
        return file_get_contents($path);
    }

    // ========================================================================= //
    // Filter button group: pointer-events guard in readonly stylesheet
    // ========================================================================= //

    public function testReadonlyStylesheetPinsBtngroupPointerEventsRule(): void
    {
        // Without `pointer-events: none`, the filter button group still
        // accepts clicks even when the parent fieldset is disabled.
        $source = self::read('src/web/assets/src/sass/notification-editor.scss');
        $this->assertMatchesRegularExpression(
            '/\.notifier-edit-fieldset--readonly\s+\.btngroup\s*\{[^}]*pointer-events:\s*none/s',
            $source
        );
    }

    public function testReadonlyStylesheetBtngroupRuleDimsAndShowsForbiddenCursor(): void
    {
        // Visual cues that match the existing readonly idiom for native controls.
        $source = self::read('src/web/assets/src/sass/notification-editor.scss');
        $this->assertMatchesRegularExpression(
            '/\.notifier-edit-fieldset--readonly\s+\.btngroup\s*\{[^}]*opacity:\s*0\.75/s',
            $source
        );
        $this->assertMatchesRegularExpression(
            '/\.notifier-edit-fieldset--readonly\s+\.btngroup\s*\{[^}]*cursor:\s*not-allowed/s',
            $source
        );
    }

    // ========================================================================= //
    // Stray h3 separator: hidden in read-only mode
    // ========================================================================= //

    public function testReadonlyStylesheetDropsNestedCheckboxH3BorderInReadOnlyMode(): void
    {
        // The h3 carries a right border to separate the heading from the
        // "Select All" link. With the link absent in read-only mode, the
        // border becomes a stray vertical bar; the readonly stylesheet
        // must drop it.
        $source = self::read('src/web/assets/src/sass/notification-editor.scss');
        $this->assertMatchesRegularExpression(
            '/\.notifier-edit-fieldset--readonly\s+\.nested-checkboxes\s+h3\s*\{[^}]*border-right:\s*0/s',
            $source
        );
    }

    // ========================================================================= //
    // Nested-checkbox partials: select-all guard
    // ========================================================================= //

    public static function selectAllPartialProvider(): array
    {
        return [
            'entry-types' => ['src/templates/notifications/_edit/event/entries/entry-types.twig'],
            'sites'       => ['src/templates/notifications/_edit/event/entries/sites.twig'],
            'user-groups' => ['src/templates/notifications/_edit/event/users/groups.twig'],
            'volumes'     => ['src/templates/notifications/_edit/event/assets/volumes.twig'],
        ];
    }

    #[DataProvider('selectAllPartialProvider')]
    public function testSelectAllIsGuardedByReadOnly(string $relPath): void
    {
        // Each nested-checkbox partial must wrap its `<div class="select-all">`
        // line in a `{% if not (readOnly ?? false) %}` guard so the affordance
        // is absent from the DOM in read-only mode.
        $source = self::read($relPath);
        $this->assertMatchesRegularExpression(
            '/\{%\s*if\s+not\s+\(readOnly\s*\?\?\s*false\)\s*%\}[\s\S]*?<div\s+class="select-all"/',
            $source,
            "Partial {$relPath} should guard its select-all div with `{% if not (readOnly ?? false) %}`"
        );
    }

    // ========================================================================= //
    // Nested-checkbox SCSS: legacy positioning rule must stay deleted
    // ========================================================================= //

    public function testNestedCheckboxesScssDoesNotPositionCheckboxAtRightZero(): void
    {
        // The Craft-3-era hack `.checkbox { position: absolute; right: 0 }`
        // was deleted because under Craft 5 it leaves the native input
        // dangling on the right edge of the panel. Pinning its absence
        // catches an accidental reintroduction.
        $source = self::read('src/web/assets/src/sass/nested-checkboxes.scss');
        $this->assertDoesNotMatchRegularExpression(
            '/\.checkbox\s*\{[^}]*position:\s*absolute[^}]*right:\s*0/s',
            $source
        );
        $this->assertDoesNotMatchRegularExpression(
            '/\.checkbox\s*\{[^}]*right:\s*0[^}]*position:\s*absolute/s',
            $source
        );
    }

    public function testNestedCheckboxesCompiledCssDoesNotPositionCheckboxAtRightZero(): void
    {
        // Defense-in-depth: the dist bundle is what actually ships, so the
        // built artifact must also be free of the legacy rule.
        $source = self::read('src/web/assets/dist/css/nested-checkboxes.css');
        $this->assertDoesNotMatchRegularExpression(
            '/\.nested-checkboxes\s+\.checkbox\s*\{[^}]*position:\s*absolute[^}]*right:\s*0/s',
            $source
        );
    }

    // ========================================================================= //
    // Native checkbox visually hidden, definitively, regardless of cp.css cache state
    // ========================================================================= //

    public function testNestedCheckboxesScssVisuallyHidesNativeCheckboxes(): void
    {
        // The "visually hidden but accessible" pattern. Pinning the
        // load-bearing properties (zero size, clip, overflow:hidden)
        // catches accidental loosening that would let the native input
        // ghost over the label's pseudo-element checkbox visual.
        $source = self::read('src/web/assets/src/sass/nested-checkboxes.scss');
        $this->assertMatchesRegularExpression(
            '/\.checkbox\s*\{[^}]*width:\s*1px[^}]*height:\s*1px/s',
            $source
        );
        $this->assertMatchesRegularExpression(
            '/\.checkbox\s*\{[^}]*clip:\s*rect\(0,\s*0,\s*0,\s*0\)/s',
            $source
        );
        $this->assertMatchesRegularExpression(
            '/\.checkbox\s*\{[^}]*overflow:\s*hidden/s',
            $source
        );
    }

    public function testNestedCheckboxesCompiledCssVisuallyHidesNativeCheckboxes(): void
    {
        // The dist bundle must reflect the visually-hidden pattern too.
        $source = self::read('src/web/assets/dist/css/nested-checkboxes.css');
        $this->assertMatchesRegularExpression(
            '/\.nested-checkboxes\s+\.checkbox\s*\{[^}]*width:\s*1px/s',
            $source
        );
        $this->assertMatchesRegularExpression(
            '/\.nested-checkboxes\s+\.checkbox\s*\{[^}]*clip:\s*rect\(0,\s*0,\s*0,\s*0\)/s',
            $source
        );
    }
}
