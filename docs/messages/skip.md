# Skip Sending a Message

Within the context of the Twig template, you can skip sending a **single message** to an **individual recipient**. Each recipient is processed individually, so a message can be stopped completely by skipping all recipients.

## How it works

During the parsing of your Twig template, the message will be aborted if the `skipMessage` tag is encountered. You can use this tag to define complex custom logic, and stop messages from being sent if some internal criteria is not met.

```twig
{% skipMessage %}
```

The `skipMessage` tag will prevent a message from being sent out.

:::warning Skips only one recipient
Please note that this will only skip **a single recipient**, and will continue trying to send the message to all other valid recipients.

If `skipMessage` is encountered for all recipients, no messages will be sent out.
:::

## Examples

#### Comparing Changes

Compare the old & new version of a field value. If the value hasn't changed, bail on sending the message.

```twig
{# If the field's value didn't change #}
{% if originalEntry.myField == entry.myField %}
    {% skipMessage %}
{% endif %}
```

---
---

#### Comparing Data

This example will prevent sending messages about entries that are "Under Review", based on a hypothetical custom dropdown field.

```twig
{# If a custom dropdown is set to "Under Review" #}
{% if entry.reviewStatus == "underReview" %}
    {% skipMessage %}
{% endif %}
```
