---
description: Trigger a notification a chosen number of days before, on, or after a date, such as an entry's Post Date or Expiry Date.
---

# When a scheduled date is reached

Sends a notification when a **chosen date is reached**, optionally offset by a number of days before or after.

Most triggers run on a Craft event. This one does not. Craft fires nothing when an entry's Post Date or Expiry Date passes, so Notifier polls for due notifications instead.

:::warning Set up Scheduled Sending
Before this trigger will fire, you will need to set up [Scheduled Sending](/events/scheduled-sending).
:::

## Configuring the date

Three controls decide when the notification fires:

- **Offset** - Number of days. Hidden when the direction is "On".
- **Direction** - Either `On`, `days before`, or `days after`.
- **Date field** - The date to measure against.

For example:
- `On` `Post Date` fires the moment each entry's post date arrives.
- `15` `days before` `Expiry Date` fires fifteen days before each entry's expiry date.

<!--@include: @/events/types/_how-scheduled-fires.md-->

<!--@include: @/events/types/_field-conditions.md-->

## Twig variables

The `object` variable (and its `entry` alias) is the [Entry](https://docs.craftcms.com/api/v5/craft-elements-entry.html) whose date was reached.

```twig
"{{ entry.title }}" reaches its expiry date in 15 days.
```

## Examples

**Remind the author before an entry expires**

```twig
Hi {{ entry.author.firstName }},

"{{ entry.title }}" expires in 15 days. Review it here: {{ entry.cpEditUrl }}
```

**Announce an entry the day its post date arrives**

```twig
"{{ entry.title }}" is now live in {{ entry.section.name }}.
```

**Follow up a week after publishing**

```twig
"{{ entry.title }}" has been live for a week. Time to check how it's performing.
```
