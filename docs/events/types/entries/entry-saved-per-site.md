---
description: Trigger a notification once per site each time a multi-site Entry saves. Best for site-aware messaging.
---

# When an entry is saved (send one message per each site)

Sends a notification when **an entry has finished saving on each particular site**. Multi-site entries fire this trigger once per site, so a notification would send one message for each site the entry saved to.

Each message renders with `currentSite`, `entry.url`, and other site-aware values resolved against the **entry's site**, not the site the editor was on when they triggered the save.

## Site and Section Filters

This trigger is filterable by **sites**, **sections and entry types**, and the [standard element filters](#element-filters).

<img class="dropshadow" src="/images/events/site-and-section-filters.png" alt="" style="width:632px; margin-top:10px">

<!--@include: @/events/types/_element-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-has-changed.png" alt="" style="width:600px; margin-top:10px">

<!--@include: @/events/types/_has-changed-operator.md-->

## Twig variables

The `object` variable (and its `entry` alias) is the saved [Entry](https://docs.craftcms.com/api/v5/craft-elements-entry.html). The pre-save copy is available as [`original`](/messages/variables#fetching-the-original-element).

```twig
{{ entry.title }} was saved on {{ currentSite.name }}.
```

## Caveats

:::warning Revision Data Unavailable
The underlying Craft on save event fires before the new revision is written, making `entry.currentRevision` unavailable at that moment.

To access revision data, instead use the event **["When an entry is saved and propagated (send one message)"](/events/types/entries/entry-saved-and-propagated)**.
:::

## Examples

**Link to the entry on its own site**

```twig
{{ entry.title }} was saved on {{ currentSite.name }}.

View it: {{ entry.url }}
```

**Send only when saved on a specific site**

```twig
{% if currentSite.handle != 'default' %}
    {% skipMessage "Only the default site triggers this message." %}
{% endif %}

{{ entry.title }} was just updated on the main site.
```

**Show the saved status alongside the title**

```twig
{{ entry.title }} ({{ entry.status }}) was saved on {{ currentSite.name }} by {{ currentUser.fullName }}.
```
