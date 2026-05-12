---
description: Trigger a notification when a soft-deleted Solspace Calendar Event is restored from the trash.
---

# When an event is restored

Sends a notification when **a soft-deleted Solspace Calendar Event is restored from the trash**.

<!--@include: @/events/types/_requires-solspace-calendar.md-->

<!--@include: @/events/types/_calendar-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-generic.png" alt="" style="width:600px; margin-top:10px">

## Twig variables

The `object` variable (and its `event` alias) is the restored [Calendar Event](https://github.com/solspace/craft-calendar/blob/v5/packages/plugin/src/Elements/Event.php).

```twig
"{{ event.title }}" is back on the calendar.
```

## Examples

**Notify subscribers of a restored event**

```twig
The following event has been restored.

- Title: {{ event.title }}
- Calendar: {{ event.calendar.name }}
- Starts: {{ event.startDate|date('F j, Y g:i a') }}
```
