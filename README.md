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

Notifier currently supports [11 event types](https://plugins.doublesecretagency.com/notifier/events/types/) and [15 message types](https://plugins.doublesecretagency.com/notifier/messages/types/). Combine them however you'd like, for example...

<img width="901" src="https://plugins.doublesecretagency.com/notifier/images/elements/notification-elements.png?v=1" alt="Screenshot of a notification list in the control panel">

To see what else Notifier can do, check out the [complete documentation ➡️](https://plugins.doublesecretagency.com/notifier/)

---

## How It Works

<img width="416" src="https://plugins.doublesecretagency.com/notifier/images/getting-started/instructions.png?v=1" alt="Screenshot of Notification tabs">

### Event Types

Trigger notifications from a variety of [events](https://plugins.doublesecretagency.com/notifier/events/types/) across native Craft elements, third-party plugins, and other data sources.

<img width="416" src="https://plugins.doublesecretagency.com/notifier/images/events/event-types.png?v=2" alt="Screenshot of event type options">

### Message Types

Send to a broad selection of [message](https://plugins.doublesecretagency.com/notifier/messages/types/) types, regardless of how the message was triggered.

<img width="416" src="https://plugins.doublesecretagency.com/notifier/images/messages/message-types.png?v=2" alt="Screenshot of message type options">

### Recipient Types

Target different [recipients](https://plugins.doublesecretagency.com/notifier/recipients/types/) based on the selected message type. Specify one or more Craft users when relevant.

<img width="416" src="https://plugins.doublesecretagency.com/notifier/images/recipients/recipient-types.png?v=1" alt="Screenshot of recipient type options">

---

## Highly Flexible Notifications System

In addition to the core `EVENT / MESSAGE / RECIPIENTS` architecture, Notifier is an extremely flexible tool for delivering the right message, to the right person, at the right moment. You can monitor individual fields, write custom messages in Twig, dynamically determine the target of a message, and see a complete log record of what's been sent out.

### Field-Level Conditions

Detect changes to specified fields, and only send a notification when those fields have changed (or match a specific value).

<img width="600" src="https://plugins.doublesecretagency.com/notifier/images/events/field-conditions-has-changed.png?v=1" alt="Screenshot of the condition builder with the has-changed operator">

### Write Messages in Twig

Compose every message with [normal Twig](https://plugins.doublesecretagency.com/notifier/messages/templating), including a set of [special variables](https://plugins.doublesecretagency.com/notifier/messages/variables) available at runtime. Each message renders through a configurable [Twig sandbox](https://plugins.doublesecretagency.com/notifier/messages/twig-sandbox).

**Personalize the message**

```twig
Hi {{ recipient.firstName }}, the entry "{{ entry.title }}" was just updated.
```

**Show what changed**

```twig
The title changed from "{{ original.title }}" to "{{ entry.title }}".
```

### Dynamic Recipients

When the recipient depends on the triggering event, [Dynamic Recipients](https://plugins.doublesecretagency.com/notifier/recipients/types/dynamic-recipients) allows you to pass the target into the <code>{%&nbsp;setRecipients&nbsp;%}</code> tag. For example, to message the author of a published entry:

```twig
{% setRecipients entry.author %}
```

### Notification Log

Every outgoing message is [logged](https://plugins.doublesecretagency.com/notifier/logging), giving you a clear view of how each one was handled. Keep the log size in check with the `logRetentionDays` and `logRetentionRecords` settings.

<img width="1000" src="https://plugins.doublesecretagency.com/notifier/images/logs/notification-log.png?v=2" alt="Screenshot of Notification Log">

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
