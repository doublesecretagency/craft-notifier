<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events get triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\models;

use craft\base\Model;
use doublesecretagency\notifier\base\EnvelopeInterface;

/**
 * Class BaseEnvelope
 * @since 1.0.0
 */
class BaseEnvelope extends Model implements EnvelopeInterface
{

    /**
     * @var int|null ID of this envelope.
     */
    public ?int $envelopeId = null;

    /**
     * @var int|null ID of original Notification.
     */
    public ?int $notificationId = null;

    /**
     * @var array Data for job queue message.
     */
    public array $jobInfo = [
        'messageType' => 'unspecified message',
        'recipient'   => 'unknown recipient',
    ];

    /**
     * Send the message.
     *
     * @return bool
     */
    public function send(): bool
    {
        // Nothing was sent
        return false;
    }

}
