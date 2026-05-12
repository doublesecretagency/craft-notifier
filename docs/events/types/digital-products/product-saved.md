---
description: Trigger a notification when a Digital Products Product is saved.
---

# When a product is saved

Sends a notification when **a Digital Product has been saved**. Covers both new products and updates to existing products.

For events around customers buying a Digital Product (license created, key granted), use the [**"When a license is saved"**](/events/types/digital-products/license-saved) trigger instead.

<!--@include: @/events/types/_requires-digital-products.md-->

<!--@include: @/events/types/_digital-product-type-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-has-changed.png" alt="" style="width:600px; margin-top:10px">

<!--@include: @/events/types/_has-changed-operator.md-->

## Twig variables

The `object` variable (and its `product` alias) is the saved [Digital Product](https://github.com/craftcms/commerce-digital-products/blob/4.x/src/elements/Product.php).

```twig
"{{ product.title }}" was just saved.
```

## Examples

**Announce a new digital product**

```twig
{{ product.title }} is now available.

- Type: {{ product.type.name }}
- SKU: {{ product.sku }}
- Price: {{ product.price|commerceCurrency }}
```

**Skip when the price didn't change**

```twig
{% if not original %}
    {% skipMessage "Skip on first save - this trigger is for price changes only." %}
{% endif %}

{% if original.price == product.price %}
    {% skipMessage "Price unchanged." %}
{% endif %}

{{ product.title }} is now {{ product.price|commerceCurrency }} (was {{ original.price|commerceCurrency }}).
```
