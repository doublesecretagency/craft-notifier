---
description:
---

# All Recipient Types

🚩

:::warning Filtering Subsets
If the subsets below will only get you partly there, [additional filtering](/recipients/#advance-filtering-of-recipients) is available at the template level.
:::

## Current User Only

Only **the user who triggered the event** will be notified.

## Only selected User(s)

Only the user(s) specified will be notified.

## All Users in selected User Group(s)

Select which user group(s) will receive the message.

## All Admins

The message will be sent to all **Admins** of the system.

## All Users

The message will be sent to **all Users in the system**.

## Custom Recipients

Specify which custom recipients will be notified. Any dynamic Twig logic will be parsed at runtime.




Use the Twig snippet to build an array of either **Users** or **email addresses**.

- [Get a collection of Users](/recipients/custom-users)
- [Get a collection of email addresses](/recipients/custom-emails)

<img class="dropshadow" src="/images/OLD/recipients/custom-recipients.png" alt="" style="max-width:420px; margin-top:8px">
