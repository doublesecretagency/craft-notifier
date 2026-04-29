---
description: Using a PHP config file, you can override several of the plugin's settings. Find out how to configure the plugin, even across different environments.
---

# PHP Config File

Everything on the plugin's [Settings](/getting-started/settings) page can also be managed via PHP in a config file. By setting these values in `config/notifier.php`, they take precedence over whatever may be set in the control panel.

To configure the sandbox, start by creating a `config/notifier.php` file. It might look something like this...

```php
/**
 * config/notifier.php
 */
return [

    // Logging (all optional)
    'loggingEnabled'      => true,
    'logRetentionDays'    => 30,
    'logRetentionRecords' => 1000,

    // Twilio (only needed if using Twilio to send SMS messages)
    'twilioAccountSid'  => getenv('TWILIO_ACCOUNT_SID'),
    'twilioAuthToken'   => getenv('TWILIO_AUTH_TOKEN'),
    'twilioPhoneNumber' => getenv('TWILIO_PHONE_NUMBER'),

    // Phone number to use for SMS testing purposes
    'testToPhoneNumber' => getenv('TEST_TO_PHONE_NUMBER'),

];
```

Much like the `db.php` and `general.php` files, `notifier.php` is [environmentally aware](https://craftcms.com/docs/4.x/config/#multi-environment-configs). You can also pass in environment values using the `getenv` PHP method.

:::warning Config File Supersedes Control Panel
Values set in `config/notifier.php` take effect at runtime. So if a key is set both here and in the control panel, the config file value wins.
:::

## Settings available via Control Panel

The following settings can also be managed on the [Settings](/getting-started/settings) page.

### Logging

Settings for the [notification log](/logging#restricting-log-size):

- `loggingEnabled` - Toggle log system on/off.
- `logRetentionDays` - Limit log retention by age.
- `logRetentionRecords` - Limit log retention by event count.

### Twilio API Credentials

Settings for the [Twilio API](/getting-started/twilio):

- `twilioAccountSid` - Twilio account SID.
- `twilioAuthToken` - Twilio auth token.
- `twilioPhoneNumber` - Twilio phone number.

:::warning Use `env` Values
Twilio credentials are sensitive. Set them via `env` values rather than hard-coding them into the config file.
:::

## Settings available only via PHP file

### `testToPhoneNumber`

_string_|_null_ - Defaults to `null`.

Recipient phone number to intercept all outbound SMS messages. Similar to [`testToEmailAddress`](https://craftcms.com/docs/5.x/reference/config/general.html#testtoemailaddress).

Set the testing phone number in your local `.env` file, then load it via the PHP config file:

```dotenv
# Testing phone number in local environment
TEST_TO_PHONE_NUMBER="888-555-4444"
```

## Deprecated Settings

### `twigSandbox` [DEPRECATED]

This config setting is deprecated. For the new approach, see the [Twig Sandbox](/messages/twig-sandbox) documentation.
