---
description: Trigger a notification when an existing Asset is saved, except when the save is a move between folders or volumes.
---

# When an asset is updated

Sends a notification when **an existing Asset is saved**. Covers rename, replacement, alt text changes, focal point changes, and any custom field edits.

The trigger does not fire when an Asset is moved between folders or volumes (see [**"When an asset is moved"**](/events/types/assets/asset-moved)).

<!--@include: @/events/types/_volume-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-has-changed.png" alt="" style="width:600px; margin-top:10px">

<!--@include: @/events/types/_has-changed-operator.md-->

## Twig variables

The `object` variable (and its `asset` alias) is the updated [Asset](https://docs.craftcms.com/api/v5/craft-elements-asset.html). The pre-save copy is available as [`original`](/messages/variables/element-events#fetching-the-original-element) for change-detection.

```twig
{{ asset.filename }} was updated by {{ currentUser.fullName }}.
```

## Examples

**Detect a rename**

```twig
{% if asset.filename == original.filename %}
    {% skipMessage "Filename unchanged." %}
{% endif %}

"{{ original.filename }}" was renamed to "{{ asset.filename }}" by {{ currentUser.fullName }}.
```

**Alert when alt text changes**

```twig
{% if asset.alt == original.alt %}
    {% skipMessage %}
{% endif %}

Alt text on "{{ asset.filename }}" changed:

- Before: {{ original.alt ?: "(none)" }}
- After:  {{ asset.alt ?: "(none)" }}
```

**Detect a file replacement**

```twig
{% if asset.dateModified == original.dateModified %}
    {% skipMessage "File content unchanged." %}
{% endif %}

The file behind "{{ asset.filename }}" was just replaced.
```
