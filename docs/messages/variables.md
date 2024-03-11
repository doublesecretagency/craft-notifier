---
description:
---

# Special Variables

The following variables will be **automatically available** within your [message template](/messages/templating).

[//]: # (They can also be used to determine [dynamic recipients]&#40;/recipients/types/dynamic-recipients&#41;, with **one notable exception.** For obvious reasons, the `recipient` variable cannot be available while determining the recipient.)

### Event Variables

| Variable | Description                                                                                      |
|:---------|--------------------------------------------------------------------------------------------------|
| `event`  | The underlying triggered [Event](https://docs.craftcms.com/api/v4/craft-events-modelevent.html). |
| `object` | The element or object which triggered the notification. (aka `$event->sender`)                   |

### People Variables

| Variable      | Description                                        |
|:--------------|----------------------------------------------------|
| `currentUser` | The logged-in User who triggered the notification. |

:::warning One recipient per outgoing message
Each message will be parsed separately for each individual recipient.
:::

| Variable                 | Description                                                            |
|:-------------------------|------------------------------------------------------------------------|
| `recipient`              | Individual recipient of each message.                                  |
| `recipient.user`         | User model of recipient.                                               |
| `recipient.name`         | Name of recipient.                                                     |
| `recipient.emailAddress` | Email address of recipient.                                            |
| `recipient.phoneNumber`  | Phone number of recipient.                                             |
| `recipient.emailField`   | Field from which the email address was retrieved.                      |
| `recipient.smsField`     | Field from which the phone number was retrieved.                       |

### Element Variables

[//]: # (:::warning Element Events)
[//]: # (Element variables are only available if the event was triggered by an element action.)
[//]: # (:::)

| Variable                    | Description                                                                              |
|:----------------------------|------------------------------------------------------------------------------------------|
| `entry` _(or another type)_ | Alias of `element`. [(see below)](#alias-of-element)                                     |
| `element`                   | Element which triggered the event.                                                       |
| `original`                  | The original version of a changed Element. [(see below)](#fetching-the-original-element) |

## Alias of `element`

The `element` variable will be automatically aliased based on its **element type**:

| Variable      | Element Type |
|:--------------|--------------|
| `user`        | User         |
| `entry`       | Entry        |
| `asset`       | Asset        |
| `matrixBlock` | Matrix Block |
| _etc_         | _etc_        |

:::warning Supports plugins and modules!
This pattern also works for third-party Elements introduced by plugins or modules.
:::

## Fetching the `original` element

If the notification was triggered by an "on save" event, the `original` element will also be fetched prior to saving.

This can be very useful when comparing the `original` (pre-save) values to the `element` (post-save) values.

:::tip Optionally Skip Messages
One major reason to compare `original` with `element` is to [optionally skip messages](/messages/skip) based on your own custom Twig logic.
:::
