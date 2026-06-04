---
description: In every message template field, a series of special Twig variables will be automatically available. Some variables are universally available, while others depend on which event type triggered the notification.
---

# Special Variables

A collection of **special variables** are automatically set within the [message template](/messages/templating). Some of these variables are always available, while others depend on the [event type](/events/types/) which triggered the notification.

They can also be used to determine [dynamic recipients](/recipients/types/dynamic-recipients), with **one notable exception**... For obvious reasons, the `recipient` variable cannot be available while determining the recipient.

## Event Type Variables

Available based on **which event type triggered the notification**.

| Event type | Variables                                                                   |
|:-----------|:----------------------------------------------------------------------------|
| [Element Events](/messages/variables/element-events) | `original`, `object`, `element`, element alias (`entry`, `asset`, `user`, etc.) |
| [RSS/JSON Feed](/messages/variables/rss-json-feed) | `feed`, `item`                                                              |
| [System Snapshot](/messages/variables/system-snapshot) | `report`                                                                    |
| [Dynamic Data](/messages/variables/dynamic-data) | `data`                                                                      |

## Event and People Variables

Available to **all event types**.

:::warning Current User Availability
`currentUser` is only available when the notification was triggered by a **real, logged-in user**. It won't be available if the notification was triggered via command line or a cron job (since there's no logged-in user in that scenario).
:::

If the message is being sent to [multiple recipients](/recipients/types/), Notifier will loop over each recipient individually. Each recipient will receive a **unique copy** of the templated message.

The `recipient` variable will be unique for each recipient, per their copy of the outbound message.

| Variable                 | Description                                                                                      |
|:-------------------------|--------------------------------------------------------------------------------------------------|
| `event`                  | The underlying triggered [Event](https://docs.craftcms.com/api/v5/craft-events-modelevent.html). |
| `currentUser`            | The logged-in User who triggered the notification.                                               |
| `recipient`              | Individual recipient of each message.                                                            |
| `recipient.user`         | User model of recipient.                                                                         |
| `recipient.name`         | Name of recipient.                                                                               |
| `recipient.emailAddress` | Email address of recipient.                                                                      |
| `recipient.phoneNumber`  | Phone number of recipient.                                                                       |
| `recipient.emailField`   | Field from which the email address was retrieved.                                                |
| `recipient.smsField`     | Field from which the phone number was retrieved.                                                 |

## Examples

**Greet the recipient by name**

```twig
Hi {{ recipient.name }},

We'll keep you posted at {{ recipient.emailAddress }}.
```

**Identify who triggered the notification**

```twig
{% if currentUser %}
    {{ currentUser.fullName }} just triggered this notification.
{% else %}
    This notification was triggered by an automated process.
{% endif %}
```

**Skip the message when the recipient is the user who triggered it**

```twig
{% if currentUser and currentUser.id == recipient.user.id %}
    {% skipMessage "Don't notify the user who triggered the event." %}
{% endif %}
```
