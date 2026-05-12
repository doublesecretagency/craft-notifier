---
description: Trigger a notification when a soft-deleted Digital Products Product is restored.
---

# When a product is restored

Sends a notification when **a soft-deleted Digital Product is restored from the trash**.

:::warning Can't be restored from the control panel
The Digital Products plugin doesn't provide a "Restore" option from the control panel.

This event will only fire when a Product is restored programmatically via `Craft::$app->getElements()->restoreElement()` or the `php craft elements/restore <id>` console command.
:::

<!--@include: @/events/types/_requires-digital-products.md-->

<!--@include: @/events/types/_digital-product-type-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-generic.png" alt="" style="width:600px; margin-top:10px">

## Twig variables

The `object` variable (and its `product` alias) is the restored [Digital Product](https://github.com/craftcms/commerce-digital-products/blob/4.x/src/elements/Product.php).

```twig
"{{ product.title }}" was restored from the trash.
```

## Examples

**Notify the merch team of a restore**

```twig
{{ product.title }} is back online.

- Restored by: {{ currentUser.fullName }}
```
