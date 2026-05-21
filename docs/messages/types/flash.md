---
description: Post a flash message when the notification event is triggered. Only delivered to the User who triggered the event.
---

# Flash Message

Posts **a flash message** when the notification event is triggered.

<img class="dropshadow" src="/images/messages/flash-example.png" alt="" style="width:366px; margin-top:10px">

## Config

<img class="dropshadow" src="/images/messages/flash-config.png" alt="" style="width:640px; margin-top:10px">

<!--@include: @/messages/types/_docs-links.md-->

## Flash Message Recipient

Only the **current user** will be able to see the message.

It will briefly appear in the bottom-left corner of the control panel. The message will appear only once, after the user triggers the event and refreshes (or goes to a new page).

## Sent Immediately

Unlike other message types, flash messages **never use the queue**. They're attached to the active session at the moment the event fires, so there's nothing to defer.

## Examples

Flash messages are short by nature. The body is rendered as plain text and shown for a few seconds in the bottom-left corner of the control panel.

**Confirm the save**

```twig
"{{ entry.title }}" was saved.
```

**Greet the user by name**

```twig
Welcome back, {{ currentUser.firstName }}!
```

**Confirm an image upload**

```twig
"{{ asset.filename }}" uploaded ({{ asset.width }}×{{ asset.height }}).
```
