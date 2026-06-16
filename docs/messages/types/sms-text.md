---
description: Send an SMS text message when the notification event is triggered. Requires a configured Twilio account.
---

# SMS (Text Message)

Sends **an SMS (text message)** when the notification event is triggered.

<img class="dropshadow" src="/images/messages/sms-example.png" alt="" style="width:414px; margin-top:10px; margin-bottom:14px">

:::warning Twilio Required
In order to send SMS messages, you must have a fully configured [Twilio](/getting-started/integrations/twilio) account.
:::

## Config

<img class="dropshadow" src="/images/messages/sms-config.png" alt="" style="width:640px; margin-top:10px">

### User's Phone Number Field

Select which User field holds the recipient's phone number.

### SMS Message Body

The body of the SMS (text message). Plain text only.

<!--@include: @/messages/types/_special-variables.md-->

## SMS Recipients

Text messages can be sent to [all recipient types](/recipients/types/).
