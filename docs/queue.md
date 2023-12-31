---
description: 
---

# Optional Queue

✅

For the majority of [message types](/messages/types/), it's possible to **send notifications via the [job queue](https://craftcms.com/docs/4.x/extend/queue-jobs.html)**. This is the recommended behavior for most cases, however, you can always circumvent the queue and send messages immediately.

:::tip Exceptions
- [Announcements](/messages/types/announcement) will **always** use the queue.
- [Flash messages](/messages/types/flash) will **never** use the queue.
:::

When using the queue, a message will be:
1. **compiled** when the event is triggered,
2. **queued** for delivery, and finally
3. **sent** once the queue job is run.
