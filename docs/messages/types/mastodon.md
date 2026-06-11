---
description: Publish a post to one or more Mastodon accounts.
---

# Mastodon

Publishes **a post to one or more [Mastodon](https://joinmastodon.org) accounts** when the notification event is triggered.

<img class="dropshadow" src="/images/messages/mastodon-example.png" alt="" style="width:596px; margin-top:10px">

:::warning Mastodon Account Required
Before posting messages to Mastodon, add at least one account via [Settings → Mastodon](/getting-started/integrations/mastodon).
:::

## Config

<img class="dropshadow" src="/images/messages/mastodon-config.png" alt="" style="width:640px; margin-top:10px">

### Visibility

Determines who will be able to see the post:

| Value              | Meaning                                             | POV                             |
|--------------------|-----------------------------------------------------|---------------------------------|
| **Public**         | Visible to everyone, shown on public timelines.     | Shout it from the rooftops.     |
| **Unlisted**       | Visible to everyone, but kept off public timelines. | Said publicly, but not shouted. |
| **Followers only** | Visible only to the account's followers.            | Shared with a private circle.   |
| **Direct**         | Visible only to the accounts mentioned in the post. | Roughly a direct message.       |

### Post Body

Plain text only. Most instances allow up to 500 characters, though the limit is set per instance.

URLs will automatically unfurl into preview cards.

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
