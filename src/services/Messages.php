<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\services;

use Craft;
use craft\base\Component;
use craft\base\ElementInterface;
use craft\commerce\elements\Order;
use craft\commerce\elements\Product as CommerceProduct;
use craft\digitalproducts\elements\License;
use craft\digitalproducts\elements\Product as DigitalProduct;
use craft\elements\Asset;
use craft\elements\db\ElementQueryInterface;
use craft\elements\Entry;
use craft\elements\User;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\exceptions\TestPreflightException;
use doublesecretagency\notifier\helpers\SystemSnapshot;
use doublesecretagency\notifier\models\Dispatch;
use doublesecretagency\notifier\NotifierPlugin;
use Solspace\Calendar\Elements\Event as CalendarEvent;
use verbb\formie\elements\Submission;
use yii\base\Event;
use yii\db\Expression;

/**
 * Builds and sends notification messages.
 *
 * @since 1.0.0
 */
class Messages extends Component
{

    /**
     * Send all Notifications activated by a single Event.
     *
     * @param array $notifications
     * @param Event $event
     * @param array $data
     * @return void
     */
    public function sendAll(array $notifications, Event $event, array $data = []): void
    {
        /** @var Notification $notification */
        foreach ($notifications as $notification) {
            // Send each individual Notification
            $this->send($notification, $event, $data);
        }
    }

    /**
     * Send a single message (possibly to multiple recipients).
     *
     * @param Notification $notification
     * @param Event $event
     * @param array $data
     * @return int Number of envelopes successfully handed off (queued or directly sent).
     */
    public function send(Notification $notification, Event $event, array $data = []): int
    {
        // Configure new dispatch message
        $dispatch = new Dispatch([
            'notification' => $notification,
            'event' => $event,
            'data' => $data
        ]);

        // If dispatch doesn't align with event config, bail
        if (!$dispatch->filterByEventType()) {
            return 0;
        }

        // Configure envelopes and whether to use the queue
        $dispatch->configureByMessageType();

        // Send all compiled envelopes, returning the count of successful ones
        return $dispatch->sendEnvelopes();
    }

    /**
     * Send a test of a single Notification, populated with real data.
     *
     * Grabs a random live item for feed events, or a random matching element
     * for everything else. Throws if no data can be found.
     *
     * @param Notification $notification
     * @return Dispatch The populated dispatch (envelopes attached) for caller introspection.
     * @throws TestPreflightException When no real data can be found for the test.
     */
    public function sendTest(Notification $notification): Dispatch
    {
        // Build a synthetic event so the dispatch pipeline has something to thread
        $event = new Event(['sender' => null]);

        // Get a realistic Twig context, refusing to send if none can be found
        if ('feed' === $notification->eventType) {
            // Pull a random item from the live feed
            $resolved = NotifierPlugin::getInstance()->feedRunner->getRandomItem($notification);

            // If nothing was returned, the feed is unreachable, unparseable, or empty
            if (null === $resolved) {
                throw new TestPreflightException(Craft::t('notifier',
                    'Unable to send test: the feed could not be read or has no items.'
                ));
            }
            $data = $resolved;
        } elseif ('system-snapshot' === $notification->eventType) {
            // Compile a fresh system snapshot report
            $data = ['report' => SystemSnapshot::compile()];
        } elseif ('dynamic-data' === $notification->eventType) {
            // No data sent, to be compiled dynamically at dispatch
            $data = [];
        } else {
            // Pick a random element matching the configured filters
            $element = $this->getRandomMatchingElement($notification);

            // If no candidate element passed every gate, refuse to send
            if (null === $element) {
                throw new TestPreflightException(Craft::t('notifier',
                    'Unable to send test: no element matches the configured filters.'
                ));
            }

            // Mirror the real dispatch shape: stash the chosen element under 'object'
            $data = ['object' => $element];

            // Thread the element through the synthetic event too, so any
            // recipient strategy that reads the sender directly sees it
            $event->sender = $element;
        }

        // Configure new dispatch flagged as a test
        $dispatch = new Dispatch([
            'notification' => $notification,
            'event' => $event,
            'data' => $data,
            'isTest' => true,
        ]);

        // Skip filterByEventType() entirely; the test simulates the event only

        // Configure envelopes and whether to use the queue
        $dispatch->configureByMessageType();

        // Send all compiled envelopes
        $dispatch->sendEnvelopes();

        // Return the populated dispatch so the caller can report envelope count
        return $dispatch;
    }

