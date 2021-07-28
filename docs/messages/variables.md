# Automatic Variables

A certain set of variables will automatically be available to your [template](/messages/set-template/).

Which variables are available is entirely dependent on how the message was triggered.


## Available Twig Variables

Each template will have access to the entire `$event` object.

Additionally, `entry` will be an alias of `$event->sender` when triggered by an Entry event.

| Variable        | Description
|:----------------|-------------
| `entry`         | The newly affected Entry.
| `originalEntry` | The original state of the same Entry.
| `recipient`     | Unique recipient of this message. Can be either a [User Model]() or basic email address, depending upon how the Recipients were determined.
