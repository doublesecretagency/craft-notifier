---
description: Trigger a notification when a Craft Commerce Order's outstanding balance reaches zero. Requires Craft Commerce.
---

# When an order is fully paid

Sends a notification when **a Commerce Order becomes fully paid**. Fires when the outstanding balance reaches zero.

If an order is refunded, and returns to zero once again, another notification will be triggered.

:::tip Requires Craft Commerce
This trigger is only available when [Craft Commerce](https://plugins.craftcms.com/commerce) is installed. The event type is hidden from the dropdown otherwise.
:::

## Twig variables

The `object` variable (and its `order` alias) is the paid [Order](https://docs.craftcms.com/commerce/api/v5/craft-commerce-elements-order.html).

```twig
Order {{ order.shortNumber }} is fully paid.
Amount paid: {{ order.totalPaid|currency }}
```

## Caveats

:::warning Refunds and re-payments
If an order is later refunded and then paid again, this trigger will fire a second time. Each transition into the fully-paid state is treated as a separate notification opportunity.

To send a notification only on the initial completion of the order, use [**"When an order is completed (placed)"**](/events/types/commerce-orders/order-completed) instead.
:::

<!--@include: @/events/types/commerce-orders/_notifying-the-customer.md-->

## Examples

**Payment confirmation for the customer**

```twig
Thanks, {{ order.billingAddress.firstName }}!

Your payment of {{ order.totalPaid|currency }} for order {{ order.shortNumber }} has been received.
```

**Internal alert for fulfillment**

```twig
Order {{ order.shortNumber }} is fully paid and ready to ship.

- Customer: {{ order.email }}
- Total: {{ order.totalPaid|currency }}
- Items: {{ order.totalQty }}
```

**Skip the message on a re-payment after a refund**

```twig
{% if order.dateOrdered != order.datePaid %}
    {% skipMessage "Payment is a re-payment after a refund." %}
{% endif %}

Order {{ order.shortNumber }} is paid in full.
```
