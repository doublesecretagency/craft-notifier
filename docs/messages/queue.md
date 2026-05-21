---
description: Send certain message types via Craft's job queue, or bypass the queue and send immediately. The default behavior is recommended for most cases.
---

# Optional Queue

For most [message types](/messages/types/), it's possible to **send notifications via the [job queue](https://craftcms.com/docs/5.x/extend/queue-jobs.html)**. This is generally the recommended behavior, however you can always circumvent the queue and send messages immediately.

<img class="dropshadow" src="/images/queue/queue-toggle.png" alt="" style="width:364px; margin-top:10px">

:::tip Exceptions
- [Announcements](/messages/types/announcement) will **always** use the queue.
- [Flash messages](/messages/types/flash) will **never** use the queue.
:::

When using the queue, a message will be:
1. **compiled** when the event is triggered,
2. **queued** for delivery, and finally
3. **sent** once the queue job is run.
