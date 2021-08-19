---
description:
---

# Queue Jobs

When new messages are triggered, they are not immediately sent out. Messages are sent to the [job queue](https://craftcms.com/docs/3.x/extend/queue-jobs.html), where they wait until the queue has been started.

If necessary, you can bypass the queue and send messages immediately. Set the `bypassQueue` config setting to `true`.

`false` by default



:::tip Recommended
Using the queue is highly recommended for production environments.
:::
