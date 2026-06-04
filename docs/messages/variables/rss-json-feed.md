---
description: The available Twig variables when a notification is triggered by a new RSS, Atom, or JSON feed item.
---

# RSS/JSON Feed Variables

<!--@include: @/messages/variables/_global-variables.md-->

When a notification is triggered by an [RSS/JSON Feed](/events/types/feed/), all relevant data can be found in `feed` and `item`.

- Standard tags are available as `feed.{tag}` and `item.{tag}`.
- Namespaced tags are available as `feed.{namespace}.{tag}` and `item.{namespace}.{tag}`.

:::warning ⚠️ Feed content is untrusted data!
RSS, Atom, and JSON feed item bodies routinely contain raw HTML. If your message template renders the `item.description` value with the `|raw` filter, treat that content as untrusted and sanitize it yourself.
:::

## Feed Variables

| Variable           | Type     | Description                         |
|:-------------------|:---------|:------------------------------------|
| `feed.title`       | _string_ | The feed's title.                   |
| `feed.description` | _string_ | The feed's description.             |
| `feed.link`        | _string_ | The feed's human-readable site URL. |
| `feed.url`         | _string_ | The configured feed URL.            |

## Item Variables

| Variable           | Type            | Description                              |
|:-------------------|:----------------|:-----------------------------------------|
| `item.title`       | _string_        | Item title.                              |
| `item.description` | _string_        | The raw item body.                       |
| `item.link`        | _string_        | Item URL.                                |
| `item.guid`        | _string_        | The unique identifier used for tracking. |
| `item.pubDate`     | _DateTime_      | Published date.                          |
| `item.author`      | _string\|null_  | Item author, when the feed provides one. |
| `item.categories`  | _string[]_      | Item categories or tags.                 |
| `item.enclosure`   | _array\|null_   | First attachment found in the item.      |

A tag's attributes become sub-keys of the Twig variable:

| Tag                         | Twig variable           |
|:----------------------------|:------------------------|
| `<enclosure url="..."/>`    | `item.enclosure.url`    |
| `<enclosure type="..."/>`   | `item.enclosure.type`   |
| `<enclosure length="..."/>` | `item.enclosure.length` |

## Namespaced Variables (e.g. iTunes)

Any `<namespace:tag>` becomes `feed.namespace.tag` or `item.namespace.tag`.

| Tag               | On feed              | On item              |
|:------------------|:---------------------|:---------------------|
| `<itunes:author>` | `feed.itunes.author` | `item.itunes.author` |
| `<podcast:foo>`   | `feed.podcast.foo`   | `item.podcast.foo`   |
| `<dc:bar>`        | `feed.dc.bar`        | `item.dc.bar`        |

A tag's attributes become sub-keys of the Twig variable:

| Tag                          | On feed                  | On item                   |
|:-----------------------------|:-------------------------|:--------------------------|
| `<itunes:image href="..."/>` | `feed.itunes.image.href` | `item.itunes.image.href`  |

Here are some of the most common iTunes tags for podcast feeds:

**Namespaced Feed Variables**

| Variable                    | Type     | Description                           |
|:----------------------------|:---------|:--------------------------------------|
| `feed.itunes.author`        | _string_ | Show author.                          |
| `feed.itunes.summary`       | _string_ | Show description.                     |
| `feed.itunes.type`          | _string_ | `episodic` or `serial`.               |
| `feed.itunes.explicit`      | _string_ | Explicit-content flag (`yes` / `no`). |
| `feed.itunes.image.href`    | _string_ | Cover artwork URL.                    |
| `feed.itunes.owner.name`    | _string_ | Owner name.                           |
| `feed.itunes.owner.email`   | _string_ | Owner email.                          |
| `feed.itunes.category.text` | _string_ | Show category.                        |

**Namespaced Item Variables**

| Variable                  | Type     | Description                                       |
|:--------------------------|:---------|:--------------------------------------------------|
| `item.itunes.duration`    | _string_ | Episode length (e.g. `30:00`).                    |
| `item.itunes.episode`     | _string_ | Episode number.                                   |
| `item.itunes.season`      | _string_ | Season number.                                    |
| `item.itunes.episodeType` | _string_ | `full`, `trailer`, or `bonus`.                    |
| `item.itunes.title`       | _string_ | Cleaner title (no episode / season prefix).       |
| `item.itunes.subtitle`    | _string_ | Episode subtitle.                                 |
| `item.itunes.summary`     | _string_ | Long episode description.                         |
| `item.itunes.explicit`    | _string_ | Explicit-content flag (`yes` / `no`).             |
| `item.itunes.image.href`  | _string_ | Episode artwork URL.                              |
| `item.itunes.author`      | _string_ | Episode author (does not override `item.author`). |

## Examples

**Announce a new post**

```twig
A new post is up on {{ feed.title }}:

{{ item.title }}
{{ item.link }}
```

**Announce a new podcast episode**

```twig
New episode of {{ feed.title }}:

{% if item.itunes.episode %}Episode {{ item.itunes.episode }}: {% endif %}{{ item.title }}
{% if item.itunes.duration %}Length: {{ item.itunes.duration }}{% endif %}

{{ item.link }}
```

**Include the published date**

```twig
{{ item.title }}

{% if item.pubDate %}
Published {{ item.pubDate|date('M j, Y') }}
{% endif %}

{{ item.link }}
```

**Skip items missing a real link**

```twig
{% if not item.link starts with 'http' %}
    {% skipMessage 'No real link on this item.' %}
{% endif %}

New on {{ feed.title }}: {{ item.title }} ({{ item.link }})
```

**Prefer the iTunes author, fall back to the standard author**

```twig
{% set who = item.itunes.author ?? item.author ?? 'someone' %}

New from {{ who }}: {{ item.title }}
{{ item.link }}
```
