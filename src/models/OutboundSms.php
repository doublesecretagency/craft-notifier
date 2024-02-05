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
use craft\helpers\App;
use doublesecretagency\notifier\base\EnvelopeInterface;
use doublesecretagency\notifier\NotifierPlugin;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

/**
 * Class OutboundSms
 * @since 1.0.0
 */
class OutboundSms extends Model implements EnvelopeInterface
{

    /**
     * @var array
     */
    public array $jobInfo = [];

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
     * @throws ConfigurationException
     * @throws TwilioException
     */
    public function send(): bool
    {
        // Ensure we're working with a valid phone number
        $recipientPhoneNumber = $this->_formatPhoneNumber($this->phoneNumber);

        // If number is not valid, log error and bail
        if (!$recipientPhoneNumber) {
            // @todo Log error message
            return false;
        }

        /** @var Settings $settings */
        $settings = NotifierPlugin::$plugin->getSettings();

        // Initialize Twilio client
        $twilio = new Client(
            App::parseEnv($settings->twilioAccountSid),
            App::parseEnv($settings->twilioAuthToken)
        );

        // Send to test phone number if it exists,
        // otherwise send to intended recipient
        $to = (App::parseEnv($settings->testToPhoneNumber) ?: $recipientPhoneNumber);

        // Attempt to send SMS message
        try {

            // Generate and send a new SMS message
            $twilio->messages->create($to, [
                'from' => App::parseEnv($settings->twilioPhoneNumber),
                'body' => $this->message
            ]);

        } catch (TwilioException $exception) {

            // $exception = [
            //     'statusCode' => '401',
            //     'moreInfo' => 'https://www.twilio.com/docs/errors/20003',
            //     'message' => '[HTTP 401] Unable to create record: Authentication Error - invalid username',
            // ];

            // @todo Log failure message

            // Return failure
            return false;
        }

        // @todo Log success message


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

    // ========================================================================= //

    /**
     * Ensure phone number is valid and properly formatted.
     *
     * @param string|null $number
     * @return string|null
     */
    private function _formatPhoneNumber(?string $number): ?string
    {
        // If no number, return null
        if (!$number) {
            return null;
        }

        // Strip all non-digits from the phone number
        $phone = preg_replace('/[^0-9]/', '', $number);

        // Get number of digits
        $digits = strlen($phone);

        // If fewer than 10 digits, return null
        if (10 < $digits) {
            return null;
        }

        // If exactly 10 digits, return US phone number
        if (10 === $digits) {
            return "+1{$phone}";
        }

        // Return international phone number
        return "+{$phone}";
    }

}
