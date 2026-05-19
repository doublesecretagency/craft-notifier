---
description: Send a notification on a schedule, triggered by a date rather than a Craft event.
---

# Scheduled Sending

Most notifications fire automatically when a Craft event occurs. **Scheduled sending** is different. The notification fires when a date is reached, not when something is saved or deleted.

<img class="dropshadow" src="/images/events/event-scheduled-triggered.png" alt="" style="width:554px; margin-top:10px; margin-bottom: 22px">

Craft raises no event when an entry's Post Date or Expiry Date passes, so a scheduled notification cannot wait on an event listener. Instead, the schedule runs on a recurring basis and sends whatever notifications are due.

You will need to [run the schedule](/getting-started/run-the-schedule) on a recurring basis before any scheduled notification can fire.

## The events

Two trigger events send on a schedule.

### [When a scheduled date is reached](/events/types/entries/date-reached)

Fires a chosen number of days before, on, or after a date, such as an entry's Post Date or Expiry Date. Available for every event type.

### [When an entry changes from Pending to Live](/events/types/entries/pending-to-live)

Fires the moment a future-dated entry's Post Date passes and its status becomes Live. Entries only.

## Setting it up

On the **Event** tab of a notification, choose an event type, then select one of the scheduled events from the event dropdown.

"When a scheduled date is reached" shows which date to compare against, offset by the specified number of days.

<img class="dropshadow" src="/images/events/relevant-date-example.png" alt="" style="width:359px; margin-top:10px; margin-bottom: 22px">

For a scheduled notification to fire, you also need to [run the schedule](/getting-started/run-the-schedule) on a recurring basis.

<!--@include: @/events/types/_how-scheduled-fires.md-->
