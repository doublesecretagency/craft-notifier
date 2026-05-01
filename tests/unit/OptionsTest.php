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
