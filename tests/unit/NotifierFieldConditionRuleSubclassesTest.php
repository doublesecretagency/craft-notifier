<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\fields\conditions\CountryFieldConditionRule;
use craft\fields\conditions\EmptyFieldConditionRule;
use craft\fields\conditions\GeneratedFieldConditionRule;
use craft\fields\conditions\LightswitchFieldConditionRule;
use craft\fields\conditions\LinkFieldConditionRule;
use craft\fields\conditions\MoneyFieldConditionRule;
use craft\fields\conditions\NumberFieldConditionRule;
use craft\fields\conditions\OptionsFieldConditionRule;
use craft\fields\conditions\RelationalFieldConditionRule;
use craft\fields\conditions\TextFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierCountryFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierEmptyFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierGeneratedFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierLightswitchFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierLinkFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierMoneyFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierNumberFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierOptionsFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierRelationalFieldConditionRule;
use doublesecretagency\notifier\conditions\fields\NotifierTextFieldConditionRule;
use doublesecretagency\notifier\conditions\operators\HasChangedOperator;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the per-field condition-rule subclasses that ship
 * the `has changed` operator.
 *
 * Each Notifier subclass under src/conditions/fields/ extends a Craft
 * built-in per-field rule and uses the HasChangedOperator trait to inject
 * the new operator. The contract under test is just that pairing: extend
 * the right Craft parent, use the trait. Behavior is exercised by the
 * trait's own test plus end-to-end manual verification in the sandbox.
 *
 * NotifierDateFieldConditionRule is excluded from this test because Date
 * uses rangeType (not operator) and therefore doesn't use the trait. It
 * has its own dedicated test.
 */
class NotifierFieldConditionRuleSubclassesTest extends TestCase
{
    /**
     * @return array<string, array{0: class-string, 1: class-string}>
     */
    public static function subclassProvider(): array
    {
        return [
            'Text'         => [NotifierTextFieldConditionRule::class,        TextFieldConditionRule::class],
            'Lightswitch'  => [NotifierLightswitchFieldConditionRule::class, LightswitchFieldConditionRule::class],
            'Number'       => [NotifierNumberFieldConditionRule::class,      NumberFieldConditionRule::class],
            'Money'        => [NotifierMoneyFieldConditionRule::class,       MoneyFieldConditionRule::class],
            'Options'      => [NotifierOptionsFieldConditionRule::class,     OptionsFieldConditionRule::class],
            'Country'      => [NotifierCountryFieldConditionRule::class,     CountryFieldConditionRule::class],
            'Link'         => [NotifierLinkFieldConditionRule::class,        LinkFieldConditionRule::class],
            'Relational'   => [NotifierRelationalFieldConditionRule::class,  RelationalFieldConditionRule::class],
            'Empty'        => [NotifierEmptyFieldConditionRule::class,       EmptyFieldConditionRule::class],
            'Generated'    => [NotifierGeneratedFieldConditionRule::class,   GeneratedFieldConditionRule::class],
        ];
    }

    /**
     * @dataProvider subclassProvider
     */
    public function testExtendsExpectedCraftParent(string $notifierClass, string $craftParent): void
    {
        $reflection = new ReflectionClass($notifierClass);
        $this->assertTrue(
            $reflection->isSubclassOf($craftParent),
            sprintf('%s should extend %s', $notifierClass, $craftParent)
        );
    }

    /**
     * @dataProvider subclassProvider
     */
    public function testUsesHasChangedOperatorTrait(string $notifierClass): void
    {
        $reflection = new ReflectionClass($notifierClass);
        $this->assertContains(
            HasChangedOperator::class,
            $reflection->getTraitNames(),
            sprintf('%s should use HasChangedOperator', $notifierClass)
        );
    }
}
