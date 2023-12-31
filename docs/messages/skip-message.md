---
description:
---

# Skip Sending a Message

✅

Within the context of the Twig template, you can skip sending a **single message** to an **individual recipient**. Each recipient is processed individually, so a message can be stopped completely by skipping all recipients.

## How it works

During the parsing of your Twig template, the message will be aborted if the `skipMessage` tag is encountered. You can use this tag to define complex custom logic, and stop messages from being sent if some internal criteria is not met.

```twig
{# Prevents a message from being sent #}
{% skipMessage %}
```

:::info Skips only one recipient
Please note that this will only skip **a single recipient**, and will continue attempting to send the message to all other valid recipients.

Ultimately, if `skipMessage` is encountered for all recipients, no message will be sent out.
:::

## Practical Examples

:::warning Logic based on Special Variables
Remember, [special variables](/messages/variables) are available to use in your Twig logic. You can use that data to determine whether a particular message should be sent out or skipped.
:::

#### Omit Specific Recipient

Prevent sending messages to a specific person, based on their User ID.

```twig
{# Skip message if the recipient is a specific person #}
{% if recipient.id == 42 %}
    {% skipMessage %}
{% endif %}
```

#### Comparing Changes

Compare the old & new version of a field value. If the value hasn't changed, bail on sending the message.

```twig
{# Skip message if the field value didn't change #}
{% if originalEntry.myField == entry.myField %}
    {% skipMessage %}
{% endif %}
```

#### Comparing Data

Prevent sending messages about entries that are "Under Review" (based on a hypothetical custom dropdown field).

```twig
{# Skip message if a custom dropdown is set to "Under Review" #}
{% if entry.reviewStatus == "underReview" %}
    {% skipMessage %}
{% endif %}
```
