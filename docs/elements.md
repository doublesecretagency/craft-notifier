---
description: 
---

# Notification Elements

Notifications are third-party [elements](https://craftcms.com/docs/4.x/elements.html) within the Craft ecosystem.

<img class="dropshadow" src="/images/elements/notification-elements.png" alt="" style="width:1252px; margin-top:10px">

Each Notification consists of four parts, separated into tabs...

### Meta

Simple "Title" and "Description" fields.

<img class="dropshadow" src="/images/elements/example-notification.png" alt="" style="width:650px; margin-top:10px">

### Event

Notifications are each tied to a specific [event](/events/) within the Craft system. When that particular event is triggered, the Notification will be sent out.

### Message

Notifications will send a specific [message](/messages/), written in Twig or plain text. See more about [templating](/messages/templating) and special [variables](/messages/variables).

### Recipients

Notifications get sent to a specific set of [recipients](/recipients/). Some message types can only reach a limited audience, while other types can be sent to a wide variety of recipients.

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
