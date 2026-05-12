---
description: Trigger a notification when a User is assigned to one or more groups.
---

# When a user is assigned to one or more groups

Sends a notification when **a User has been assigned to one or more groups**.

This trigger will catch:
- Group assignments made by editing a user in the control panel, and
- Group assignments made programmatically using Craft's internal API.

User group filters will be matched against the user's **newly-assigned** groups. The event fires when a user is added to a selected group, and not when they are removed from that group.

<!--@include: @/events/types/_user-group-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-generic.png" alt="" style="width:600px; margin-top:10px">

## Twig variables

The `object` variable (and its `user` alias) is the [User](https://docs.craftcms.com/api/v5/craft-elements-user.html) who was assigned. The dispatch data also carries:

- `groupIds` (int[]) - all groups the user belongs to after the assignment
- `newGroupIds` (int[]) - the groups that were just added
- `removedGroupIds` (int[]) - the groups that were just removed

```twig
{{ user.fullName }} was added to {{ newGroupIds|length }} group(s).
```

## Examples

**Welcome a new group member**

```twig
Hi {{ user.firstName }},

You have been added to the Editors group. You can now create and edit entries in the editorial sections.

Welcome aboard!
```

**Notify admins of a sensitive role assignment**

```twig
{{ user.fullName }} ({{ user.email }}) was added to the Admins group by {{ currentUser.fullName }}.

Verify this change was intentional.
```

**Skip unless a specific group was assigned**

```twig
{% set approvedVendors = craft.app.userGroups.getGroupByHandle('approvedVendors') %}

{% if approvedVendors.id not in newGroupIds %}
    {% skipMessage "User wasn't assigned to Approved Vendors." %}
{% endif %}

{{ user.fullName }} is now an approved vendor.
```
