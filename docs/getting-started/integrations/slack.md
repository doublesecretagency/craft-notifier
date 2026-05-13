---
description: Connect to Slack by creating one or more Incoming Webhooks. Notifier can post to any channel with a webhook, so your notifications can post to different channels if needed.
---

# Configuring Slack

If using [Slack](https://slack.com) to post channel messages, you'll first need to create one or more Incoming Webhook URLs.

### Create an Incoming Webhook

<img class="dropshadow" src="/images/getting-started/integrations/slack-apps.png" alt="Screenshot of Slack's Incoming Webhooks configuration" style="width:1036px; margin-top:17px; margin-bottom:27px">

1. Go to [api.slack.com/apps](https://api.slack.com/apps) and click **Create New App** (or pick an existing app).
2. Under **Features**, enable **Incoming Webhooks**.
3. Click the **Add New Webhook** button.
4. Pick the channel where messages should appear.
5. Copy the generated webhook URL. It looks like `https://hooks.slack.com/services/...`.

<img class="dropshadow" src="/images/getting-started/integrations/slack-webhook-url.png" alt="Screenshot of Slack's Incoming Webhooks configuration" style="width:676px; margin-top:26px; margin-bottom:24px">

:::warning Protect the Webhook URL
Anyone who knows the webhook URL can post to that Slack channel. Treat it like an API key. Keep it in a `.env` variable so the secret never lands in your project config.
:::

### Configure Notifier

First, store each webhook URL in your `.env` file:

```dotenv
SLACK_WEBHOOK_ENGINEERING="https://hooks.slack.com/services/..."
```

Then in the Craft control panel, go to **Settings → Plugins → Notifier → Slack** to:

- Add one or more webhooks with a friendly label (e.g. `#engineering`).
- In the **Webhook URL** field, reference the `.env` variable (e.g. `$SLACK_WEBHOOK_ENGINEERING`).
- Hit the **Test** button next to each webhook to confirm it delivers to the right channel.

<img class="dropshadow" src="/images/settings/settings-slack.png" alt="Screenshot of the Slack settings sub-page" style="width:1044px; margin-top:10px">

### Sending to multiple Slack channels

Each Slack channel will require its own unique webhook URL. Click the **Add New Webhook** button to generate a new URL for each targeted Slack channel.

A single notification can simultaneously post to multiple channels, or you can set up separate notifications which post to different channels.
