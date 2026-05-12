---
description: Trigger a notification when a Craft Commerce Product is deleted.
---

# When a product is deleted

Sends a notification when **a Commerce Product has been deleted**.

This trigger fires for both soft deletes (moved to the trash) and hard deletes. Restoring a deleted product fires the separate [**"When a product is restored"**](/events/types/craft-commerce/product-restored) event.

<!--@include: @/events/types/_requires-craft-commerce.md-->

<!--@include: @/events/types/_product-type-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-generic.png" alt="" style="width:600px; margin-top:10px">

## Twig variables

The `object` variable (and its `product` alias) is the deleted [Product](https://docs.craftcms.com/commerce/api/v5/craft-commerce-elements-product.html).

```twig
"{{ product.title }}" was just deleted.
```

## Examples

**Alert administrators of a deletion**

```twig
{{ product.title }} was deleted by {{ currentUser.fullName }}.

- Type: {{ product.type.name }}
- SKU: {{ product.defaultVariant.sku }}
```

**Skip deletions in a specific product type**

```twig
{% if product.type.handle == 'archived' %}
    {% skipMessage "Archived products are not announced." %}
{% endif %}

Deleted: {{ product.title }}
```
