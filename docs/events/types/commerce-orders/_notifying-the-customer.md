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
