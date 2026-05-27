<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\services;

use Craft;
use craft\base\Component;
use craft\db\Query;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\exceptions\FeedParseException;
use doublesecretagency\notifier\helpers\Feed;
use doublesecretagency\notifier\NotifierPlugin;
use Throwable;
use yii\base\Event;

/**
 * Class FeedRunner
 * @since 3.0.0
 */
class FeedRunner extends Component
{

    /**
     * @var string The feed tracking table name.
     */
    private const TABLE = '{{%notifier_trackfeeds}}';

    /**
     * @var string Reserved itemId that marks a notification as seeded.
     *
     * Marks the first scan, so subsequent scans can properly trigger notifications.
     */
    private const SEED_MARKER = '___seeded___';

    /**
     * @var int HTTP timeout in seconds for feed fetches.
     */
    private const FETCH_TIMEOUT = 10;

    /**
     * Run every feed-driven notification and send messages based on any new items.
     *
     * @return array Summary with notification / dispatched / sent counts and any errors.
     */
    public function run(): array
    {
        // Initialize the run summary
        $summary = ['notifications' => 0, 'dispatched' => 0, 'sent' => 0, 'errors' => []];

        // Loop through every feed notification
        foreach (NotifierPlugin::getInstance()->messages->getFeedNotifications() as $notification) {

            // Count the notification
            $summary['notifications']++;

            // Run it, catching any failure
            try {
                // Get the dispatched and sent counts from this notification's run
                [$dispatched, $sent] = $this->_runNotification($notification);
                // Merge the counts into the run summary
                $summary['dispatched'] += $dispatched;
                $summary['sent']       += $sent;
            } catch (Throwable $e) {
                // Record the failure for the run summary
                $summary['errors'][] = "Notification {$notification->id}: {$e->getMessage()}";
            }

        }

        // Return the run summary
        return $summary;
    }

    // ========================================================================= //

    /**
     * Seed a feed notification's tracking history.
     *
     * No-op when the notification isn't a feed notification, has no Feed URL,
     * or has already been seeded. Otherwise, fetch the feed and record every
     * currently-visible item as already-seen. Never dispatches.
     *
     * @param Notification $notification
     * @return bool True if a fresh seed was recorded, false if no action was taken.
     */
    public function seedNotification(Notification $notification): bool
    {
        // If this isn't a feed notification, bail
        if ('feed' !== $notification->eventType) {
            return false;
        }

        // Get the configured feed URL
        $feedUrl = trim((string) ($notification->eventConfig['feedUrl'] ?? ''));

        // If no feed URL is configured, bail
        if ('' === $feedUrl) {
            return false;
        }

        // Check if the seed marker is already claimed
        $alreadySeeded = (new Query())
            ->from(self::TABLE)
            ->where(['notificationId' => $notification->id, 'itemId' => self::SEED_MARKER])
            ->exists();

        // If already seeded, bail
        if ($alreadySeeded) {
            return false;
        }

        // Fetch and parse the feed
        $parsed = $this->_fetchAndParse($notification);

        // If the fetch or parse failed, bail
        if (null === $parsed) {
            return false;
        }

        // Try to claim the seed marker (atomic; bail if a concurrent scan beat us)
        if (!$this->_markFirstScan($notification->id)) {
            return false;
        }

        // Track every currently-visible item as already-seen, oldest first
        foreach (array_reverse($parsed['items']) as $item) {
            // Track the item so it's not re-fired later
            $this->_trackItem($notification->id, $item['guid']);
        }

        // Success
        return true;
    }

    /**
     * Wipe all tracking history for a notification.
     *
     * Removes both the seed marker and every tracked item ID. The next seed
     * pass starts fresh against whatever feed is currently configured.
     *
     * @param int $notificationId
     * @return void
     */
    public function wipeHistory(int $notificationId): void
    {
        // Delete every history row for the notification
        Craft::$app->getDb()->createCommand()
            ->delete(self::TABLE, ['notificationId' => $notificationId])
            ->execute();
    }

    /**
     * Fetch the live feed and return a random item with feed-level metadata.
     *
     * Used by the "Send a test message" button on feed notifications.
     * Returns null when the feed can't be read or has no items.
     *
     * @param Notification $notification
     * @return array|null Tuple of ['item' => array, 'feed' => array] or null.
     */
    public function getRandomItem(Notification $notification): ?array
    {
        // Fetch and parse the live feed
        $parsed = $this->_fetchAndParse($notification);

        // If the fetch or parse failed, bail
        if (null === $parsed) {
            return null;
        }

        // If the feed has no items, bail
        if (empty($parsed['items'])) {
            return null;
        }

        // Pick a random item from the live feed
        $item = $parsed['items'][array_rand($parsed['items'])];

        // Return the chosen item paired with feed-level metadata
        return [
            'item' => $item,
            'feed' => $parsed['feed'],
        ];
    }

    // ========================================================================= //

