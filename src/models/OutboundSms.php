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

use craft\helpers\App;
use craft\helpers\Json;
use doublesecretagency\notifier\elements\Notification;
use doublesecretagency\notifier\helpers\Notifier;
use doublesecretagency\notifier\NotifierPlugin;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

/**
 * Class OutboundSms
 * @since 1.0.0
 */
class OutboundSms extends BaseEnvelope
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
        // Get original notification
        /** @var Notification $notification */
        $notification = Notifier::getNotification($this->notificationId);

        // If invalid notification, bail (unable to log)
        if (!$notification) {
            return false;
        }

        /** @var Settings $settings */
        $settings = NotifierPlugin::$plugin->getSettings();

        // Check if any part of credentials are missing
        $missing = [];

        // Check each value exists
        if (!App::parseEnv($settings->twilioAccountSid)) {
            $missing[] = "Twilio Account SID";
        }
        if (!App::parseEnv($settings->twilioAuthToken)) {
            $missing[] = "Twilio Auth Token";
        }

        // If something is missing
        if ($missing) {

            // Link to docs for Twilio credentials
            $url = 'https://plugins.doublesecretagency.com/notifier/getting-started/twilio';

            // Log error
            $m = implode(' and ', $missing);
            $notification->log->error("[Invalid Twilio credentials.]({$url}) Missing {$m}.", $this->envelopeId);

            // Return failure
            return false;
        }

        // Get the Twilio phone number
        $from = App::parseEnv($settings->twilioPhoneNumber);

        // If no sender exists, log error and return failure
        if (!$from) {
            $notification->log->error('Unable to send SMS, no Twilio phone number exists.', $this->envelopeId);
            return false;
        }

        // Send to test phone number if it exists,
        // otherwise send to intended recipient
        $to = (App::parseEnv($settings->testToPhoneNumber) ?: $this->phoneNumber);

        // If no recipient exists, log error and return failure
        if (!$to) {
            $notification->log->error('Unable to send SMS, no recipient phone number exists.', $this->envelopeId);
            return false;
        }

        // Properly format the recipient's phone number
        // or nullify if phone number is invalid
        $to = $this->_formatPhoneNumber($to);

        // If recipient phone number is invalid, log error and return failure
        if (!$to) {
            $notification->log->error('Unable to send SMS, recipient phone number is invalid.', $this->envelopeId);
            return false;
        }

        // Attempt to send SMS message
        try {

            // Initialize Twilio client
            $twilio = new Client(
                App::parseEnv($settings->twilioAccountSid),
                App::parseEnv($settings->twilioAuthToken)
            );

            // Generate and send a new SMS message
            $twilio->messages->create($to, [
                'from' => $from,
                'body' => $this->message
            ]);

        } catch (TwilioException $exception) {

            // Set error message
            $message = ($exception->getMessage() ?? 'Unknown error: '.Json::encode($exception));

            // Log error message
            $notification->log->error($message, $this->envelopeId);

            // Return failure
            return false;
        }

        // Log success message
        $notification->log->success("Successfully sent SMS message!", $this->envelopeId);

        // Return success
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
        $phone = preg_replace('/\D/', '', $number);

        // Get number of digits
        $digits = strlen($phone);

        // If fewer than 10 digits, return null
        if ($digits < 10) {
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
