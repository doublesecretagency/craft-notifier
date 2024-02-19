---
description: Using a PHP config file, you can override several of the plugin's settings. Find out how to configure the plugin, even across different environments.
---

# PHP Config File

Everything on the plugin's [Settings](/getting-started/settings) page can also be managed via PHP in a config file. By setting these values in `config/notifier.php`, they take precedence over whatever may be set in the control panel.

```shell
# Copy this file...
/vendor/doublesecretagency/craft-notifier/src/config.php

# To here... (and rename it)
/config/notifier.php
```

Much like the `db.php` and `general.php` files, `notifier.php` is [environmentally aware](https://craftcms.com/docs/4.x/config/#multi-environment-configs). You can also pass in environment values using the `getenv` PHP method.

```php
return [

    // Twilio (only needed if using Twilio to send SMS messages)
    'twilioAccountSid'  => getenv('TWILIO_ACCOUNT_SID'),
    'twilioAuthToken'   => getenv('TWILIO_AUTH_TOKEN'),
    'twilioPhoneNumber' => getenv('TWILIO_PHONE_NUMBER'),

    // Phone number to use for SMS testing purposes
    'testToPhoneNumber' => getenv('TEST_TO_PHONE_NUMBER'),

];
```

## Settings available via Control Panel

Twilio API credentials can also be managed on the [Settings](/getting-started/settings) page (preferably using `env` values).

Learn more about managing your [Twilio API credentials](/getting-started/twilio).

## Settings available only via PHP file

### `testToPhoneNumber`

_string_|_null_ - Defaults to `null`.

Recipient phone number to intercept all outbound SMS messages. Similar to [`testToEmailAddress`](https://craftcms.com/docs/4.x/config/general.html#testtoemailaddress).

Set the testing phone number in your local `.env` file, then load it via the PHP config file:

```dotenv
# Testing phone number in local environment
TEST_TO_PHONE_NUMBER="888-555-4444"
```
