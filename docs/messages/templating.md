---
description:
---

# Message Templating

## Twig Parsing

When composing Twig snippets for outgoing messages, most tags, filters, and functions will be available to you. It's worth noting, however, that messages are parsed in a secure [Twig Sandbox](/messages/twig-sandbox).

There are two different ways to specify variables:

```twig
{# Standard syntax (long) #}
New Article: {{ entry.title }}

{# Object syntax (short) #}
New Article: {title}
```

In the short syntax, the `object` is mapped to the element which triggered the notification (ie: the saved Entry).

:::warning No Object Syntax in External Templates
If you `include` a separate Twig file, the short object syntax won't be available within the included file.
:::

## Special Variables

In most situations, you will have access to an additional set of [special variables](/messages/variables).

These variables are highly dependent on context, so pay close attention to where they are being used.

## Separate Twig File

When composing a message, take into account how long your message needs to be. For shorter messages, it may be easiest to simply write your message within the control panel. For longer messages, you may choose to `include` a separate Twig file.

```twig
{# Use a normal Twig template for a longer message #}
{% include 'emails/new-user-activated' %}
```

Since each template is a normal Twig environment, you can use `extends`, `include`, or any other tags just as you typically would.
