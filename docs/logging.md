---
description:
---

# Notification Log

To see a detailed notification log, visit **Utilities > Notification Log** in the control panel:

<img class="dropshadow" src="/images/logs/notification-log.png" alt="" style="width:1184px; margin-top:10px">

## Individual log events

Each log event displays the path taken by that message as it was packed up and delivered.

Click the **Details** button to reveal additional information about what each message contained:

<img src="/images/logs/log-details.png" alt="" style="width:755px; margin-top:10px">

The **Config** button will open the original [Notification](/elements) which generated the outgoing message.

## Deleting log events

To delete a single message log, click the **X** button.

To delete all logs on a given date, click the **Delete Day Logs** button at the top of the page.

<img class="dropshadow" src="/images/logs/log-header.png" alt="" style="width:606px; margin-top:26px; margin-bottom:-14px;">

## Navigating between dates

Click the **left & right arrows** to move back or forward a full day.

- Left goes back to the previous day.
- Right goes forward to the following day.
- Once you have reached the current day, it will be impossible to navigate any further into the future.

:::warning TODAY
If displaying logs for the current day, a **TODAY** tag will appear beside the date.
:::

### Manually change date

To manually navigate, **specify a date in the page URL**.

```
.../utilities/notification-log?date=2024-02-18
```
