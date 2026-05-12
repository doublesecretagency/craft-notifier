---
description: Trigger a notification when an Entry is deleted. Fires once per delete, not per site.
---

# When an entry is deleted

Sends a notification when **an Entry has been deleted**. Multi-site entries fire this trigger once (when the canonical record is deleted), regardless of how many sites the entry was propagated to.

This trigger fires for both soft deletes (moved to the trash) and hard deletes. Restoring a deleted entry fires the separate [**"When an entry is restored"**](/events/types/entries/entry-restored) event.

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-generic.png" alt="" style="width:600px; margin-top:10px">

## Twig variables

The `object` variable (and its `entry` alias) is the deleted [Entry](https://docs.craftcms.com/api/v5/craft-elements-entry.html).

```twig
"{{ entry.title }}" was just deleted.
```

## Examples

**Alert administrators of a deletion**

```twig
{{ entry.title }} was deleted by {{ currentUser.fullName }}.

- Section: {{ entry.section.name }}
- Type: {{ entry.type.name }}
- Slug: {{ entry.slug }}
```

**Skip deletions in a specific section**

```twig
{% if entry.section.handle == 'scratch' %}
    {% skipMessage "Scratch entries are not announced." %}
{% endif %}

Deleted: {{ entry.title }}
```

**Notify the entry's author**

```twig
Hi {{ entry.author.firstName }},

Heads up: "{{ entry.title }}" was deleted by {{ currentUser.fullName }}.

If you need it back, ask an admin to restore it from the trash.
```
