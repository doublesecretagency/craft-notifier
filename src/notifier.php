<?php

/**
 * Notifier General Configuration
 *
 * Copy this file to:
 * /config/notifier.php
 *
 * For complete configuration details, visit:
 * https://plugins.doublesecretagency.com/notifier/getting-started/settings/php-config
 */

return [

    // Notification order (optional)
    //'defaultPlacement' => 'end', // 'beginning' or 'end' (default)

    // Logging (all optional)
    //'loggingEnabled'      => true,
    //'logRetentionDays'    => 30,
    //'logRetentionRecords' => 1000,

    // Scheduled sending (only needed if running the schedule via its web endpoint)
    //'scheduledToken' => getenv('NOTIFIER_SCHEDULED_TOKEN'),

    // Twilio (if using Twilio to send SMS messages)
    //'twilioAccountSid'  => getenv('TWILIO_ACCOUNT_SID'),
    //'twilioAuthToken'   => getenv('TWILIO_AUTH_TOKEN'),
    //'twilioPhoneNumber' => getenv('TWILIO_PHONE_NUMBER'),

    // Phone number to use for SMS testing purposes
    //'testToPhoneNumber' => getenv('TEST_TO_PHONE_NUMBER'),

    // Pushover (if using Pushover)
    //'pushoverApplicationToken' => getenv('PUSHOVER_APPLICATION_TOKEN'),

    // ntfy (if using ntfy)
    //'ntfyServerUrl'   => getenv('NTFY_SERVER_URL'),
    //'ntfyAccessToken' => getenv('NTFY_ACCESS_TOKEN'),

    // Bluesky (if posting to Bluesky)
    //'blueskyPdsUrl' => getenv('BLUESKY_PDS_URL'),

    // MQTT (if publishing to an MQTT broker)
    //'mqttHost'              => getenv('MQTT_HOST'),
    //'mqttPort'              => 8883,
    //'mqttUseTls'            => true,
    //'mqttUsername'          => getenv('MQTT_USERNAME'),
    //'mqttPassword'          => getenv('MQTT_PASSWORD'),
    //'mqttClientId'          => 'my-craft-site',
    //'mqttProtocolLevel'     => '3.1.1',
    //'mqttTlsCaFile'         => getenv('MQTT_TLS_CA_FILE'),
    //'mqttTlsClientCertFile' => getenv('MQTT_TLS_CLIENT_CERT_FILE'),
    //'mqttTlsClientKeyFile'  => getenv('MQTT_TLS_CLIENT_KEY_FILE'),

    /**
     * Your messaging channels are managed in the control panel, not in this file.
     *
     * To keep secrets out of the database, store each one in a .env variable and
     * reference that variable in the control-panel field instead of typing the
     * value directly.
     */

];
