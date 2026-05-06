<?php
namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Source-level guards on the Volume Filter and User Group Filter templates.
 *
 * The CP templates and the runtime in Dispatch.php form a contract: the
 * template emits hidden inputs under specific names, and the runtime reads
 * the same keys from `eventConfig`. Renaming one side without the other
 * silently breaks the gate (notifications stop firing, or fire when they
 * shouldn't), so each side of the contract is pinned here.
 *
 * @since 3.0.0
 */
class EventFilterTemplatesTest extends TestCase
{

    private static function templatePath(string $name): string
    {
        return dirname(__DIR__, 2) . '/src/templates/notifications/_edit/event/' . $name;
    }

    private static function read(string $name): string
    {
        $path = self::templatePath($name);
        if (!file_exists($path)) {
            throw new \RuntimeException("Missing template: $path");
        }
        return file_get_contents($path);
    }

    // ========================================================================= //
    // Volume Filter template
    // ========================================================================= //

    public function testVolumesTemplateExists(): void
    {
        $this->assertFileExists(self::templatePath('assets/volumes.twig'));
    }

    public function testVolumesTemplateUsesCorrectInputName(): void
    {
        // The runtime _filterAssets() reads $eventConfig['volumes'] —
        // the template must emit hidden inputs under exactly that key.
        $source = self::read('assets/volumes.twig');
        $this->assertStringContainsString(
            'name="eventConfig[volumes][]"',
            $source
        );
    }

    public function testVolumesTemplateCallsAvailableVolumesHelper(): void
    {
        // The Twig helper that powers the checkbox list.
        $source = self::read('assets/volumes.twig');
        $this->assertStringContainsString('availableVolumes()', $source);
    }

    public function testVolumesTemplateHidesUntilAssetsEventIsSelected(): void
    {
        // The wrapper carries the .assets-event-after-propagate toggle class
        // so Craft's native event-toggle hides the section until the user
        // picks an Assets event from the dropdown.
        $source = self::read('assets/volumes.twig');
        $this->assertMatchesRegularExpression(
            '/<div class="assets-event-after-propagate hidden">/',
            $source
        );
    }

    public function testVolumesTemplateReadsExistingSelections(): void
    {
        // On edit, the saved volume IDs are checked back on. Reads from the
        // same eventConfig key the runtime gate reads from.
        $source = self::read('assets/volumes.twig');
        $this->assertMatchesRegularExpression(
            '/notification\.eventConfig\.volumes/',
            $source
        );
    }

    // ========================================================================= //
    // User Group Filter template
    // ========================================================================= //

    public function testUserGroupsTemplateExists(): void
    {
        $this->assertFileExists(self::templatePath('users/groups.twig'));
    }

    public function testUserGroupsTemplateUsesCorrectInputName(): void
    {
        // The runtime _filterUsers() reads $eventConfig['userGroups'] —
        // the template must emit hidden inputs under exactly that key.
        $source = self::read('users/groups.twig');
        $this->assertStringContainsString(
            'name="eventConfig[userGroups][]"',
            $source
        );
    }

    public function testUserGroupsTemplateHasUngroupedSentinelRow(): void
    {
        // The pseudo-row for users with no Group assignment uses value="0".
        // Both _filterUsers() (in_array(0, ...)) and the template input must
        // agree on the literal `0`.
        $source = self::read('users/groups.twig');
        $this->assertMatchesRegularExpression(
            '/value="0"/',
            $source
        );
        $this->assertStringContainsString('Ungrouped Users', $source);
    }

    public function testUserGroupsTemplateGuardsOnHavingAtLeastOneGroup(): void
    {
        // If the install has zero User Groups defined, the section hides
        // entirely. The Ungrouped row alone would gate every user out.
        $source = self::read('users/groups.twig');
        $this->assertMatchesRegularExpression(
            '/\{%\s*if\s+availableUserGroups\(\)\|length\s*%\}/',
            $source
        );
    }

    public function testUserGroupsTemplateCallsAvailableUserGroupsHelper(): void
    {
        // Both the guard and the loop iterate over the helper's return value.
        $source = self::read('users/groups.twig');
        $this->assertGreaterThanOrEqual(
            2,
            substr_count($source, 'availableUserGroups()'),
            'Expected availableUserGroups() to power both the guard and the loop'
        );
    }

    public function testUserGroupsTemplateHidesUntilUsersEventIsSelected(): void
    {
        // Wrapper carries both Users event-toggle classes so the section
        // is visible for new-user-created and user-activated alike.
        $source = self::read('users/groups.twig');
        $this->assertMatchesRegularExpression(
            '/<div class="users-event-after-propagate users-event-after-activate-user hidden">/',
            $source
        );
    }

    public function testUserGroupsTemplateReadsExistingSelections(): void
    {
        // On edit, the saved group IDs (and the `0` sentinel) are checked back on.
        $source = self::read('users/groups.twig');
        $this->assertMatchesRegularExpression(
            '/notification\.eventConfig\.userGroups/',
            $source
        );
    }

    public function testUngroupedRowAppearsBeforeRealGroups(): void
    {
        // Ungrouped Users is the conventional first row; renaming it `Other`
        // or shuffling it under the loop changes the UX. Pin the order.
        $source = self::read('users/groups.twig');
        $ungroupedPos = strpos($source, 'Ungrouped Users');
        $loopPos = strpos($source, '{% for groupId,groupName in availableUserGroups() %}');
        $this->assertNotFalse($ungroupedPos);
        $this->assertNotFalse($loopPos);
        $this->assertLessThan($loopPos, $ungroupedPos);
    }

    // ========================================================================= //
    // Folder layout / index includes
    // ========================================================================= //

    public function testAssetsIndexIncludesVolumesAndCondition(): void
    {
        // The Assets event tab pulls in the volumes selector AND the
        // condition builder. Forgetting either include breaks the form.
        $source = self::read('assets/index.twig');
        $this->assertStringContainsString(
            "{% include 'notifier/notifications/_edit/event/assets/volumes' %}",
            $source
        );
        $this->assertStringContainsString(
            "{% include 'notifier/notifications/_edit/event/assets/condition' %}",
            $source
        );
    }

    public function testUsersIndexIncludesGroupsAndCondition(): void
    {
        $source = self::read('users/index.twig');
        $this->assertStringContainsString(
            "{% include 'notifier/notifications/_edit/event/users/groups' %}",
            $source
        );
        $this->assertStringContainsString(
            "{% include 'notifier/notifications/_edit/event/users/condition' %}",
            $source
        );
    }

}
