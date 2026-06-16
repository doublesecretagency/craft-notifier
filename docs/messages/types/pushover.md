---
description: Send a push notification via Pushover.
---

# Pushover

Sends **a push notification to one or more Craft users** via [Pushover](https://pushover.net) when the notification event is triggered.

<img class="dropshadow" src="/images/messages/pushover-example.png" alt="" style="width:414px; margin-top:10px">

To receive messages, each Craft user will need their own Pushover account.

Each user's unique **Pushover User Key** should be stored in a [custom plain-text field](/getting-started/integrations/pushover#get-the-user-key) on their User profile.

:::warning Pushover Setup Required
Before sending Pushover messages, set the Application API Token via [Settings → Pushover](/getting-started/integrations/pushover).
:::

## Config

For each Pushover notification, be sure to specify the **field containing each user's Pushover key**.

<img class="dropshadow" src="/images/messages/pushover-config.png" alt="" style="width:640px; margin-top:10px">

### Field containing each user's Pushover key

Select which User field holds the recipient's Pushover user key.

### Pushover Title

Optionally include a heading above the body.

### Pushover Body

The body of the Pushover notification. Plain text only.

<!--@include: @/messages/types/_special-variables.md-->

## Pushover Recipients

Pushover messages can be sent to standard [User-centric recipient types](/recipients/types/).

For each recipient, Notifier will read the **field containing each user's Pushover key**. Whatever user field was specified will be referenced for the recipient's Pushover user key for that outbound message.

Users with an empty key field will be skipped.

## Examples

**Ping admins when a new user signs up**

```twig
{{ user.friendlyName }} just created an account.
```

**Flag a new file upload**

```twig
New upload: {{ asset.filename }} ({{ asset.size|filesize }}).
```

**Alert on a high-value order**

```twig
{% if order.totalPrice < 1000 %}
    {% skipMessage "Below the alert threshold." %}
{% endif %}

Large order: {{ order.totalPrice|currency }} from {{ order.email }}.
```
