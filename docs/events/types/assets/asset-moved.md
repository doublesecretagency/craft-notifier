---
description: Trigger a notification when an Asset is moved between folders or volumes.
---

# When an asset is moved

Sends a notification when **an Asset has been moved** to a different folder or volume.

This event can be triggered by:
- drag-and-drop reorganization of the Assets index,
- programmatic [`moveAsset()`](https://docs.craftcms.com/api/v5/craft-services-assets.html#method-moveasset) calls, or
- renames that change the file's underlying path.

<!--@include: @/events/types/_volume-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-generic.png" alt="" style="width:600px; margin-top:10px">

## Twig variables

The `object` variable (and its `asset` alias) is the moved [Asset](https://docs.craftcms.com/api/v5/craft-elements-asset.html) at its new location. The pre-move copy is available as [`original`](/messages/variables/element-events#fetching-the-original-element), which carries the old `folder`, `volume`, and path values for before/after comparison.

```twig
{{ asset.filename }} was moved from "{{ original.folder.name }}" to "{{ asset.folder.name }}".
```

## Examples

**Show the before/after location**

```twig
{{ asset.filename }} was moved:

- From: {{ original.volume.name }} / {{ original.folder.name }}
- To:   {{ asset.volume.name }} / {{ asset.folder.name }}
```

**Skip moves within the same volume**

```twig
{% if original.volumeId == asset.volumeId %}
    {% skipMessage "Same-volume folder reorganization." %}
{% endif %}

{{ asset.filename }} crossed volumes: {{ original.volume.name }} -> {{ asset.volume.name }}
```

**Alert moderators when assets land in a watched folder**

```twig
{% if asset.folder.name != 'Pending Review' %}
    {% skipMessage %}
{% endif %}

A new asset is waiting for review:

- File: {{ asset.filename }}
- Moved by: {{ currentUser.fullName }}
```
