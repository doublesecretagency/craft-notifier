---
description: Trigger a notification when a Digital Products License is deleted.
---

# When a license is deleted

Sends a notification when **a Digital Product License is deleted**. Most commonly fires when an admin revokes a customer's access, or when a refund automatically strips the license.

The trigger covers both soft deletes (moved to the trash) and hard deletes. Restoring a deleted license fires the separate [**"When a license is restored"**](/events/types/digital-products/license-restored) event.

<!--@include: @/events/types/_requires-digital-products.md-->

<!--@include: @/events/types/_digital-product-type-filters.md-->

<!--@include: @/events/types/_field-conditions.md-->

<img class="dropshadow" src="/images/events/field-conditions-generic.png" alt="" style="width:600px; margin-top:10px">

## Twig variables

The `object` variable (and its `license` alias) is the deleted [License](https://github.com/craftcms/commerce-digital-products/blob/4.x/src/elements/License.php) element.

```twig
License {{ license.licenseKey }} for "{{ license.product.title }}" was revoked.
```

## Examples

**Notify the customer of a revoked license**

```twig
Hi {{ license.licensedTo }},

Your license for {{ license.product.title }} has been revoked.

If you believe this is in error, please contact support.
```

**Alert admins of a revocation**

```twig
License revoked.

- Product: {{ license.product.title }}
- Customer: {{ license.licensedTo }}
- Key: {{ license.licenseKey }}
- Revoked by: {{ currentUser.fullName }}
```
