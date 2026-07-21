<img align="left" width="66" src="https://plugins.doublesecretagency.com/notifier/images/icon.svg" alt="Plugin icon">

# Notifier plugin for Craft CMS

**First-class Notifications for Craft 4 and Craft 5.**

🔌️ Find it in the [Craft Plugin Store](https://plugins.craftcms.com/notifier)!

---

```
When an [EVENT] occurs, send a [MESSAGE] to designated [RECIPIENTS].
```

Notifier supports a wide variety of [event](https://plugins.doublesecretagency.com/notifier/events/types/) and [message types](https://plugins.doublesecretagency.com/notifier/messages/types/), mix & match to build each Notification!

- **Email admins** about pending users.
- **Send welcome email** to new users.
- **Post to Slack** when an order is placed.
- **Text customers** when new products are added.
- **Tweet** when a new blog post goes live.
- Get an **alert** if a critical update is available.
- Get a **daily summary** of site activity.

What else can it to? See the [complete documentation ➡️](https://plugins.doublesecretagency.com/notifier/)

---

## How It Works

<img width="416" src="https://plugins.doublesecretagency.com/notifier/images/getting-started/instructions.png?v=1" alt="Screenshot of Notification tabs">

### Event Types

Trigger notifications from a variety of [events](https://plugins.doublesecretagency.com/notifier/events/types/) across native Craft elements, third-party plugins, and other data sources.

| Event Group        | Trigger Types                                       |
|:-------------------|:----------------------------------------------------|
| Native Elements    | Entries, Assets, Users                              |
| Plugin Elements    | Craft Commerce, Digital Products, Solspace Calendar |
| Other Data Sources | RSS/JSON Feed, System Snapshot, Dynamic Data        |

### Message Types

Send to a broad selection of [message](https://plugins.doublesecretagency.com/notifier/messages/types/) types, regardless of how the message was triggered.

| Category           | Message Types                                                 |
|:-------------------|:--------------------------------------------------------------|
| Native Pings       | Email, Announcement, Flash Message                            |
| Push Notifications | SMS, Pushover, ntfy                                           |
| Chat Platforms     | Slack, Discord                                                |
| Social Media       | Facebook, Instagram, X (Twitter), Bluesky, Mastodon, LinkedIn |
| Internet of Things | MQTT                                                          |

### Recipient Types

Target different [recipients](https://plugins.doublesecretagency.com/notifier/recipients/types/) based on the selected message type. Specify one or more Craft users when relevant.

---

## Highly Flexible Notifications System

Notifier is an extremely flexible tool for delivering the right message at the right moment.

### Write Messages in Twig

Compose every message with [normal Twig](https://plugins.doublesecretagency.com/notifier/messages/templating), including a set of [special variables](https://plugins.doublesecretagency.com/notifier/messages/variables) available at runtime.

**Personalize the message**

```twig
Hi {{ recipient.firstName }}, the entry "{{ entry.title }}" was just updated.
```

**Show what changed**

```twig
The title changed from "{{ original.title }}" to "{{ entry.title }}".
```

**Include additional information**

Add [custom fields](https://plugins.doublesecretagency.com/notifier/custom-fields) (e.g. "Additional Resources") and include them in your message.

```twig
<p>Welcome {{ recipient.firstName }},</p>
<p>Here are some links to get you started...</p>
<ul>
  {% for resource in notification.additionalResources.all() %}
    <li>
      <a href="{{ resource.url }}">{{ resource.title }}</a>
    </li>
  {% endfor %}
</ul>
```

---

## How to Install the Plugin

To get started, see the [**complete installation instructions ➡️**](https://plugins.doublesecretagency.com/notifier/getting-started/installation)

---

## Further Reading

If you haven't already, flip through the [complete plugin documentation](https://plugins.doublesecretagency.com/notifier/).

And if you have any remaining questions, feel free to [reach out to us](https://www.doublesecretagency.com/contact).

**On behalf of Double Secret Agency, thanks for checking out our plugin!** 🍺

<p align="center">
    <img width="130" src="https://www.doublesecretagency.com/resources/images/dsa-transparent.png" alt="Logo for Double Secret Agency">
</p>
