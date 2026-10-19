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

## Events

Rarely, you may need to modify an outbound email before it gets sent out. Or you may want to trigger a reaction as soon as the email has been sent.

Notifier provides the following two `EVENT`s for these occasions:  

### `EVENT_BEFORE_SEND`

Triggered right before each email is sent. You can modify the email, or cancel it entirely.

```php
use doublesecretagency\notifier\events\SendEmailEvent;
use doublesecretagency\notifier\models\OutboundEmail;
use yii\base\Event;

// If Notifier is installed
if (class_exists(OutboundEmail::class)) {
    Event::on(
        OutboundEmail::class,
        OutboundEmail::EVENT_BEFORE_SEND,
        static function (SendEmailEvent $event) {
            // Add a signature to the HTML version
            $html = $event->envelope->body;
            $event->message->setHtmlBody("{$html}<p>Cheers, the Support Team</p>");

            // Add the same signature to the plain-text version
            $text = $event->message->getSymfonyEmail()->getTextBody();
            $event->message->setTextBody("{$text}\n\nCheers, the Support Team");
        }
    );
}
```

To cancel the email, set `$event->isValid = false`. The email will not be sent, and a `[CANCELED]` warning will appear in the [notification log](/logging).

### `EVENT_AFTER_SEND`

Triggered after each email has been sent, whether or not it was successful. Check `$event->isSuccessful` to see how it went.

```php
// If Notifier is installed
if (class_exists(OutboundEmail::class)) {
    Event::on(
        OutboundEmail::class,
        OutboundEmail::EVENT_AFTER_SEND,
        static function (SendEmailEvent $event) {
            // If the email failed to send
            if (!$event->isSuccessful) {
                Craft::warning("Unable to email {$event->envelope->to}.", __METHOD__);
            }
        }
    );
}
```

Since the email has already been sent, this event cannot be canceled.

### Event properties

Both events share the same `SendEmailEvent` class.

| Property       | Type                 | Description                                                         |
|:---------------|:---------------------|:--------------------------------------------------------------------|
| `message`      | `craft\mail\Message` | The email itself. Change the subject, body, recipients, or headers. |
| `notification` | `Notification`       | The notification sending the email.                                 |
| `envelope`     | `OutboundEmail`      | The recipient (`to`), `subject`, and rendered `body`.               |
| `isValid`      | _bool_               | Set to `false` in `EVENT_BEFORE_SEND` to cancel the email.          |
| `isSuccessful` | _bool_ or _null_     | Whether the email was sent. Only set in `EVENT_AFTER_SEND`.         |

:::warning Using the queue?
If the notification is sent [via the queue](/messages/queue), these events are triggered while the queue runs, not during the original request.
:::

## Troubleshooting

When sending email messages, Notifier relies on Craft's own internal mail configuration.

:::warning Problems sending out emails?
Follow the official Craft guide for [Troubleshooting Email Errors](https://craftcms.com/knowledge-base/troubleshooting-email-errors).
:::
