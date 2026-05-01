---
description:
---

# Commerce Orders

<img class="dropshadow" src="/images/events/event-commerce-orders.png" alt="" style="width:433px; margin-top:10px">

:::tip Requires Craft Commerce
These events are only available when [Craft Commerce](https://plugins.craftcms.com/commerce) is installed. The event type is hidden from the dropdown otherwise.
:::

## When an order is completed (placed)

Sends a notification when **a Commerce Order is completed**. Fires once per order, the first time it transitions out of cart status.

## When an order is fully paid

Sends a notification when **a Commerce Order becomes fully paid**. Fires the first time the outstanding balance reaches zero.

:::warning Refunds and re-payments
If an order is later refunded and then paid again, this event will fire a second time. Each transition into the fully-paid state is treated as a separate notification opportunity.
:::

## Accessing order data in templates

Inside a notification body, the [`object` variable](/messages/variables#event-variables) is the Order itself. Per the [element alias](/messages/variables#alias-of-element) pattern, the `order` alias is also available.

```twig
Order {{ object.shortNumber }} was placed by {{ object.email }}.
Total: {{ object.totalPrice|currency }}
```
```twig
Order {{ order.shortNumber }} was placed by {{ order.email }}.
Total: {{ order.totalPrice|currency }}
```

## Notifying the customer

To notify the customer of an Order, use [Dynamic Recipients](/recipients/types/dynamic-recipients) and pass the order's email address into `{% setRecipients %}`:

```twig
{% if order.email %}
    {% setRecipients order.email %}
{% endif %}
```

If the customer is a Craft user, you can instead pass the User object to get more data from the [`recipient` variable](/messages/variables#people-variables):

```twig
{% if order.customer %}
    {% setRecipients order.customer %}
{% endif %}
```
