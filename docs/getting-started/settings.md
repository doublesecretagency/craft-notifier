---
description: Configure the notification log and manage the Twilio API credentials via the plugin's Settings page.
---

# Settings Page

To access the plugin settings, log into your control panel and visit **Settings > Notifier**.

### Logging

By default, Notifier writes a [log event](/logging) every time a message is sent.

These settings control whether and how long those events remain in the database.

<img src="/images/settings/logging-settings.png" alt="Screenshot of the Logging settings panel" style="width:690px; margin-top:8px">

Learn more about [restricting log size](/logging#restricting-log-size).

### Twilio API Credentials

Learn how to manage the [Twilio API credentials](/getting-started/twilio).

In order to use Twilio to send SMS messages, properly configured credentials are **required**.

<img src="/images/settings/twilio-settings.png" alt="Screenshot of Twilio API credentials settings" style="width:690px; margin-top:10px">

Each field can be set directly using an [environment variable](https://craftcms.com/docs/4.x/config/#control-panel-settings) to provide an additional layer of security and portability.

<img src="/images/settings/twilio-env.png" alt="Screenshot of Twilio API credentials provided via environment variables" style="width:690px; margin-top:10px">
