---
description:
---

# Events

✅

Each notification will be triggered by an **event**. Events can be considered "trigger points" within the Craft system.

Commonly used events include:

- **When an Entry is saved**
- **When a new User is created**
- **When an Asset is uploaded**

:::warning List of Event Types
For more information, see the [complete list of event types...](/events/types/)
:::

Once an event is triggered, it will send a [message](/messages/) for each relevant Notification.

## Representative Events

In actuality, the saving of an Entry will trigger _several_ different [internal events](https://craftcms.com/docs/4.x/extend/events.html) as it runs through the entire process (before save, after save, after propagate, etc).

For the purpose of the Notifier plugin, each "event" has been translated to its nearest PHP approximation.
