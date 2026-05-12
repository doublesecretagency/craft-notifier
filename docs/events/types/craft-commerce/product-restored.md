---
description: Trigger a notification when a soft-deleted Craft Commerce Product is restored from the trash.
---

# When a product is restored

Sends a notification when **a soft-deleted Commerce Product is restored from the trash**.

<!--@include: @/events/types/_requires-craft-commerce.md-->

<!--@include: @/events/types/_product-type-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-generic.png" alt="" style="width:600px; margin-top:10px">

## Twig variables

The `object` variable (and its `product` alias) is the restored [Product](https://docs.craftcms.com/commerce/api/v5/craft-commerce-elements-product.html).

```twig
"{{ product.title }}" was restored from the trash.
```

## Examples

**Notify the merch team of a restore**

```twig
{{ product.title }} is back online.

- Type: {{ product.type.name }}
- Restored by: {{ currentUser.fullName }}
```
