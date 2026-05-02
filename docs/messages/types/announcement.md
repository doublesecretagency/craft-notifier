---
description: Post a control panel announcement when the notification event is triggered. Always dispatched via the queue.
---

# Announcement

Posts **an announcement** to the Craft control panel when the notification event is triggered.

<img class="dropshadow" src="/images/messages/announcement-example.png" alt="" style="width:396px; margin-top:10px">

## Config

<img class="dropshadow" src="/images/messages/announcement-config.png" alt="" style="width:650px; margin-top:10px">

<!--@include: @/messages/types/_docs-links.md-->

## Announcement Recipients

Announcements can be shown to all control panel users, or restricted to only Admins.

<img class="dropshadow" src="/images/messages/announcement-recipients.png" alt="" style="width:650px; margin-top:10px">

## Examples

Announcements support a separate body and heading. Both fields render through the standard [Twig parsing](/messages/templating).

**A new entry was published**

```twig
"{{ entry.title }}" is now live in the {{ entry.section.name }} section.
```

**A new user joined**

```twig
{{ user.fullName }} just signed up ({{ user.email }}).
```

**A high-value order came in**

```twig
{% if order.totalPrice < 1000 %}
    {% skipMessage "Below the announcement threshold." %}
{% endif %}

Order {{ order.shortNumber }} - {{ order.totalPrice|currency }} - placed by {{ order.email }}.
```
