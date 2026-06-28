<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Source-level tests for the per-section entry type pair model.
 *
 * Entry notifications match on a flat list of "{sectionId}-{typeId}" pairs
 * (eventConfig['sectionEntryTypes']) rather than two independent flat lists
 * of section ids and entry type ids. This makes each section/entry-type row
 * independent (the same entry type shared across sections no longer collides),
 * while still requiring an entry to match BOTH a selected section and one of
 * its selected entry types.
 *
 * These checks pin the structure across the four touch points: the live
 * matcher (Dispatch), the scheduled query (Messages), the field-layout
 * gathering (Notification), and the checkbox template.
 */
class SectionEntryTypePairsTest extends TestCase
{
    private string $dispatchSource;
    private string $messagesSource;
    private string $notificationSource;
    private string $templateSource;

    protected function setUp(): void
    {
        $root = dirname(__DIR__, 2) . '/src';
        $this->dispatchSource     = file_get_contents("{$root}/models/Dispatch.php");
        $this->messagesSource     = file_get_contents("{$root}/services/Messages.php");
        $this->notificationSource = file_get_contents("{$root}/elements/Notification.php");
        $this->templateSource     = file_get_contents("{$root}/templates/notifications/_edit/event/entries/entry-types.twig");
    }

    // ========================================================================= //
    // Live matcher (Dispatch::_filterEntries)
    // ========================================================================= //

    public function testLiveMatcherReadsSectionEntryTypes(): void
    {
        $this->assertMatchesRegularExpression(
            "/eventConfig\\['sectionEntryTypes'\\]/",
            $this->dispatchSource
        );
    }

    public function testLiveMatcherChecksTheSectionTypePair(): void
    {
        // An entry matches only when its (section, type) pair is selected.
        $this->assertStringContainsString(
            '"{$element->sectionId}-{$element->typeId}"',
            $this->dispatchSource
        );
    }

    public function testLiveMatcherNoLongerReadsFlatEntryTypes(): void
    {
        // The old flat entryTypes key must be gone from the matcher.
        $this->assertDoesNotMatchRegularExpression(
            "/eventConfig\\['entryTypes'\\]/",
            $this->dispatchSource
        );
    }

    // ========================================================================= //
    // Scheduled query (Messages::_buildCandidateQuery)
    // ========================================================================= //

    public function testScheduledQueryReadsSectionEntryTypes(): void
    {
        $this->assertMatchesRegularExpression(
            "/eventConfig\\['sectionEntryTypes'\\]/",
            $this->messagesSource
        );
    }

    public function testScheduledQueryBuildsPerSectionOrConditions(): void
    {
        // The query ORs together (sectionId AND its selected typeIds) blocks,
        // so an entry must match both a section and one of its types.
        $this->assertStringContainsString("['entries.sectionId' => \$sectionId]", $this->messagesSource);
        $this->assertStringContainsString("['entries.typeId' => \$typeIds]", $this->messagesSource);
        $this->assertStringContainsString('->andWhere(', $this->messagesSource);
    }

    // ========================================================================= //
    // Field-layout gathering (Notification)
    // ========================================================================= //

    public function testFieldLayoutGatheringReadsSectionEntryTypes(): void
    {
        // The Field Conditions feature derives its entry types from the pairs.
        $this->assertMatchesRegularExpression(
            "/eventConfig\\['sectionEntryTypes'\\]/",
            $this->notificationSource
        );
    }

    // ========================================================================= //
    // Checkbox template (entry-types.twig)
    // ========================================================================= //

    public function testTemplateBuildsAUniquePairPerRow(): void
    {
        // Each row computes a section/type pair so the id and value are unique
        // even when the same entry type is shared across multiple sections.
        $this->assertStringContainsString("{% set pair = sectionId ~ '-' ~ typeId %}", $this->templateSource);
    }

    public function testTemplateUsesThePairForIdNameValueAndChecked(): void
    {
        $this->assertStringContainsString('id="type-{{ pair }}"', $this->templateSource);
        $this->assertStringContainsString('name="eventConfig[sectionEntryTypes][]"', $this->templateSource);
        $this->assertStringContainsString('value="{{ pair }}"', $this->templateSource);
        $this->assertStringContainsString('pair in sectionEntryTypes', $this->templateSource);
        $this->assertStringContainsString('<label for="type-{{ pair }}">', $this->templateSource);
    }

    public function testTemplateNoLongerUsesTheCollidingTypeIdOnlyMarkup(): void
    {
        // The old shape keyed everything on the (shared) entry type id alone.
        $this->assertStringNotContainsString('name="eventConfig[entryTypes][]"', $this->templateSource);
        $this->assertStringNotContainsString('id="type-{{ typeId }}"', $this->templateSource);
    }
}
