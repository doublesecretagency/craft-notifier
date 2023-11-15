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
 * Class OutboundFlash
 * @since 1.0.0
 */
class OutboundFlash extends Model implements EnvelopeInterface
{

//    /**
//     * @var string|null
//     */
//    public ?string $to = null;

    /**
     * @var string|null
     */
    public ?string $type = null;

    /**
     * @var string|null
     */
    public ?string $message = null;

    /**
     * Send the flash message.
     */
    public function send(): bool
    {

        // SEND FLASH MESSAGE


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
