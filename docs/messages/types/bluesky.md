---
description: Publish a post to one or more Bluesky accounts.
---

# Bluesky

Publishes **a post to one or more [Bluesky](https://bsky.app) accounts** when the notification event is triggered.

<img class="dropshadow" src="/images/messages/bluesky-example.png" alt="" style="width:598px; margin-top:10px">

:::warning Bluesky Account Required
Before posting messages to Bluesky, add at least one account via [Settings → Bluesky](/getting-started/integrations/bluesky).
:::

## Config

<img class="dropshadow" src="/images/messages/bluesky-config.png" alt="" style="width:640px; margin-top:10px">

<!--@include: @/messages/types/_docs-links.md-->

### Generate Link Preview

This toggle (enabled by default) controls whether Notifier will attempt to generate a _rich preview card_ based on the first link in the post. The preview card will show the linked page's title, description, and image.

Turn the toggle off to post plain links with no card.

## Formatting

### Character limit

Bluesky limits posts to 300 characters. Notifier truncates anything longer.

### Auto-linked URLs and mentions

URLs and `@handle.tld` mentions in the post body link automatically. Hashtags do not.

## Examples

**Announce a post and credit the author**

```twig
New on the blog by @{{ entry.author.username }}.bsky.social: "{{ entry.title }}"

{{ entry.url }}
```

**Promote an upcoming event**

```twig
Save the date! {{ event.title }} is happening {{ event.startDate|date('F j') }}.

{{ event.url }}
```

**Announce a new product in the catalog**

```twig
Just added to the catalog: {{ product.title }}

{{ product.url }}
```
