---
description: Via Craft user permissions, manage who can view, edit, and delete notifications and the notification log.
---

# User Permissions

Notifier's user permissions allow privileged users or groups to manage **Notifications** and the **Notification Log**.

<img class="dropshadow" src="/images/permissions/permissions-tree.png" alt="Screenshot of the Notifier permissions tree" style="width:361px; margin-top:10px">

| Permission                                     | Allows                                                                                |
|:-----------------------------------------------|:--------------------------------------------------------------------------------------|
| **View notifications**                         | Access **Notifications** in the control panel navigation.                             |
| —>&nbsp; **Save notifications**                | Create and edit notifications, including the **Meta** tab.                            |
| ——>&nbsp; **Edit the Event tab**               | Edit the trigger event and its conditions.                                            |
| ———>&nbsp; **Use the Dynamic Data type**       | Use the [Dynamic Data](/events/types/dynamic-data/) event type. ⚠️                    |
| ——>&nbsp; **Edit the Message tab**             | Edit the message type and body fields.                                                |
| ——>&nbsp; **Edit the Recipients tab**          | Change who receives the notification.                                                 |
| ———>&nbsp; **Use the Dynamic Recipients type** | Use the [Dynamic Recipients](/recipients/types/dynamic-recipients) recipient type. ⚠️ |
| —>&nbsp; **Send test notifications**           | Send [test notifications](/testing).                                                  |
| —>&nbsp; **Send manual notifications**         | Send [manual notifications](/events/manual-sending) on demand.                        |
| —>&nbsp; **Delete notifications**              | Delete notifications.                                                                 |
| **View notification log**                      | Access **Notification Log** in the control panel Utilities.                           |
| —>&nbsp; **Delete notification log**           | Delete individual log entries, or entire days.                                        |

:::warning ⚠️ Security Warning - For Highly Trusted Users Only!
[Dynamic Data](/events/types/dynamic-data/) and [Dynamic Recipients](/recipients/types/dynamic-recipients) allow a user to run arbitrary Twig when a message is sent.

Even though both snippets are processed via the secure [Twig sandbox](/messages/twig-sandbox), you should still exercise caution and grant permissions _only_ to highly trusted users.
:::
