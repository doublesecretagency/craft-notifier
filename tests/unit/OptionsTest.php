<?php
namespace doublesecretagency\notifier\tests\unit;

use doublesecretagency\notifier\enums\Options;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Structural tests for the Options enum.
 *
 * Options is the canonical map of every event type and event the plugin
 * exposes in the CP. The CP edit screen reads it to render the event
 * picker, and Notifier's own dispatch code references the same string
 * keys; drift between the two would silently hide events from the
 * picker or break dispatch routing.
 */
class OptionsTest extends TestCase
{
    private string $optionsSource;
    private ReflectionClass $reflection;

    protected function setUp(): void
    {
        $path = dirname(__DIR__, 2) . '/src/enums/Options.php';
        $this->assertTrue(file_exists($path), "Options.php should exist at: $path");
        $this->optionsSource = file_get_contents($path);
        $this->reflection = new ReflectionClass(Options::class);
    }

    // ========================================================================= //
    // Class shape
    // ========================================================================= //

    public function testIsAbstract(): void
    {
        // Options is a static enum-style holder; instantiating it would be
        // a programming error.
        $this->assertTrue($this->reflection->isAbstract());
    }

    // ========================================================================= //
    // EVENT_TYPE coverage
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function eventTypeKeyProvider(): array
    {
        return [
            ['users'],
            ['entries'],
            ['assets'],
            ['commerce-orders'],
        ];
    }

    /**
     * @dataProvider eventTypeKeyProvider
     */
    public function testEventTypeIncludesKey(string $key): void
    {
        // Each top-level event type must be a key in the EVENT_TYPE map so
        // the CP picker can render it.
        $this->assertArrayHasKey($key, Options::EVENT_TYPE);
    }

    public function testCommerceOrdersHasHumanLabel(): void
    {
        // Drift between the key and the label would render an empty option
        // in the dropdown.
        $this->assertSame('Commerce Orders', Options::EVENT_TYPE['commerce-orders']);
    }

    // ========================================================================= //
    // ALL_EVENTS coverage — Commerce orders branch (PR #33)
    // ========================================================================= //

    public function testCommerceOrdersAppearsInAllEvents(): void
    {
        // The dispatch table for the Commerce branch lives under the same
        // 'commerce-orders' key as the EVENT_TYPE entry.
        $this->assertArrayHasKey('commerce-orders', Options::ALL_EVENTS);
    }

    public function testCommerceOrdersListsBothEventValues(): void
    {
        // Both events must be present and addressable by the value strings
        // the CP form posts back.
        $values = array_column(Options::ALL_EVENTS['commerce-orders'], 'value');
        $this->assertContains('after-complete-order', $values);
        $this->assertContains('after-order-paid', $values);
    }

    public function testCommerceOrdersReferencesOrderEventConstants(): void
    {
        // The 'class' entry is stored as a fully-qualified string (not as
        // a constant reference) so installs without Commerce don't blow up
        // at parse time. Pin the literal form so the strings stay correct.
        $classes = array_column(Options::ALL_EVENTS['commerce-orders'], 'class');
        $this->assertContains(
            'craft\commerce\elements\Order::EVENT_AFTER_COMPLETE_ORDER',
            $classes
        );
        $this->assertContains(
            'craft\commerce\elements\Order::EVENT_AFTER_ORDER_PAID',
            $classes
        );
    }

    // ========================================================================= //
    // ALL_EVENTS coverage: Entry events (Tier 1 expansion)
    // ========================================================================= //

    public function testEntriesAppearsInAllEvents(): void
    {
        $this->assertArrayHasKey('entries', Options::ALL_EVENTS);
    }

    public function testEntriesListsAllFourEventValues(): void
    {
        // Save and propagate were the original two; delete and restore arrived
        // in the Tier 1 expansion. All four must be addressable by their value
        // strings so the CP form posts them back unambiguously.
        $values = array_column(Options::ALL_EVENTS['entries'], 'value');
        $this->assertContains('after-save', $values);
        $this->assertContains('after-propagate', $values);
        $this->assertContains('after-delete', $values);
        $this->assertContains('after-restore', $values);
    }

    public function testEntriesDeleteAndRestoreReferenceEntryEventConstants(): void
    {
        // Delete and restore wire directly to the Element-level event constants
        // on the Entry class. Drift between these strings and the actual
        // constants would silently break dispatch.
        $classes = array_column(Options::ALL_EVENTS['entries'], 'class');
        $this->assertContains('craft\elements\Entry::EVENT_AFTER_DELETE', $classes);
        $this->assertContains('craft\elements\Entry::EVENT_AFTER_RESTORE', $classes);
    }

    // ========================================================================= //
    // ALL_EVENTS coverage: User events (Tier 1 expansion)
    // ========================================================================= //

