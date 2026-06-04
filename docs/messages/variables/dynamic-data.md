---
description: The available Twig variables when a Dynamic Data notification is compiled.
---

# Dynamic Data Variables

<!--@include: @/messages/variables/_global-variables.md-->

When a notification is produced with [Dynamic Data](/events/types/dynamic-data/), all compiled values can be found in `data`.

Unlike other types, `data` has **no fixed schema**. It contains exactly what was added via the `{% setData %}` tag.

:::warning Detailed Instructions
See [Dynamic Data](/events/types/dynamic-data/) for complete instructions.
:::

## Examples

**Output a single value**

```twig
{{ data.greeting }} world!
```

**Loop over a data array**

```twig
{% for entry in data.entries %}
   {{ entry.title }}
{% endfor %}
```

**Data can contain any value type**

```twig
{{ data.anyString }}
{{ data.anyNumber }}

{% if data.anyBoolean %}
   ...
{% endif %}

{% for item in data.anyArray %}
   ...
{% endfor %}
```
