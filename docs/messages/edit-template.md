# Editing the Template

Message templates can be configured however you see fit. Each template is a normal Twig environment, so you can use `extends`, `include`, or any other tags just as you typically would.

## Variables

A certain set of variables will be **automatically available** within the context of your template.

:::warning Which variables are available?
To see an organized breakdown of which variables will be available, check out the docs regarding [Automatic Variables](/messages/variables/).
:::

These variables can be used to deeply customize the notification message. You can implement complex Twig logic to create branching paths and variations within individual emails.

If necessary, you can even use Twig to [prevent a message from being sent](/messages/skip/).