    /**
     * Run a single feed notification and send messages based on any new items.
     *
     * @param Notification $notification
     * @return array{0:int,1:int} Tuple of [dispatched items, successful envelope sends].
     */
    private function _runNotification(Notification $notification): array
    {
        // Fetch and parse the feed
        $parsed = $this->_fetchAndParse($notification);

        // If the fetch or parse failed, bail
        if (null === $parsed) {
            return [0, 0];
        }

        // Mark whether this is the first scan
        $isFirstScan = $this->_markFirstScan($notification->id);

        // If this is the first scan, seed every item but send no messages
        if ($isFirstScan) {
            // Loop through every item in the feed, oldest first
            foreach (array_reverse($parsed['items']) as $item) {
                // Track the item so it's not re-fired later
                $this->_trackItem($notification->id, $item['guid']);
            }
            return [0, 0];
        }

        // Initialize the dispatched and sent counts
        $dispatched = 0;
        $sent = 0;

        // Loop through every item in the feed, oldest first, so messages arrive in chronological order
        foreach (array_reverse($parsed['items']) as $item) {
            // If the item has already been tracked, skip it
            if (!$this->_trackItem($notification->id, $item['guid'])) {
                continue;
            }
            // Send the notification for this item and capture the envelope count
            $sent += $this->_send($notification, $item, $parsed['feed']);
            // Count this dispatch
            $dispatched++;
        }

        // Return the dispatched and sent counts
        return [$dispatched, $sent];
    }

    /**
     * Fetch and parse a feed for a notification, logging any failures.
     *
     * @param Notification $notification
     * @return array|null Parsed feed data, or null on any failure.
     */
    private function _fetchAndParse(Notification $notification): ?array
    {
        // Get the configured feed URL
        $feedUrl = trim((string) ($notification->eventConfig['feedUrl'] ?? ''));

        // If no feed URL is configured, bail
        if ('' === $feedUrl) {
            return null;
        }

        // Configure the HTTP client with our preferred Accept and User-Agent headers
        $client = Craft::createGuzzleClient([
            'timeout' => self::FETCH_TIMEOUT,
            'headers' => [
                'Accept' => 'application/feed+json, application/json, application/atom+xml, application/rss+xml, application/xml, text/xml, */*',
                'User-Agent' => sprintf(
                    'Notifier/%s (+https://plugins.doublesecretagency.com/notifier/)',
                    NotifierPlugin::getInstance()->getVersion()
                ),
            ],
        ]);

        // Try to fetch the feed
        try {
            $response = $client->get($feedUrl);
        } catch (Throwable $e) {
            // If the fetch fails, log the error and bail
            $notification->log->error(Craft::t('notifier',
                'Unable to fetch the feed: {message}',
                ['message' => $e->getMessage()]
            ));
            return null;
        }

        // Read the response body and content type
        $body = (string) $response->getBody();
        $contentType = $response->getHeaderLine('Content-Type');

        // If the feed is XML and the required PHP extensions are missing, log the error and bail
        if (Feed::needsXmlExtensions($body, $contentType) && !extension_loaded('simplexml')) {
            $notification->log->error(Craft::t('notifier',
                'Unable to parse the feed. The PHP `simplexml` and `libxml` extensions are required.'
            ));
            return null;
        }

        // Try to parse the response, auto-detecting the feed format
        try {
            $parsed = Feed::parseAuto($body, $contentType);
        } catch (FeedParseException) {
            // If parsing fails, log the error and bail
            $notification->log->error(Craft::t('notifier', 'Unable to parse the feed.'));
            return null;
        }

        // Save the feed URL onto the parsed data, so templates can access it
        $parsed['feed']['url'] = $feedUrl;

        // Return the parsed feed
        return $parsed;
    }

    /**
     * Mark this notification's first scan.
     *
     * @param int $notificationId
     * @return bool True if this was the first scan, false if it was already marked.
     */
    private function _markFirstScan(int $notificationId): bool
    {
        return $this->_trackItem($notificationId, self::SEED_MARKER);
    }

    /**
     * Attempt to track a single item ID against a notification.
     *
     * @param int $notificationId
     * @param string $itemId
     * @return bool True if the row was newly inserted, false if it already existed.
     */
    private function _trackItem(int $notificationId, string $itemId): bool
    {
        // Check if the item is already tracked
        $exists = (new Query())
            ->from(self::TABLE)
            ->where(['notificationId' => $notificationId, 'itemId' => $itemId])
            ->exists();

        // If the item is already tracked, bail
        if ($exists) {
            return false;
        }

        // Try to insert the row
        try {
            Craft::$app->getDb()->createCommand()
                ->insert(self::TABLE, [
                    'notificationId' => $notificationId,
                    'itemId'         => $itemId,
                ])
                ->execute();
        } catch (Throwable) {
            // Another ping beat us to it
            return false;
        }

        // Success
        return true;
    }

    /**
     * Send notification for a single feed item.
     *
     * @param Notification $notification
     * @param array $item Normalized feed item.
     * @param array $feed Feed-level metadata.
     * @return int Number of envelopes successfully sent.
     */
    private function _send(Notification $notification, array $item, array $feed): int
    {
        // Create an event for this feed item
        $event = new Event(['sender' => null]);

        // Send the Notification for this feed item and return the envelope count
        return NotifierPlugin::getInstance()->messages->send($notification, $event, [
            'item' => $item,
            'feed' => $feed,
        ]);
    }

}
