---
description: Send a notification when a User event is triggered, such as when a new account is created or an existing User is activated.
---

# Users

Sends a notification when a **User** event is triggered.

<img class="dropshadow" src="/images/events/event-users.png" alt="" style="width:416px; margin-top:10px">

### [When a new user is created](/events/types/users/new-user-created)

Fires the first time a User is saved. Covers public registrations, admin-created accounts, and programmatic User saves.

### [When a user is activated](/events/types/users/user-activated)

Fires when a User account transitions into the active status. Triggered by email verification, manual admin activation, or re-enabling a suspended User.

### [When a user is updated](/events/types/users/user-updated)

Fires every time an existing User is saved (except activation, see above). Covers profile edits, password changes, and group reassignment.

### [When a user is assigned to one or more groups](/events/types/users/user-assigned-to-groups)

Fires when a User is assigned to one or more groups. Catches programmatic group assignments that bypass a full user save, in addition to admin-driven assignments.

### [When a user is deleted](/events/types/users/user-deleted)

Fires when a User account is deleted. Covers both soft deletes (moved to the trash) and hard deletes.

### [When a user is restored](/events/types/users/user-restored)

Fires when a soft-deleted User account is restored from the trash.
