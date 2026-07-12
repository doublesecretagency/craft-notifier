---
description: Send a notification with data you build yourself in a Twig snippet.
---

# Dynamic Data

Sends a compiled report with custom-crafted data, on demand and/or on a recurring schedule.

<img class="dropshadow" src="/images/events/event-dynamic-data.png" alt="" style="width:646px; margin-top:10px; margin-bottom:36px">

Dynamic Data lets you **construct a custom data set**. You write a Twig snippet which gathers whatever content you need, push the values into a `data` variable via the `{% setData %}` tag, then read them back within the message body.

:::warning ⚠️ Security Warning - Permission Required
Users without the "[Use the Dynamic Data type](/getting-started/permissions)" permission will not have the option to select the "Dynamic Data" type.

Since authoring Dynamic Data snippets involves **executing custom Twig at send time**, it is first necessary to enable this permission for users who require it. Grant it only to highly-trusted users.
:::

## Configuring Dynamic Data

The snippet **must** call the `{% setData %}` tag at least once.

For example, imagine our website has a _song catalog_. The following snippet would gather every song added within the past week, then build a list with each song, band, and album:

**Dynamic data snippet:**

```twig
{# Get every song added in the past 7 days #}
{% set songs = craft.entries
    .section('songs')
    .dateCreated('>= ' ~ now|date_modify('-7 days')|atom)
    .all() %}

{# Compile a list of recently added songs #}
{% set recentSongs = [] %}
{% for entry in songs %}
    {% set recentSongs = recentSongs|merge([{
        song: entry.title,
        band: entry.band,
        album: entry.album,
    }]) %}
{% endfor %}

{# Prepare data for the message body #}
{% setData {
    recentSongs: recentSongs,
} %}
```

Then within the message body, we can loop over the array data to list each song:

**Message body snippet:**

```twig
New songs added this week:

{% for item in data.recentSongs %}
- {{ item.song }} by {{ item.band }} ({{ item.album }})
{% endfor %}
```

### When `{% setData %}` is called multiple times

You can call `{% setData %}` as many times as you'd like. Consecutive calls will _append_ to the `data` variable, so you can build it up in stages if needed. Matching keys will override previously set values.

### When `{% setData %}` is never called

If the snippet parses but never calls `{% setData %}`, the `data` variable will be empty in the outgoing message. A `[NO DATA]` warning will be logged in the [Notification Log](/logging).

### When `{% setData %}` has no (or empty) parameter

To intentionally send an empty dataset without the `[NO DATA]` warning, call `{% setData %}` with no value (or an empty value).

### When the snippet fails to parse

If the snippet fails to parse, the error is logged and Notifier won't send a message. You can check the [Notification Log](/logging) for more information about what went wrong.

## Twig Variables

Dynamic data set with `{% setData %}` will be available in the message template under the `data` Twig variable.

See the [Dynamic Data variables](/messages/variables/dynamic-data) for usage and examples.

<!--@include: @/events/types/_sending-reports.md-->
