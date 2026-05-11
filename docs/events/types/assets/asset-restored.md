---
description: Trigger a notification when a soft-deleted Asset is restored from the trash.
---

# When an asset is restored

Sends a notification when **an Asset has been restored from the trash**.

This only covers assets that were soft-deleted and then restored from the control panel **Trashed** view or via [`restoreElement()`](https://docs.craftcms.com/api/v5/craft-services-elements.html#method-restoreelement). Assets that were hard-deleted cannot be restored, and thus never fire this trigger.

::: warning Can't restore Assets deleted without `keepFileOnDelete`
Craft only allows an Asset to be restored if its file was preserved at delete time.

The control panel's standard "Delete" action will **hard-delete the underlying file**. Once the file has been deleted, it becomes impossible to restore the Asset.

To produce a restorable Asset, you must delete it _programmatically_, and set the `keepFileOnDelete` flag before deletion:

```php
$asset->keepFileOnDelete = true;
Craft::$app->getElements()->deleteElement($asset);
```

Without that flag, a deleted Asset will not be restorable.
:::

<!--@include: @/events/types/_volume-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-generic.png" alt="" style="width:600px; margin-top:10px">

## Twig variables

The `object` variable (and its `asset` alias) is the restored [Asset](https://docs.craftcms.com/api/v5/craft-elements-asset.html).

```twig
{{ asset.filename }} was just restored.
```

## Examples

**Alert moderators of an asset restore**

```twig
An asset was just restored:

- File: {{ asset.filename }}
- Volume: {{ asset.volume.name }}
- Restored by: {{ currentUser.fullName }}
```

**Skip restores from automated processes**

```twig
{% if currentUser is null %}
    {% skipMessage "Restored by an automated process." %}
{% endif %}

{{ asset.filename }} was restored by {{ currentUser.fullName }}.
```
