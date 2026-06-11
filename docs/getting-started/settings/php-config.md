---
description: Using a PHP config file, you can override several of the plugin's settings. Find out how to configure the plugin, even across different environments.
---

# PHP Config File

Nearly every setting can also be managed via a PHP config file. See [Settings](/getting-started/settings/) for how the control panel and PHP config file interact.

To get started, create a `config/notifier.php` file. It might look something like this...

```php
/**
 * config/notifier.php
 */
return [

    // Notification order (optional)
    'defaultPlacement' => 'end', // 'beginning' or 'end' (default)

    // Logging (all optional)
    'loggingEnabled'      => true,
    'logRetentionDays'    => 30,
    'logRetentionRecords' => 1000,

    // Scheduled sending (only needed if running the schedule via its web endpoint)
    'scheduledToken' => getenv('NOTIFIER_SCHEDULED_TOKEN'),

    // Twilio (if using Twilio to send SMS messages)
    'twilioAccountSid'  => getenv('TWILIO_ACCOUNT_SID'),
    'twilioAuthToken'   => getenv('TWILIO_AUTH_TOKEN'),
    'twilioPhoneNumber' => getenv('TWILIO_PHONE_NUMBER'),

    // Phone number to use for SMS testing purposes
    'testToPhoneNumber' => getenv('TEST_TO_PHONE_NUMBER'),

    // Pushover (if using Pushover)
    'pushoverApplicationToken' => getenv('PUSHOVER_APPLICATION_TOKEN'),

    // ntfy (if using ntfy)
    'ntfyServerUrl'   => getenv('NTFY_SERVER_URL'),
    'ntfyAccessToken' => getenv('NTFY_ACCESS_TOKEN'),

    // Bluesky (if posting to Bluesky)
    'blueskyPdsUrl' => getenv('BLUESKY_PDS_URL'),

    // MQTT (if publishing to an MQTT broker)
    'mqttHost'              => getenv('MQTT_HOST'),
    'mqttPort'              => 8883,
    'mqttUseTls'            => true,
    'mqttUsername'          => getenv('MQTT_USERNAME'),
    'mqttPassword'          => getenv('MQTT_PASSWORD'),
    'mqttClientId'          => 'my-craft-site',
    'mqttProtocolLevel'     => '3.1.1',
    'mqttTlsCaFile'         => getenv('MQTT_TLS_CA_FILE'),
    'mqttTlsClientCertFile' => getenv('MQTT_TLS_CLIENT_CERT_FILE'),
    'mqttTlsClientKeyFile'  => getenv('MQTT_TLS_CLIENT_KEY_FILE'),

];
```

Much like the `db.php` and `general.php` files, `notifier.php` is [environmentally aware](https://craftcms.com/docs/5.x/configure.html#multi-environment-configs). You can also pass in environment values using the `getenv` PHP method.

:::warning PHP File Supersedes Control Panel
Values set in `config/notifier.php` take effect at runtime. So if a key is set both here and in the control panel, the PHP file value takes precedence.
:::

## Settings available via Control Panel

The following settings can also be managed on the [Control Panel](/getting-started/settings/control-panel) page.

### Notification Order

Settings for the [notification order](/getting-started/settings/control-panel#notification-order):

- `defaultPlacement` - Where new notifications are added to the list. Either `'beginning'` or `'end'` (default).

### Logging

Settings for the [notification log](/logging#restricting-log-size):

- `loggingEnabled` - Toggle log system on/off.
- `logRetentionDays` - Limit log retention by age.
- `logRetentionRecords` - Limit log retention by event count.

### Scheduled Sending

Settings for [scheduled sending](/getting-started/settings/control-panel#scheduled-sending):

- `scheduledToken` - Shared secret for the scheduled-run [web endpoint](/getting-started/run-the-schedule#web-endpoint). Only needed when triggering the schedule over the web.

### Twilio

Settings for [Twilio](/getting-started/integrations/twilio):

- `twilioAccountSid` - Twilio account SID.
- `twilioAuthToken` - Twilio auth token.
- `twilioPhoneNumber` - Twilio phone number.
- `testToPhoneNumber` - Intercept all outbound SMS to this number, for testing. Similar to Craft's [`testToEmailAddress`](https://craftcms.com/docs/5.x/reference/config/general.html#testtoemailaddress).

### Pushover

Settings for [Pushover](/getting-started/integrations/pushover):

- `pushoverApplicationToken` - Pushover application API token.

### ntfy

Settings for [ntfy](/getting-started/integrations/ntfy):

- `ntfyServerUrl` - ntfy server URL. Leave unset to use `https://ntfy.sh`.
- `ntfyAccessToken` - ntfy access token, for protected topics or authenticated instances.

### Bluesky

Settings for [Bluesky](/getting-started/integrations/bluesky):

- `blueskyPdsUrl` - Bluesky PDS URL. Defaults to `https://bsky.social`.

### MQTT

Settings for [MQTT](/getting-started/integrations/mqtt):

- `mqttHost` - Broker hostname, without a protocol or port.
- `mqttPort` - Broker port. Defaults to `8883` with TLS, otherwise `1883`.
- `mqttUseTls` - Whether to connect over a secure TLS socket.
- `mqttUsername` - Username, for brokers that require authentication.
- `mqttPassword` - Password, for brokers that require authentication.
- `mqttClientId` - Client ID. Auto-generated when left blank.
- `mqttProtocolLevel` - Protocol version sent to the broker. Defaults to `3.1.1`.
- `mqttTlsCaFile` - Path to the CA certificate file.
- `mqttTlsClientCertFile` - Path to the client certificate file (Mutual TLS).
- `mqttTlsClientKeyFile` - Path to the client private key file (Mutual TLS).
