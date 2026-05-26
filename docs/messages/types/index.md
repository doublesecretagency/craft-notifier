---
description: Notifier supports a large collection of message types, including email, SMS/text, Pushover, ntfy, Slack, Bluesky, and more.
---

# All Message Types

<img class="dropshadow" src="/images/messages/message-types.png" alt="" style="width:416px; margin-top:10px">

## Craft Native

### [Email](/messages/types/email)

Sends a traditional email.

### [Announcement](/messages/types/announcement)

Posts an [announcement](https://craftcms.com/docs/5.x/system/control-panel.html#announcements) in the Craft control panel. Appears under the gift icon in the top-right corner.

### [Flash Message](/messages/types/flash)

Posts a short-term message for near-immediate consumption. On the following page load, the logged-in user will see the flash message appear in the lower-left corner.

## Third-party Integrations

### [SMS (Text Message)](/messages/types/sms-text)

Sends an SMS (text) message via the [Twilio](https://www.twilio.com) API.

### [Pushover](/messages/types/pushover)

Sends a push notification to one or more Craft users via [Pushover](https://pushover.net).

### [ntfy](/messages/types/ntfy)

Sends a push notification to one or more [ntfy](https://ntfy.sh) topics.

### [Slack](/messages/types/slack)

Posts a message to one or more Slack channels via [Incoming Webhooks](https://api.slack.com/messaging/webhooks).

### [Bluesky](/messages/types/bluesky)

Publishes a post to one or more [Bluesky](https://bsky.app) accounts via the ATProto API.
