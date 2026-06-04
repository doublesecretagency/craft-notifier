---
description: Send a notification when a new item is found in an external RSS, Atom, or JSON feed.
---

# RSS/JSON Feed

Sends a notification when a **new item appears in an external feed**.

<img class="dropshadow" src="/images/events/event-feed.png" alt="" style="width:416px; margin-top:10px; margin-bottom:22px">

Unlike other event types, RSS/JSON Feed isn't tied to specific Craft elements. Instead, Notifier will poll the feed and send a message every time a new item shows up.

The format will be automatically detected when the feed is parsed. Notifier will sync with the feed, and fire notifications for any new items which appear after the schedule has been set up. Pre-existing feed items will be ignored.

<!--@include: @/events/types/_run-the-schedule.md-->

## Identifying unique items

Each feed item is tracked by its canonical identifier:

- **RSS**: `<guid>`
- **Atom**: `<id>`
- **JSON Feed**: `id`

If no unique ID is provided by the feed, the item's URL (`<link>` / `url`) will be used instead.

### Expected behavior

- An item whose identifier (correctly) never changes will fire exactly **once**, no matter how often the schedule is run.
- An item whose identifier (incorrectly) changes between runs _will be fired every time the identifier changes_.
- Items with no identifier or URL will be skipped.

## Twig variables

All feed data is exposed through the `feed` and `item` Twig variables.

See the [RSS/JSON Feed variables](/messages/variables/rss-json-feed) for the full reference and examples.
