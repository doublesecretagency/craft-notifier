---
description:
---

# Skip Sending a Message

✅

Within the context of the Twig template, you can skip sending a **single message** to an **individual recipient**.

Each recipient is processed individually, so a message could be stopped completely by skipping all recipients.

## How it works

During the parsing of your Twig template, the message will be aborted if the `skipMessage` tag is encountered. You can use this tag to define complex custom logic, and stop messages from being sent if some internal criteria is not met.

```twig
{# Prevents a message from being sent #}
{% skipMessage %}
```

:::tip Skips only one recipient
Please note that this will skip **only a single recipient**, and will continue attempting to send the message to all other valid recipients.

Ultimately, if `skipMessage` is encountered for all recipients, no message will be sent out.
:::

## Practical Examples

There are a wide variety of [special variables](/messages/variables) available in your Twig logic.

You can use that information to determine whether a particular message should be skipped, or continue being sent.

```twig
{# Skip message if the recipient is a specific person #}
{% if recipient.id == 42 %}
    {% skipMessage %}
{% endif %}

{# Skip message if the recipient is in a specific group #}
{% if recipient.isInGroup('groupHandle') %}
    {% skipMessage %}
{% endif %}

{# Skip message if a custom dropdown is set to "Under Review" #}
{% if entry.reviewStatus == 'underReview' %}
    {% skipMessage %}
{% endif %}

{# Skip message if the field value didn't change #}
{% if originalEntry.myField == entry.myField %}
    {% skipMessage %}
{% endif %}
```
