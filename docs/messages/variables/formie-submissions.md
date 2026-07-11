---
description: The available Twig variables when a notification is triggered by a submitted Formie form.
---

# Formie Submissions Variables

<!--@include: @/messages/variables/_global-variables.md-->

When a notification is triggered by a [Formie Submission](/events/types/formie/), the submitted form and all its data are available through the `submission`, `form`, and `success` variables.

| Variable     | Type    | Description                                                                                            |
|:-------------|:--------|:------------------------------------------------------------------------------------------------------|
| `submission` | _Submission_ | The submitted [Formie Submission](https://github.com/verbb/formie/blob/craft-5/src/elements/Submission.php) element (also available as `object` and `element`). |
| `form`       | _Form_  | The [Formie Form](https://github.com/verbb/formie/blob/craft-5/src/elements/Form.php) the submission belongs to. |
| `success`    | _bool_  | `true` if the submission succeeded, `false` if it did not. |

## Field values

Any submitted field value can be read by its handle:

```twig
"{{ form.title }}" was submitted by {{ submission.name }}.
```

## Spam details

When a submission is flagged as spam, the reason is available on the `submission`:

| Variable                | Type          | Description                                              |
|:------------------------|:--------------|:--------------------------------------------------------|
| `submission.isSpam`     | _bool_        | Whether the submission was flagged as spam.             |
| `submission.spamReason` | _string\|null_ | Why it was flagged (e.g. "Failed Captcha ...").         |

## Examples

**Get a [Pushover](/messages/types/pushover) alert when a form is submitted**

```twig
New submission on {{ form.title }} from {{ submission.name }} ({{ submission.email }}).
```

**Post new submissions to a [Slack](/messages/types/slack) channel**

```twig
New submission on *{{ form.title }}*

- Name: {{ submission.name }}
- Email: {{ submission.email }}
- Message: {{ submission.message }}
```

**Send a [text message](/messages/types/sms-text) to the person who submitted the form**

```twig
Thanks {{ submission.name }}! We got your message and will be in touch soon.
```

You can specify their phone number via [Dynamic Recipients](/recipients/types/dynamic-recipients).

```twig
{% setRecipients submission.phone %}
```