    public function testUsersListsAllFiveEventValues(): void
    {
        // Propagate (new user) was the original; activate-user was second.
        // Tier 1 added update, delete, and restore. The two propagate-shaped
        // values (after-propagate, after-update) share the same Craft constant
        // but distinguish on firstSave at handler level.
        $values = array_column(Options::ALL_EVENTS['users'], 'value');
        $this->assertContains('after-propagate', $values);
        $this->assertContains('after-update', $values);
        $this->assertContains('after-activate-user', $values);
        $this->assertContains('after-delete', $values);
        $this->assertContains('after-restore', $values);
    }

    public function testUsersUpdateReusesPropagateConstant(): void
    {
        // after-update and after-propagate both ride EVENT_AFTER_PROPAGATE.
        // The handler-level firstSave guard splits "new user" from "updated user".
        $updateEntry = null;
        foreach (Options::ALL_EVENTS['users'] as $event) {
            if ($event['value'] === 'after-update') {
                $updateEntry = $event;
                break;
            }
        }
        $this->assertNotNull($updateEntry, 'after-update entry must exist under users');
        $this->assertSame(
            'craft\elements\User::EVENT_AFTER_PROPAGATE',
            $updateEntry['class']
        );
    }

    public function testUsersDeleteAndRestoreReferenceUserEventConstants(): void
    {
        $classes = array_column(Options::ALL_EVENTS['users'], 'class');
        $this->assertContains('craft\elements\User::EVENT_AFTER_DELETE', $classes);
        $this->assertContains('craft\elements\User::EVENT_AFTER_RESTORE', $classes);
    }

    // ========================================================================= //
    // ALL_EVENTS coverage: Asset events (Tier 1 expansion)
    // ========================================================================= //

    public function testAssetsListsAllFiveEventValues(): void
    {
        // Propagate (new upload) was the original. Tier 1 added move, update,
        // delete, and restore. Propagate, move, and update all share
        // EVENT_AFTER_PROPAGATE; the handler-level firstSave + folder/volume
        // diff splits them into three mutually-exclusive paths.
        $values = array_column(Options::ALL_EVENTS['assets'], 'value');
        $this->assertContains('after-propagate', $values);
        $this->assertContains('after-move', $values);
        $this->assertContains('after-update', $values);
        $this->assertContains('after-delete', $values);
        $this->assertContains('after-restore', $values);
    }

    public function testAssetsMoveAndUpdateReusePropagateConstant(): void
    {
        // after-move and after-update both ride EVENT_AFTER_PROPAGATE; only
        // after-propagate (the new-upload path) was originally wired there.
        // The handler-level guards keep all three from overlapping at runtime.
        $classes = [];
        foreach (Options::ALL_EVENTS['assets'] as $event) {
            if (in_array($event['value'], ['after-move', 'after-update'], true)) {
                $classes[$event['value']] = $event['class'];
            }
        }
        $this->assertArrayHasKey('after-move', $classes);
        $this->assertArrayHasKey('after-update', $classes);
        $this->assertSame('craft\elements\Asset::EVENT_AFTER_PROPAGATE', $classes['after-move']);
        $this->assertSame('craft\elements\Asset::EVENT_AFTER_PROPAGATE', $classes['after-update']);
    }

    public function testAssetsDeleteAndRestoreReferenceAssetEventConstants(): void
    {
        $classes = array_column(Options::ALL_EVENTS['assets'], 'class');
        $this->assertContains('craft\elements\Asset::EVENT_AFTER_DELETE', $classes);
        $this->assertContains('craft\elements\Asset::EVENT_AFTER_RESTORE', $classes);
    }

    // ========================================================================= //
    // Other channel/recipient maps (regression coverage)
    // ========================================================================= //

    public function testMessageTypeIncludesAllFourChannels(): void
    {
        // Email / SMS / Announcement / Flash are the four channels Notifier
        // understands; any addition would also need a Dispatch case branch.
        $this->assertArrayHasKey('email', Options::MESSAGE_TYPE);
        $this->assertArrayHasKey('sms', Options::MESSAGE_TYPE);
        $this->assertArrayHasKey('announcement', Options::MESSAGE_TYPE);
        $this->assertArrayHasKey('flash', Options::MESSAGE_TYPE);
    }

    public function testRecipientsTypeIncludesAllSixStrategies(): void
    {
        // The six recipient strategies must each remain addressable by key
        // so RecipientsService::getRecipients() can dispatch them.
        $this->assertArrayHasKey('current-user', Options::RECIPIENTS_TYPE);
        $this->assertArrayHasKey('all-users', Options::RECIPIENTS_TYPE);
        $this->assertArrayHasKey('all-admins', Options::RECIPIENTS_TYPE);
        $this->assertArrayHasKey('selected-groups', Options::RECIPIENTS_TYPE);
        $this->assertArrayHasKey('selected-users', Options::RECIPIENTS_TYPE);
        $this->assertArrayHasKey('dynamic-recipients', Options::RECIPIENTS_TYPE);
    }
}
