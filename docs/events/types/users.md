---
description: Send a notification when a User event is triggered, such as when a new account is created or an existing User is activated.
---

# Users

Sends a notification when a **User** event is triggered.

<img class="dropshadow" src="/images/events/event-users.png" alt="" style="width:422px; margin-top:10px">

## [When a new user is created](/events/types/users/new-user-created)

Fires the first time a User is saved. Covers public registrations, admin-created accounts, and programmatic User saves.

## [When a user is activated](/events/types/users/user-activated)

Fires when a User account transitions into the active status. Triggered by email verification, manual admin activation, or re-enabling a suspended User.
