---
description: Trigger a notification when an Asset is deleted from any volume.
---

# When an asset is deleted

Sends a notification when **an Asset has been deleted**. The trigger fires for both soft deletes (moved to the trash) and hard deletes alike. Restoring a deleted asset fires the separate [**"When an asset is restored"**](/events/types/assets/asset-restored) trigger.

<!--@include: @/events/types/_volume-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-generic.png" alt="" style="width:600px; margin-top:10px">

## Twig variables

The `object` variable (and its `asset` alias) is the deleted [Asset](https://docs.craftcms.com/api/v5/craft-elements-asset.html).

```twig
{{ asset.filename }} was just deleted from "{{ asset.volume.name }}".
```

## Examples

**Alert moderators when an asset is removed**

```twig
{{ currentUser.fullName }} deleted an asset:

- File: {{ asset.filename }}
- Volume: {{ asset.volume.name }}
- Folder: {{ asset.folder.name }}
- Size: {{ asset.size|filesize }}
```

**Only announce deletions from a watched volume**

```twig
{% if asset.volume.handle != 'criticalDocuments' %}
    {% skipMessage "Only Critical Documents trigger this announcement." %}
{% endif %}

Deleted from Critical Documents: {{ asset.filename }}.
```

**Notify the asset's uploader**

```twig
{% if asset.uploader is null %}
    {% skipMessage "No uploader on record." %}
{% endif %}

Hi {{ asset.uploader.firstName }},

The file you uploaded, "{{ asset.filename }}", was just deleted by {{ currentUser.fullName }}.
```
