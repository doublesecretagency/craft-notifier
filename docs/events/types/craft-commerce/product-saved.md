---
description: Trigger a notification when a Craft Commerce Product is saved.
---

# When a product is saved

Sends a notification when **a Commerce Product has been saved**. Covers both new products and updates to existing products.

<!--@include: @/events/types/_requires-craft-commerce.md-->

<!--@include: @/events/types/_product-type-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-has-changed.png" alt="" style="width:600px; margin-top:10px">

<!--@include: @/events/types/_has-changed-operator.md-->

## Twig variables

The `object` variable (and its `product` alias) is the saved [Product](https://docs.craftcms.com/commerce/api/v5/craft-commerce-elements-product.html).

```twig
"{{ product.title }}" was just saved.
```

## Examples

**Notify the merch team of a new product launch**

```twig
{{ product.title }} is now live.

- Type: {{ product.type.name }}
- Price: {{ product.defaultVariant.price|commerceCurrency }}
- SKU: {{ product.defaultVariant.sku }}
```

**Skip when the price didn't change**

```twig
{% if not original %}
    {% skipMessage "Skip on first save - this trigger is for price changes only." %}
{% endif %}

{% if original.defaultVariant.price == product.defaultVariant.price %}
    {% skipMessage "Price unchanged." %}
{% endif %}

{{ product.title }} is now {{ product.defaultVariant.price|commerceCurrency }} (was {{ original.defaultVariant.price|commerceCurrency }}).
```
