---
description: Trigger Notifier's schedule via cron job, console command, or web endpoint.
---

# Run the Schedule

Notifier's [scheduled notifications](/events/scheduled-sending) fire when a date is reached, not when a Craft event happens. The schedule sits idle until something triggers a run, so you will need to trigger one on a recurring basis.

A run checks every scheduled notification and sends any that are due. There are three ways to trigger a run...

## Cron job

The simplest setup is a cron job that runs once a minute. Add a crontab entry to run the schedule:

```
* * * * * php /path/to/craft notifier/scheduled/run
```

:::warning Send Message via Queue
Depending on how your Notification is configured, this may only push messages to Craft's [queue](https://craftcms.com/docs/5.x/system/queue.html).

The messages themselves will then be sent by your queue runner.
:::

## Console command

For a manual one-off run, or to verify your setup:

```sh
php craft notifier/scheduled/run
```

This is the same command a cron job runs.

## Web endpoint

If command line access is not available, you can trigger a run with an HTTP request:

```
POST /actions/notifier/scheduled/run
```

### Shared secret

The endpoint is protected by a shared secret.

Set up a [Scheduled-Run Token](/getting-started/settings/control-panel#scheduled-sending) first, then include it with each request, either as an `X-Notifier-Token` header or as a `token` body parameter:

```sh
curl -X POST -H "X-Notifier-Token: your-secret-token" https://example.com/actions/notifier/scheduled/run
```

A request without a valid token will be rejected.

:::warning Token required
If no token has been configured, the web endpoint will be unavailable.
:::
