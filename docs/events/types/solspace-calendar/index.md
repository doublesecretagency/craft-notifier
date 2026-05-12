---
description: Send a notification when a Solspace Calendar Event is saved, deleted, or restored. Requires the Solspace Calendar plugin.
---

# Solspace Calendar

Sends a notification when a **Solspace Calendar** Event is triggered.

<!--@include: @/events/types/_requires-solspace-calendar.md-->

## Calendar Events

A Calendar Event is a scheduled occurrence on a Solspace Calendar, either a one-time event or a recurring series.

<img class="dropshadow" src="/images/events/event-solspace-calendar-events.png" alt="" style="width:416px; margin-top:10px">

### [When an event is saved](/events/types/solspace-calendar/event-saved)

Fires when a Calendar Event is saved. Covers both creation and updates to existing events, including changes to recurrence rules.

### [When an event is deleted](/events/types/solspace-calendar/event-deleted)

Fires when a Calendar Event is deleted. Covers both soft deletes (moved to the trash) and hard deletes.

### [When an event is restored](/events/types/solspace-calendar/event-restored)

Fires when a soft-deleted Calendar Event is restored from the trash.
