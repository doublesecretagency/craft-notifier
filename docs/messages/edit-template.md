# Editing the Template

Your message template can be configured however you see fit. The template is a normal Twig environment, so it's possible to use `extends` and `include` tags just as you typically would.

## Variables

A certain set of variables will be **automatically available** within the context of your template.

:::warning Which variables are available?
To see an organized breakdown of which variables will be available, check out the docs regarding [Automatic Variables](/messages/variables/).
:::

These variables can be used to deeply customize the notification message. You can implement complex Twig logic to create branching paths and variations within individual emails. 

If necessary, you can use Twig to prevent a message from being sent.

## Skip sending a single message to an individual recipient

If your Twig logic determines that the message should not be sent for whatever reason, you can easily abort the message like this...

```twig
{% skipMessage %}
```

The `skipMessage` tag will prevent a message from being sent out.

:::warning Skips only one recipient
Please note that this will only skip **a single recipient**, and will continue trying to send the message to all other valid recipients.

If `skipMessage` is encountered for all recipients, no messages will be sent out.
:::

## Example

Compare the old & new version of a field value. If the value hasn't changed, bail on sending the message.

```twig
{# If the value didn't change #}
{% if originalEntry.myField == entry.myField %}

    {# Prevent the message from being sent #}
    {% skipMessage %}

{% endif %}
```
