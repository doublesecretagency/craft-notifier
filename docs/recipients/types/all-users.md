---
description: Send the message to every active User in the system. Use with caution and consider skipping recipients that don't meet your criteria.
---

# All Users

Sends the message to **every active User in the system.**

:::warning ⚠️ USE WITH CAUTION
Ensure you really want all system Users to see the message!

Otherwise, take proper care to [skip any recipients](/messages/skip) which don't meet required conditions.

Or use a different [Recipient Type](/recipients/types/). You may find it easier to work with the [Dynamic Recipients](/recipients/types/dynamic-recipients) type instead.
:::

:::tip Additional Filtering of Recipients
Within the context of the Twig message body, you can [skip a recipient](/messages/skip) if they don't meet certain conditions.
:::
## Active Users only

Pending, suspended, and locked Users are skipped. Only Users with an `active` status receive the message.

## Compatibility with message types

Available for [Email](/messages/types/email), [SMS](/messages/types/sms-text), and [Announcement](/messages/types/announcement) messages.

Not available for [Flash Messages](/messages/types/flash), which only ever go to the [current user](/recipients/types/current-user).

## Examples

Use [`{% skipMessage %}`](/messages/skip) inside the message body to exclude individual recipients at send time.

**Skip users who haven't logged in for 90 days**

```twig
{% if not recipient.user.lastLoginDate or recipient.user.lastLoginDate < now|date_modify('-90 days') %}
    {% skipMessage "User has been inactive for 90+ days." %}
{% endif %}
```

**Skip users in a specific group**

```twig
{% if recipient.user.isInGroup('contractors') %}
    {% skipMessage "Contractor group does not receive this message." %}
{% endif %}
```

**Skip the user who triggered the event**

```twig
{% if currentUser and currentUser.id == recipient.user.id %}
    {% skipMessage "Don't notify the user who triggered the event." %}
{% endif %}
```
