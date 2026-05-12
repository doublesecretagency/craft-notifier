---
description: Trigger a notification when a User account is deleted.
---

# When a user is deleted

Sends a notification when **a User has been deleted**.

This trigger fires for both soft deletes (moved to the trash) and hard deletes. Restoring a deleted user fires the separate [**"When a user is restored"**](/events/types/users/user-restored) event.

<!--@include: @/events/types/_user-group-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-generic.png" alt="" style="width:600px; margin-top:10px">

## Twig variables

The `object` variable (and its `user` alias) is the deleted [User](https://docs.craftcms.com/api/v5/craft-elements-user.html).

```twig
{{ user.fullName }} ({{ user.email }}) was just deleted.
```

## Examples

**Alert administrators of an account deletion**

```twig
A user account was just deleted.

- Name: {{ user.fullName }}
- Username: {{ user.username }}
- Email: {{ user.email }}
- Deleted by: {{ currentUser.fullName ?? 'system' }}
```

**Only notify for admin-tier deletions**

```twig
{% if not user.admin %}
    {% skipMessage "Only admin deletions are announced." %}
{% endif %}

Admin user deleted: {{ user.fullName }} ({{ user.email }}).
```

**Capture the deletion in an audit log**

```twig
User deleted at {{ now|date('Y-m-d H:i:s') }}:

- ID: {{ user.id }}
- Email: {{ user.email }}
- Groups: {{ user.groups|map(g => g.handle)|join(', ') ?: 'none' }}
- Deleted by: {{ currentUser.username ?? 'system' }}
```
