<img align="left" width="66" src="https://plugins.doublesecretagency.com/notifier/images/icon.svg" alt="Plugin icon">

# Notifier plugin for Craft CMS

**First-class Notifications for Craft 4 and Craft 5.**

---

<div align="center">
  <a href="#event-types">Event Types</a> &nbsp;&nbsp;&bull;&nbsp;&nbsp;
  <a href="#message-types">Message Types</a> &nbsp;&nbsp;&bull;&nbsp;&nbsp;
  <a href="#recipient-types">Recipient Types</a>
</div>

---

It can best be explained with the following formula:

```
When an [EVENT] occurs, send a [MESSAGE] to designated [RECIPIENTS].
```

There are endless reasons why you may need a combination of these event/message/recipient types, for example...

- Email a welcome message when a User registers
- Text the warehouse when an order is paid
- Send a Slack message when an RSS feed updates
- Post to Bluesky when a new entry goes live

... and so much more. For more details, see the [complete documentation](https://plugins.doublesecretagency.com/notifier/).

## How It Works

### Event Types

Trigger notifications from a variety of [events](https://plugins.doublesecretagency.com/notifier/events/types/), including Entries, Assets, Users, Craft Commerce, Digital Products, Solspace Calendar, or even watching RSS/JSON feeds.

<img width="416" src="https://plugins.doublesecretagency.com/notifier/images/events/event-types.png?v=1" alt="Screenshot of event type options">

### Message Types

Regardless of the trigger, you can send a [message](https://plugins.doublesecretagency.com/notifier/messages/types/) via email, SMS, Slack, ntfy, Pushover, Bluesky, a control-panel Announcement, or Flash message.

<img width="416" src="https://plugins.doublesecretagency.com/notifier/images/messages/message-types.png?v=1" alt="Screenshot of message type options">

### Recipient Types

Messages can be sent to many [recipients](https://plugins.doublesecretagency.com/notifier/recipients/types/), including [Dynamic Recipients](https://plugins.doublesecretagency.com/notifier/recipients/types/dynamic-recipients) for cases where the recipient is determined at runtime.

<img width="416" src="https://plugins.doublesecretagency.com/notifier/images/recipients/recipient-types.png?v=1" alt="Screenshot of recipient type options">

## Write Messages in Twig

All messages can be composed using [normal Twig](https://plugins.doublesecretagency.com/notifier/messages/templating), including a set of [special variables](https://plugins.doublesecretagency.com/notifier/messages/variables) available at runtime. Each message renders through a configurable [Twig sandbox](https://plugins.doublesecretagency.com/notifier/messages/twig-sandbox).

**Personalize the message**

```twig
Hi {{ recipient.firstName }}, the entry "{{ entry.title }}" was just updated.
```

**Show what changed**

```twig
The title changed from "{{ original.title }}" to "{{ entry.title }}".
```

## Dynamic Recipients

When you need to determine the recipient at runtime, use [Dynamic Recipients](https://plugins.doublesecretagency.com/notifier/recipients/types/dynamic-recipients) and pass the target into the `{% setRecipients %}` tag:

```twig
{% setRecipients entry.author %}
```

## Field-Level Conditions

Detect changes to specified fields, and only send a notification when those fields have changed (or match a specific value).

<img width="600" src="https://plugins.doublesecretagency.com/notifier/images/events/field-conditions-has-changed.png?v=1" alt="Screenshot of the condition builder with the has-changed operator">

## Notification Log

Every outgoing message is [logged](https://plugins.doublesecretagency.com/notifier/logging), giving you a detailed view of how each message was handled. Restrict log growth with the `logRetentionDays` and `logRetentionRecords` settings.

<img width="1184" src="https://plugins.doublesecretagency.com/notifier/images/logs/notification-log.png?v=1" alt="Screenshot of Notification Log">

---

## How to Install the Plugin

To get started, see the [**complete installation instructions ➡️**](https://plugins.doublesecretagency.com/notifier/getting-started/installation)

---

## Further Reading

If you haven't already, flip through the [complete plugin documentation](https://plugins.doublesecretagency.com/notifier/).

And if you have any remaining questions, feel free to [reach out to us](https://www.doublesecretagency.com/contact) (via Discord is preferred).

**On behalf of Double Secret Agency, thanks for checking out our plugin!** 🍺

<p align="center">
    <img width="130" src="https://www.doublesecretagency.com/resources/images/dsa-transparent.png" alt="Logo for Double Secret Agency">
</p>
