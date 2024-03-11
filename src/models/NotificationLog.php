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

namespace doublesecretagency\notifier\models;

use Craft;
use craft\base\Model;
use craft\helpers\Json;
use doublesecretagency\notifier\records\Log;

/**
 * Class NotificationLog
 * @since 1.0.0
 */
class NotificationLog extends Model
{

    /**
     * @var int|null
     */
    public ?int $notificationId = null;

    /**
     * @var int|null
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
        // Set envelope creation message
        $message = Craft::t('notifier', 'Sending {messageType} to {recipient}.', $jobInfo);

        // Log envelope and return ID
        return $this->_log('envelope', $message, null, $details);
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

}
