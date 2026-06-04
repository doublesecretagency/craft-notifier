## Send Manually

After saving the notification, a "Send" button will appear in the page header (next to the "Save" button). Click it to compile and send the report immediately.

## Send on a Recurring Schedule

Enable **Send on a Recurring Schedule** to send reports automatically. Configure the schedule to determine how frequently it will be sent out.

<!--@include: @/events/types/_run-the-schedule.md-->

### Configure Recurring Schedule

After enabling **Send on a Recurring Schedule**, configure the ongoing cadence:

| Control          | Description                                                                                                                                                                                            |
|:-----------------|:-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Every**        | Frequency of runs                                                                                                                                                                                      |
| **Unit**         | Days / Weeks / Months / Years                                                                                                                                                                          |
| **On**           | <ul><li><strong>Weekly:</strong> Day of the week (Monday - Sunday)</li><li><strong>Monthly:</strong> Day of the month (1 - 28)</li><li><strong>Yearly:</strong> Month & day (e.g. "January 1")</li></ul> |
| **At**           | Time of day                                                                                                                                                                                            |
| **Starting on**  | Date the schedule begins                                                                                                                                                                               |

:::tip Max 28 days per month
Day of the month is capped at 28, so that every month (including February) always has the specified day.
:::

### Missed opportunities

If a scheduled run is missed for any reason (e.g. the server was down or the cron didn't fire), only **one** notification will be sent on the following scheduled run. Missed runs will not be retried automatically.
