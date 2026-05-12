---
description: Trigger a notification when a Digital Products Product is deleted.
---

# When a product is deleted

Sends a notification when **a Digital Product has been deleted**.

This trigger fires for both soft deletes (moved to the trash) and hard deletes. Restoring a deleted product fires the separate [**"When a product is restored"**](/events/types/digital-products/product-restored) event.

<!--@include: @/events/types/_requires-digital-products.md-->

<!--@include: @/events/types/_digital-product-type-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-generic.png" alt="" style="width:600px; margin-top:10px">

## Twig variables

The `object` variable (and its `product` alias) is the deleted [Digital Product](https://github.com/craftcms/commerce-digital-products/blob/4.x/src/elements/Product.php).

```twig
"{{ product.title }}" was just deleted.
```

## Examples

**Alert administrators of a deletion**

```twig
{{ product.title }} was deleted by {{ currentUser.fullName }}.

- Type: {{ product.type.name }}
- SKU: {{ product.sku }}
```
