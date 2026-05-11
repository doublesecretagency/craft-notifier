---
description: Trigger a notification when an existing User is updated. Covers profile edits, password changes, and group reassignment.
---

# When a user is updated

Sends a notification when **an existing User is saved**. Covers profile edits, password changes, group reassignment, and any programmatic re-save of an existing User.

Activation is a separate trigger, the two notifications never fire together for the same save (see [**"When a user is activated"**](/events/types/users/user-activated)).

<!--@include: @/events/types/_user-group-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-has-changed.png" alt="" style="width:600px; margin-top:10px">

<!--@include: @/events/types/_has-changed-operator.md-->

## Twig variables

The `object` variable (and its `user` alias) is the updated [User](https://docs.craftcms.com/api/v5/craft-elements-user.html). The pre-save copy is available as [`original`](/messages/variables#fetching-the-original-element), which is useful for change-detection.

```twig
{{ user.fullName }}'s profile was just updated.
```

## Examples

**Notify the user when their own profile changes**

```twig
Hi {{ user.firstName }},

Your account details were just updated.

If you didn't make this change, please contact support.
```

**Alert admins when a group assignment changes**

```twig
{% set oldGroups = original.groups|map(g => g.handle) %}
{% set newGroups = user.groups|map(g => g.handle) %}

{% if oldGroups == newGroups %}
    {% skipMessage "Group assignment unchanged." %}
{% endif %}

{{ user.fullName }}'s groups changed:

- Before: {{ oldGroups|join(', ') ?: 'none' }}
- After: {{ newGroups|join(', ') ?: 'none' }}
```

**Highlight email address changes**

```twig
{% if user.email == original.email %}
    {% skipMessage "Email address unchanged." %}
{% endif %}

Security notice: {{ user.fullName }}'s email address just changed.

- Before: {{ original.email }}
- After: {{ user.email }}
```
