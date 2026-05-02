---
description: Send a notification when an Asset event is triggered, such as when a new file is uploaded to any volume.
---

# Assets

Sends a notification when an **Asset** event is triggered.

<img class="dropshadow" src="/images/events/event-assets.png" alt="" style="width:422px; margin-top:10px">

## [When a new file is uploaded and saved](/events/types/assets/file-uploaded)

Fires the first time an Asset is saved, after upload and propagation finish. Subsequent edits to the same Asset (rename, replace, move) do not re-fire it.
