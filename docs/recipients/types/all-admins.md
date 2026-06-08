---
description: Send the message to every active User with Admin permissions. Pending, suspended, and locked admins are automatically skipped.
---

# All Admins

Sends the message to **every active User with Admin permissions.**

<img class="dropshadow" src="/images/recipients/all-admins.png" alt="" style="width:400px; margin-top:10px">

## Active Users only

Pending, suspended, and locked admins are skipped. Only admins with an `active` status receive the message.

## Compatibility with message types

Available for [Email](/messages/types/email), [SMS](/messages/types/sms-text), and [Announcement](/messages/types/announcement) messages.

Not available for [Flash Messages](/messages/types/flash), which only ever go to the [current user](/recipients/types/current-user).

:::tip Additional Filtering of Recipients
Within the context of the Twig message body, you can [skip a recipient](/messages/skip) if they don't meet certain conditions.
:::

## Examples

Use [`{% skipMessage %}`](/messages/skip) inside the message body to exclude individual admins at send time.

**Skip the admin who authored the entry**

```twig
{% if entry.author and recipient.user.id == entry.author.id %}
    {% skipMessage "Don't notify the admin who authored the entry." %}
{% endif %}
```

**Skip admins who haven't logged in for 30 days**

```twig
{% if not recipient.user.lastLoginDate or recipient.user.lastLoginDate < now|date_modify('-30 days') %}
    {% skipMessage "Admin has been inactive for 30+ days." %}
{% endif %}
```

**Highlight the admin's first name**

```twig
Hi {{ recipient.user.firstName }},

{{ currentUser.fullName }} just made a change you should review.
```
