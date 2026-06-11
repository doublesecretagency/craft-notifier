---
description: Notifications are third-party elements within Craft, organized into Meta, Trigger, Message, and Recipients tabs for easy editing.
---

# Notification Elements

Notifications are third-party [elements](https://craftcms.com/docs/5.x/system/elements.html) within the Craft ecosystem.

<img class="dropshadow" src="/images/elements/notification-elements.png" alt="" style="width:901px; margin-bottom:30px">

## Tabs

Each individual Notification consists of four parts, separated into tabs...

<img class="dropshadow" src="/images/elements/other-tabs.png" alt="" style="width:416px; margin-top:18px">

### Meta

Simple "Title" and "Description" fields.

### Event

Each Notification is tied to a specific [event](/events/) within the Craft system. When that particular event is triggered, the corresponding message will be sent out.

### Message

Write a custom [message](/messages/) for each Notification. Within the message's [Twig template](/messages/templating) you can use a series of [special variables](/messages/variables/) about the event which triggered it.

### Recipients

Select which [recipients](/recipients/) will receive each Notification. The available options for recipients depends primarily on which [message type](/messages/types/) was selected.

## Fetching Notification Elements

Whether working in Twig or PHP, you can use the following **helper functions** to fetch Notifications...

_**Twig**_

```twig
{# Use an element query for Notifications #}
{% set notifications = notifier.notifications.all() %}

{# Get a specific Notification by its ID #}
{% set notification = notifier.getNotification(id) %}
```

_**PHP**_

```php
use doublesecretagency\notifier\helpers\Notifier;

// Use an element query for Notifications
$notifications = Notifier::notifications()->all();

// Get a specific Notification by its ID
$notification = Notifier::getNotification($id);
```
