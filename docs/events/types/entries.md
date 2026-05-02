---
description:
---

# Entries

<img class="dropshadow" src="/images/events/event-entries.png" alt="" style="width:433px; margin-top:10px">

## When an entry is saved (send one message per each site)

Sends a notification when **an entry has finished saving on each particular site**. Multi-site entries fire this trigger once per site, so a notification configured here will dispatch one message per site the entry saved to.

Each message renders with `currentSite`, `entry.url`, and other site-aware values resolved against the **entry's site**, not the site the editor was on when they triggered the save.

:::warning Revision Data Unavailable
The underlying Craft on save event fires before the new revision is written, making `entry.currentRevision` unavailable at that moment.

To access revision data, instead use the event **"When an entry is saved and propagated (send one message)"** (see below).
:::

<img class="dropshadow" src="/images/events/sites-entry-types-filters.png" alt="" style="width:650px; margin-top:22px">

## When an entry is saved and propagated (send one message)

Sends a notification when **an entry has completely finished saving, and propagated across all sites**. This trigger fires exactly once per save, regardless of how many sites the entry propagates to.

The event fires after the save transaction has committed and after the new revision has been written, so `entry.currentRevision` and `entry.currentRevision.revisionNotes` are accessible in the message body.

:::warning Relationship Issues
If your [message template](/messages/) relies on the [`original` variable](/messages/variables#element-variables), please note that any **related** values (ie: Matrix Blocks, Assets, etc) may have changed by the time propagation has completed.

To ensure `original` relationships are accurate, instead use the event **"When an entry is saved (send one message per each site)"** (see above).
:::

<img class="dropshadow" src="/images/events/entry-types-filters.png" alt="" style="width:570px; margin-top:22px">
