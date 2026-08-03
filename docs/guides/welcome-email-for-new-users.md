---
description: Any time a new User account is activated, automatically send them a personalized welcome email.
---

# When a User is activated, send them a "Welcome" email

Greet new members with a friendly message and helpful information.

This guide explains how to send a personalized email to a new User when their account is activated.

<img class="dropshadow" src="/images/guides/welcome-email-for-new-users/welcome-email.png" alt="The delivered welcome email" style="width:410px; margin-top:20px">

## Confirm Craft can send email

1. If you haven't already, fill out your mail settings under **Settings → Email**.
2. Hit the **Test** button and confirm the message actually lands in your inbox.

Notifier sends [email](/messages/types/email) through Craft's own mailer, so anything broken here will break the notification too.

## Select the "When a user is activated" event

1. Create a new notification and name it.
2. Set the **Event Type** to **Users**.
3. Set the **Users Event** to [**When a user is activated**](/events/types/users/user-activated).
4. Check any **User Groups** which should receive the greeting message.

<img class="dropshadow" src="/images/guides/welcome-email-for-new-users/users-event.png" alt="Event tab set to the user activated event" style="width:640px; margin-top:10px">

## Write the welcome email

:::warning Feel free to customize
However you configure the message is up to you. These are just some recommendations to get you started.
:::

1. Set the **Message Type** to **Email**. Dynamic fields will have access to [element variables](/messages/variables/element-events).
2. Leave **User's Email Address Field** on the default native **Email** field.
3. Write a brief and friendly **Email Subject**:
    ```twig
    Welcome aboard, {{ user.friendlyName }}!
    ```
4. Switch the **Email Body** to **Code** mode, and greet them with some helpful information to get started:
    ```twig
    <p>Hi {{ user.friendlyName }},</p>

    <p>Your account is active and ready to use.</p>
    <p>A few things to help you get started:</p>

    {# Use custom fields to add dynamic details #}
    <ul>
      {% for link in notification.additionalResources.all() %}
        <li><a href="{{ link.url }}">{{ link.title }}</a></li>
      {% endfor %}
    </ul>

    <p>Glad to have you with us!</p>
    ```

:::warning Custom Fields
In the snippet above, `notification.additionalResources` is an example of a custom field.

To separate your clients from the code, you can create [custom fields](/custom-fields) for them on the **Meta** tab.
:::

<img class="dropshadow" src="/images/guides/welcome-email-for-new-users/email-message.png" alt="Email message config with the welcome body in Code mode" style="width:640px; margin-top:10px">

## Send the message to the new User

In order to target the brand-new User, use [Dynamic Recipients](/recipients/types/dynamic-recipients).

1. On the **Recipients** tab, set the **Recipients Type** to **Dynamic Recipients**.
2. For the **Twig Snippet to Determine Recipients**, simply specify the new `user`:
    ```twig
    {% setRecipients user %}
    ```

The `user` email address will be extracted and sent a personalized copy of the message. 

<img class="dropshadow" src="/images/guides/welcome-email-for-new-users/email-recipients.png" alt="Recipients tab with the setRecipients snippet" style="width:640px; margin-top:10px">

## Skip people who aren't actually new

Protect against mistakenly sending the welcome message to a user being **re-activated**.

Check whether the `user` already has a `lastLoginDate`, and use [`skipMessage`](/messages/skip) if they've previously logged in.

Put this check at the very top of the **Email Body**, before everything else:

```twig
{% if user.lastLoginDate %}
    {% skipMessage "Not a new user, they've logged in before." %}
{% endif %}

{# ...the rest of your message... #}
```

Anyone who has previously logged in gets skipped, and the skip is recorded in the [notification log](/logging).

## Save and finish!

Congrats, you've finished setting up the Notification!

_"Whenever a **User is activated**, Craft will email them a **personalized welcome message**."_
