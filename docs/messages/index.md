---
description:
---

# Messages

✅

Each notification contains a dynamic **message**, composed by you, using Twig.

Several message types are available, including:

- **Email**
- **SMS (Text Message)**

:::warning List of Message Types
For more information, see the [complete list of message types...](/messages/types/)
:::

After being triggered by a corresponding [event](/events/), each message will be sent to the specified [recipients](/recipients/).

## Normal Twig

If the Twig message is short, it can be written directly in the control panel. For longer messages, you'll probably want to `include` a separate Twig file.

```twig
{# Use a normal Twig template for a long message #}
{% include 'emails/new-user-activated' %}
```

Your template is a standard Twig template, so you can use any normal Twig you'd like. Since each template is a normal Twig environment, you can use `extends`, `include`, or any other tags just as you typically would.

## Customizing the message body

Additionally, a collection of [special variables](/messages/variables) are available within the Twig context. These variables can be used to create highly customized notification messages.

## Stop a message from being sent

If necessary, you can even use Twig to [prevent a message from being sent](/messages/skip-message). The template can perform Twig-based logic while it is being parsed, and gracefully skip a message if certain criteria are not met.
