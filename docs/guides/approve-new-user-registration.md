---
description: Any time a new User registers, automatically email your Admins a link to review and activate the account.
---

# When a new User registers, email Admins for approval

Review new User accounts before they are activated.

This guide explains how to email your Admins when someone registers, with a direct link to review and activate the new account.

<img class="dropshadow" src="/images/guides/approve-new-user-registration/admin-email.png" alt="The delivered approval email" style="width:461px; margin-top:20px">

## Confirm Craft can send email

1. If you haven't already, fill out your mail settings under **Settings → Email**.
2. Hit the **Test** button and confirm the message actually lands in your inbox.

Notifier sends [email](/messages/types/email) through Craft's own mailer, so anything broken here will break the notification too.

## Select the "When a new user is created" event

1. Create a new notification and name it.
2. Set the **Event Type** to **Users**.
3. Set the **Users Event** to [**When a new user is created**](/events/types/users/new-user-created).
4. Check any **User Groups** which need to be monitored.

:::warning Check at least one group
If no groups are checked, no email will be sent. Check **Ungrouped Users** if your site doesn't assign a group during registration.
:::

:::tip No user groups?
If your site has no user groups, an approval email will be sent for **all new Users**.
:::

<img class="dropshadow" src="/images/guides/approve-new-user-registration/users-event.png" alt="Event tab set to the new user created event" style="width:640px; margin-top:10px">

## Write the approval email

:::warning Feel free to customize
However you configure the message is up to you. These are just some recommendations to get you started.
:::

1. Set the **Message Type** to **Email**. Dynamic fields will have access to [element variables](/messages/variables/element-events).
2. Leave **User's Email Address Field** on the default native **Email** field.
3. For the **Email Subject**, name the person who needs approval:
    ```twig
    New registration: {{ user.fullName ?? user.email }}
    ```
4. Switch the **Email Body** to **Code** mode, and give your Admins everything they need to make a call:
    ```twig
    <p><strong>{{ user.friendlyName }}</strong> just registered and is waiting for approval.</p>

    <ul>
        <li>Name: {{ user.fullName ?? 'not provided' }}</li>
        <li>Email: {{ user.email }}</li>
        <li>Username: {{ user.username }}</li>
        <li>Registered: {{ user.dateCreated|datetime }}</li>
    </ul>

    <p><a href="{{ user.cpEditUrl }}">Review this account</a></p>
    ```

<img class="dropshadow" src="/images/guides/approve-new-user-registration/email-message.png" alt="Email message config with the approval body" style="width:640px; margin-top:10px">

## Send the message to Admins or individual Users

On the **Recipients** tab, set the **Recipients Type** to [**All Admins**](/recipients/types/all-admins).

If you need greater flexibility, set the **Recipients Type** to [**Only selected User(s)**](/recipients/types/selected-users) and specify which Users should receive the message.

<img class="dropshadow" src="/images/guides/approve-new-user-registration/email-recipients.png" alt="Recipients tab set to All Admins" style="width:640px; margin-top:10px">

## Save and finish!

Congrats, you've finished setting up the Notification!

_"Whenever a new **User registers**, Craft will email your **Admins** a link to **review and activate** the account."_

## How an Admin approves the account

We have this link within the message body to Admins:

```twig
{# Link to view User account #}
{{ user.cpEditUrl }}
```

1. Clicking that link will take the Admin to the User's account page in the Craft control panel.
2. From there, the Admin can then review the new user's details.
3. Assuming everything looks good, the Admin selects **Activate account** in the status menu.

<img class="dropshadow" src="/images/guides/approve-new-user-registration/activate-account.png" alt="Status menu with 'Activate account' highlighted" style="width:280px; margin-top:28px">

:::tip Pair this with a welcome email!
To fully welcome aboard a new user, you may also want to [send a welcome email when a User is activated](/guides/welcome-email-for-new-users).

The welcome message won't be sent until an Admin has reviewed the new User and **activated** the account.
:::
