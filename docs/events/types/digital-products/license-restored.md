---
description: Trigger a notification when a soft-deleted Digital Products License is restored.
---

# When a license is restored

Sends a notification when **a soft-deleted Digital Product License is restored from the trash**. Use this to notify the customer their access has been re-enabled after a reversal.

:::warning Can't be restored from the control panel
The Digital Products plugin doesn't provide a "Restore" option from the control panel.

This event will only fire when a License is restored programmatically via `Craft::$app->getElements()->restoreElement()` or the `php craft elements/restore <id>` console command.
:::

<!--@include: @/events/types/_requires-digital-products.md-->

<!--@include: @/events/types/_digital-product-type-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-generic.png" alt="" style="width:600px; margin-top:10px">

## Twig variables

The `object` variable (and its `license` alias) is the restored [License](https://github.com/craftcms/commerce-digital-products/blob/4.x/src/elements/License.php) element.

```twig
License {{ license.licenseKey }} for "{{ license.product.title }}" was restored.
```

## Examples

**Restore notification for the customer**

```twig
Hi {{ license.licensedTo }},

Your license for {{ license.product.title }} has been restored.

Your key: {{ license.licenseKey }}
```
