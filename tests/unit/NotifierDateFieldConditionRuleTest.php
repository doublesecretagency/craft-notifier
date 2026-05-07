<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\fields\conditions\DateFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierDateFieldConditionRule;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the Date-specific has_changed integration.
 *
 * Date is the one field rule that doesn't use the standard operator
 * dropdown; it uses BaseDateRangeConditionRule's rangeType property
 * with a menu of options like "Today", "This week", "Before...", etc.
 * The valueless entries "has a value" and "is empty" are mixed in
 * (BaseDateRangeConditionRule lines 264-281), and we add "has changed"
 * to the same options list with matching valueless treatment.
 *
 * Because the structural shape is different from the trait-based
 * subclasses, Date gets its own test rather than appearing in the
 * subclass-data-provider table next door.
 */
class NotifierDateFieldConditionRuleTest extends TestCase
{
    private string $ruleSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/conditions/fields/NotifierDateFieldConditionRule.php';
        $this->assertTrue(file_exists($path), "NotifierDateFieldConditionRule.php should exist at: $path");
        $this->ruleSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(NotifierDateFieldConditionRule::class);
    }

    public function testExtendsCraftDateFieldConditionRule(): void
    {
        $this->assertTrue($this->reflection->isSubclassOf(DateFieldConditionRule::class));
    }

    public function testDeclaresRangeTypeHasChangedConstant(): void
    {
        // Date uses the rangeType property (not operator), so we expose the
        // has_changed value as a RANGE_TYPE_* constant rather than reusing
        // OPERATOR_HAS_CHANGED. Same string value (`has_changed`), different
        // structural slot.
        $this->assertSame('has_changed', NotifierDateFieldConditionRule::RANGE_TYPE_HAS_CHANGED);
    }

    public function testRangeTypeOptionsAppendsHasChanged(): void
    {
        // The Date rangeType menu is built by rangeTypeOptions(); appending
        // (instead of replacing) preserves Today / This week / Before / After
        // / Range / has a value / is empty.
        $this->assertMatchesRegularExpression(
            '/protected function rangeTypeOptions\(\): array[\s\S]*?array_merge\(parent::rangeTypeOptions\(\),\s*\[[\s\S]*?self::RANGE_TYPE_HAS_CHANGED\s*=>\s*Craft::t\(\'notifier\', \'has changed\'\)/',
            $this->ruleSource
        );
    }

    public function testMatchElementBranchesOnHasChangedRangeType(): void
    {
        // matchElement() must check $this->rangeType (not $this->operator)
        // since Date uses the rangeType field. The early-return on
        // RANGE_TYPE_HAS_CHANGED keeps the standard date-range matching path
        // intact for every other rangeType value.
        $this->assertMatchesRegularExpression(
            '/public function matchElement\(ElementInterface \$element\): bool[\s\S]*?\$this->rangeType !== self::RANGE_TYPE_HAS_CHANGED[\s\S]*?return parent::matchElement/',
            $this->ruleSource
        );
    }

    public function testMatchElementUsesLiveDirtyAndDiffFallback(): void
    {
        // Same two-tier check as the trait: live isFieldDirty() first (covers
        // entry-saved-per-site), captured-original diff second (covers
        // entry-saved-and-propagated, where markAsClean() has already wiped
        // the live state). EntryEvents::getCapturedOriginal is the public
        // accessor for the pre-save snapshot.
        $this->assertMatchesRegularExpression(
            '/\$element->isFieldDirty\(\$field->handle\)/',
            $this->ruleSource
        );
        $this->assertStringContainsString(
            'EntryEvents::getCapturedOriginal($element->id, $element->siteId)',
            $this->ruleSource
        );
        // Source assigns to local variables for readability
        $this->assertMatchesRegularExpression(
            '/\$element->getFieldValue\(\$field->handle\)/',
            $this->ruleSource
        );
        $this->assertMatchesRegularExpression(
            '/\$original->getFieldValue\(\$field->handle\)/',
            $this->ruleSource
        );
    }

    public function testMatchElementSerializesValuesBeforeCompare(): void
    {
        // Same recursive-dependency guard as the HasChangedOperator trait.
        // Date field values are DateTime objects which compare cleanly with
        // `!=`, but applying serializeValue() uniformly keeps the matchElement
        // shape identical across every Notifier per-field subclass and avoids
        // a future regression if a Date subtype ever returns a more complex
        // value type.
        $this->assertMatchesRegularExpression(
            '/\$field->serializeValue\(/',
            $this->ruleSource
        );
    }

    public function testElementQueryParamShortCircuitsOnHasChanged(): void
    {
        // There's no query-phase equivalent for "has changed since this save."
        // Returning null from elementQueryParam() makes
        // FieldConditionRuleTrait::modifyQuery() skip the SQL filter entirely,
        // matching the behavior of OPERATOR_EMPTY / OPERATOR_NOT_EMPTY in the
        // base class but cleanly rather than via a magic marker string.
        $this->assertMatchesRegularExpression(
            '/protected function elementQueryParam\(\)[\s\S]*?\$this->rangeType === self::RANGE_TYPE_HAS_CHANGED[\s\S]*?return null/',
            $this->ruleSource
        );
    }
}
