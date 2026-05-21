---
description: Send a notification when a new item is found in an external RSS, Atom, or JSON feed.
---

# RSS/JSON Feed

Sends a notification when a **new item appears in an external feed**.

<img class="dropshadow" src="/images/events/event-feed.png" alt="" style="width:416px; margin-top:10px; margin-bottom:22px">

Unlike other event types, RSS/JSON Feed isn't tied to specific Craft elements. Instead, Notifier will poll the feed and send a message every time a new item shows up.

The format will be automatically detected when the feed is parsed. Notifier will sync with the feed, and fire notifications for any new items which appear after the schedule has been set up. Pre-existing feed items will be ignored.

:::warning Set up Scheduled Sending
Before this trigger will fire, you will need to [run the schedule](/getting-started/run-the-schedule) on a recurring basis.
:::

## Identifying unique items

Each feed item is tracked by its canonical identifier:

- **RSS**: `<guid>`
- **Atom**: `<id>`
- **JSON Feed**: `id`

If no unique ID is provided by the feed, the item's URL (`<link>` / `url`) will be used instead.

### Expected behavior

- An item whose identifier (correctly) never changes will fire exactly **once**, no matter how often the schedule is run.
- An item whose identifier (incorrectly) changes between runs _will be fired every time the identifier changes_.
- Items with no identifier or URL will be skipped.

## Twig variables

:::warning ⚠️ Feed content is untrusted data!
RSS, Atom, and JSON feed item bodies routinely contain raw HTML. If your message template renders the `item.description` value with the `|raw` filter, treat that content as untrusted and sanitize it yourself.
:::

The typical element variables (`element`, `entry`, `original`, etc.) are **not available** (or relevant) when watching an RSS/JSON feed.

Instead, all feed data is exposed through the `feed` and `item` variables.

- Standard tags are available as `feed.{tag}` and `item.{tag}`.
- Namespaced tags are available as `feed.{namespace}.{tag}` and `item.{namespace}.{tag}`.

### Feed Tags

| Variable           | Type     | Description                        |
|:-------------------|:---------|:-----------------------------------|
| `feed.title`       | _string_ | The feed's title                   |
| `feed.description` | _string_ | The feed's description             |
| `feed.link`        | _string_ | The feed's human-readable site URL |
| `feed.url`         | _string_ | The configured feed URL            |

### Item Tags

| Variable           | Type            | Description                             |
|:-------------------|:----------------|:----------------------------------------|
| `item.title`       | _string_        | Item title                              |
| `item.description` | _string_        | The raw item body                       |
| `item.link`        | _string_        | Item URL                                |
| `item.guid`        | _string_        | The unique identifier used for tracking |
| `item.pubDate`     | _DateTime_      | Published date                          |
| `item.author`      | _string\|null_  | Item author, when the feed provides one |
| `item.categories`  | _string[]_      | Item categories or tags                 |
| `item.enclosure`   | _array\|null_   | First attachment found in the item      |

A tag's attributes become sub-keys of the Twig variable:

| Tag                         | Twig variable           |
|:----------------------------|:------------------------|
| `<enclosure url="..."/>`    | `item.enclosure.url`    |
| `<enclosure type="..."/>`   | `item.enclosure.type`   |
| `<enclosure length="..."/>` | `item.enclosure.length` |

### Namespaced Tags (e.g. iTunes)

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

**Namespaced Feed Tags**

| Variable                    | Type     | Description                          |
|:----------------------------|:---------|:-------------------------------------|
| `feed.itunes.author`        | _string_ | Show author                          |
| `feed.itunes.summary`       | _string_ | Show description                     |
| `feed.itunes.type`          | _string_ | `episodic` or `serial`               |
| `feed.itunes.explicit`      | _string_ | Explicit-content flag (`yes` / `no`) |
| `feed.itunes.image.href`    | _string_ | Cover artwork URL                    |
| `feed.itunes.owner.name`    | _string_ | Owner name                           |
| `feed.itunes.owner.email`   | _string_ | Owner email                          |
| `feed.itunes.category.text` | _string_ | Show category                        |

**Namespaced Item Tags**

| Variable                  | Type     | Description                                      |
|:--------------------------|:---------|:-------------------------------------------------|
| `item.itunes.duration`    | _string_ | Episode length (e.g. `30:00`)                    |
| `item.itunes.episode`     | _string_ | Episode number                                   |
| `item.itunes.season`      | _string_ | Season number                                    |
| `item.itunes.episodeType` | _string_ | `full`, `trailer`, or `bonus`                    |
| `item.itunes.title`       | _string_ | Cleaner title (no episode / season prefix)       |
| `item.itunes.subtitle`    | _string_ | Episode subtitle                                 |
| `item.itunes.summary`     | _string_ | Long episode description                         |
| `item.itunes.explicit`    | _string_ | Explicit-content flag (`yes` / `no`)             |
| `item.itunes.image.href`  | _string_ | Episode artwork URL                              |
| `item.itunes.author`      | _string_ | Episode author (does not override `item.author`) |

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
