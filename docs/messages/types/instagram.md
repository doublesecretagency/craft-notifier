---
description: Post a photo to one or more Instagram accounts.
---

# Instagram

Posts **a photo to one or more Instagram accounts** when the notification event is triggered.

<img class="dropshadow" src="/images/messages/instagram-example.png" alt="" style="width:937px; margin-top:10px">

:::warning At least one account is required
Before posting, add at least one Instagram account via [Settings → Instagram](/getting-started/integrations/instagram).
:::

## Config

<img class="dropshadow" src="/images/messages/instagram-config.png" alt="" style="width:640px; margin-top:10px">

### Image Attachment

The image to publish. **Required**, Instagram cannot post without an image.

Attach an image using the [`{% setMedia %}`](/messages/media) tag. See [examples](#examples) below.

:::warning Requirements:
- **JPEG format only.** No PNGs, GIFs, WebP, etc.
- Max 8 MB filesize.
- Width between 320px - 1440px.
- Aspect ratio between 4:5 - 1.91:1.
- Must resolve to a **publicly-accessible URL**.
:::

### Caption

An optional caption, max 2200 characters. Longer text is truncated automatically.

<!--@include: @/messages/types/_special-variables.md-->

## Examples

**Publish a photo which meets the requirements**

```twig
{% setMedia entry.photo.one() %}
```

**Specify an image asset by its ID**

```twig
{% setMedia asset.id %}
```

**Use a fixed publicly-accessible URL**

```twig
{% setMedia 'https://example.com/images/banner.jpg' %}
```
