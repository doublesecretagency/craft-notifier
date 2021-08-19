# Editing the Template

Message templates can be configured however you see fit. Each template is a normal Twig environment, so you can use `extends`, `include`, or any other tags just as you typically would.


## Customizing the message body

A special collection of [automatic variables](/messages/variables/) will be available to you within the context of your message template. These variables can be used to deeply customize the notification message.

## Stop a message from being sent

If necessary, you can even use Twig to [prevent a message from being sent](/messages/skip/). The template can perform Twig-based logic while it is being parsed, and gracefully skip a message if certain criteria are not met.
