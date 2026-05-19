---
description: Configure Notifier's logging and integrations from the Craft control panel.
---

# Control Panel

To access the plugin settings, log into your control panel and visit **Settings → Notifier**.

<img class="dropshadow" src="/images/settings/settings-general.png" alt="Screenshot of the Notifier settings page showing the sidebar and General sub-page" style="width:1044px; margin-top:10px">

### Logging

By default, Notifier writes a [log event](/logging) every time a message is sent.

Here you can decide:
 - Whether to log outgoing messages at all.
 - How long to keep log records (in days).
 - How many log records to keep (row count).

:::tip Log Management
Learn more about [restricting log size](/logging#restricting-log-size).
:::

### Scheduled Sending

If you plan to run the schedule via its [web endpoint](/getting-started/run-the-schedule#web-endpoint), be sure to set a **Scheduled-Run Token**.

It's encouraged to use an environment variable for this value, so you can keep it out of version control and easily change it across environments.

:::warning Token required to use the web endpoint
Web requests must include this value to authenticate.
:::

Any string will work. A long random hex value (e.g. `openssl rand -hex 32`) is the safest default. Avoid a leading `$` unless you intend to reference an environment variable.

---

### Third-Party Integrations

Each [integration](/getting-started/integrations/) lives on its own sub-page. Per-provider credentials, account lists, and webhook lists are configured there.

- [Twilio](/getting-started/integrations/twilio) for SMS messages
- [Pushover](/getting-started/integrations/pushover) for push notifications to Craft users
- [ntfy](/getting-started/integrations/ntfy) for push notifications via topics
- [Slack](/getting-started/integrations/slack) for channel posts via Incoming Webhooks
- [Bluesky](/getting-started/integrations/bluesky) for posts via the ATProto API
