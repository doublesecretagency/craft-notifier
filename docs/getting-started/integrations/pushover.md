---
description: Set up a Pushover application to send notifications, and a separate user key for each recipient.
---

# Configuring Pushover

If using [Pushover](https://pushover.net) to send push notifications, you'll first need a Pushover account and the following:
- A [user key](#get-the-user-key) for each recipient, which represents the user **receiving** the notifications.
- A single [application token](#get-the-application-token), which represents the app **sending** the notifications.

You'll only need one application token to send notifications, but each recipient should have their own user key.

Each recipient will also need to install the client app on whichever devices they would like to receive messages on.

:::warning Cheap, but not free
After a trial period, each Pushover license is a one-time $5 charge for each device receiving messages.
:::

## Get the User Key

Each recipient needs their own [Pushover account](https://pushover.net/signup) and at least one of the device clients ([iOS](https://apps.apple.com/us/app/pushover-notifications/id506088175), [Android](https://play.google.com/store/apps/details?id=net.superblock.pushover), or [desktop](https://pushover.net/clients)).

### (1) Find each user's Pushover key

Each Pushover account has a unique user key shown on the [account page](https://pushover.net/).

<img class="dropshadow" src="/images/getting-started/integrations/pushover-account-info.png" alt="Screenshot of a Pushover account page showing the user key" style="width:573px; margin-top:10px">

Within Craft, each potential recipient will need their own unique key stored **in a field on their User profile**.

### (2) Create a "Pushover Key" field in Craft

Pushover keys should typically live in a Plain Text custom field on the User profile.

1. Go to **Settings → Users → User Profile Fields**.
2. Create a new **Plain Text** field called "Pushover Key" (or any name you prefer).

Each person can then store their own unique Pushover user key in the "Pushover Key" field of their User profile.

When configuring Pushover Notifications, you can select the "Pushover Key" field which contains their Pushover keys.

:::tip Notifications skip users without keys
Users with an empty field will be silently skipped when a notification is sent.
:::

## Get the Application Token

In Pushover's [applications](https://pushover.net) page, create a new application for Notifier (or reuse an existing one).

<img class="dropshadow" src="/images/getting-started/integrations/pushover-application-token.png" alt="Screenshot of a Pushover application showing the API token" style="width:565px; margin-top:10px">

Copy the **API Token**, and save it into your `.env` file.

```dotenv
PUSHOVER_APPLICATION_TOKEN="a9u**************************rdt"
```

### Configure Notifier

In the Craft control panel, go to **Settings → Plugins → Notifier → Pushover** to set the application token.

<img class="dropshadow" src="/images/settings/settings-pushover.png" alt="Screenshot of the Pushover settings sub-page" style="width:1044px; margin-top:10px">

:::warning Store the application token securely
You can (and probably should) store the application token in a `.env` variable.
:::