    /**
     * Pick a random element matching this notification's filtering criteria.
     *
     * Used by the "Send a test message" button on element-backed notifications.
     * Returns null when nothing in the system matches the configured filters.
     *
     * @param Notification $notification
     * @return ElementInterface|null
     */
    public function getRandomMatchingElement(Notification $notification): ?ElementInterface
    {
        // Get the element class for this notification's event type
        $elementClass = $this->_eventTypeToElementClass($notification->eventType);

        // If the event type is unsupported, or its host plugin isn't installed, bail
        if (!$elementClass) {
            return null;
        }

        // Build a query restricted to the notification's eventConfig filters
        $query = $this->_buildCandidateQuery($notification, $elementClass);

        // Get the notification's element condition
        $condition = $notification->getEventCondition();

        // If a condition is configured, narrow the query to matching elements
        if ($condition) {
            $condition->modifyQuery($query);
        }

        // Pull a small random batch; not every candidate will pass the gate
        $candidates = (clone $query)
            ->orderBy(new Expression('RAND()'))
            ->limit(20)
            ->all();

        // If no candidates were found, bail
        if (!$candidates) {
            return null;
        }

        // Loop through the candidates and return the first that passes the shared gate
        foreach ($candidates as $candidate) {
            // Build a one-off dispatch to validate via the shared filter gate
            $dispatch = new Dispatch([
                'notification' => $notification,
                'event'        => new Event(['sender' => $candidate]),
                'data'         => ['object' => $candidate],
                'isTest'       => false,
            ]);

            // If this candidate passes every gate, use it
            if ($dispatch->filterByEventType()) {
                return $candidate;
            }
        }

        // No candidate passed every gate, bail
        return null;
    }

    /**
     * Get all manually triggered Notifications which apply to a given element.
     *
     * @param ElementInterface $element
     * @return Notification[] Notifications which can be manually triggered for this element.
     */
    public function getManualNotifications(ElementInterface $element): array
    {
        // Get the Notifier event type for this element
        $eventType = NotifierPlugin::getInstance()->events->getEventTypeForElement($element);

        // If the element type is unsupported, bail
        if (!$eventType) {
            return [];
        }

        // Get all manually triggered Notifications for this event type
        $notifications = Notification::find()
            ->where([
                'eventType' => $eventType,
                'event' => 'manually-triggered',
            ])
            ->all();

        // Create an event with this element
        $event = new Event(['sender' => $element]);

        // Keep only the Notifications whose filters accept this element
        return array_values(array_filter($notifications,
            static function (Notification $notification) use ($element, $event): bool {
                // Reuse the live dispatch filter as the membership gate
                $dispatch = new Dispatch([
                    'notification' => $notification,
                    'event' => $event,
                    'data' => ['object' => $element],
                ]);
                return $dispatch->filterByEventType();
            }
        ));
    }

    /**
     * Get all Notifications driven by the scheduled run.
     *
     * @return Notification[] Notifications using a time-based trigger event.
     */
    public function getScheduledNotifications(): array
    {
        // Get all notifications using a time-based trigger event
        return Notification::find()
            ->where(['event' => ['date-reached', 'pending-to-live']])
            ->all();
    }

    /**
     * Get all Notifications driven by RSS/JSON feed polling.
     *
     * @return Notification[] Notifications using the RSS/JSON Feed event type.
     */
    public function getFeedNotifications(): array
    {
        // Get all notifications using the RSS/JSON Feed event type
        return Notification::find()
            ->where(['eventType' => 'feed'])
            ->all();
    }

    /**
     * Get all Notifications driven by the recurring System Snapshot schedule.
     *
     * @return Notification[] Recurring System Snapshot notifications.
     */
    public function getSystemSnapshotNotifications(): array
    {
        // Get all recurring System Snapshot notifications
        return $this->_recurringNotifications('system-snapshot');
    }

    /**
     * Get all Notifications driven by the recurring Dynamic Data schedule.
     *
     * @return Notification[] Recurring Dynamic Data notifications.
     */
    public function getDynamicDataNotifications(): array
    {
        // Get all recurring Dynamic Data notifications
        return $this->_recurringNotifications('dynamic-data');
    }

    /**
     * Get all recurring notifications of a given event type.
     *
     * @param string $eventType
     * @return Notification[]
     */
    private function _recurringNotifications(string $eventType): array
    {
        // Get all notifications of the specified event type
        $notifications = Notification::find()
            ->where(['eventType' => $eventType])
            ->all();

        // Return only the recurring notifications
        return array_values(array_filter($notifications,
            static fn(Notification $n): bool => (bool) ($n->eventConfig['recurring'] ?? false)
        ));
    }

