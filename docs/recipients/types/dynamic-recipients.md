---
description: Define recipients with a Twig snippet. Pass Users, email addresses, or phone numbers into the `setRecipients` tag and Notifier handles the rest.
---

# Dynamic Recipients

Send the message to **a dynamic set of recipients, as defined by a Twig snippet.**

<img class="dropshadow" src="/images/recipients/dynamic-recipients.png" alt="" style="width:640px; margin-top:10px">

Write a short Twig snippet which passes one or more Users, email addresses, or phone numbers (or any combination) into the `{% setRecipients %}` tag. The tag will then parse out which email addresses (or phone numbers) will be sent the notification.

:::warning ⚠️ Security Warning - Permission Required
Users without the "[Use the Dynamic Recipients type](/getting-started/permissions#use-the-dynamic-recipients-type)" permission will not have the option to select the "Dynamic Recipients" type.

Since authoring Dynamic Recipients snippets involves **executing custom Twig at send time**, it is first necessary to enable this permission for users who require it. Grant it only to highly-trusted users.
:::

## Special Variables

All the [special variables](/messages/variables/) available in message templates are also available in this snippet, **with one exception:** the `recipient` variable is unavailable. _This snippet_ is what will determine each recipient, so it cannot reference itself.

## How To Use

In summary, your Twig snippet **must include** the `{% setRecipients %}` tag.

Compile your recipients list (or single value) however you like, then pass it to `{% setRecipients %}`. The message will be sent to whatever recipients that resolves to.

```twig
{% setRecipients myListOfRecipients %}
```

Invalid recipients will be logged and skipped at runtime.

If the `{% setRecipients %}` tag is run more than once, the results will be _added_ to the existing collection of recipients. This allows you to build up a list of recipients in stages, if needed.

## Basic Examples

**Send to a specific email address**

```twig
{% setRecipients 'bob@example.com' %}
```

**Send to multiple recipients**

```twig
{% setRecipients ['alice@example.com', 'bob@example.com'] %}
```

**Send to the person who saved the entry**

```twig
{% setRecipients currentUser %}
```

**Send to the author of the saved entry**

```twig
{% setRecipients entry.author %}
```

**Send to the person stored in a Users field**

```twig
{% setRecipients entry.assignedTo.one() %}
```

**Send to the customer of a completed Commerce Order**

```twig
{% setRecipients order.customer %}
```

For more on the Commerce Order pattern, see [When an order is completed](/events/types/craft-commerce/order-completed#notifying-the-customer).

## Advanced Examples

**Send to mixed recipient types (users and email addresses)**

```twig
{% setRecipients [
    currentUser,
    entry.author,
    'alice@example.com',
    'bob@example.com'
] %}
```

**Build a list of recipients with custom logic**

```twig
{% set allRecipients = [] %}

{# Loop over all users watching this entry #}
{% for user in entry.watchers.all() %}

    {# If the watcher has logged in within the past 30 days #}
    {% if user.lastLoginDate and user.lastLoginDate >= now|date_modify('-30 days') %}

        {# Add watcher to the recipients array #}
        {% set allRecipients = allRecipients | merge([user]) %}

    {% endif %}

{% endfor %}

{# Send to compiled list of recipients #}
{% setRecipients allRecipients %}
```

## Acceptable Values

There are a few different values which can be passed into the `{% setRecipients %}` tag.

- **Email address string** - Any string that validates as an email address.
- **Phone number string** - Any string that validates as a phone number.
- **`User` object** - Any User object, from which the relevant email address (or phone number) can be extracted.
- **Arrays of any of the above** - You can pass an array containing any combination of the above types.

### One type or the other, per message

At send time, only the contact field which matches the message type will be used:

- **Email messages** are delivered only to recipients that resolve an email address.
- **SMS messages** are delivered only to recipients that resolve a phone number.

If your array of recipients contains a mix of types, the message will be sent to all valid recipients of the active message type.

Non-valid recipients will be [logged](/logging) and skipped.

## Array or Single Value

The `{% setRecipients %}` tag accepts **either an array or a single value.** When you pass a single value, it's treated as a one-item list.

```twig
{# Send to a single recipient #}
{% setRecipients 'bob@example.com' %}
```
```twig
{# Send to multiple recipients #}
{% setRecipients ['alice@example.com', 'bob@example.com'] %}
```

## Troubleshooting

Every snippet call is captured in the [notification log](/logging).

### Common log entries and what they mean

| Log entry                                                | Meaning                                                         |
|----------------------------------------------------------|-----------------------------------------------------------------|
| `Dynamic recipients snippet did not call setRecipients.` | The `{% setRecipients %}` tag was never invoked.                |
| `setRecipients was called with an empty value.`          | The `{% setRecipients %}` tag was invoked with an empty value.  |
| `Unrecognized recipient of type "...".`                  | Item is neither a User, an email string, nor a phone string.    |
| `Unrecognized recipient "...".`                          | String is neither a valid email address nor valid phone number. |
| `Recipient "..." has no email address.`                  | Email message recipient has no email address.                   |
| `Recipient "..." has no phone number.`                   | SMS message recipient has no phone number.                      |

## Sandbox Compatibility

Dynamic Recipients snippets run inside the same [Twig sandbox](/messages/twig-sandbox) as message bodies. The [default blacklist](https://github.com/nystudio107/craft-twig-sandbox/blob/v5/src/twig/BlacklistSecurityPolicy.php) permits `object.author`, field access, element queries via `craft.users` / `craft.entries`, and the other accessors most snippets will need.

Sites running a `WHITELIST` policy may need to permit `craft.users.find`, `craft.entries.find`, and similar methods.

:::warning Shared Sandbox
The sandbox is shared between Dynamic Recipients snippets and message bodies - widening the policy for one widens it for the other.
:::
