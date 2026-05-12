<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\elements\conditions\LanguageConditionRule;
use craft\elements\conditions\LevelConditionRule;
use craft\elements\conditions\SlugConditionRule;
use craft\elements\conditions\StatusConditionRule;
use craft\elements\conditions\TitleConditionRule;
use craft\elements\conditions\UriConditionRule;
use craft\elements\conditions\entries\SectionConditionRule;
use craft\elements\conditions\entries\TypeConditionRule;
use doublesecretagency\notifier\conditions\attributes\NotifierLanguageConditionRule;
use doublesecretagency\notifier\conditions\attributes\NotifierLevelConditionRule;
use doublesecretagency\notifier\conditions\attributes\NotifierSectionConditionRule;
use doublesecretagency\notifier\conditions\attributes\NotifierSlugConditionRule;
use doublesecretagency\notifier\conditions\attributes\NotifierStatusConditionRule;
use doublesecretagency\notifier\conditions\attributes\NotifierTitleConditionRule;
use doublesecretagency\notifier\conditions\attributes\NotifierTypeConditionRule;
use doublesecretagency\notifier\conditions\attributes\NotifierUriConditionRule;
use doublesecretagency\notifier\conditions\operators\HasChangedAttributeOperator;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the native-attribute rule subclasses that ship the
 * `has changed` operator via the HasChangedAttributeOperator trait.
 *
 * Sibling of NotifierFieldConditionRuleSubclassesTest. PostDate and ExpiryDate
 * are excluded because they extend BaseDateRangeConditionRule and use the
 * rangeType pattern instead of the operator dropdown, they have their own
 * dedicated test files (mirroring the per-field Date subclass split).
 */
class NotifierAttributeConditionRuleSubclassesTest extends TestCase
{
    /**
     * @return array<string, array{0: class-string, 1: class-string}>
     */
    public static function subclassProvider(): array
    {
        return [
            'Title'    => [NotifierTitleConditionRule::class,    TitleConditionRule::class],
            'Slug'     => [NotifierSlugConditionRule::class,     SlugConditionRule::class],
            'Uri'      => [NotifierUriConditionRule::class,      UriConditionRule::class],
            'Status'   => [NotifierStatusConditionRule::class,   StatusConditionRule::class],
            'Level'    => [NotifierLevelConditionRule::class,    LevelConditionRule::class],
            'Language' => [NotifierLanguageConditionRule::class, LanguageConditionRule::class],
            'Section'  => [NotifierSectionConditionRule::class,  SectionConditionRule::class],
            'Type'     => [NotifierTypeConditionRule::class,     TypeConditionRule::class],
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
    public function testUsesHasChangedAttributeOperatorTrait(string $notifierClass): void
    {
        $reflection = new ReflectionClass($notifierClass);
        $this->assertContains(
            HasChangedAttributeOperator::class,
            $reflection->getTraitNames(),
            sprintf('%s should use HasChangedAttributeOperator', $notifierClass)
        );
    }

    /**
     * @dataProvider subclassProvider
     */
    public function testImplementsHasChangedComparisonValue(string $notifierClass): void
    {
        // Each subclass must implement the abstract method. Reflection's
        // getMethod returns the implementation, not the abstract declaration.
        $reflection = new ReflectionClass($notifierClass);
        $this->assertTrue($reflection->hasMethod('hasChangedComparisonValue'));
        $method = $reflection->getMethod('hasChangedComparisonValue');
        $this->assertFalse($method->isAbstract(), sprintf('%s::hasChangedComparisonValue should be implemented', $notifierClass));
    }
}
