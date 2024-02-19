---
description:
---

# Dynamic Recipients <Badge type="warning" text="Coming Soon" />

A new mechanism for selecting dynamic recipients is on the way!

Meanwhile, there are several new [recipient types](/recipients/types/) for sending messages to pre-selected Users.

:::tip Removed From Beta
The original public beta (v0) allowed for a "custom selection" of recipients, a feature very similar to the upcoming Dynamic Recipients.

It was **removed**, however, because the underlying mechanism for selecting dynamic recipients will soon be changing significantly, and the original field value can't be ported into the new field.
:::

[//]: # (Sends the message to **a dynamic set of recipients, as defined by a Twig snippet.**)
[//]: # (Specify which custom recipients will be notified. Any dynamic Twig logic will be parsed at runtime.)
[//]: # (Use the Twig snippet to build an array of **Users**.)
[//]: # (If sending an email, you can also compile an array of **email addresses**.)
[//]: # (If sending an SMS &#40;text message&#41;, you can also compile an array of **phone numbers**.)
[//]: # (## Special Variables)
[//]: # (With just one exception, you can use [special variables]&#40;/messages/variables&#41; to help compile an array of recipients.)
[//]: # (:::tip Exception)
[//]: # (For obvious reasons, you cannot use the `recipient` variable to generate the recipients. The `recipient` variable will only be available in the [message template]&#40;/messages/edit-template&#41;, since it gets injected _immediately_ before each message template is parsed.)
[//]: # (:::)
