---
description: Send the message only to the User who triggered the event. The required recipient type for Flash Messages.
---

# Current User (who triggers the Event)

Sends the message to **only the User who triggered the event.**

This is the only recipient type that's eligible for [Flash Messages](/messages/types/flash), since flashes can only be displayed to the actively logged-in user.

## When no current user exists

No message will be sent if the event is triggered anonymously (for example, via command line).

## Compatibility with message types

Available for [all message types](/messages/types/).

## Examples

**Show a downstream effect with a flash message**

```twig
"{{ entry.title }}" published. The team will be notified shortly.
```

**Email the user a copy of what they just did**

```twig
Hi {{ currentUser.firstName }},

You just updated "{{ entry.title }}" at {{ now|date('g:i a') }}.

If this wasn't you, please contact an administrator.
```

**Skip when the current user is an admin**

```twig
{% if currentUser.admin %}
    {% skipMessage "Admins don't need confirmation messages." %}
{% endif %}
```
