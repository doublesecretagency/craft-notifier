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
 * Class OutboundAnnouncement
 * @since 1.0.0
 */
class OutboundAnnouncement extends Model implements EnvelopeInterface
{

//    /**
//     * @var string|null
//     */
//    public ?string $to = null;

    /**
     * @var string|null
     */
    public ?string $subject = null;

    /**
     * @var string|null
     */
    public ?string $message = null;

    /**
     * Send the announcement.
     */
    public function send(): bool
    {

        // SEND ANNOUNCEMENT


//        // If unsuccessful, log error and bail
//        if (!$success) {
//            Log::warning("Unable to send the announcement.");
//            return false;
//        }
//
//        // Log success message
//        Log::success("The announcement to {$this->to} was sent successfully!");

        // Return whether message was sent successfully
//        return $success;
        return true;

    }

}
