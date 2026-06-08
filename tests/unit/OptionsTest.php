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
            ['craft-commerce-orders'],
            ['craft-commerce-products'],
            ['digital-products-products'],
            ['digital-products-licenses'],
            ['solspace-calendar-events'],
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
        $this->assertSame('Commerce Orders', Options::EVENT_TYPE['craft-commerce-orders']);
    }

    public function testTier2CategoryLabels(): void
    {
        // Pin the canonical dropdown labels for the four new Tier 2 categories.
        // Drift here would render misleading or empty options in the CP.
        $this->assertSame('Commerce Products', Options::EVENT_TYPE['craft-commerce-products']);
        $this->assertSame('Digital Products', Options::EVENT_TYPE['digital-products-products']);
        $this->assertSame('Digital Product Licenses', Options::EVENT_TYPE['digital-products-licenses']);
        $this->assertSame('Solspace Calendar', Options::EVENT_TYPE['solspace-calendar-events']);
    }

    public function testEventTypeOrderMatchesCanonicalSequence(): void
    {
        // The order is load-bearing - the CP dropdown renders options in
        // source order. Native elements first, then the plugin event types,
        // then the data-source event types (System Snapshot, Dynamic Data,
        // RSS/JSON Feed) last.
        $this->assertSame(
            [
                'entries',
                'assets',
                'users',
                'craft-commerce-orders',
                'craft-commerce-products',
                'digital-products-products',
                'digital-products-licenses',
                'solspace-calendar-events',
                'system-snapshot',
                'dynamic-data',
                'feed',
            ],
            array_keys(Options::EVENT_TYPE)
        );
    }

    public function testAllEventsOrderMatchesEventTypeOrder(): void
    {
        // ALL_EVENTS top-level key order must match EVENT_TYPE so any consumer
        // that iterates them side-by-side stays consistent.
        $this->assertSame(
            array_keys(Options::EVENT_TYPE),
            array_keys(Options::ALL_EVENTS)
        );
    }

    // ========================================================================= //
    // EVENT_TYPE_GROUPED, dropdown shape with plugin optgroups
    // ========================================================================= //

    public function testEventTypeGroupedCoversEverySlug(): void
    {
        // Every flat EVENT_TYPE slug must appear in the grouped variant; the
        // dropdown is the consumer and must be able to render every category.
        foreach (array_keys(Options::EVENT_TYPE) as $slug) {
            $this->assertArrayHasKey(
                $slug,
                Options::EVENT_TYPE_GROUPED,
                "Slug '{$slug}' missing from EVENT_TYPE_GROUPED"
            );
        }
    }

    public function testEventTypeGroupedDeclaresEveryOptgroupInOrder(): void
    {
        // Pin the optgroup labels and their order: native elements first, then
        // one optgroup per plugin (Craft Commerce, Digital Products, Solspace
        // Calendar), then the data-source event types last. Drift here would
        // re-shape the CP dropdown.
        $optgroups = [];
        foreach (Options::EVENT_TYPE_GROUPED as $key => $value) {
            if (is_int($key) && is_array($value) && isset($value['optgroup'])) {
                $optgroups[] = $value['optgroup'];
            }
        }
        $this->assertSame(
            ['Native Elements', 'Craft Commerce', 'Digital Products', 'Solspace Calendar', 'Other Data Sources'],
            $optgroups
        );
    }

    public function testEventTypeGroupedInnerLabelsAreShortenedWhereParentDisambiguates(): void
    {
        // Inside the Digital Products optgroup, the inner labels drop the
        // "Digital" prefix because the optgroup heading already supplies it.
        // Inside the Solspace Calendar optgroup, "Calendar Events" stays full.
        $this->assertSame('Products',       Options::EVENT_TYPE_GROUPED['digital-products-products']);
        $this->assertSame('Licenses',       Options::EVENT_TYPE_GROUPED['digital-products-licenses']);
        $this->assertSame('Calendar Events', Options::EVENT_TYPE_GROUPED['solspace-calendar-events']);
    }

    // ========================================================================= //
    // ALL_EVENTS coverage, Commerce orders branch (PR #33)
    // ========================================================================= //

    public function testCommerceOrdersAppearsInAllEvents(): void
    {
        // The dispatch table for the Commerce branch lives under the same
        // 'craft-commerce-orders' key as the EVENT_TYPE entry.
        $this->assertArrayHasKey('craft-commerce-orders', Options::ALL_EVENTS);
    }

    public function testCommerceOrdersListsBothEventValues(): void
    {
        // Both events must be present and addressable by the value strings
        // the CP form posts back.
        $values = array_column(Options::ALL_EVENTS['craft-commerce-orders'], 'value');
        $this->assertContains('after-complete-order', $values);
        $this->assertContains('after-order-paid', $values);
    }

    public function testCommerceOrdersReferencesOrderEventConstants(): void
    {
        // The 'class' entry is stored as a fully-qualified string (not as
        // a constant reference) so installs without Commerce don't blow up
        // at parse time. Pin the literal form so the strings stay correct.
        $classes = array_column(Options::ALL_EVENTS['craft-commerce-orders'], 'class');
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

    public function testUsersIncludesAfterAssignToGroups(): void
    {
        // Tier 2 added the assignment event, slotted under the existing
        // users category. It rides the Users service event (not the User
        // element event), so its class string points at Users::EVENT_...
        $values = array_column(Options::ALL_EVENTS['users'], 'value');
        $this->assertContains('after-assign-to-groups', $values);

        $classes = array_column(Options::ALL_EVENTS['users'], 'class');
        $this->assertContains(
            'craft\services\Users::EVENT_AFTER_ASSIGN_USER_TO_GROUPS',
            $classes
        );
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
    // ALL_EVENTS coverage: Tier 2 categories
    // ========================================================================= //

    /**
     * @return string[][]
     */
    public static function tier2CategoryProvider(): array
    {
        return [
            ['craft-commerce-products', 'craft\commerce\elements\Product'],
            ['digital-products-products', 'craft\digitalproducts\elements\Product'],
            ['digital-products-licenses', 'craft\digitalproducts\elements\License'],
            ['solspace-calendar-events', 'Solspace\Calendar\Elements\Event'],
        ];
    }

    /**
     * @dataProvider tier2CategoryProvider
     */
    public function testTier2CategoryListsSavedDeletedRestored(string $category): void
    {
        // Every Tier 2 category ships save / delete / restore as a triplet,
        // matching the symmetric-parity precedent from Tier 1.
        // The save event rides EVENT_AFTER_PROPAGATE (once per element) rather
        // than EVENT_AFTER_SAVE (once per site), so its value is 'after-propagate'.
        $values = array_column(Options::ALL_EVENTS[$category], 'value');
        $this->assertContains('after-propagate', $values);
        $this->assertContains('after-delete', $values);
        $this->assertContains('after-restore', $values);
    }

    /**
     * @dataProvider tier2CategoryProvider
     */
    public function testTier2CategoryReferencesElementEventConstants(string $category, string $elementClass): void
    {
        // The class strings are stored as fully-qualified literal strings so
        // installs without the source plugin don't blow up at parse time.
        // Pin all three constants per category.
        $classes = array_column(Options::ALL_EVENTS[$category], 'class');
        $this->assertContains("{$elementClass}::EVENT_AFTER_PROPAGATE", $classes);
        $this->assertContains("{$elementClass}::EVENT_AFTER_DELETE", $classes);
        $this->assertContains("{$elementClass}::EVENT_AFTER_RESTORE", $classes);
    }

    // ========================================================================= //
    // Other channel/recipient maps (regression coverage)
    // ========================================================================= //

    public function testMessageTypeIncludesAllNineChannels(): void
    {
        // The nine channels Notifier understands; any addition would also need a Dispatch case branch.
        $this->assertArrayHasKey('email', Options::MESSAGE_TYPE);
        $this->assertArrayHasKey('sms', Options::MESSAGE_TYPE);
        $this->assertArrayHasKey('announcement', Options::MESSAGE_TYPE);
        $this->assertArrayHasKey('flash', Options::MESSAGE_TYPE);
        $this->assertArrayHasKey('pushover', Options::MESSAGE_TYPE);
        $this->assertArrayHasKey('ntfy', Options::MESSAGE_TYPE);
        $this->assertArrayHasKey('slack', Options::MESSAGE_TYPE);
        $this->assertArrayHasKey('bluesky', Options::MESSAGE_TYPE);
        $this->assertArrayHasKey('mqtt', Options::MESSAGE_TYPE);
    }

    public function testMessageTypeIconCoversEveryMessageType(): void
    {
        // Every message type must declare an icon, so the manual-send action
        // menu never falls through to a generic placeholder.
        foreach (array_keys(Options::MESSAGE_TYPE) as $type) {
            $this->assertArrayHasKey($type, Options::MESSAGE_TYPE_ICON,
                "Message type '{$type}' must declare an icon in MESSAGE_TYPE_ICON");
        }
    }

    public function testRecipientsTypeIncludesAllTenStrategies(): void
    {
        // The ten recipient strategies must each remain addressable by key.
        $this->assertArrayHasKey('current-user', Options::RECIPIENTS_TYPE);
        $this->assertArrayHasKey('all-users', Options::RECIPIENTS_TYPE);
        $this->assertArrayHasKey('all-admins', Options::RECIPIENTS_TYPE);
        $this->assertArrayHasKey('selected-groups', Options::RECIPIENTS_TYPE);
        $this->assertArrayHasKey('selected-users', Options::RECIPIENTS_TYPE);
        $this->assertArrayHasKey('dynamic-recipients', Options::RECIPIENTS_TYPE);
        $this->assertArrayHasKey('ntfy-topics', Options::RECIPIENTS_TYPE);
        $this->assertArrayHasKey('slack-channels', Options::RECIPIENTS_TYPE);
        $this->assertArrayHasKey('bluesky-accounts', Options::RECIPIENTS_TYPE);
        $this->assertArrayHasKey('mqtt-topics', Options::RECIPIENTS_TYPE);
    }

    public function testAllowedRecipientTypesMapIsExhaustive(): void
    {
        // Every message type must have an entry in the allowed-recipient map
        foreach (array_keys(Options::MESSAGE_TYPE) as $messageType) {
            $this->assertArrayHasKey(
                $messageType,
                Options::ALLOWED_RECIPIENT_TYPES,
                "ALLOWED_RECIPIENT_TYPES missing entry for message type: {$messageType}"
            );
        }
    }

    public function testAllowedRecipientTypesReferenceValidRecipients(): void
    {
        // Every referenced recipient-type key must exist in RECIPIENTS_TYPE
        foreach (Options::ALLOWED_RECIPIENT_TYPES as $messageType => $recipientTypes) {
            foreach ($recipientTypes as $recipientType) {
                $this->assertArrayHasKey(
                    $recipientType,
                    Options::RECIPIENTS_TYPE,
                    "ALLOWED_RECIPIENT_TYPES[{$messageType}] references unknown recipient type: {$recipientType}"
                );
            }
        }
    }

    public function testNtfyPriorityMapHasFiveLevels(): void
    {
        $this->assertCount(5, Options::NTFY_PRIORITY);
        $this->assertArrayHasKey('1', Options::NTFY_PRIORITY);
        $this->assertArrayHasKey('5', Options::NTFY_PRIORITY);
    }

    public function testMqttQosMapHasThreeLevels(): void
    {
        // QoS levels 0, 1, 2 map to the MQTT delivery guarantees.
        $this->assertCount(3, Options::MQTT_QOS);
        $this->assertArrayHasKey('0', Options::MQTT_QOS);
        $this->assertArrayHasKey('1', Options::MQTT_QOS);
        $this->assertArrayHasKey('2', Options::MQTT_QOS);
    }

    public function testMqttVersionMapShipsThreeOneOneAndThreeOne(): void
    {
        // 3.1.1 ships as the default; 3.1 is offered for older brokers.
        // 5.0 is intentionally absent until a supporting transport exists.
        $this->assertArrayHasKey('3.1.1', Options::MQTT_VERSION);
        $this->assertArrayHasKey('3.1', Options::MQTT_VERSION);
        $this->assertArrayNotHasKey('5.0', Options::MQTT_VERSION);
    }

    public function testMqttIconIsSet(): void
    {
        // No MQTT brand icon exists; tower-broadcast is the chosen Font Awesome glyph.
        $this->assertSame('tower-broadcast', Options::MESSAGE_TYPE_ICON['mqtt']);
    }

    // ========================================================================= //
    // ALL_EVENTS coverage: manually-triggered sub-event
    // ========================================================================= //

    /**
     * @dataProvider eventTypeKeyProvider
     */
    public function testEveryEventTypeOffersManuallyTriggered(string $key): void
    {
        // The manual-trigger feature adds a `manually-triggered` sub-event to
        // every element-type dropdown so any element type can be fired on demand.
        $values = array_column(Options::ALL_EVENTS[$key], 'value');
        $this->assertContains('manually-triggered', $values);
    }

    /**
     * @dataProvider eventTypeKeyProvider
     */
    public function testManuallyTriggeredIsTheLastSubEvent(string $key): void
    {
        // It sits last in each list, below the event-driven and time-based
        // triggers, so the dropdown leads with the more common cases.
        $events = Options::ALL_EVENTS[$key];
        $last = $events[array_key_last($events)];
        $this->assertSame('manually-triggered', $last['value']);
        $this->assertSame('When manually triggered', $last['label']);
    }

    public function testManuallyTriggeredHasNoEventClass(): void
    {
        // Manual triggers aren't backed by a Yii event, so the `class` key
        // is intentionally omitted from every manually-triggered entry.
        foreach (Options::ALL_EVENTS as $key => $events) {
            $last = $events[array_key_last($events)];
            $this->assertArrayNotHasKey('class', $last,
                "manually-triggered entry under '{$key}' must not declare a class");
        }
    }

    // ========================================================================= //
    // ALL_EVENTS coverage: scheduled trigger events
    // ========================================================================= //

    /**
     * @dataProvider eventTypeKeyProvider
     */
    public function testEveryEventTypeOffersDateReached(string $key): void
    {
        // "When a date is reached" is a poll-driven trigger offered for
        // every element type.
        $values = array_column(Options::ALL_EVENTS[$key], 'value');
        $this->assertContains('date-reached', $values);
    }

    public function testDateReachedIsTheSecondToLastSubEvent(): void
    {
        // date-reached sits directly above manually-triggered, so the two
        // non-Yii triggers close out every element-type list together.
        // The data-source event types are exceptions: RSS Feed ships one event,
        // and System Snapshot / Dynamic Data use a recurring-schedule trigger.
        foreach (Options::ALL_EVENTS as $key => $events) {
            if (in_array($key, ['feed', 'system-snapshot', 'dynamic-data'], true)) {
                continue;
            }
            $secondToLast = $events[count($events) - 2];
            $this->assertSame('date-reached', $secondToLast['value'],
                "date-reached must be the second-to-last sub-event under '{$key}'");
        }
    }

    public function testDateReachedLabelMentionsScheduled(): void
    {
        // The label is "When a scheduled date is reached", distinguishing it
        // from the event-driven triggers in the dropdown.
        foreach (Options::ALL_EVENTS as $key => $events) {
            foreach ($events as $event) {
                if ('date-reached' === $event['value']) {
                    $this->assertSame('When a scheduled date is reached', $event['label']);
                }
            }
        }
    }

    // ========================================================================= //
    // ALL_EVENTS coverage: RSS Feed event type
    // ========================================================================= //

    public function testFeedAppearsInAllThreeEventTypeLookups(): void
    {
        // RSS Feed is a top-level event type with no third-party plugin
        // dependency, so it must appear in every lookup.
        $this->assertArrayHasKey('feed', Options::EVENT_TYPE);
        $this->assertArrayHasKey('feed', Options::EVENT_TYPE_GROUPED);
        $this->assertArrayHasKey('feed', Options::ALL_EVENTS);
    }

    public function testFeedLabelIsExact(): void
    {
        // The user-visible label is pinned so CP drift is caught early.
        $this->assertSame('RSS/JSON Feed', Options::EVENT_TYPE['feed']);
        $this->assertSame('RSS/JSON Feed', Options::EVENT_TYPE_GROUPED['feed']);
    }

    public function testFeedShipsExactlyOneEvent(): void
    {
        // There is one event under RSS Feed: "When a new RSS feed item is found".
        // Adding a sibling event later means revisiting the CP template.
        $events = Options::ALL_EVENTS['feed'];
        $this->assertCount(1, $events);
        $this->assertSame('new-item', $events[0]['value']);
        $this->assertSame('When a new RSS feed item is found', $events[0]['label']);
    }

    public function testFeedEventHasNoEventClass(): void
    {
        // The RSS event is poll-driven, not backed by a Yii event, so no class.
        $events = Options::ALL_EVENTS['feed'];
        $this->assertArrayNotHasKey('class', $events[0]);
    }

    public function testDataSourcesGroupComesLastInOrder(): void
    {
        // In the dropdown's grouped form, the data-source event types sit in a
        // trailing "Other Data Sources" optgroup, in the order System Snapshot,
        // Dynamic Data, RSS/JSON Feed - after every plugin optgroup.
        $keys = array_keys(Options::EVENT_TYPE_GROUPED);

        // Find the "Other Data Sources" optgroup divider
        $dividerIndex = null;
        foreach ($keys as $i => $key) {
            $value = Options::EVENT_TYPE_GROUPED[$key];
            if (is_int($key) && is_array($value) && 'Other Data Sources' === ($value['optgroup'] ?? null)) {
                $dividerIndex = $i;
                break;
            }
        }
        $this->assertNotNull($dividerIndex, 'Missing the "Other Data Sources" optgroup');

        // The three data sources follow the divider, in order, and close out the list
        $this->assertSame('system-snapshot', $keys[$dividerIndex + 1]);
        $this->assertSame('dynamic-data',    $keys[$dividerIndex + 2]);
        $this->assertSame('feed',            $keys[$dividerIndex + 3]);
        $this->assertArrayNotHasKey($dividerIndex + 4, $keys, 'Data sources must be the final group');
    }

    public function testEntriesOffersPendingToLive(): void
    {
        // The Pending-to-Live trigger is entry-specific; only entries carry
        // a Post Date whose passing drives a status transition.
        $values = array_column(Options::ALL_EVENTS['entries'], 'value');
        $this->assertContains('pending-to-live', $values);
    }

    public function testPendingToLiveIsEntriesOnly(): void
    {
        // No other element type exposes the entries-only Pending-to-Live event.
        foreach (Options::ALL_EVENTS as $key => $events) {
            if ('entries' === $key) {
                continue;
            }
            $values = array_column($events, 'value');
            $this->assertNotContains('pending-to-live', $values,
                "'{$key}' must not offer the entries-only pending-to-live event");
        }
    }

    public function testScheduledEventsHaveNoEventClass(): void
    {
        // date-reached and pending-to-live are poll-driven, not backed by a
        // Yii event, so neither declares a `class` key.
        foreach (Options::ALL_EVENTS as $key => $events) {
            foreach ($events as $event) {
                if (in_array($event['value'], ['date-reached', 'pending-to-live'], true)) {
                    $this->assertArrayNotHasKey('class', $event,
                        "scheduled event '{$event['value']}' under '{$key}' must not declare a class");
                }
            }
        }
    }
}
