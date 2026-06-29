---
description: Configure a wide range of notifications from within your Craft control panel. Here's how to get up and running...
---

# Getting Started

Notifier sends a notification whenever something happens in Craft. Pick an [event](/events/), choose a [message](/messages/) type, and decide who will [receive](/recipients/) it. You build each notification in the control panel, writing the message body with Twig so it can pull in details from whatever triggered it.

When the event fires, Notifier checks any conditions you've set, builds the message from your template, and sends it through the channels you configured. Recipients can be Craft users, dynamically chosen people, or anyone you specify, so the right people hear about the right things at the right time.

<img class="dropshadow" src="/images/getting-started/instructions.png" alt="The notification editor's Event, Message, and Recipients tabs annotated: which event triggers it, what message is sent, and who receives it" style="width:416px; margin-top:30px; margin-bottom:40px">

## Where to begin

If you're just getting started, the first steps will be:

1. [Install](/getting-started/installation) the plugin.
2. Configure the plugin's [settings](/getting-started/settings/).
3. Configure any third-party [integrations](/getting-started/integrations/) you need.

:::warning Run the Schedule
If you're running any **time-based** or **scheduled** notifications, you'll also need to [run the schedule](/getting-started/run-the-schedule), which is how Notifier checks for things that should be sent at a certain time or on a recurring basis.
:::

Once you've got the basics set up, you can start building notifications.
- [Events](/events/) are the triggers which cause notifications to send.
- [Messages](/messages/) are the types of notifications you can send.
- [Recipients](/recipients/) are the people who will receive each notification.

## Notifications

For more info, see [Notification Elements...](/elements)

<img class="dropshadow" src="/images/elements/notification-elements.png" alt="The Notifications index, showing several hypothetical example Notifications" style="width:901px; margin-top:30px">
