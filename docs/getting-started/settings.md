---
description: Configure the Notifier plugin's logging behavior, plus any third-party integrations you want to use.
---

# Settings Page

To access the plugin settings, log into your control panel and visit **Settings → Notifier**.

A vertical sidebar splits the settings into one page per provider, with a **General** tab for plugin-wide options.

<img class="dropshadow" src="/images/settings/settings-general.png" alt="Screenshot of the Notifier settings page showing the sidebar and General sub-page" style="width:1044px; margin-top:10px">

### General

By default, Notifier writes a [log event](/logging) every time a message is sent.

Here you can decide:
 - Whether to log outgoing messages at all.
 - How long to keep log records (in days).
 - How many log records to keep (row count).

:::tip Log Management
Learn more about [restricting log size](/logging#restricting-log-size).
:::

### Integrations

Each [integration](/getting-started/integrations/) lives on its own sub-page. Per-provider credentials, account lists, and webhook lists are configured there.

- [Twilio](/getting-started/integrations/twilio) for SMS messages
- [Pushover](/getting-started/integrations/pushover) for push notifications to Craft users
- [ntfy](/getting-started/integrations/ntfy) for push notifications via topics
- [Slack](/getting-started/integrations/slack) for channel posts via Incoming Webhooks
- [Bluesky](/getting-started/integrations/bluesky) for posts via the ATProto API
