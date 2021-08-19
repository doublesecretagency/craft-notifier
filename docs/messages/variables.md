# Automatic Variables

The following variables will be **automatically available** within your Twig [message template](/messages/set-template/). Certain variables will (or won't) exist, depending on how each notification was triggered.

#### [**Config Variables**](#config-variables) - Always Available

| Variable     | Availability | Description
|:-------------|--------------|-------------
| `recipient`  | All Events   | Individual recipient (User or email address) of each message.
| `activeUser` | All Events   | The logged-in User who triggered the notification.
| `event`      | All Events   | The entire [Event](https://docs.craftcms.com/api/v3/craft-events-modelevent.html) which triggered the notification.

#### [**Content Variables**](#content-variables) - Mixed Availability

| Variable     | Availability | Description
|:-------------|--------------|-------------
| `original`   | On Save      | The original version of a saved Element.
| `entry`      | Entry Events | The updated Entry which triggered the notification.
<!--
| `user`       | User Events  | The updated User which triggered the notification.
| `asset`      | Asset Events | The updated Asset which triggered the notification.
-->

## Where can I use automatic variables?

### Email Subject

For email messages, these variables are available in the [subject line](/messages/set-template/#email-subject).

### Custom Recipients

If your message compiles a set of [custom recipients](/recipients/#custom-selection), these variables will also be available within the context of your custom Twig snippet. The only exception will be the `recipient` variable (which cannot exist before the recipients have been determined).

## Config Variables

### `recipient`

#### Available on All Events

Individual recipient of each message. Can be either a [User Model](https://docs.craftcms.com/api/v3/craft-elements-user.html) or basic email address, depending upon how the [recipients](/recipients/) were determined.

:::warning One Recipient Per Message
Each message is processed separately for each individual recipient. The entire message template will be re-evaluated with the current `recipient` every time it is parsed.
:::

### `activeUser`

#### Available on All Events

The logged-in User who triggered the notification. For example, if this message were triggered when a User saved an Entry, that User would be referenced as the `activeUser`.

### `event`

#### Available on All Events

The [Event](https://docs.craftcms.com/api/v3/craft-events-modelevent.html) itself, which triggered the notification.

## Content Variables

### `original`

#### Available when an element is being saved

The original version of a saved element. You can use this to compare against the modified version of the same element.

### `entry`

#### Available on Entry events

The [Entry](https://docs.craftcms.com/api/v3/craft-elements-entry.html) affected by this event.

<!--

### `user`

#### Available on User events

The [User](https://docs.craftcms.com/api/v3/craft-elements-user.html) affected by this event.

### `asset`

#### Available on Asset events

The [Asset](https://docs.craftcms.com/api/v3/craft-elements-asset.html) affected by this event.

-->