    // ========================================================================= //

    /**
     * Map a Notifier event type to its element class.
     *
     * Returns null when the event type is unrecognized or its host plugin
     * isn't installed.
     *
     * @param string $eventType
     * @return string|null Fully-qualified element class name.
     */
    private function _eventTypeToElementClass(string $eventType): ?string
    {
        // Core element types ship with Craft
        $map = [
            'entries' => Entry::class,
            'assets'  => Asset::class,
            'users'   => User::class,
        ];

        // If Craft Commerce is installed, map its order and product types
        if (class_exists(Order::class)) {
            $map['craft-commerce-orders']   = Order::class;
            $map['craft-commerce-products'] = CommerceProduct::class;
        }

        // If Digital Products is installed, map its product and license types
        if (class_exists(DigitalProduct::class)) {
            $map['digital-products-products'] = DigitalProduct::class;
            $map['digital-products-licenses'] = License::class;
        }

        // If Solspace Calendar is installed, map its event type
        if (class_exists(CalendarEvent::class)) {
            $map['solspace-calendar-events'] = CalendarEvent::class;
        }

        // If Formie is installed, map its submission type
        if (class_exists(Submission::class)) {
            $map['formie-submissions'] = Submission::class;
        }

        // Return the matching element class, or null
        return ($map[$eventType] ?? null);
    }

    /**
     * Build a candidate element query for a notification's event type.
     *
     * Applies eventConfig restrictions where they map to query methods.
     * The rest fall through to filterByEventType() for gating.
     *
     * @param Notification $notification
     * @param string $elementClass
     * @return ElementQueryInterface
     */
    private function _buildCandidateQuery(Notification $notification, string $elementClass): ElementQueryInterface
    {
        // Get the notification's eventConfig as a plain array
        $eventConfig = ($notification->eventConfig ?? []);

        // Start a base element query
        /** @var ElementQueryInterface $query */
        $query = $elementClass::find();

        // Apply per-event-type restrictions
        switch ($notification->eventType) {
            case 'entries':
                // Get the selected section + entry type pairs
                $sectionEntryTypes = ($eventConfig['sectionEntryTypes'] ?? []);

                // If any pairs are configured, restrict to them
                if (!empty($sectionEntryTypes)) {

                    // Initialize the types grouped by section
                    $typesBySection = [];

                    // Loop through the section and entry type pairs
                    foreach ($sectionEntryTypes as $pair) {

                        // Get the section and entry type IDs
                        [$sectionId, $typeId] = array_pad(explode('-', (string) $pair, 2), 2, null);

                        // If both are present, group the type under its section
                        if (null !== $sectionId && null !== $typeId) {
                            $typesBySection[(int) $sectionId][] = (int) $typeId;
                        }
                    }

                    // Build an OR of (section AND its selected entry types), so an entry
                    // must match BOTH a selected section and one of its selected entry types
                    $orConditions = ['or'];

                    // Loop through each section's entry types
                    foreach ($typesBySection as $sectionId => $typeIds) {

                        // Require the section AND one of its entry types
                        $orConditions[] = [
                            'and',
                            ['entries.sectionId' => $sectionId],
                            ['entries.typeId' => $typeIds],
                        ];
                    }
                    $query->andWhere($orConditions);
                }

                // Restrict to configured sites
                if (!empty($eventConfig['sites'])) {
                    $query->siteId($eventConfig['sites']);
                }
                break;
            case 'assets':
                // Restrict to configured volumes
                if (!empty($eventConfig['volumes'])) {
                    $query->volumeId($eventConfig['volumes']);
                }
                break;
            case 'users':
                // Strip the "Ungrouped" sentinel (0) from the configured group list
                $groupIds = array_filter(($eventConfig['userGroups'] ?? []), static fn($g) => 0 !== (int) $g);

                // If real groups are configured, restrict the query to them
                if (!empty($groupIds)) {
                    $query->groupId($groupIds);
                }
                break;
            case 'craft-commerce-products':
                // Restrict to configured Commerce product types
                if (!empty($eventConfig['productTypes'])) {
                    $query->typeId($eventConfig['productTypes']);
                }
                break;
            case 'digital-products-products':
                // Restrict to configured Digital Product types
                if (!empty($eventConfig['digitalProductTypes'])) {
                    $query->typeId($eventConfig['digitalProductTypes']);
                }
                break;
            case 'formie-submissions':
                // Restrict to configured Forms
                if (!empty($eventConfig['forms'])) {
                    $query->formId($eventConfig['forms']);
                }
                break;
        }

        // Return the query
        return $query;
    }

}
