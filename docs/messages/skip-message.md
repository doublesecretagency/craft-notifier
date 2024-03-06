---
description:
---

# Skip Sending a Message

Within the context of the Twig template, you can skip sending a **single message** to an **individual recipient**.

Each recipient is processed individually, so a message could be stopped completely by skipping all recipients.

## How It Works

During the parsing of your Twig template, the message will be aborted if the `skipMessage` tag is encountered. You can use this tag to define complex custom logic, and stop messages from being sent if some internal criteria is not met.

```twig
{% skipMessage %}
```

:::tip Skips only one recipient
Please note that this will skip **only a single recipient**, and will continue attempting to send the message to all other valid recipients.

Ultimately, if `skipMessage` is encountered for all recipients, no message will be sent out.
:::

## Optional Reason for Skipping

If preferred, it's possible to enter a reason for skipping the message:

```twig
{# Skip if the recipient is a specific person #}
{% if recipient.user.id == 42 %}
    {% skipMessage "Don't send message to Bill." %}
{% endif %}
```

The message will appear in the [Notification Log](/logging).

## Practical Examples

There are a wide variety of [special variables](/messages/variables) available in your Twig logic.

You can use that information to determine whether a particular message should be skipped, or continue being sent.

```twig
{# Skip if the field value didn't change #}
{% if original.myField == entry.myField %}
    {% skipMessage "My Field did not change." %}
{% endif %}

{# Skip if the recipient is in a specific group #}
{% if recipient.user.isInGroup('userGroup') %}
    {% skipMessage "User is a member of User Group." %}
{% endif %}

{# Skip if a custom dropdown is set to "Under Review" #}
{% if entry.reviewStatus == 'underReview' %}
    {% skipMessage "Entry is currently under review." %}
{% endif %}
```
