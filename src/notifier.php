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

    // Logging (all optional)
    //'loggingEnabled'      => true,
    //'logRetentionDays'    => 30,
    //'logRetentionRecords' => 1000,

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
    //'mqttUsername'          => getenv('MQTT_USERNAME'),
    //'mqttPassword'          => getenv('MQTT_PASSWORD'),
    //'mqttTlsCaFile'         => getenv('MQTT_TLS_CA_FILE'),
    //'mqttTlsClientCertFile' => getenv('MQTT_TLS_CLIENT_CERT_FILE'),
    //'mqttTlsClientKeyFile'  => getenv('MQTT_TLS_CLIENT_KEY_FILE'),

    /**
     * Your ntfy topics, Slack channels, Bluesky accounts, and MQTT topics are
     * managed in the control panel, not in this file.
     *
     * To keep sensitive values out of the database (Slack bot tokens, Bluesky
     * app passwords, MQTT passwords and certificate paths), store each secret
     * in a .env variable and reference that variable in the control-panel field
     * instead of typing the value directly.
     */

];
