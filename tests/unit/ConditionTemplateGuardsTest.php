<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events are triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * Source-level guards on the per-event-type condition includes.
 *
 * The shared `_condition.twig` partial is included unconditionally from every
 * event-type tab so all four builders coexist in the DOM and Craft's native
 * `event-type-<type>` toggle handles which one is visible. Per-type form
 * names and DOM ids (set inside `Notification::getEventCondition()`) keep the
 * builders from colliding. Each tab passes its own `eventType` literal into
 * the include so the partial can resolve the correct condition class.
 *
 * Earlier revisions guarded the include on `notification.eventType == '<type>'`
 * to avoid duplicate ids, but that produced a worse bug: switching event-type
 * tabs in the UI hid the builder until the user saved. The per-type id and
 * name pattern fixes both surfaces. These regex assertions pin the new shape
 * in place against future regression.
 *
 * @since 3.0.0
 */
class ConditionTemplateGuardsTest extends TestCase
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
    // Per-event-type unconditional includes
    // ========================================================================= //

    public function testEntriesTabIncludesConditionWithEntriesEventType(): void
    {
        // The entries tab wraps the include in the entries-only sub-toggle
        // (entries-event-after-save / entries-event-after-propagate) but no
        // longer guards on notification.eventType.
        $source = self::read('entries/condition.twig');
        $this->assertStringContainsString(
            "{% include 'notifier/notifications/_edit/event/_condition' with { eventType: 'entries' } %}",
            $source
        );
        $this->assertStringContainsString(
            'entries-event-after-save entries-event-after-propagate hidden',
            $source
        );
        $this->assertDoesNotMatchRegularExpression(
            "/notification\.eventType\s*==\s*'entries'/",
            $source
        );
    }

    public function testUsersTabIncludesConditionWithUsersEventType(): void
    {
        // The Users tab moved into a folder layout, so the condition wrapper
        // lives in users/condition.twig.
        $source = self::read('users/condition.twig');
        $this->assertStringContainsString(
            "{% include 'notifier/notifications/_edit/event/_condition' with { eventType: 'users' } %}",
            $source
        );
        $this->assertDoesNotMatchRegularExpression(
            "/notification\.eventType\s*==\s*'users'/",
            $source
        );
    }

    public function testUsersTabHidesConditionUntilSubEventIsSet(): void
    {
        // The condition slot stays hidden until the Users Event sub-dropdown
        // is set, mirroring the entries pattern. The sub-dropdown carries
        // toggle:true + targetPrefix '.users-event-' (in users/index.twig),
        // and the condition wrapper carries one toggle class per available
        // event value (after-propagate when a user is created,
        // after-activate-user when a user is activated).
        $index = self::read('users/index.twig');
        $this->assertStringContainsString("targetPrefix: '.users-event-'", $index);

        $condition = self::read('users/condition.twig');
        $this->assertMatchesRegularExpression(
            '/<div class="users-event-after-propagate users-event-after-activate-user hidden">/',
            $condition
        );
    }

    public function testAssetsTabIncludesConditionWithAssetsEventType(): void
    {
        // The Assets tab moved into a folder layout, so the condition wrapper
        // lives in assets/condition.twig.
        $source = self::read('assets/condition.twig');
        $this->assertStringContainsString(
            "{% include 'notifier/notifications/_edit/event/_condition' with { eventType: 'assets' } %}",
            $source
        );
        $this->assertDoesNotMatchRegularExpression(
            "/notification\.eventType\s*==\s*'assets'/",
            $source
        );
    }

    public function testAssetsTabHidesConditionUntilSubEventIsSet(): void
    {
        // Same pattern as users: toggle:true + targetPrefix '.assets-event-'
        // (in assets/index.twig) and a wrapper class per event value
        // on assets/condition.twig.
        $index = self::read('assets/index.twig');
        $this->assertStringContainsString("targetPrefix: '.assets-event-'", $index);

        $condition = self::read('assets/condition.twig');
        $this->assertMatchesRegularExpression(
            '/<div class="assets-event-after-propagate hidden">/',
            $condition
        );
    }

    public function testCommerceOrdersTabIncludesConditionWithCommerceOrdersEventType(): void
    {
        $source = self::read('commerce-orders.twig');
        $this->assertStringContainsString(
            "{% include 'notifier/notifications/_edit/event/_condition' with { eventType: 'commerce-orders' } %}",
            $source
        );
        $this->assertDoesNotMatchRegularExpression(
            "/notification\.eventType\s*==\s*'commerce-orders'/",
            $source
        );
    }

    public function testCommerceOrdersTabHidesConditionUntilSubEventIsSet(): void
    {
        // Same pattern as users / assets: toggle:true + targetPrefix
        // '.commerce-orders-event-' and a wrapper class per event value
        // (after-complete-order, after-order-paid).
        $source = self::read('commerce-orders.twig');
        $this->assertStringContainsString("targetPrefix: '.commerce-orders-event-'", $source);
        $this->assertMatchesRegularExpression(
            '/<div class="commerce-orders-event-after-complete-order commerce-orders-event-after-order-paid hidden">/',
            $source
        );
    }

    // ========================================================================= //
    // Shared partial integrity
    // ========================================================================= //

    public function testSharedConditionPartialPassesEventTypeIntoGetEventCondition(): void
    {
        // The shared partial resolves the condition via Notification::getEventCondition,
        // forwarding the eventType arg so each tab gets the right element-type rules.
        $source = self::read('_condition.twig');
        $this->assertStringContainsString(
            'notification.getEventCondition(eventType)',
            $source
        );
    }

    public function testSharedConditionPartialUsesPerTypeFieldId(): void
    {
        // The wrapping forms.field id and the inline {% css %} selector are
        // both keyed on eventType so the four rendered builders don't collide.
        $source = self::read('_condition.twig');
        $this->assertMatchesRegularExpression(
            '/fieldId\s*=\s*"eventCondition_#\{eventType\}"/',
            $source
        );
        $this->assertStringContainsString(
            '#{{ fieldId }}-field',
            $source
        );
    }

    public function testSharedConditionPartialRendersBuilderHtml(): void
    {
        // Renders the Craft-native condition builder HTML produced by BaseCondition::getBuilderHtml.
        $source = self::read('_condition.twig');
        $this->assertMatchesRegularExpression(
            '/condition\.getBuilderHtml\(\)\|raw/',
            $source
        );
    }

    public function testSharedConditionPartialContainsNoDiagnosticJs(): void
    {
        // Diagnostic console-logging from the rule-add debugging session must
        // not ship to production; pinning the absence catches accidental revival.
        $source = self::read('_condition.twig');
        $this->assertStringNotContainsString('NotifierCondition', $source);
        $this->assertStringNotContainsString('console.log', $source);
    }

}
