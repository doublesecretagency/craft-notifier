---
description: Send the message to every active User in one or more selected User Groups. Selecting All covers any group added later.
---

# All Users in selected User Group(s)

Sends the message to **every active User in the selected User Groups.**

<img class="dropshadow" src="/images/recipients/selected-groups.png" alt="" style="width:340px; margin-top:10px">

Pick one or more User Groups. Selecting **All** is equivalent to picking every group individually, and applies to any group added to the system after the notification is saved.

:::info One Message Per User
If a User is in more than one of the selected groups, they will receive only a single message.
:::

:::tip Active Users Only
Pending, suspended, and locked Users are skipped. Only Users with an `active` status receive the message.
:::

## Compatibility with message types

Available for [Email](/messages/types/email), [SMS](/messages/types/sms-text), and [Announcement](/messages/types/announcement) messages.

Not available for [Flash Messages](/messages/types/flash), which only ever go to the [current user](/recipients/types/current-user).

## Examples

Use [`{% skipMessage %}`](/messages/skip) inside the message body to exclude individual recipients at send time.

**Skip users who opted out via a custom field**

```twig
{% if recipient.user.skipNotifications %}
    {% skipMessage "User has opted out of notifications." %}
{% endif %}
```

**Skip newly created accounts**

```twig
{% if recipient.user.dateCreated > now|date_modify('-7 days') %}
    {% skipMessage "Account is less than 7 days old." %}
{% endif %}
```

**Skip users without a specific permission**

```twig
{% if not recipient.user.can('accessPlugin-notifier') %}
    {% skipMessage "User does not have access to Notifier." %}
{% endif %}
```
