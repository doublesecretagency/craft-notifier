# Editing the Template

Your message template can be configured however you see fit. The template is a normal Twig environment, so it's possible to use `extends` and `include` tags just as you typically would.

## Variables

A certain set of variables will be **automatically available** within the context of your template.

:::warning Which variables are available?
To see an organized breakdown of which variables will be available, check out the docs regarding [Automatic Variables](/messages/variables/).
:::

These variables can be used to deeply customize the notification message. You can implement complex Twig logic to create branching paths and variations within individual emails. 

If necessary, you can use Twig to prevent a message from being sent.
