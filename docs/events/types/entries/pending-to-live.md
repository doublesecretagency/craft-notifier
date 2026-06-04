---
description: Trigger a notification when an entry's Post Date passes and its status changes to Live.
---

# When an entry changes from Pending to Live

Sends a notification the moment an **entry's status changes from Pending to Live**.

A future-dated entry stays at the `Pending` status until its Post Date arrives. Craft computes that transition on the fly and fires no event for it, so Notifier polls for it instead.

This trigger is functionally equivalent to a ["When a scheduled date is reached"](/events/types/entries/date-reached) notification set to `On` `Post Date`.

<!--@include: @/events/types/_run-the-schedule.md-->

## Twig variables

The `object` variable (and its `entry` alias) is the [Entry](https://docs.craftcms.com/api/v5/craft-elements-entry.html) that just went live.

```twig
"{{ entry.title }}" is now live.
```

## Examples

**Automatically post a new entry to Bluesky**

```twig
New in {{ entry.section.name }}: {{ entry.title }}

{{ entry.url }}
```

**Announce a new post to a Slack channel**

```twig
New on the blog: "{{ entry.title }}" - {{ entry.url }}
```

**Tell the author their scheduled entry has published**

```twig
Hi {{ entry.author.firstName }},

"{{ entry.title }}" just went live in {{ entry.section.name }}. View it: {{ entry.url }}
```
