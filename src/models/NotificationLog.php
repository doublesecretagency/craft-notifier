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

namespace doublesecretagency\notifier\models;

use Craft;
use craft\base\Model;
use craft\db\Query;
use craft\helpers\Db;
use craft\helpers\Json;
use DateInterval;
use DateTime;
use DateTimeZone;
use doublesecretagency\notifier\NotifierPlugin;
use doublesecretagency\notifier\records\Log;

/**
 * Writes notification activity to the log.
 *
 * @since 1.0.0
 */
class NotificationLog extends Model
{

    /**
     * @var int|null ID of the notification being logged.
     */
    public ?int $notificationId = null;

    /**
     * @var int|null ID of the envelope being logged.
     */
    public ?int $envelopeId = null;

    // ========================================================================= //

    /**
     * Log creation of an envelope.
     *
     * @param array $jobInfo
     * @param array $details
     * @return int|null
     */
    public function envelope(array $jobInfo, array $details): ?int
    {
        // If logging disabled, bail
        if (!NotifierPlugin::$plugin->getSettings()->loggingEnabled) {
            return null;
        }

        // Prune expired log entries before adding a new envelope
        $this->_prune();

        // Set envelope creation message
        $message = Craft::t('notifier', 'Sending {messageType} to {recipient}.', $jobInfo);

        // Log envelope and return ID
        return $this->_log('envelope', $message, null, $details);
    }

    /**
     * Log a feed scan as a parent envelope.
     *
     * @param string $feedUrl
     * @return int|null
     */
    public function feedScan(string $feedUrl): ?int
    {
        // If logging disabled, bail
        if (!NotifierPlugin::$plugin->getSettings()->loggingEnabled) {
            return null;
        }

        // Prune expired log entries before adding a new envelope
        $this->_prune();

        // Set the feed scan message
        $message = Craft::t('notifier', 'Scanning feed {url}.', ['url' => $feedUrl]);

        // Log envelope and return ID
        return $this->_log('envelope', $message, null, []);
    }

    /**
     * Log a dispatch as a run-level parent envelope.
     *
     * @param string $title
     * @return int|null
     */
    public function dispatchEnvelope(string $title): ?int
    {
        // If logging disabled, bail
        if (!NotifierPlugin::$plugin->getSettings()->loggingEnabled) {
            return null;
        }

        // Prune expired log entries before adding a new envelope
        $this->_prune();

        // Set the dispatch message
        $message = Craft::t('notifier', 'Sending "{title}".', ['title' => $title]);

        // Log envelope and return ID
        return $this->_log('envelope', $message, null, []);
    }

    // ========================================================================= //

    /**
     * Log success message.
     *
     * @param string $message
     * @param int|null $envelopeId
     * @param array $details
     * @return int|null
     */
    public function success(string $message, ?int $envelopeId = null, array $details = []): ?int
    {
        return $this->_log('success', $message, $envelopeId, $details);
    }

    /**
     * Log info message.
     *
     * @param string $message
     * @param int|null $envelopeId
     * @param array $details
     * @return int|null
     */
    public function info(string $message, ?int $envelopeId = null, array $details = []): ?int
    {
        return $this->_log('info', $message, $envelopeId, $details);
    }

    /**
     * Log warning message.
     *
     * @param string $message
     * @param int|null $envelopeId
     * @param array $details
     * @return int|null
     */
    public function warning(string $message, ?int $envelopeId = null, array $details = []): ?int
    {
        return $this->_log('warning', $message, $envelopeId, $details);
    }

    /**
     * Log error message.
     *
     * @param string $message
     * @param int|null $envelopeId
     * @param array $details
     * @return int|null
     */
    public function error(string $message, ?int $envelopeId = null, array $details = []): ?int
    {
        return $this->_log('error', $message, $envelopeId, $details);
    }

    // ========================================================================= //

    /**
     * Log message.
     *
     * @param string $type
     * @param string $message
     * @param int|null $envelopeId
     * @param array $details
     * @return int|null
     */
    private function _log(string $type, string $message, ?int $envelopeId = null, array $details = []): ?int
    {
        // If logging disabled, bail
        if (!NotifierPlugin::$plugin->getSettings()->loggingEnabled) {
            return null;
        }

        // Create a new log record
        $record = new Log();

        // Configure the log data
        $record->notificationId = $this->notificationId;
        $record->envelopeId = $envelopeId;
        $record->type = $type;
        $record->message = $message;
        $record->details = Json::encode($details);

        // Save the log item
        $record->save(false);

        // Return the log ID
        return $record->id;
    }

    // ========================================================================= //

    /**
     * Prune expired envelope groups from the log table.
     *
     * Runs once per dispatch (called from `envelope()`). Two retention rules
     * may be configured independently and both are applied:
     *
     *  - `logRetentionDays`: deletes envelopes (and their child rows) whose
     *    `dateCreated` is older than the cutoff.
     *  - `logRetentionRecords`: deletes envelopes (and their child rows)
     *    beyond the most recent N envelopes.
     *
     * Both modes operate on envelope IDs, then delete the envelope rows
     * plus every child row whose `envelopeId` matches, so we never strand
     * orphaned children.
     *
     * @return void
     */
    private function _prune(): void
    {
        // Get plugin settings
        /** @var Settings $settings */
        $settings = NotifierPlugin::$plugin->getSettings();

        // Initialize the list of expired envelope IDs
        $expiredEnvelopeIds = [];

        // Limit by age (days)
        if ($settings->logRetentionDays > 0) {

            // Calculate the cutoff date
            $cutoff = (new DateTime('now', new DateTimeZone('UTC')))
                ->sub(new DateInterval("P{$settings->logRetentionDays}D"));

            // Find envelopes older than the cutoff
            $tooOld = (new Query())
                ->select('id')
                ->from(Log::tableName())
                ->where(['type' => 'envelope'])
                ->andWhere(['<', 'dateCreated', Db::prepareDateForDb($cutoff)])
                ->column();

            // Append to the expired list
            $expiredEnvelopeIds = array_merge($expiredEnvelopeIds, $tooOld);
        }

        // Limit by count (dispatches)
        if ($settings->logRetentionRecords > 0) {

            // Find the most recent N envelope IDs to keep
            $keepIds = (new Query())
                ->select('id')
                ->from(Log::tableName())
                ->where(['type' => 'envelope'])
                ->orderBy(['id' => SORT_DESC])
                ->limit($settings->logRetentionRecords)
                ->column();

            // If anything to keep, find everything else
            if ($keepIds) {
                $tooMany = (new Query())
                    ->select('id')
                    ->from(Log::tableName())
                    ->where(['type' => 'envelope'])
                    ->andWhere(['not in', 'id', $keepIds])
                    ->column();

                // Append to the expired list
                $expiredEnvelopeIds = array_merge($expiredEnvelopeIds, $tooMany);
            }
        }

        // If nothing expired, bail
        if (!$expiredEnvelopeIds) {
            return;
        }

        // Deduplicate the expired list
        $expiredEnvelopeIds = array_unique($expiredEnvelopeIds);

        // Delete the envelope rows AND every child row pointing at them
        Craft::$app->getDb()->createCommand()
            ->delete(Log::tableName(), [
                'or',
                ['id' => $expiredEnvelopeIds],
                ['envelopeId' => $expiredEnvelopeIds],
            ])
            ->execute();
    }

}
