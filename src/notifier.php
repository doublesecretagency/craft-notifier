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

    /**
     * Note: ntfyTopics, slackChannels, and blueskyAccounts are managed via the
     * control panel only, not in this file. For sensitive values (Slack webhook
     * URLs, Bluesky app passwords), store the secret in a .env variable and
     * reference it in the control-panel field, e.g. $SLACK_WEBHOOK_URL.
     */

];
