---
description: Send a notification when a Craft Commerce Order event is triggered. Requires the Craft Commerce plugin.
---

# Commerce Orders

Sends a notification when a **Commerce Order** event is triggered.

<img class="dropshadow" src="/images/events/event-commerce-orders.png" alt="" style="width:416px; margin-top:10px">

:::tip Requires Craft Commerce
These triggers are only available when [Craft Commerce](https://plugins.craftcms.com/commerce) is installed. The event type is hidden from the dropdown otherwise.
:::

## [When an order is completed (placed)](/events/types/commerce-orders/order-completed)

Fires when an order transitions out of cart status. Ideal for:
- Customer receipts ("Thanks for your order")
- Internal alerts ("A new order has been placed")

## [When an order is fully paid](/events/types/commerce-orders/order-fully-paid)

Fires when an order's outstanding balance reaches zero.
