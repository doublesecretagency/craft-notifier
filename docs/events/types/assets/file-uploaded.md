---
description: Trigger a notification the first time a new Asset is saved, after the upload finishes.
---

# When a new file is uploaded and saved

Sends a notification when **a new file has been uploaded and saved** to any Craft asset volume. This trigger fires the first time an Asset is saved, after the upload completes and propagation finishes.

The trigger only fires once per Asset. Replacing a file, renaming it, moving it between folders, or saving an Asset's metadata does not re-fire it.

<!--@include: @/events/types/_field-conditions.md-->

## Twig variables

The `object` variable (and its `asset` alias) is the new [Asset](https://docs.craftcms.com/api/v5/craft-elements-asset.html).

```twig
{{ asset.filename }} was uploaded to "{{ asset.volume.name }}".
```

## Filtering by volume

The notification configuration screen does not include a volume selector. To target a specific volume (or a specific folder within a volume), use [`{% skipMessage %}`](/messages/skip) inside the message body:

```twig
{% if asset.volume.handle != 'productPhotos' %}
    {% skipMessage %}
{% endif %}
```

## Examples

**Email a moderator with the upload details**

```twig
{{ currentUser.fullName }} uploaded a new file:

- File: {{ asset.filename }}
- Size: {{ asset.size|filesize }}
- Volume: {{ asset.volume.name }}
- Folder: {{ asset.folder.name }}
```

**Announce uploads to a specific volume**

```twig
{% if asset.volume.handle != 'criticalDocuments' %}
    {% skipMessage "Only Critical Documents trigger this announcement." %}
{% endif %}

{{ asset.filename }} was uploaded to Critical Documents.
```

**Skip files smaller than a threshold**

```twig
{% if asset.size < 5242880 %}
    {% skipMessage "Asset is under 5 MB." %}
{% endif %}

Large file uploaded: {{ asset.filename }} ({{ asset.size|filesize }}).
```
