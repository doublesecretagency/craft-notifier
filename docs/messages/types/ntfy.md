---
description: Send a push notification to one or more ntfy topics.
---

# ntfy

Sends **a push notification to one or more [ntfy](https://ntfy.sh) topics** when the notification event is triggered.

<img class="dropshadow" src="/images/messages/ntfy-example.png" alt="" style="width:414px; margin-top:10px">

ntfy is a free push notification service. Unlike a typical notification service, users subscribe to a **topic**, which acts as a feed for new messages. When Notifier sends a message to that topic, all subscribers receive it.

:::warning Setup Required
Before sending ntfy messages, be sure to add one or more recipient topics via [Settings → ntfy](/getting-started/integrations/ntfy).

If you're self-hosting ntfy and/or have an access token, add that info to the same page. It's recommended to store sensitive credentials in a `.env` variable.
:::

## Config

<img class="dropshadow" src="/images/messages/ntfy-config.png" alt="" style="width:640px; margin-top:10px">

### Priority

Sets how prominently the notification displays, from 1 (lowest) to 5 (highest). Higher values are harder to miss, and on iOS can break through Do Not Disturb.

### Tags

Adds emoji to the notification. Enter a comma-separated list of [emoji shortcodes](https://docs.ntfy.sh/emojis/).

### Link URL

Attaches a URL to the notification. Tapping the notification will open that URL on the recipient's device.

<!--@include: @/messages/types/_special-variables.md-->

### Enable Markdown

Renders the body as Markdown. Some ntfy clients (like the web app) will properly format Markdown syntax, while others (like the iOS app) do not support it and will show the raw text.

## Examples

**Note when an entry is deleted**

```twig
Removed from the site: "{{ entry.title }}".
```

**Flag a new admin account**

```twig
{% if not user.admin %}
    {% skipMessage "Not an admin account." %}
{% endif %}

Heads up: a new admin account was created for {{ user.email }}.
```

**Confirm an order payment**

```twig
Payment received: {{ order.totalPrice|currency }} on order #{{ order.shortNumber }}.
```
