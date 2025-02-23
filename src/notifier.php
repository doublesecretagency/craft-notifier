<?php

/**
 * Notifier General Configuration
 *
 * Copy this file to:
 * /config/notifier.php
 *
 * For complete configuration details, visit:
 * https://plugins.doublesecretagency.com/notifier/getting-started/config
 */

return [

    // Twilio (only needed if using Twilio to send SMS messages)
    'twilioAccountSid'  => getenv('TWILIO_ACCOUNT_SID'),
    'twilioAuthToken'   => getenv('TWILIO_AUTH_TOKEN'),
    'twilioPhoneNumber' => getenv('TWILIO_PHONE_NUMBER'),

    // Phone number to use for SMS testing purposes
    'testToPhoneNumber' => getenv('TEST_TO_PHONE_NUMBER'),

];
