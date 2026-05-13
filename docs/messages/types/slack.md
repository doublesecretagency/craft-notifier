---
description: Post a message to one or more Slack channels.
---

# Slack

Posts **a message to one or more Slack channels** when the notification event is triggered.

<img class="dropshadow" src="/images/messages/slack-example.png" alt="" style="width:393px; margin-top:10px">

Slack uses "Incoming Webhooks" to route messages to individual channels.

Each webhook is bound to a _specific channel_ from the moment it is created. If you need to add a new channel, it means you'll need to create an additional webhook for it. Each channel will have its own webhook URL.

:::warning At least one channel is required
Before sending Slack messages, add at least one Slack Channel via [Settings → Slack](/getting-started/integrations/slack).
:::

:::tip Slack Throttling
Slack throttles each webhook to roughly one message per second, so a burst of notifications may not all get through.
:::

## Config

<img class="dropshadow" src="/images/messages/slack-config.png" alt="" style="width:647px; margin-top:10px">

<!--@include: @/messages/types/_docs-links.md-->
<!--@include: @/messages/types/_queue-link.md-->

## mrkdwn Syntax

Slack uses its own lightweight markup called [**mrkdwn**](https://api.slack.com/reference/surfaces/formatting), which differs from standard Markdown.

Here are some of the most useful tokens:

| Token | Result |
|---|---|
| `*bold*` | **bold** |
| `_italic_` | _italic_ |
| `~strike~` | ~~strike~~ |
| `` `code` `` | `code` |
| ```` ```block``` ```` | code block |
| `<https://example.com\|text>` | link with custom text |
| `<@U12345>` | mentions a user by Slack ID |
| `<#C12345\|name>` | links a channel |
| `<!here>` | pings everyone currently active in the channel |
| `<!channel>` | pings everyone in the channel (use sparingly) |

## Examples

**Notify the channel of a new entry**

```twig
*New entry published:* "{{ entry.title }}"
```

**Include a deep link**

```twig
"{{ entry.title }}" is now live: <{{ entry.url }}|view on site>
```

**Ping the channel on a high-value order**

```twig
{% if order.totalPrice < 5000 %}
    {% skipMessage "Below the channel-ping threshold." %}
{% endif %}

<!here> Order {{ order.shortNumber }} for {{ order.totalPrice|currency }} just placed.
```
