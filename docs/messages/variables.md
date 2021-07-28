# Automatic Variables

A certain set of variables will automatically be available to your [template](/messages/set-template/).

Which variables are available is entirely dependent on how the message was triggered.


## Always Available

Each template will have access to the entire `$event` object.

| Variable     | Description
|:-------------|-------------
| `event`      | The entire [Model Event](https://docs.craftcms.com/api/v3/craft-events-modelevent.html) responsible for triggering the notification.
| `recipient`  | Individual recipient of this message. Can be either a [User Model](https://docs.craftcms.com/api/v3/craft-elements-user.html) or basic email address, depending upon how the [recipients](/recipients/) were determined.
| `activeUser` | The User responsible for triggering the notification. Would generally be known as `currentUser` in a different context.

## Available on Entry Events

Additionally, `entry` will be an alias of `$event->sender` when triggered by an Entry event.

| Variable        | Description
|:----------------|-------------
| `entry`         | The newly affected Entry.
| `originalEntry` | The original state of the same Entry.
