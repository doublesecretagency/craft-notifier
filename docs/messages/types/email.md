---
description: Send a traditional email when the notification event is triggered. Configure subject, body, and recipients.
---

# Email

Sends **an email** when the notification event is triggered.

<img class="dropshadow" src="/images/messages/email-example.png" alt="" style="width:740px; margin-top:10px">

## Config

<img class="dropshadow" src="/images/messages/email-config.png" alt="" style="width:640px; margin-top:10px">

<!--@include: @/messages/types/_special-variables.md-->

### User's Email Address Field

Select which User field holds the recipient's email address.

### Email Subject

The subject line of the email.

### Email Body

The body of the email, supports HTML. Switch between "Rich Text" and "Code" modes at any time.

<img class="dropshadow" src="/images/messages/email-body-toggle.png" alt="" style="width:644px; margin-top:10px">

- `Rich Text` - A basic WYSIWYG editor for writing prose-heavy notifications, with minimal inline Twig interpolations.

- `Code` - A code-editing interface which provides Twig hints and syntax highlighting, making it easier to write complex Twig logic.

For intricate Twig logic, use Code mode or an `{% include %}` pointed to a hard-coded Twig template file.

## Troubleshooting

When sending email messages, Notifier relies on Craft's own internal mail configuration.

:::warning Problems sending out emails?
Follow the official Craft guide for [Troubleshooting Email Errors](https://craftcms.com/knowledge-base/troubleshooting-email-errors).
:::
