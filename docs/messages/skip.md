---
description:
---

# Skip Sending a Message

Within the context of the Twig template, you can skip sending a **single message** to an **individual recipient**.

```twig
{% skipMessage %}
```

## How It Works

During the parsing of your Twig template, the message will be aborted if the `skipMessage` tag is encountered. You can use this tag to define complex custom logic, and stop messages from being sent if some internal criteria is not met.

Your ordinary usage might look something like this...

```twig
{% if "requirements are not met" %}
    {% skipMessage "Explanation of why message wasn't sent." %}
{% endif %}
```

The explanation will appear in the [Notification Log](/logging).

:::tip Skips only one recipient
Please note that this will skip **only a single recipient**, and will continue attempting to send the message to all other valid recipients.

Ultimately, if `skipMessage` is encountered for all recipients, no messages will be sent out.
:::

## Practical Examples

Here are a few arbitrary examples of how you might skip a message...

:::warning Use the Special Variables
There are a wide variety of [special variables](/messages/variables) available in your Twig template, which can be used to help determine whether a particular message or recipient should be skipped.
:::

**Only send a message when the field value changes**

```twig
{% if original.myField == entry.myField %}
    {% skipMessage "My Field did not change." %}
{% endif %}
```

**Skip if a dropdown field is set to "Under Review"**

```twig
{% if entry.reviewStatus == 'underReview' %}
    {% skipMessage "Entry is currently under review." %}
{% endif %}
```

**Send a message to everyone except Bill**

```twig
{% if recipient.user.id == 42 %}
    {% skipMessage "Don't send the message to Bill." %}
{% endif %}
```

**Don't send if the recipient is in a specific group**

```twig
{% if recipient.user.isInGroup('userGroup') %}
    {% skipMessage "User is a member of User Group." %}
{% endif %}
```
