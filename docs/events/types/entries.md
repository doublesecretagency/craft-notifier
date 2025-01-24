---
description:
---

# Entries

<img class="dropshadow" src="/images/events/event-entries.png" alt="" style="width:433px; margin-top:10px">

## When an entry is saved (per each site)

Sends a notification when **an entry has finished saving on each particular site**.

<img class="dropshadow" src="/images/events/sites-entry-types-filters.png" alt="" style="width:650px; margin-top:22px">

## When an entry is fully saved and propagated

:::warning Relationship Issues
If your [message template](/messages/) relies on the [`original` variable](/messages/variables#element-variables), please note that any **related** values (ie: Matrix Blocks, Assets, etc) may have changed by the time propagation has completed.

To ensure `original` relationships are accurate, instead use the event **"When an entry is saved (per each site)"** (see above).
:::

Sends a notification when **an entry has completely finished saving, and propagated across all sites**.

<img class="dropshadow" src="/images/events/entry-types-filters.png" alt="" style="width:570px; margin-top:22px">
