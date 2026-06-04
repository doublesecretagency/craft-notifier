---
description: Send a report of internal Craft system info (e.g. system details, available updates, queue health, and more).
---

# System Snapshot

Sends a compiled report about the current Craft installation, on demand and/or on a recurring schedule.

<img class="dropshadow" src="/images/events/event-system-snapshot.png" alt="" style="width:646px; margin-top:10px; margin-bottom:40px">

System Snapshot compiles a report about the current Craft installation, and sends it via your configured message type. The `report` data includes basic Craft information, plugin versions (including pending updates), and queue health.

## Twig Variables

Report data will be available in the message template under the `report` Twig variable.

See the [System Snapshot variables](/messages/variables/system-snapshot) for the full reference and examples.

<!--@include: @/events/types/_sending-reports.md-->
