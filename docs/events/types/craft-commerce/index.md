---
description: Send a notification when a Craft Commerce Order or Product event is triggered. Requires the Craft Commerce plugin.
---

# Craft Commerce

Sends a notification when a **Craft Commerce** Order or Product event is triggered.

<!--@include: @/events/types/_requires-craft-commerce.md-->

## Commerce Orders

An Order is a customer's purchase.

Order events fire on state transitions like checkout completion and payment, and are the natural place to send receipts to customers and alerts to your fulfillment team.

<img class="dropshadow" src="/images/events/event-craft-commerce-orders.png" alt="" style="width:416px; margin-top:10px">

### [When an order is completed (placed)](/events/types/craft-commerce/order-completed)

Fires when an order transitions out of cart status. Ideal for:
- Customer receipts ("Thanks for your order")
- Internal alerts ("A new order has been placed")

### [When an order is fully paid](/events/types/craft-commerce/order-fully-paid)

Fires when an order's outstanding balance reaches zero.

## Commerce Products

Products are the items in your Commerce catalog.

Product events cover the full catalog lifecycle: a new item going live, an existing product getting edited, soft-deletes when an item is pulled from sale, and restores.

<img class="dropshadow" src="/images/events/event-craft-commerce-products.png" alt="" style="width:416px; margin-top:10px">

### [When a product is saved](/events/types/craft-commerce/product-saved)

Fires when a Commerce Product is saved. Covers both creation and updates.

### [When a product is deleted](/events/types/craft-commerce/product-deleted)

Fires when a Commerce Product is deleted. Covers both soft deletes (moved to the trash) and hard deletes.

### [When a product is restored](/events/types/craft-commerce/product-restored)

Fires when a soft-deleted Commerce Product is restored from the trash.
