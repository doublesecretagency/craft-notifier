# Editing a Twig Template

## Available Twig Variables

Each template will have access to the entire `$event` object.

Additionally, `entry` will be an alias of `$event->sender` when triggered by an Entry event.

| Variable | Description
|:---------|-------------
| `entry`  | The newly affected Entry.
| `originalEntry` | The original state of the same Entry.


## How to abort without sending the message

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
