---
description:
---

# Notification Logs

🚩

A complete history of notification attempts will be recorded in a log file. To see what has been processed, check out the log data, either via the control panel or by opening the log file directly.

## Control Panel

To see the detailed log, visit the **Utilities > Notification Logs** page in your control panel.

<img class="dropshadow" src="/images/OLD/guides/notification-logs.png" alt="" style="max-width:760px; margin-top:10px">

## Log File

The screenshot above is a GUI representation of the underlying text log data...

```
{"*":"2021-08-06 11:32:37 [info] Determining which email addresses based on custom Twig snippet..."
{"*":"2021-08-06 11:32:37 [info] Preparing to send email message to alice@example.com..."
{"*":"--> 2021-08-06 11:32:39 [success] The email to alice@example.com was sent successfully! (New Article: Styles of Summer)"
{"*":"2021-08-06 11:32:39 [info] Preparing to send email message to bob-example.com..."
{"*":"--> 2021-08-06 11:32:39 [warning] \"bob-example.com\" is not a valid email address."
{"*":"--> 2021-08-06 11:32:39 [error] Invalid recipient, email could not be sent."
```

:::tip Truncated Example
The data shown here has been truncated for example purposes. Each row is actually part of a much more complex JSON encoded string. If you open the log file, you will see additional data available on each line.
:::

### File Path

All log data will be stored in the following file...

```
yoursite/storage/logs/notifier.log
```

No logging data is stored in the database.
