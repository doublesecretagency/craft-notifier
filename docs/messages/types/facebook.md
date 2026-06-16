---
description: Post to one or more Facebook pages.
---

# Facebook

Posts **to one or more Facebook pages** when the notification event is triggered.

<img class="dropshadow" src="/images/messages/facebook-example.png" alt="" style="width:653px; margin-top:10px">

:::warning At least one page is required
Before posting, add at least one Facebook page via [Settings → Facebook](/getting-started/integrations/facebook).
:::

## Config

<img class="dropshadow" src="/images/messages/facebook-config.png" alt="" style="width:640px; margin-top:10px">

### Message Body

The text of your post.

### Preview Card URL

Optionally add a link to generate a preview card. The URL can be specified via Twig, so each message can link to a different page.

### Image Attachment

Optionally attach a photo via the [`{% setMedia %}`](/messages/media) tag. When an image is attached, the post is published as a photo.

<!--@include: @/messages/types/_special-variables.md-->

## Examples

:::warning Use the Preview Card URL field
To generate a link preview card, put the URL in the **Preview Card URL** field (not the message body).
:::

**Announce a new entry**

```twig
New on the blog: "{{ entry.title }}"

{{ entry.url }}
```

**Spotlight a new product**

```twig
Just launched: {{ product.title }}. Check it out and let us know what you think!

{{ product.url }}
```

**Promote a sale or event**

```twig
Don't miss {{ event.title }}! Happening {{ event.startDate|date('l, F j') }}.

{{ event.url }}
```
