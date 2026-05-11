---
description: Trigger a notification when a Craft Commerce Order is completed and transitions out of cart status. Requires Craft Commerce.
---

# When an order is completed (placed)

Sends a notification when **a Commerce Order has been completed**. Fires when the order transitions from `cart` status.

Use this event for customer receipts ("Thanks for your order") and internal alerts ("A new order has been placed").

:::tip Requires Craft Commerce
This trigger is only available when [Craft Commerce](https://plugins.craftcms.com/commerce) is installed. The event type is hidden from the dropdown otherwise.
:::

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-has-changed.png" alt="" style="width:600px; margin-top:10px">

<!--@include: @/events/types/_has-changed-operator.md-->

## Twig variables

The `object` variable (and its `order` alias) is the completed [Order](https://docs.craftcms.com/commerce/api/v5/craft-commerce-elements-order.html).

```twig
Order {{ order.shortNumber }} was placed by {{ order.email }}.
Total: {{ order.totalPrice|currency }}
```

<!--@include: @/events/types/commerce-orders/_notifying-the-customer.md-->

## Examples

**Thank you message and receipt for the customer**

```twig
Thanks for your order, {{ order.billingAddress.firstName }}!

Order {{ order.shortNumber }} - {{ order.totalPrice|currency }}

We'll send tracking info as soon as your items ship.
```

**Internal alert with order summary**

```twig
New order: {{ order.shortNumber }}

Customer: {{ order.email }}
Total: {{ order.totalPrice|currency }}
Items: {{ order.totalQty }}
```

**SMS to fulfillment for high-value orders**

```twig
{% if order.totalPrice < 500 %}
    {% skipMessage "Order under $500." %}
{% endif %}

Priority order: {{ order.shortNumber }}
Total: {{ order.totalPrice|currency }}
Ship today.
```
