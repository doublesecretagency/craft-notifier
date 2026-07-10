<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\conditions\operators\HasChangedAttributeOperator;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Source-level tests for the HasChangedAttributeOperator trait.
 *
 * Sibling of HasChangedOperatorTraitTest. Same overall shape (operators,
 * operatorLabel, inputHtml, modifyQuery overrides + matchElement two-tier
 * logic) but the matchElement path here uses a single hasChangedComparisonValue()
 * call per side instead of looping field instances. Each native attribute
 * rule subclass (Title, Slug, Status, etc.) implements that abstract method
 * to declare which value the rule's has_changed semantics should diff.
 */
class HasChangedAttributeOperatorTraitTest extends TestCase
{
    private string $traitSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/conditions/operators/HasChangedAttributeOperator.php';
        $this->assertTrue(file_exists($path), "HasChangedAttributeOperator.php should exist at: $path");
        $this->traitSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(HasChangedAttributeOperator::class);
    }

    public function testIsTrait(): void
    {
        $this->assertTrue($this->reflection->isTrait());
    }

    public function testDeclaresNoTraitConstant(): void
    {
        // Trait constants fatal at compile time on PHP < 8.2 ("Traits cannot
        // have constants"), and Craft 4 floors PHP at 8.0.2. The operator value
        // lives on the shared HasChangedOperatorInterface instead (interface
        // constants are legal on every PHP version). Regression pin for that fix.
        $this->assertEmpty(
            $this->reflection->getReflectionConstants(),
            'HasChangedAttributeOperator must not declare any constant (fatals on PHP < 8.2)'
        );
        $this->assertStringContainsString(
            'HasChangedOperatorInterface::OPERATOR_HAS_CHANGED',
            $this->traitSource
        );
    }

    public function testDeclaresAbstractComparisonValueMethod(): void
    {
        // Each consuming subclass must provide its own value-to-compare. The
        // abstract method declaration on the trait is the contract.
        $this->assertTrue($this->reflection->hasMethod('hasChangedComparisonValue'));
        $method = $this->reflection->getMethod('hasChangedComparisonValue');
        $this->assertTrue($method->isAbstract());
    }

    // ========================================================================= //
    // Required method overrides
    // ========================================================================= //

    public function testOverridesOperatorsMethod(): void
    {
        $this->assertMatchesRegularExpression(
            '/protected function operators\(\): array[\s\S]*?array_merge\(parent::operators\(\),\s*\[HasChangedOperatorInterface::OPERATOR_HAS_CHANGED\]\)/',
            $this->traitSource
        );
    }

    public function testOverridesOperatorLabelMethod(): void
    {
        $this->assertStringContainsString(
            "Craft::t('notifier', 'has changed')",
            $this->traitSource
        );
    }

    public function testOverridesInputHtmlMethod(): void
    {
        $this->assertMatchesRegularExpression(
            '/protected function inputHtml\(\): string[\s\S]*?\$this->operator === HasChangedOperatorInterface::OPERATOR_HAS_CHANGED[\s\S]*?return \'\'/',
            $this->traitSource
        );
    }

    public function testOverridesModifyQueryMethod(): void
    {
        $this->assertMatchesRegularExpression(
            '/public function modifyQuery\(QueryInterface \$query\): void[\s\S]*?\$this->operator === HasChangedOperatorInterface::OPERATOR_HAS_CHANGED[\s\S]*?return;/',
            $this->traitSource
        );
    }

    public function testOverridesMatchElementMethod(): void
    {
        $this->assertMatchesRegularExpression(
            '/public function matchElement\(ElementInterface \$element\): bool/',
            $this->traitSource
        );
    }

    // ========================================================================= //
    // matchElement diffs the comparison value against the captured original
    // ========================================================================= //

    public function testMatchElementDiffsAgainstCapturedOriginal(): void
    {
        $this->assertStringContainsString(
            'Originals::get($element)',
            $this->traitSource
        );
        $this->assertMatchesRegularExpression(
            '/\$this->hasChangedComparisonValue\(\$element\)\s*!=\s*\$this->hasChangedComparisonValue\(\$original\)/',
            $this->traitSource
        );
    }

    public function testImportsOriginalsRegistry(): void
    {
        $this->assertStringContainsString(
            'use doublesecretagency\\notifier\\helpers\\events\\Originals',
            $this->traitSource
        );
    }
}
