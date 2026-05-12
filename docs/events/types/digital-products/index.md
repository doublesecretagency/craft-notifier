---
description: Send a notification when a Digital Products Product or License event is triggered. Requires the Digital Products plugin.
---

# Digital Products

Sends a notification when a **Digital Products** Product or License event is triggered.

<!--@include: @/events/types/_requires-digital-products.md-->

## Products

A digital Product is a downloadable item in your catalog (an ebook, a piece of software, a music track).

Product events cover the catalog lifecycle: launches, edits, removals, and restores.

<img class="dropshadow" src="/images/events/event-digital-products-products.png" alt="" style="width:416px; margin-top:10px">

### [When a product is saved](/events/types/digital-products/product-saved)

Fires when a digital Product is saved. Covers both creation and updates.

### [When a product is deleted](/events/types/digital-products/product-deleted)

Fires when a digital Product is deleted. Covers both soft deletes (moved to the trash) and hard deletes.

### [When a product is restored](/events/types/digital-products/product-restored)

Fires when a soft-deleted digital Product is restored from the trash.

## Licenses

A License is what a customer gets after paying for a digital Product.

License events are where you wire up customer-facing notifications: send the key, grant download access, or alert someone when access gets revoked.

<img class="dropshadow" src="/images/events/event-digital-products-licenses.png" alt="" style="width:416px; margin-top:10px">

### [When a license is saved](/events/types/digital-products/license-saved)

Fires when a License is created or updated. Most often used to email the customer their key the moment their order is paid.

### [When a license is deleted](/events/types/digital-products/license-deleted)

Fires when a License is deleted. Useful for notifying customers their access has been revoked, or for alerting admins about refunded purchases.

### [When a license is restored](/events/types/digital-products/license-restored)

Fires when a soft-deleted License is restored from the trash.
