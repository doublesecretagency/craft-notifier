---
description: Send a real test message from any Notification's edit screen, simulating only the event itself.
---

# Testing Notifications

On every Notification you will find a "Send a test message" button.

:::warning Sends a real message
Triggering a test will send a **real message**:
- to the specified recipients,
- using the specified message template.
:::

Look for the button in the page header, next to the Save button:

<img class="dropshadow" src="/images/notifications/send-test-notification.png" alt="" style="width:362px; margin-top:10px">

## What the test does

When you click the button:

1. A confirmation dialog asks whether you really want to send. Cancel here and nothing happens.
2. On confirm, Notifier compiles the message body, resolves the recipients, and sends each message through the configured channel.
3. Each test send appears in the [Notification Log](/logging) tagged with a **TEST** badge so you can audit it later.

:::tip Queueing respected
The configured queue setting still applies. Email and SMS sends respect their `emailQueue` / `smsQueue` toggles. Announcements are always queued. Flash messages run in the request, exactly as they would on a real event.
:::

## What the test does not do

The test **simulates the event only**. No real entry/asset/user is ever invoked, the triggered event is artificial.

Which means that event-based variables and conditions will not apply. Many [special variables](/messages/variables) will not resolve, and any filters or conditions that rely on the event's sender or context will be bypassed.

The test verifies only what is found in the **Message** and **Recipients** tabs.

## Verifying the test in the log

Open **Utilities > Notification Log** to see the result of each test send. Test envelopes carry a small **TEST** badge:

<img class="dropshadow" src="/images/logs/log-test-badge.png" alt="" style="width:804px; margin-top:10px">

## Permissions

The "Send a test message" button is available only to users with the [Test notifications](/getting-started/permissions) permission enabled.
