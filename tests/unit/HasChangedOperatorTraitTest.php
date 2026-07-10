<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\conditions\operators\HasChangedOperator;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Source-level tests for the HasChangedOperator trait.
 *
 * The trait is composed into the per-field rule subclasses in
 * src/conditions/fields/. Exercising it via instantiation would require
 * a full Craft bootstrap (the parent classes touch fieldInstances() and
 * Element::isFieldDirty()), so the structural-and-source-level approach
 * here pins the contract: the operator constant is declared, the four
 * expected method overrides exist with the correct visibility and
 * signatures, the operator-detection branch reaches the captured-original
 * accessor on EntryEvents, and the two-tier check (live dirty state
 * first, value-diff fallback second) is intact.
 *
 * If any one of these source-level invariants drifts during a future
 * cleanup, the next session loses the ability to dispatch on per-field
 * change semantics in either the per-site `entry-saved` event or the
 * propagated event without anyone noticing until manual sandbox QA.
 */
class HasChangedOperatorTraitTest extends TestCase
{
    private string $traitSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/conditions/operators/HasChangedOperator.php';
        $this->assertTrue(file_exists($path), "HasChangedOperator.php should exist at: $path");
        $this->traitSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(HasChangedOperator::class);
    }

    public function testIsTrait(): void
    {
        $this->assertTrue($this->reflection->isTrait());
    }

    public function testDeclaresNoTraitConstant(): void
    {
        // Trait constants fatal at compile time on PHP < 8.2 ("Traits cannot
        // have constants"), and Craft 4 floors PHP at 8.0.2. So the operator
        // value must NOT live on the trait; it lives on the shared
        // HasChangedOperatorInterface (interface constants are legal on every
        // PHP version). This test is the regression pin for that fix; if a
        // future edit reintroduces a `const` on the trait, it breaks here
        // before it can fatal on a real Craft 4 install.
        $this->assertEmpty(
            $this->reflection->getReflectionConstants(),
            'HasChangedOperator must not declare any constant (fatals on PHP < 8.2)'
        );

        // The trait references the interface constant rather than declaring
        // its own; downstream code (matchElement, inputHtml) relies on the
        // literal string `has_changed` to detect the operator branch.
        $this->assertStringContainsString(
            'HasChangedOperatorInterface::OPERATOR_HAS_CHANGED',
            $this->traitSource
        );
    }

    // ========================================================================= //
    // Required method overrides
    // ========================================================================= //

    public function testOverridesOperatorsMethod(): void
    {
        // The operator dropdown is rendered from operators(); the trait must
        // append OPERATOR_HAS_CHANGED to the parent's list rather than
        // replacing it (otherwise contains/equals/etc. disappear).
        $this->assertTrue($this->reflection->hasMethod('operators'));
        $this->assertMatchesRegularExpression(
            '/protected function operators\(\): array[\s\S]*?array_merge\(parent::operators\(\),\s*\[HasChangedOperatorInterface::OPERATOR_HAS_CHANGED\]\)/',
            $this->traitSource
        );
    }

    public function testOverridesOperatorLabelMethod(): void
    {
        // The dropdown label for the new operator is "has changed" (lowercase
        // to match Craft's convention of "contains", "is set", etc.).
        $this->assertTrue($this->reflection->hasMethod('operatorLabel'));
        $this->assertStringContainsString(
            "Craft::t('notifier', 'has changed')",
            $this->traitSource
        );
    }

    public function testOverridesInputHtmlMethod(): void
    {
        // For the has_changed operator the rule is valueless (there's nothing
        // to compare against; it's a boolean "did this change" check), so
        // inputHtml() must return an empty string. Mirrors the precedent set by
        // BaseTextConditionRule for OPERATOR_EMPTY / OPERATOR_NOT_EMPTY, where
        // returning '' tells the framework not to render a value-input below
        // the operator dropdown.
        $this->assertTrue($this->reflection->hasMethod('inputHtml'));
        $this->assertMatchesRegularExpression(
            '/protected function inputHtml\(\): string[\s\S]*?\$this->operator === HasChangedOperatorInterface::OPERATOR_HAS_CHANGED[\s\S]*?return \'\'/',
            $this->traitSource
        );
    }

    public function testOverridesModifyQueryMethod(): void
    {
        // No query-phase equivalent for dirty state. modifyQuery() must
        // early-return on has_changed so the standard query-modifier code path
        // doesn't attempt to translate has_changed into a SQL clause (which
        // would either silently produce no filter or, worse, produce a
        // mistranslated one).
        $this->assertTrue($this->reflection->hasMethod('modifyQuery'));
        $this->assertMatchesRegularExpression(
            '/public function modifyQuery\(QueryInterface \$query\): void[\s\S]*?\$this->operator === HasChangedOperatorInterface::OPERATOR_HAS_CHANGED[\s\S]*?return;/',
            $this->traitSource
        );
    }

    public function testOverridesMatchElementMethod(): void
    {
        $this->assertTrue($this->reflection->hasMethod('matchElement'));
        $this->assertMatchesRegularExpression(
            '/public function matchElement\(ElementInterface \$element\): bool/',
            $this->traitSource
        );
    }

    // ========================================================================= //
    // Two-tier match: live dirty state first, value-diff against captured original second
    // ========================================================================= //

    public function testMatchElementUsesLiveIsFieldDirtyFirst(): void
    {
        // For per-site entry-saved events, Craft hasn't yet called
        // markAsClean(), so the live dirty flag is authoritative. The trait
        // checks isFieldDirty() on each fieldInstances() hit before falling
        // back to the slower diff path.
        $this->assertMatchesRegularExpression(
            '/foreach \(\$fieldInstances as \$field\) \{[\s\S]*?\$element->isFieldDirty\(\$field->handle\)/',
            $this->traitSource
        );
    }

    public function testMatchElementFallsBackToCapturedOriginalDiff(): void
    {
        // For the propagated event, dirty state is gone by the time the
        // bridged afterApplyDraft handler fires. The diff against the
        // pre-save original captured at beforeSave is the only way to detect
        // the change at that lifecycle point. Originals::get() is the
        // polymorphic accessor that works across every element type the
        // plugin captures (Entry, Asset, User, Commerce Product, etc.).
        $this->assertStringContainsString(
            'Originals::get($element)',
            $this->traitSource
        );
        // The diff itself; the source assigns to local variables first for
        // readability, so match either inline or via locals
        $this->assertMatchesRegularExpression(
            '/\$element->getFieldValue\(\$field->handle\)/',
            $this->traitSource
        );
        $this->assertMatchesRegularExpression(
            '/\$original->getFieldValue\(\$field->handle\)/',
            $this->traitSource
        );
        $this->assertMatchesRegularExpression(
            '/!=/',
            $this->traitSource
        );
    }

    public function testMatchElementGuardsAgainstMissingOriginal(): void
    {
        // The captured-original lookup returns null for elements that weren't
        // captured (e.g. a brand-new element on its first save, where the
        // pre-save state doesn't exist yet). Bail to false in that case.
        $this->assertMatchesRegularExpression(
            '/Originals::get\(\$element\)[\s\S]*?if\s*\(!\$original\)\s*\{\s*return\s+false/',
            $this->traitSource
        );
    }

    public function testMatchElementSerializesValuesBeforeCompare(): void
    {
        // Relational and complex field values are object graphs (ElementQuery,
        // ElementCollection, etc.) with cyclic property references; PHP's `!=`
        // operator can't traverse them without hitting "Nesting level too deep
        // - recursive dependency". Serializing via `$field->serializeValue()`
        // produces a flat scalar/array representation safe to compare with `!=`.
        // Without this guard, any rule on a Categories / Entries / Tags / Assets
        // / Users field would crash the dispatch handler at match time.
        $this->assertMatchesRegularExpression(
            '/\$field->serializeValue\(/',
            $this->traitSource
        );
    }

    public function testImportsOriginalsRegistry(): void
    {
        // The diff fallback reaches across to the central Originals registry
        // for the pre-save snapshot. Without the import, the accessor reference
        // at the bottom of matchElement() would resolve to a non-existent class
        // in the operators namespace.
        $this->assertStringContainsString(
            'use doublesecretagency\\notifier\\helpers\\events\\Originals',
            $this->traitSource
        );
    }
}
