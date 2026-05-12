---
description: Trigger a notification when a Solspace Calendar Event is deleted.
---

# When an event is deleted

Sends a notification when **a Solspace Calendar Event is deleted**.

This trigger fires for both soft deletes (moved to the trash) and hard deletes. Restoring a deleted event fires the separate [**"When an event is restored"**](/events/types/solspace-calendar/event-restored) event.

<!--@include: @/events/types/_requires-solspace-calendar.md-->

<!--@include: @/events/types/_calendar-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-generic.png" alt="" style="width:600px; margin-top:10px">

## Twig variables

The `object` variable (and its `event` alias) is the deleted [Calendar Event](https://github.com/solspace/craft-calendar/blob/v5/packages/plugin/src/Elements/Event.php).

```twig
"{{ event.title }}" was canceled.
```

## Examples

**Notify subscribers of a cancellation**

```twig
The following event has been canceled.

- Title: {{ event.title }}
- Calendar: {{ event.calendar.name }}
- Was scheduled: {{ event.startDate|date('F j, Y g:i a') }}
```
