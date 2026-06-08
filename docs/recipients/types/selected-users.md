---
description: Send the message to a hand-picked list of Users. Deleted Users are silently dropped from the recipient list.
---

# Only selected User(s)

Sends the message to **only the selected Users.**

<img class="dropshadow" src="/images/recipients/selected-users.png" alt="" style="width:400px; margin-top:10px">

Pick one or more Users. Updates to the User will not impact their placement on this list. If a User is deleted, they will be silently dropped from the recipient list.

:::tip Active Users Only
Pending, suspended, and locked Users are skipped. Only Users with an `active` status receive the message.
:::

## Compatibility with message types

Available for [Email](/messages/types/email), [SMS](/messages/types/sms-text), and [Announcement](/messages/types/announcement) messages.

Not available for [Flash Messages](/messages/types/flash), which only ever go to the [current user](/recipients/types/current-user).

