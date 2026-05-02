---
description: Trigger a notification the first time a User is saved. Covers public registrations, control panel signups, and programmatic User creation.
---

# When a new user is created

Sends a notification when **a new User is created**. This trigger fires the first time a User is saved, so it covers public registrations, control-panel "New User" submissions, and any programmatic call to `Craft::$app->getElements()->saveElement()` on a brand-new User.

The trigger only fires once per User. Re-saving an existing User (profile updates, password changes, group reassignment) does not re-fire it.

## Twig variables

The `object` variable (and its `user` alias) is the new [User](https://docs.craftcms.com/api/v5/craft-elements-user.html).

```twig
A new user just signed up: {{ user.fullName }} ({{ user.email }}).
```

## Caveats

:::warning Creation, not activation
This trigger fires the moment a User record is saved for the first time, regardless of activation status. If your site requires email verification, this notification will be sent _before_ they click the verification link.

To send a message after the User has activated their account instead, use [**"When a user is activated"**](/events/types/users/user-activated).
:::

## Examples

**Confirm the new sign-up**

```twig
Hi {{ user.firstName }},

Thanks for signing up! Watch your inbox for a verification email.
```

**Alert administrators of a public registration**

```twig
A new user just signed up:

- Name: {{ user.fullName }}
- Email: {{ user.email }}
- Username: {{ user.username }}
```

**Skip the welcome message for users in a specific group**

```twig
{% if user.isInGroup('contractors') %}
    {% skipMessage "Contractors do not receive the welcome email." %}
{% endif %}
```
