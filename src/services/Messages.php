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

namespace doublesecretagency\notifier\services;

use craft\base\Component;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\models\Dispatch;
use yii\base\Event;

/**
 * Class Messages
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
     * @return void
     */
    public function send(Notification $notification, Event $event, array $data = []): void
    {
        // Configure new dispatch message
        $dispatch = new Dispatch([
            'notification' => $notification,
            'event' => $event,
            'data' => $data
        ]);

        // If dispatch doesn't align with event config, bail
        if (!$dispatch->filterByEventType()) {
            return;
        }

        // Configure envelopes and whether to use the queue
        $dispatch->configureByMessageType();

        // Send all compiled envelopes
        $dispatch->sendEnvelopes();
    }

    /**
     * Send a test of a single Notification, simulating only the event itself.
     *
     * Bypasses event-type filters and condition gates so the operator can verify
     * the configured message body and recipient strategy without waiting for a
     * real Craft event to fire. The message body, recipients, queue setting,
     * and channel all use the live Notification configuration.
     *
     * @param Notification $notification
     * @return Dispatch The populated dispatch (envelopes attached) for caller introspection.
     * @since 3.0.0
     */
    public function sendTest(Notification $notification): Dispatch
    {
        // Build a synthetic event so the dispatch pipeline has something to thread
        $syntheticEvent = new Event(['sender' => null]);

        // Configure new dispatch flagged as a test
        $dispatch = new Dispatch([
            'notification' => $notification,
            'event' => $syntheticEvent,
            'data' => [],
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

}
