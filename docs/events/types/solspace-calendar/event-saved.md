---
description: Trigger a notification when a Solspace Calendar Event is saved.
---

# When an event is saved

Sends a notification when **a Solspace Calendar Event is saved**. Covers both new events and updates to existing events, including changes to recurrence rules.

<!--@include: @/events/types/_requires-solspace-calendar.md-->

<!--@include: @/events/types/_calendar-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-has-changed.png" alt="" style="width:600px; margin-top:10px">

<!--@include: @/events/types/_has-changed-operator.md-->

## Twig variables

The `object` variable (and its `event` alias) is the saved [Calendar Event](https://github.com/solspace/craft-calendar/blob/v5/packages/plugin/src/Elements/Event.php).

```twig
"{{ event.title }}" is scheduled for {{ event.startDate|date('F j, Y g:i a') }}.
```

## Examples

**Announce a new event**

```twig
A new event has been scheduled.

- Title: {{ event.title }}
- Calendar: {{ event.calendar.name }}
- Starts: {{ event.startDate|date('F j, Y g:i a') }}
- Ends: {{ event.endDate|date('F j, Y g:i a') }}
```

**Skip recurring-event updates**

```twig
{% if event.rrule %}
    {% skipMessage "Recurring event updates not announced." %}
{% endif %}

Saved: {{ event.title }}
```
