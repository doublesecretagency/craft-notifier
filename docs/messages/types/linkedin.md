---
description: Publish a post to one or more LinkedIn member profiles.
---

# LinkedIn

Publishes **a post to one or more [LinkedIn](https://linkedin.com) accounts** when the notification event is triggered.

<img class="dropshadow" src="/images/messages/linkedin-example.png" alt="" style="width:560px; margin-top:10px">

:::warning LinkedIn Connection Required
Before posting to LinkedIn, connect at least one account via [Settings → LinkedIn](/getting-started/integrations/linkedin).
:::

## Config

<img class="dropshadow" src="/images/messages/linkedin-config.png" alt="" style="width:640px; margin-top:10px">

### Post Body

Plain text. The body becomes the commentary shown above your post.

### Preview Card URL

Optionally add a link to show a preview card beneath your post. The card's title, description, and image are pulled from the linked page's Open Graph (`og`) tags.

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
