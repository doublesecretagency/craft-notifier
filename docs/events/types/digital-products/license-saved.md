---
description: Trigger a notification when a Digital Products License is created or updated.
---

# When a license is saved

Sends a notification when **a Digital Product License is saved**. Covers both new licenses (usually minted the moment a customer's order is paid) and updates to existing ones.

This is the trigger to reach for when you want to email customers their license key. The License element shows up on `event.sender`, so the key, the buyer's email, the product, and the order are all available directly in your Twig body.

<!--@include: @/events/types/_requires-digital-products.md-->

<!--@include: @/events/types/_digital-product-type-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-has-changed.png" alt="" style="width:600px; margin-top:10px">

<!--@include: @/events/types/_has-changed-operator.md-->

## Twig variables

The `object` variable (and its `license` alias) is the saved [License](https://github.com/craftcms/commerce-digital-products/blob/4.x/src/elements/License.php) element. It carries:

- `licenseKey` (string) - the actual key the customer uses
- `getProduct()` - the Digital Product the license is tied to
- `getOrder()` - the Commerce Order that minted the license
- `getUser()` - the Craft User (if the buyer was registered)
- `ownerName`, `ownerEmail` - the buyer (guest checkout falls back to these)
- `getLicensedTo()` - convenience: returns the user's email or the guest email

```twig
"{{ license.product.title }}" license: {{ license.licenseKey }}
```

## Examples

**Send the customer their key on purchase**

```twig
Hi {{ license.licensedTo }},

Thanks for purchasing {{ license.product.title }}.

Your license key: {{ license.licenseKey }}

Download: {{ license.product.url }}
```

**Alert admins of a new sale**

```twig
New license issued.

- Product: {{ license.product.title }}
- Customer: {{ license.licensedTo }}
- Order: #{{ license.order.shortNumber }}
- Total: {{ license.order.totalPrice|commerceCurrency }}
```

**Skip licenses tied to internal test orders**

```twig
{% if license.order.email ends with '@internal.test' %}
    {% skipMessage "Internal test order; not announced." %}
{% endif %}

New license: {{ license.licenseKey }}
```
