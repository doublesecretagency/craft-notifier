---
description: Trigger a notification when a soft-deleted Entry is restored from the trash.
---

# When an entry is restored

Sends a notification when **an Entry has been restored from the trash**.

This only covers entries that were soft-deleted and then restored from the control panel **Trashed** view or via [`restoreElement()`](https://docs.craftcms.com/api/v5/craft-services-elements.html#method-restoreelement). Entries that were hard-deleted cannot be restored, and thus never fire this trigger.

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-generic.png" alt="" style="width:600px; margin-top:10px">

## Twig variables

The `object` variable (and its `entry` alias) is the restored [Entry](https://docs.craftcms.com/api/v5/craft-elements-entry.html).

```twig
"{{ entry.title }}" was just restored from the trash.
```

## Examples

**Notify the original author when their entry is restored**

```twig
Hi {{ entry.author.firstName }},

Good news, "{{ entry.title }}" was just restored from the trash by {{ currentUser.fullName }}.

View it: {{ entry.cpEditUrl }}
```

**Acknowledge the restore to whoever triggered it**

```twig
You just restored "{{ entry.title }}". It's back in {{ entry.section.name }}.
```
