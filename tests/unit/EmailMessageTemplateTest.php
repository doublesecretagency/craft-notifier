<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Structural tests for the email-notification edit template.
 *
 * The template hosts both the Monaco (code) and Trix (rich text) editors,
 * a toggle widget, and a single canonical textarea that posts the body.
 * Drift in any of the DOM ids or the form-field name silently breaks
 * either the toggle JS (which queries by id) or the server-side save
 * path (which reads `messageConfig[emailMessage]` and the new sibling
 * `messageConfig[emailMessageMode]` from POST).
 */
class EmailMessageTemplateTest extends TestCase
{
    private string $templateSource;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/templates/notifications/_edit/message/email.twig';
        $this->assertTrue(file_exists($path), "email.twig should exist at: $path");
        $this->templateSource = file_get_contents($path);
    }

    // ========================================================================= //
    // Field wrapper
    // ========================================================================= //

    public function testFieldWrapperHasStableId(): void
    {
        // Toggle controller keys off id="email-message-field"
        $this->assertStringContainsString(
            'id="email-message-field"',
            $this->templateSource
        );
    }

    public function testFieldWrapperCarriesDataModeAttribute(): void
    {
        // JS reads the active mode from data-mode on the wrapper
        $this->assertMatchesRegularExpression(
            '/id="email-message-field"[^>]*data-mode="\{\{\s*mode\s*\}\}"/',
            $this->templateSource
        );
    }

    public function testModeDefaultsToRichWhenMissing(): void
    {
        // Notifications with no saved emailMessageMode default to Rich Text;
        // a saved 'code' value continues to show the Monaco editor.
        $this->assertMatchesRegularExpression(
            "/set\s+mode\s*=\s*\(\s*notification\.messageConfig\.emailMessageMode\s*\?\?\s*'rich'\s*\)/",
            $this->templateSource
        );
    }

    // ========================================================================= //
    // Mode toggle widget
    // ========================================================================= //

    public function testToggleGroupHasStableId(): void
    {
        $this->assertStringContainsString(
            'id="email-message-mode-toggle"',
            $this->templateSource
        );
    }

    public function testCodeToggleButtonExists(): void
    {
        $this->assertMatchesRegularExpression(
            '/<button[^>]*data-mode="code"/',
            $this->templateSource
        );
    }

    public function testRichToggleButtonExists(): void
    {
        $this->assertMatchesRegularExpression(
            '/<button[^>]*data-mode="rich"/',
            $this->templateSource
        );
    }

    public function testRichToggleAppearsBeforeCodeToggle(): void
    {
        // Rich Text is the default mode; its button leads the segmented control.
        $richPos = strpos($this->templateSource, 'data-mode="rich"');
        $codePos = strpos($this->templateSource, 'data-mode="code"');
        $this->assertNotFalse($richPos, 'Rich Text toggle should be present');
        $this->assertNotFalse($codePos, 'Code toggle should be present');
        $this->assertLessThan($codePos, $richPos, 'Rich Text toggle should render before the Code toggle');
    }

    // ========================================================================= //
    // Editor containers
    // ========================================================================= //

    public function testCodeEditorContainerHasStableId(): void
    {
        // JS toggles the .hidden class on this container
        $this->assertStringContainsString(
            'id="email-message-editor-code"',
            $this->templateSource
        );
    }

    public function testRichEditorContainerHasStableId(): void
    {
        $this->assertStringContainsString(
            'id="email-message-editor-rich"',
            $this->templateSource
        );
    }

    public function testTrixEditorIsBoundToHiddenInput(): void
    {
        // Trix syncs its HTML output into the input element identified by
        // the `input` attribute on <trix-editor>. JS mirrors that input
        // into the canonical textarea on every trix-change event.
        $this->assertMatchesRegularExpression(
            '/<trix-editor[^>]*\binput="email-message-rich-input"/',
            $this->templateSource
        );
        $this->assertStringContainsString(
            'id="email-message-rich-input"',
            $this->templateSource
        );
    }

    public function testTrixEditorReferencesCustomToolbar(): void
    {
        // The streamlined toolbar lives in the template as a <trix-toolbar>
        // with a stable id; <trix-editor toolbar="..."> points Trix at it.
        $this->assertStringContainsString(
            '<trix-toolbar id="email-message-trix-toolbar">',
            $this->templateSource
        );
        $this->assertMatchesRegularExpression(
            '/<trix-editor[^>]*\btoolbar="email-message-trix-toolbar"/',
            $this->templateSource
        );
    }

    /**
     * @return string[][]
     */
    public static function streamlinedToolbarButtonProvider(): array
    {
        return [
            ['bold'],
            ['italic'],
            ['underline'],
            ['strike'],
            ['bullet'],
            ['number'],
            ['heading1'],
            ['code'],
        ];
    }

    /**
     * @dataProvider streamlinedToolbarButtonProvider
     */
    public function testStreamlinedToolbarHasButton(string $attribute): void
    {
        // Streamlined set: text formatting + lists + heading + code only
        $this->assertMatchesRegularExpression(
            "/<button[^>]*data-trix-attribute=\"$attribute\"/",
            $this->templateSource
        );
    }

    public function testStreamlinedToolbarHasUndoAndRedo(): void
    {
        // History controls live on data-trix-action, not data-trix-attribute
        $this->assertMatchesRegularExpression('/<button[^>]*data-trix-action="undo"/', $this->templateSource);
        $this->assertMatchesRegularExpression('/<button[^>]*data-trix-action="redo"/', $this->templateSource);
    }

    /**
     * @return string[][]
     */
    public static function omittedToolbarButtonProvider(): array
    {
        return [
            // Link, quote, attach, indent/outdent omitted from the streamlined set
            ['data-trix-attribute="href"'],
            ['data-trix-attribute="quote"'],
            ['data-trix-action="attachFiles"'],
            ['data-trix-action="decreaseNestingLevel"'],
            ['data-trix-action="increaseNestingLevel"'],
        ];
    }

    /**
     * @dataProvider omittedToolbarButtonProvider
     */
    public function testStreamlinedToolbarOmitsButton(string $needle): void
    {
        $this->assertStringNotContainsString($needle, $this->templateSource);
    }

    // ========================================================================= //
    // Canonical posted fields
    // ========================================================================= //

    public function testCanonicalTextareaPostsAsMessageConfigEmailMessage(): void
    {
        // Single source of truth for the body, written by both editors
        $this->assertStringContainsString(
            "name: 'messageConfig[emailMessage]'",
            $this->templateSource
        );
        $this->assertStringContainsString(
            "id: 'messageConfig-emailMessage'",
            $this->templateSource
        );
    }

    public function testModeIsPersistedAsMessageConfigEmailMessageMode(): void
    {
        // The new sibling JSON key, enforced by the server-side validator.
        $this->assertMatchesRegularExpression(
            '/<input[^>]*name="messageConfig\[emailMessageMode\]"[^>]*value="\{\{\s*mode\s*\}\}"/',
            $this->templateSource
        );
    }

    public function testCanonicalTextareaUsesForms_Textarea(): void
    {
        // Use forms.textarea (bare textarea) rather than forms.textareaField
        // (full field shell) so the surrounding markup stays our custom shell.
        $this->assertMatchesRegularExpression(
            '/forms\.textarea\(\{[\s\S]*?messageConfig\[emailMessage\]/',
            $this->templateSource
        );
    }

    public function testCodeEditorJsIsAttachedToCanonicalTextarea(): void
    {
        // Monaco mounts onto messageConfig-emailMessage so its onDidChangeModelContent
        // syncs back into the same textarea both editors share.
        $this->assertMatchesRegularExpression(
            "/codeEditor\.includeJs\(\s*'messageConfig-emailMessage'/",
            $this->templateSource
        );
    }

    // ========================================================================= //
    // Asset bundle registration
    // ========================================================================= //

    public function testRegistersMessageEditorAssetBundle(): void
    {
        // The toggle controller + Trix files come from MessageEditorAsset.
        // Other Notifier asset bundles register from inside their templates;
        // we follow that pattern. Drift here means trix.js + message-editor.js
        // never load and the toggle silently fails.
        $this->assertMatchesRegularExpression(
            "/view\.registerAssetBundle\('doublesecretagency\\\\\\\\notifier\\\\\\\\web\\\\\\\\assets\\\\\\\\MessageEditorAsset'\)/",
            $this->templateSource
        );
    }

    // ========================================================================= //
    // Toggle controller bootstrap
    // ========================================================================= //

    public function testInvokesToggleControllerInit(): void
    {
        // The {% js %} block defers init until after the field is in the DOM
        $this->assertMatchesRegularExpression(
            "/notifierMessageEditor\.init\(\s*'email-message-field'\s*\)/",
            $this->templateSource
        );
    }
}
