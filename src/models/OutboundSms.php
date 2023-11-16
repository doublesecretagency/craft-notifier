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
 * Class OutboundSms
 * @since 1.0.0
 */
class OutboundSms extends Model implements EnvelopeInterface
{

    /**
     * @var string|null
     */
    public ?string $phoneNumber = null;

    /**
     * @var string
     */
    public string $message = '';

    /**
     * Send the SMS (text) message.
     *
     * @return bool
     */
    public function send(): bool
    {

        // SEND SMS MESSAGE


//        // If unsuccessful, log error and bail
//        if (!$success) {
//            Log::warning("Unable to send the SMS message using the Twilio API.");
//            Log::error("Check the plugin's configuration settings.");
//            return false;
//        }
//
//        // Log success message
//        Log::success("The text to {$this->to} was sent successfully!");

        // Return whether message was sent successfully
//        return $success;
        return true;

    }

}
