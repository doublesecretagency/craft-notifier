---
description: Trigger a notification once per Entry save, after the transaction commits and propagation finishes across every site.
---

# When an entry is saved and propagated (send one message)

Sends a notification when **an entry has completely finished saving, and propagated across all sites**. This trigger fires exactly once per save, regardless of how many sites the entry propagates to.

The event fires after the save transaction has committed and after the new revision has been written, so `entry.currentRevision` and `entry.currentRevision.revisionNotes` are accessible in the message body.

## Section Filters

This trigger is filterable by **sections and entry types** and the [standard element filters](#element-filters).

<img class="dropshadow" src="/images/events/section-filters.png" alt="" style="width:632px; margin-top:10px">

<!--@include: @/events/types/_element-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

## Twig variables

The `object` variable (and its `entry` alias) is the saved [Entry](https://docs.craftcms.com/api/v5/craft-elements-entry.html). The pre-save copy is available as [`original`](/messages/variables#fetching-the-original-element).

```twig
{{ entry.title }} was saved by {{ currentUser.fullName }}.

{% if entry.currentRevision %}
    Revision notes: {{ entry.currentRevision.revisionNotes }}
{% endif %}
```

## Caveats

:::warning Relationship Issues
If your [message template](/messages/) relies on the [`original` variable](/messages/variables#element-variables), please note that any **related** values (ie: Matrix Blocks, Assets, etc) may have changed by the time propagation has completed.

To ensure `original` relationships are accurate, instead use the event **["When an entry is saved (send one message per each site)"](/events/types/entries/entry-saved-per-site)**.
:::

## Examples

**Show what changed in the title**

```twig
{% if entry.title != original.title %}
    The title changed from "{{ original.title }}" to "{{ entry.title }}".
{% else %}
    The entry "{{ entry.title }}" was saved.
{% endif %}
```

**Include the revision note when present**

```twig
{{ entry.title }} was saved by {{ currentUser.fullName }}.

{% if entry.currentRevision and entry.currentRevision.revisionNotes %}
    Note: {{ entry.currentRevision.revisionNotes }}
{% endif %}
```

**Announce only the very first save**

```twig
{% if original %}
    {% skipMessage "Entry has been saved before." %}
{% endif %}

A brand new entry was just published: {{ entry.title }}
```
