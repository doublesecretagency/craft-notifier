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

    public function testDeclaresOperatorHasChangedConstant(): void
    {
        $constants = $this->reflection->getReflectionConstants();
        $found = null;
        foreach ($constants as $const) {
            if ($const->getName() === 'OPERATOR_HAS_CHANGED') {
                $found = $const;
                break;
            }
        }
        $this->assertNotNull($found, 'OPERATOR_HAS_CHANGED constant should be declared on the trait');
        $this->assertSame('has_changed', $found->getValue());
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
            '/protected function operators\(\): array[\s\S]*?array_merge\(parent::operators\(\),\s*\[self::OPERATOR_HAS_CHANGED\]\)/',
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
            '/protected function inputHtml\(\): string[\s\S]*?\$this->operator === self::OPERATOR_HAS_CHANGED[\s\S]*?return \'\'/',
            $this->traitSource
        );
    }

    public function testOverridesModifyQueryMethod(): void
    {
        $this->assertMatchesRegularExpression(
            '/public function modifyQuery\(QueryInterface \$query\): void[\s\S]*?\$this->operator === self::OPERATOR_HAS_CHANGED[\s\S]*?return;/',
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
            'EntryEvents::getCapturedOriginal($element->id, $element->siteId)',
            $this->traitSource
        );
        $this->assertMatchesRegularExpression(
            '/\$this->hasChangedComparisonValue\(\$element\)\s*!=\s*\$this->hasChangedComparisonValue\(\$original\)/',
            $this->traitSource
        );
    }

    public function testMatchElementGuardsAgainstMissingIdAndSiteId(): void
    {
        $this->assertMatchesRegularExpression(
            '/empty\(\$element->id\) \|\| empty\(\$element->siteId\)/',
            $this->traitSource
        );
    }

    public function testImportsEntryEventsAccessor(): void
    {
        $this->assertStringContainsString(
            'use doublesecretagency\\notifier\\helpers\\events\\EntryEvents',
            $this->traitSource
        );
    }
}
