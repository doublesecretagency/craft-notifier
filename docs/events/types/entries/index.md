---
description: Send a notification when an Entry event is triggered, with separate triggers for per-site saves and post-propagation saves.
---

# Entries

Sends a notification when an **Entry** event is triggered.

<img class="dropshadow" src="/images/events/event-entries.png" alt="" style="width:479px; margin-top:10px">

### [When an entry changes from Pending to Live](/events/types/entries/pending-to-live)

Fires the moment a future-dated entry's Post Date passes and its status becomes Live.

### [When an entry is saved (send one message per each site)](/events/types/entries/entry-saved-per-site)

Fires once per site each time an entry saves. Best for site-aware messaging, where each copy of a multi-site entry warrants its own notification.

### [When an entry is saved and propagated (send one message)](/events/types/entries/entry-saved-and-propagated)

Fires exactly once per save, after the entry has propagated across all its sites and the new revision has been written. Best when you want a single notification regardless of site count, or when the message body needs revision data.

### [When an entry is deleted](/events/types/entries/entry-deleted)

Fires when an Entry is deleted. Covers both soft deletes (moved to the trash) and hard deletes.

### [When an entry is restored](/events/types/entries/entry-restored)

Fires when a soft-deleted Entry is restored from the trash.

### [When a scheduled date is reached](/events/types/entries/date-reached)

Fires a chosen number of days before, on, or after a date such as an entry's Post Date or Expiry Date.
