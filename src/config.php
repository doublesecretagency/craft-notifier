<?php

/**
 * Notifier config.php
 *
 * This file exists only as a template for the Notifier settings.
 * It does nothing on its own.
 *
 * Don't edit this file, instead copy it to 'config' as 'notifier.php'
 * and make your changes there to override default settings.
 *
 * Once copied to 'config', this file will be multi-environment aware as
 * well, so you can have different settings groups for each environment, just as
 * you do for 'general.php'
 */

return [

    // Twilio (only needed if using Twilio to send SMS messages)
    //'twilioAccountSid'  => getenv('TWILIO_ACCOUNT_SID'),
    //'twilioAuthToken'   => getenv('TWILIO_AUTH_TOKEN'),
    //'twilioPhoneNumber' => getenv('TWILIO_PHONE_NUMBER'),

    // Phone number to use for SMS testing purposes
    //'testToPhoneNumber' => getenv('TEST_TO_PHONE_NUMBER'),

];
