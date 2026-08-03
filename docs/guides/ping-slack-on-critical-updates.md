---
description: Whenever a critical update is released, Craft will send a Slack message to your preferred channel.
---

# Post to a Slack channel when Critical Updates are released

Stay up-to-date with security patches for Craft and all plugins.

This guide explains how to watch Craft's [Critical Releases](https://feeds.craftcms.com/critical.atom) feed, and post to a Slack channel any time a new critical update is released.

:::tip Covers both Craft and plugins
This RSS feed includes all releases marked `[CRITICAL]` by Craft and/or plugins.
:::

<img class="dropshadow" src="/images/guides/ping-slack-on-critical-updates/slack-result.png" alt="The delivered Slack message" style="width:515px; margin-top:20px">

## Configure the Slack integration

1. If you haven't already, [configure Slack](/getting-started/integrations/slack).
2. Under **Settings → Plugins → Notifier → Slack**, add the channel you want to post to.
3. Give it a friendly label like `#dev-alerts`.
4. Set the **Bot Token** to your `$SLACK_BOT_TOKEN` env variable.
5. Point the **Channel ID** at the channel (e.g. `$SLACK_DEV_ALERTS`).

<img class="dropshadow" src="/images/guides/ping-slack-on-critical-updates/slack-integration.png" alt="Slack settings with a #dev-alerts channel" style="width:1204px; margin-top:10px">

## Select the "RSS/JSON Feed" event type

1. Create a new notification and choose the [**RSS/JSON Feed** event](/events/types/feed/).
2. Paste this value into the **Feed URL** field:
    ```
    https://feeds.craftcms.com/critical.atom
    ```
3. Increase the timeout if needed (e.g. `30` seconds).

<img class="dropshadow" src="/images/guides/ping-slack-on-critical-updates/rssfeed-event.png" alt="Event tab set to RSS/JSON Feed with the critical.atom feed URL" style="width:640px; margin-top:10px; margin-bottom:22px">

## Write the Slack message

:::warning Feel free to customize
However you configure the message is up to you. These are just some recommendations to get you started.
:::

1. Set the **Message Type** to **Slack**. All dynamic fields will have access to [RSS/JSON Feed variables](/messages/variables/rss-json-feed).
2. For the **Slack Message Body**, show the `description` of a given feed `item`:
    ```twig
    {{ item.description }}
    ```
3. Enable **Render Message Body as HTML**, because `item.description` is a snippet of HTML.
4. Disable **Render Link Previews** to keep the post compact (unfurls create noise in this scenario).
5. For this example, we're putting some key information in the **Bot Name** field:
    ```twig
    {{ item.author }} - {{ item.title }}
    ```
6. We set the **Bot Emoji** to `:warning:` here, but feel free to choose a different emoji, or use the **Bot Icon URL** field instead.

<img class="dropshadow" src="/images/guides/ping-slack-on-critical-updates/slack-message.png" alt="Slack message config with the item.description body" style="width:640px; margin-top:10px">

## Select recipient Slack channel(s)

On the **Recipients** tab, check the `#dev-alerts` channel (or whatever you named it earlier).

<img class="dropshadow" src="/images/guides/ping-slack-on-critical-updates/slack-recipients.png" alt="Recipients tab with the #dev-alerts channel checked" style="width:400px; margin-top:10px; margin-bottom:30px">

## Save and finish!

Congrats, you've finished setting up the Notification!

_"Whenever a **critical update is released**, Craft will send a **Slack message** to your **preferred channel**."_

:::warning Don't forget to run the schedule!
As a feed-based event, this Notification is triggered **whenever the schedule is run**. If the schedule doesn't get run, nothing will be sent out.

If you haven't already, be sure to [run the schedule](/getting-started/run-the-schedule) on a recurring basis.
:::
