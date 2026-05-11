---
description: Trigger a notification when a User account becomes active, whether by email verification, admin activation, or unsuspension.
---

# When a user is activated

Sends a notification when **a User account becomes active**. The trigger fires whenever Craft transitions a User into the `active` status. Most commonly that happens when the User clicks an email verification link, when an administrator activates a pending account, or when an admin re-enables a previously suspended User.

<!--@include: @/events/types/_user-group-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-generic.png" alt="" style="width:600px; margin-top:10px">

## Twig variables

The `object` variable (and its `user` alias) is the activated [User](https://docs.craftcms.com/api/v5/craft-elements-user.html).

```twig
{{ user.fullName }}'s account is now active.
```

## Caveats

:::warning Activation, not registration
A new User is not necessarily activated the moment they register, their status may be set to `pending`. If your site requires email verification, this notification will be sent _after_ they click the verification link.

To send a message at registration instead, use [**"When a new user is created"**](/events/types/users/new-user-created).
:::

## Examples

**Welcome the activated user**

```twig
Hi {{ user.firstName }},

Your account is now active. You can log in any time at {{ siteUrl }}.
```

**Alert administrators of an activation**

```twig
{{ user.fullName }} ({{ user.email }}) has activated their account.
```

**Skip when the user is in a specific group**

```twig
{% if user.isInGroup('imported') %}
    {% skipMessage "Imported users do not receive activation emails." %}
{% endif %}
```
