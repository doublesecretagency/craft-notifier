---
description: Trigger a notification when a Formie form is submitted.
---

# Formie

Sends a notification when a **Formie form is submitted**.

<!--@include: @/events/types/_requires-formie.md-->

The notification will be triggered whenever a visitor submits a normal front-end form. Every submitted field is available in your message. You can post new submissions to a Slack channel, text your team, or use any other [message types](/messages/types/).

:::warning Formie already has excellent email support
If you only want emails from Formie submissions, you may not need another plugin. Reach for Notifier if you want Formie submissions to send via **different message types** (e.g. SMS or Slack notifications).
:::

<img class="dropshadow" src="/images/events/event-formie-submissions.png" alt="" style="width:646px; margin-top:10px; margin-bottom:22px">

## Forms

Select which form(s) will trigger the notification.

## Submission Outcome

Trigger based on the success or failure of a submission.

- **Successful submissions only** _(default)_
- **Failed submissions only**
- **All submissions**

<!--@include: @/events/types/_field-conditions.md-->

## Twig variables

The submission and its data are exposed through the `submission`, `form`, and `success` Twig variables.

See the [Formie Submissions variables](/messages/variables/formie-submissions) for the full reference and examples.
