---
description: Send a real test message from any Notification's edit screen, using real data matched to the notification's filters and condition.
---

# Testing Notifications

At the top of every Notification, you will find a "Send a test message" button (beside the Save button):

<img class="dropshadow" src="/images/notifications/send-test-notification.png" alt="" style="width:362px; margin-top:21px; margin-bottom:27px">

:::warning ⚠️ Warning, sends a real message!
Triggering a test will send a **real message**:
- to the specified recipients,
- using the specified message template.
:::

## What happens when you push the button

1. A confirmation dialog asks whether you really want to send. _Cancel here and nothing happens._
2. On confirm, Notifier resolves recipients, compiles the message body, and sends the message.
3. Each test send appears in the [Notification Log](/logging) tagged with a **TEST** badge so you can audit it later.

:::tip Queueing respected
The configured queue setting still applies. If your notification is configured to use the jobs queue, that will apply to the test message as well.
:::

## How it works

The test runs against **real data**, so you can see what a real notification would look like:

| Event Type          | Dummy Data                           |
|---------------------|--------------------------------------|
| **Element events**  | A randomly selected matching element |
| **RSS/JSON Feed**   | A randomly selected feed item        |
| **System Snapshot** | A real report (not a test)           |
| **Dynamic Data**    | A real report (not a test)           |

Because the test uses real data, most [special variables](/messages/variables/) will resolve correctly, and the **Event** tab's filters and conditions are respected.

## What it can't do

The event itself is simulated, not fired by Craft, so it has no real "before" state to compare against. The `original` element is unavailable, so any `"has changed"` comparison won't resolve, and event-specific details (such as which User Groups were just assigned) aren't present.

Everything on the **Message** and **Recipients** tabs is otherwise exercised end to end.

## Verifying in the log

Open [**Utilities > Notification Log**](/logging) to see the result of each test send. Test messages carry a small **TEST** badge:

<img class="dropshadow" src="/images/logs/log-test-badge.png" alt="" style="width:804px; margin-top:10px">
