---
description: Post to one or more X (Twitter) accounts.
---

# X (Twitter)

Posts **to one or more X (Twitter) accounts** when the notification event is triggered.

<img class="dropshadow" src="/images/messages/x-twitter-example.png" alt="" style="width:596px; margin-top:10px; margin-bottom:22px">

:::warning At least one account is required
Before posting, add at least one X (Twitter) account via [Settings → X (Twitter)](/getting-started/integrations/x-twitter).
:::

## Config

<img class="dropshadow" src="/images/messages/x-twitter-config.png" alt="" style="width:640px; margin-top:10px">

### Post Body

The text of your post, max 280 characters. Longer text is truncated automatically.

### Image Attachment

Optionally attach up to four images via the [`{% setMedia %}`](/messages/media) tag.

<!--@include: @/messages/types/_special-variables.md-->

## Examples

**Announce a new entry**

```twig
New on the blog: "{{ entry.title }}"

{{ entry.url }}
```

**Promote a sale or event**

```twig
Don't miss {{ event.title }}! Happening {{ event.startDate|date('l, F j') }}.

{{ event.url }}
```

**Spotlight a new product**

```twig
Just launched: {{ product.title }}. Check it out and let us know what you think!

{{ product.url }}
```
