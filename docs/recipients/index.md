---
description: Each notification is sent to one or more recipients. Pick a recipient type to decide who receives the message.
---

# Recipients

Each notification will be sent to one or more **recipients**.

Some examples of recipient types are:

- **All Admins**
- **All Users in Group(s)**
- **Only a specific User**

If the provided recipient types don't meet your needs, it's also possible to write a [custom Twig snippet](/recipients/types/dynamic-recipients) to generate a dynamic list of recipients at runtime.

:::warning All Recipient Types
For more information, see the [complete list of recipient types...](/recipients/types/)
:::

The list of available recipient types may change based on which type of [message](/messages/) was selected (for example, a Flash Message can only be sent to the Current User).

## Unique Messages

Each recipient will receive their own unique copy of the message. Any [special variables](/messages/variables/) will be re-parsed for each individual recipient.

## Advance Filtering of Recipients

If needed, you can start with a pre-existing set of recipients (e.g. "All Admins"), then reduce the subset even further. By using the [`skipMessage`](/messages/skip) tag, you can omit recipients on a granular level.

```twig
{# Don't send message to Doug #}
{% if recipient.user.id == 42 %}
    {% skipMessage %}
{% endif %}
```
