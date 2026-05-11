---
description: Send a notification when an Asset event is triggered, such as when a new file is uploaded to any volume.
---

# Assets

Sends a notification when an **Asset** event is triggered.

<img class="dropshadow" src="/images/events/event-assets.png" alt="" style="width:416px; margin-top:10px">

## [When a new file is uploaded and saved](/events/types/assets/file-uploaded)

Fires the first time an Asset is saved, after upload and propagation finish. Subsequent edits to the same Asset (rename, replace, move) do not re-fire it.

## [When an asset is moved](/events/types/assets/asset-moved)

Fires when an Asset is moved between folders or volumes. The pre-move location is available on the `original` Twig variable for before/after rendering.

## [When an asset is updated](/events/types/assets/asset-updated)

Fires every time an existing Asset is saved (except when moved, see above). Covers rename, replacement, alt text, focal point, and custom field edits.

## [When an asset is deleted](/events/types/assets/asset-deleted)

Fires when an Asset is deleted. Covers both soft deletes (moved to the trash) and hard deletes.

## [When an asset is restored](/events/types/assets/asset-restored)

Fires when a soft-deleted Asset is restored from the trash.
