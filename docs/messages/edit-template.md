# Editing the Template

## Variables

A certain set of variables will be **automatically available** within the context of your template.

:::warning Which variables are available?
To see an organized breakdown of which variables will be available, check out the docs regarding [Automatic Variables](/messages/variables/).
:::

These variables can be used to deeply customize the notification message. You can implement complex Twig logic to create branching paths and variations within individual emails. 

If necessary, you can use Twig to prevent a message from being sent.

## How to abort without sending a message

If your Twig logic determines that the message should not be sent for whatever reason, you can easily abort the message like this...

```twig
{% exit %}
```

The `exit` tag is native to Craft, and can be used here to stop a message from being sent.

## Example

Compare the old & new version of a field value. If the value hasn't changed, bail on sending the message.

```twig
{# If the value didn't change #}
{% if originalEntry.myField == entry.myField %}

    {# Prevent the message from being sent #}
    {% exit %}

{% endif %}
```
