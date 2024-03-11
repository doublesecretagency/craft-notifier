---
description:
---

# All Recipient Types

<img class="dropshadow" src="/images/recipients/recipient-types.png" alt="" style="width:650px; margin-top:10px">

:::tip Not Available to All Message Types
There are a few select message types (namely [Announcements](/messages/types/announcement#announcement-recipients) and [Flash Messages](/messages/types/flash#flash-message-recipient)) which cannot send to all recipient types listed below. Follow those links to see which recipients will actually receive each message type.
:::

:::warning Additional Filtering of Recipients
Regardless of which recipients are specified, you can always [skip a message](/messages/skip) if an individual recipient fails to meet your custom criteria.
:::

## [Current User (who triggers the Event)](/recipients/types/current-user)

Sends the message to **only the User who triggers the event.**

## [All Users](/recipients/types/all-users)

Sends the message to **all Users in the system.**

## [All Admins](/recipients/types/all-admins)

Sends the message to **all Users with Admin permissions.**

## [All Users in selected User Group(s)](/recipients/types/selected-groups)

Sends the message to **all Users in selected User Groups.**

## [Only selected User(s)](/recipients/types/selected-users)

Sends the message to **only selected Users.**

## [Dynamic Recipients](/recipients/types/dynamic-recipients) <Badge type="warning" text="Coming Soon" />

Sends the message to **a dynamically-compiled set of recipients, as defined by a Twig snippet.**
