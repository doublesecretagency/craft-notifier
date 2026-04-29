---
description: Notifier records every sent message in a detailed log utility.
---

# Notification Log

To see a detailed notification log, visit **Utilities > Notification Log** in the control panel:

<img class="dropshadow" src="/images/logs/notification-log.png" alt="" style="width:1184px; margin-top:10px">

## Restricting log size

By default, the log will accumulate events indefinitely, until/unless they are manually cleared. The following settings manage whether and how long those log events remain in the database.

These settings can be managed via either the plugin's [Settings page](/getting-started/settings) or the plugin's [PHP config file](/getting-started/config).

### `loggingEnabled`

_bool_ - Defaults to `true`.

When disabled, Notifier writes nothing to the notification log, and the "Notification Log" utility will be unavailable.

### `logRetentionDays`

_int_|_null_ - Defaults to `null` (no limit).

Maximum age, in days, of log events to retain. Older events will be pruned automatically. Leave blank for no limit.

### `logRetentionRecords`

_int_|_null_ - Defaults to `null` (no limit).

Maximum number of log events to retain. When this limit is exceeded, the oldest events will be dropped. Leave blank for no limit.

:::tip No cron required
If either retention maximum is set, older log events will be pruned automatically as new ones are written.
:::

:::tip Both Rules Apply
If both `logRetentionDays` and `logRetentionRecords` are set, both rules will apply. Any log event that exceeds either maximum will be pruned.
:::

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
