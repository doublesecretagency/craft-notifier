---
description: Connect to Slack by creating a Slack app with a bot token. Notifier can post to any channel the bot can access, so your notifications can post to different channels if needed.
---

# Configuring Slack

If using [Slack](https://slack.com) to post channel messages, you'll first need to create a Slack app and grant it the right scopes. Notifier uses the [`chat.postMessage`](https://docs.slack.dev/reference/methods/chat.postMessage) Web API, which supports per-message icon, emoji, and username overrides.

### Create a Slack app

<img class="dropshadow" src="/images/getting-started/integrations/slack-apps.png" alt="Screenshot of the Your Apps page at api.slack.com/apps" style="width:1036px; margin-top:17px; margin-bottom:27px">

1. Go to [api.slack.com/apps](https://api.slack.com/apps) and click **Create New App** → **From scratch** (or pick an existing app).
2. In the sidebar, open **OAuth & Permissions**.
3. Under **Scopes** → **Bot Token Scopes**, add the following three scopes:
   - `chat:write` to post messages.
   - `chat:write.customize` for per-message icon, emoji, and username overrides.
   - `chat:write.public` to post to public channels the bot has not joined.
4. Scroll up and click **Install to Workspace** (or **Reinstall to Workspace** if updating an existing app).
5. Once installed, copy the **Bot User OAuth Token**. It starts with `xoxb-`.

:::warning Protect the Bot Token
Anyone who knows the bot token can post as the app to any channel the bot has access to. Treat it like an API key. Keep it in a `.env` variable so the secret never lands in your project config.
:::

### Find your channel IDs

To find the **channel ID** (e.g. `C01234ABCD`):

1. Open the channel in Slack.
2. Click the channel name at the top to open channel details.
3. Scroll to the bottom of the panel. There's a **Channel ID** field.

Alternatively, right-click the channel in the sidebar and choose **Copy link**. The channel ID is the last path segment.

For **private channels**, also invite the bot:

```
/invite @YourAppName
```

Public channels don't require an invite because of the `chat:write.public` scope.

### Configure Notifier

First, store the bot token and channel IDs in your `.env` file:

```dotenv
SLACK_BOT_TOKEN="xoxb-..."
SLACK_CHANNEL_ENGINEERING="C01234ABCD"
SLACK_CHANNEL_SALES="C05678EFGH"
# ... add all relevant channel IDs
```

Then in the Craft control panel, go to **Settings → Plugins → Notifier → Slack** to:

- Add one or more channels with a friendly label (e.g. `#engineering`).
- In the **Bot Token** field, reference the `.env` variable (e.g. `$SLACK_BOT_TOKEN`).
- In the **Channel ID** field, either paste the channel ID directly (`C01234ABCD`) or reference a `.env` variable (`$SLACK_CHANNEL_ENGINEERING`).
- Hit the **Test** button next to each channel to confirm it delivers to the right place.

<img class="dropshadow" src="/images/settings/settings-slack.png" alt="Screenshot of the Slack settings sub-page" style="width:1044px; margin-top:10px">

### Sending to multiple Slack channels

One bot token can post to as many channels as the bot has access to. Add a separate row in **Settings → Slack** for each channel, using the same bot token reference with a different channel ID and label.

A single notification can simultaneously post to multiple channels, or you can set up separate notifications which post to different channels.

### Multiple Slack workspaces

If you need to post to channels in different Slack workspaces, create a separate Slack app per workspace and store each workspace's bot token in its own `.env` variable. Each row in **Settings → Slack** can then reference the appropriate token.
