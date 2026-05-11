---
description: Trigger a notification when a soft-deleted User account is restored from the trash.
---

# When a user is restored

Sends a notification when **a User account has been restored from the trash**.

This only covers users that were soft-deleted and then restored from the control panel **Trashed** view or via [`restoreElement()`](https://docs.craftcms.com/api/v5/craft-services-elements.html#method-restoreelement). Users that were hard-deleted cannot be restored, and thus never fire this trigger.

<!--@include: @/events/types/_user-group-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-generic.png" alt="" style="width:600px; margin-top:10px">

## Twig variables

The `object` variable (and its `user` alias) is the restored [User](https://docs.craftcms.com/api/v5/craft-elements-user.html).

```twig
{{ user.fullName }}'s account was just restored.
```

## Examples

**Welcome the user back**

```twig
Hi {{ user.firstName }},

Your account was just restored. You can sign in again at {{ siteUrl }}.
```

**Alert admins of an account restore**

```twig
A user account was just restored.

- Name: {{ user.fullName }}
- Email: {{ user.email }}
- Restored by: {{ currentUser.fullName ?? 'system' }}
```
