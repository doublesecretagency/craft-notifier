---
description: Post a control panel announcement when the notification event is triggered. Always dispatched via the queue.
---

# Announcement

Posts **an announcement** to the Craft control panel when the notification event is triggered.

<img class="dropshadow" src="/images/messages/announcement-example.png" alt="" style="width:396px; margin-top:10px">

Announcements are posted in the upper-right corner of the control panel for each user (marked by the gift icon).

## Config

<img class="dropshadow" src="/images/messages/announcement-config.png" alt="" style="width:650px; margin-top:10px">

<!--@include: @/messages/types/_docs-links.md-->

## Announcement Recipients

Announcements are only visible within the control panel. All [recipient types](/recipients/types/) are supported, but recipients without control panel access will be skipped.

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
