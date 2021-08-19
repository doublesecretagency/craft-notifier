# Triggers

To begin the lifecycle of a notification, a **trigger** must be activated. Each trigger directly correlates with an underlying **event** in Craft (for example, "on Entry save").

## What is being triggered?

A trigger can have a set of corresponding [messages](/messages/) associated with it. Assuming your trigger is configured correctly, all of its respective messages will be sent whenever the trigger is activated.

## Available Triggers

:::warning BETA
While in beta, only a single Trigger is available. More triggers will become available between the beta and formal release.
:::

| Trigger | Description
|:--------|:------------
| [When an Entry is saved](/triggers/on-entry-save/) | Triggered each time an Entry is saved.
