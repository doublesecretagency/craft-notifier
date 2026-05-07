<?php
namespace doublesecretagency\notifier\tests\unit;

use craft\elements\conditions\entries\EntryCondition;
use doublesecretagency\notifier\conditions\NotifierEntryCondition;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural test for the Notifier-scoped EntryCondition subclass.
 *
 * NotifierEntryCondition exists so plugin-only condition rules (the
 * `has_changed`-aware per-field subclasses, plus any future Notifier-only
 * rules) can be registered without leaking into Craft's CP entries-index
 * filter or any other consumer of EntryCondition::class.
 *
 * The subclass relationship is the entire contract: built-in entry rules
 * are inherited via parent::selectableConditionRules(), and Yii event
 * handlers registered against EntryCondition::class still fire on subclass
 * instances. Breaking the inheritance silently drops every shared rule.
 */
class NotifierEntryConditionTest extends TestCase
{
    public function testIsSubclassOfEntryCondition(): void
    {
        $reflection = new ReflectionClass(NotifierEntryCondition::class);
        $this->assertTrue($reflection->isSubclassOf(EntryCondition::class));
    }
}
