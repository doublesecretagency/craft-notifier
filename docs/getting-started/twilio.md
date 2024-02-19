---
description: 
---

# Configuring Twilio

If using the Twilio API to send [SMS (text messages)](/messages/types/sms-text), you'll first need to create and configure your [Twilio account](https://console.twilio.com).

### Get an Active Number

You will need a Twilio phone number to send SMS messages. This will be used as the "return address" for all text messages sent out by the Notifier plugin.

:::warning Somewhat Complicated Setup
Be warned, Twilio may force you to jump through several hoops to get a valid phone number. It should be possible to get a free trial phone number for testing, however there may still be several verification steps.
:::

<img class="dropshadow" src="/images/twilio/twilio-active-numbers.png" alt="Screenshot of Active Numbers in the Twilio console" style="width:1480px; margin-top:10px">

### Get the Account Info

Once you have a Twilio phone number to send messages from, go to the [Twilio console homepage](https://console.twilio.com) and scroll to the bottom of the page. There you will find the required **Account Info** to copy into your project.

<img src="/images/twilio/twilio-account-info.png" alt="Screenshot of complete Twilio account info" style="width:602px; margin-top:10px">

### Copy credentials to .env

Copy the complete set of Twilio API credentials and save them to your `.env` file.

```dotenv
# Twilio API credentials
TWILIO_ACCOUNT_SID="AC58c47ed8054da83c9f0a86fcbadf63f2"
TWILIO_AUTH_TOKEN="c84c5394bd883e0bbf1883162cf8f158"
TWILIO_PHONE_NUMBER="+18885556412"
```

### Load credentials via Settings

Once those values have been added to your `.env`, there are two ways to load them into Craft:

- Via the [Settings](/getting-started/settings) page.
- Via the [PHP config](/getting-started/config) file.
