---
description: Notifier supports an assortment of recipient types. In addition to messaging Craft users, you can also send SMS/text messages, Pushover and ntfy push notifications, Slack messages, and Bluesky posts.
---

# All Recipient Types

<img class="dropshadow" src="/images/recipients/recipient-types.png" alt="" style="width:416px; margin-top:10px">

:::warning Additional Filtering of Recipients
Regardless of which recipients are specified, you can always [skip a message](/messages/skip) for individual recipients who fail to meet your custom criteria.
:::

## Native Users

### [Current User (who triggers the Event)](/recipients/types/current-user)

Sends the message to **only the User who triggers the event.**

### [All Users](/recipients/types/all-users)

Sends the message to **all Users in the system.**

### [All Admins](/recipients/types/all-admins)

Sends the message to **all Users with Admin permissions.**

### [All Users in selected User Group(s)](/recipients/types/selected-groups)

Sends the message to **all Users in selected User Groups.**

### [Only selected User(s)](/recipients/types/selected-users)

Sends the message to **only selected Users.**

### [Dynamic Recipients](/recipients/types/dynamic-recipients)

Sends the message to **a dynamically-compiled set of recipients, as defined by a Twig snippet.**

## Push Notifications

### [Selected ntfy topic(s)](/recipients/types/ntfy-topics)

Sends the ntfy message to **one or more topics**.

## Chat Platforms

### [Selected Slack channel(s)](/recipients/types/slack-channels)

Posts the Slack message to **one or more channels**.

### [Selected Discord channel(s)](/recipients/types/discord-channels)

Posts the Discord message to **one or more channels**.

## Social Media

### [Selected Facebook page(s)](/recipients/types/facebook-pages)

Posts the Facebook message to **one or more pages**.

### [Selected Instagram account(s)](/recipients/types/instagram-accounts)

Posts the Instagram message from **one or more accounts**.

### [Selected X (Twitter) account(s)](/recipients/types/x-twitter-accounts)

Posts the X (Twitter) message from **one or more accounts**.

### [Selected Bluesky account(s)](/recipients/types/bluesky-accounts)

Posts the Bluesky message from **one or more accounts**.

### [Selected Mastodon account(s)](/recipients/types/mastodon-accounts)

Publishes the Mastodon post from **one or more accounts**.

## Internet of Things

### [Selected MQTT topic(s)](/recipients/types/mqtt-topics)

Publishes the MQTT message to **one or more topics**.
