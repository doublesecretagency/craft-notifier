---
description:
---

# Templating

Generally speaking, you will have the full suite of Twig tags, filters, and functions available to you. Any fields which allow you to enter Twig will be parsed as normal templates.

## Separate Twig File

When composing a message, take into account how long your message needs to be. For shorter messages, it may be easiest to simply write your message within the control panel. For longer messages, you may choose to `include` a separate Twig file.

```twig
{# Use a normal Twig template for a long message #}
{% include 'emails/new-user-activated' %}
```

Since each template is a normal Twig environment, you can use `extends`, `include`, or any other tags just as you typically would.

## Twig Parsing

When generating a message, there are two different ways to specify variables...

#### 1. Short `{object}` syntax

The `object` will be mapped to the element which triggered the notification.

```twig
New Article: {title}
```

#### 2. Standard long syntax

The `entry` special variable (see below) could be used as well.

```twig
New Article: {{ entry.title }}
```

## Special Variables

In most situations, you will have access to an additional set of [special variables](/messages/variables).

These variables are highly dependent on context, so pay close attention to where they are being used.
