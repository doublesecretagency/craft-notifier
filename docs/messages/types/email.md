---
description: Send a traditional email when the notification event is triggered. Configure subject, body, and recipients.
---

# Email

Sends **an email** when the notification event is triggered.

<img class="dropshadow" src="/images/messages/email-example.png" alt="" style="width:740px; margin-top:10px">

## Config

<img class="dropshadow" src="/images/messages/email-config.png" alt="" style="width:640px; margin-top:10px">

<!--@include: @/messages/types/_special-variables.md-->

## Body Editor

The **Email Body** field offers two editing modes, switchable at any time via the mode toggle in the field heading.

<img class="dropshadow" src="/images/messages/email-body-toggle.png" alt="" style="width:644px; margin-top:10px">

### `Rich Text`

Provides a basic WYSIWYG editor for writing prose-heavy notifications with a few inline Twig interpolations.

### `Code`

A code-editing interface which provides Twig hints and syntax highlighting, making it easier to write complex Twig logic.

:::tip For intricate Twig logic, use Code mode or an `{% include %}`
Writing a lot of Twig tags? Switch to code mode to get hints and syntax highlighting.

For extremely long or complex messages, use an `{% include %}` pointed to a hard-coded Twig template file.
:::

## Troubleshooting

When sending email messages, Notifier relies on Craft's own internal mail configuration.

:::warning Problems sending out emails?
Follow the official Craft guide for [Troubleshooting Email Errors](https://craftcms.com/knowledge-base/troubleshooting-email-errors).
:::
