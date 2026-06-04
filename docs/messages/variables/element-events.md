---
description: The available Twig variables when a notification is triggered by a Craft element (Entries, Assets, Users, etc).
---

# Element Variables

<!--@include: @/messages/variables/_global-variables.md-->

When a notification is triggered by an element event, the element (and variants) will be available in the message template.

These apply to all element-based events (Entries, Assets, Users, etc), including third-party element types:

| Variable                    | Description                                                                             |
|:----------------------------|-----------------------------------------------------------------------------------------|
| `object`                    | The element or object which triggered the notification.                                 |
| `element`                   | The element which triggered the notification.                                           |
| `entry` _(or another type)_ | Alias of `element`. [(see below)](#alias-of-element).                                   |
| `original`                  | The **pre-saved** copy of the `element`. [(see below)](#fetching-the-original-element). |

## Alias of `element`

The `element` variable will be automatically aliased based on its **element type**:

| Variable      | Element Type |
|:--------------|--------------|
| `entry`       | Entry        |
| `asset`       | Asset        |
| `user`        | User         |
| `matrixBlock` | Matrix Block |
| _etc_         | _etc_        |

:::warning Supports plugins and modules
This pattern also works for third-party elements introduced by plugins or modules.
:::

## Fetching the `original` element

If the notification was triggered by an "on save" event, the `original` element will also be fetched prior to saving.

This can be very useful when comparing the `original` (pre-save) values to the `element` (post-save) values.

:::tip Optionally Skip Messages
One major reason to compare `original` with `element` is to [optionally skip messages](/messages/skip) based on your own custom Twig logic.
:::

## Examples

**Welcome and onboard a new user**

```twig
Hi {{ user.firstName }},

Welcome aboard! Your account is ready to use.

- Username: {{ user.username }}
- Email: {{ user.email }}

{% if user.groups|length %}
Access granted: {{ user.groups|map(g => g.name)|join(', ') }}.
{% endif %}

{% if currentUser %}
This account was set up for you by {{ currentUser.fullName }}.
{% endif %}
```

**Alert an editor when their content changes**

```twig
{% if entry.title == original.title and entry.postDate == original.postDate %}
    {% skipMessage "Nothing noteworthy changed." %}
{% endif %}

Hi {{ recipient.name }},

{{ currentUser.fullName }} just updated "{{ original.title }}".

{% if entry.title != original.title %}
The title is now "{{ entry.title }}".
{% endif %}

Review the latest version: {{ entry.cpEditUrl }}
```

**Audit asset renames and replacements**

```twig
{% if asset.filename == original.filename and asset.dateModified == original.dateModified %}
    {% skipMessage "No file or name change to report." %}
{% endif %}

Hi {{ recipient.name }},

{{ currentUser.fullName }} just modified an asset.

{% if asset.filename != original.filename %}
- Renamed from "{{ original.filename }}" to "{{ asset.filename }}"
{% endif %}
{% if asset.dateModified != original.dateModified %}
- The underlying file was replaced
{% endif %}

View the asset: {{ asset.cpEditUrl }}
```
