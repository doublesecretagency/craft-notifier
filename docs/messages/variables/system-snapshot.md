---
description: The available Twig variables when a System Snapshot notification is compiled.
---

# System Snapshot Variables

<!--@include: @/messages/variables/_global-variables.md-->

When a notification is produced by a [System Snapshot](/events/types/system-snapshot/), all relevant data can be found in `report`.

## Craft Variables

| Variable                          | Type          | Description                                   |
|:----------------------------------|:--------------|:----------------------------------------------|
| `report.craft.version`            | _string_      | The running Craft version.                    |
| `report.craft.edition`            | _string_      | The running edition (Solo / Pro).             |
| `report.craft.systemName`         | _string_      | The system name.                              |
| `report.craft.schemaVersion`      | _string_      | The Craft schema version.                     |
| `report.craft.live`               | _bool_        | Whether the system is live.                   |
| `report.craft.maintenanceMode`    | _bool_        | Whether maintenance mode is on.               |
| `report.craft.devMode`            | _bool_        | Whether Dev Mode is on.                       |
| `report.craft.licensed`           | _bool_        | Whether the running edition is licensed.      |
| `report.craft.licensedEdition`    | _string&#124;null_ | The licensed edition, if it differs.          |
| `report.craft.update.available`   | _bool_        | Whether a Craft update is available.          |
| `report.craft.update.latest`      | _string&#124;null_ | The latest available Craft version.           |
| `report.craft.update.critical`    | _bool_        | Whether a critical Craft update is available. |
| `report.craft.update.refreshedAt` | _DateTime&#124;null_ | When the update data was compiled.            |
| `report.craft.update.refreshFailed` | _bool_      | Whether this compile's fresh check failed.    |

## Plugin Variables

Each installed plugin has these variables:

| Variable                                 | Type          | Description                                    |
|:-----------------------------------------|:--------------|:-----------------------------------------------|
| `report.plugins.<handle>.name`           | _string_      | The plugin's name.                             |
| `report.plugins.<handle>.handle`         | _string_      | The plugin's handle.                           |
| `report.plugins.<handle>.packageName`    | _string_      | The plugin's Composer package name.            |
| `report.plugins.<handle>.version`        | _string_      | The installed version.                         |
| `report.plugins.<handle>.edition`        | _string&#124;null_ | The plugin's edition, if any.                  |
| `report.plugins.<handle>.license`        | _string_      | The license status (`valid`, `invalid`, etc.). |
| `report.plugins.<handle>.update.available`| _bool_       | Whether a plugin update is available.          |
| `report.plugins.<handle>.update.latest`  | _string&#124;null_ | The latest available version.                  |
| `report.plugins.<handle>.update.critical`| _bool_        | Whether a critical update is available.        |
| `report.plugins.<handle>.update.abandoned`| _bool_       | Whether the plugin is marked abandoned.        |

## Site Variables

Each site has these variables:

| Variable                          | Type     | Description                       |
|:----------------------------------|:---------|:----------------------------------|
| `report.sites.<handle>.id`        | _int_    | The site's ID.                    |
| `report.sites.<handle>.handle`    | _string_ | The site's handle.                |
| `report.sites.<handle>.name`      | _string_ | The site's name.                  |
| `report.sites.<handle>.url`       | _string_ | The site's base URL.              |
| `report.sites.<handle>.language`  | _string_ | The site's language.              |
| `report.sites.<handle>.primary`   | _bool_   | Whether this is the primary site. |

## System Variables

| Variable             | Type     | Description                       |
|:---------------------|:---------|:----------------------------------|
| `report.system.php`  | _string_ | The PHP version.                  |
| `report.system.os`   | _string_ | The operating system and version. |
| `report.system.db`   | _string_ | The database driver and version.  |

## Queue Variables

| Variable               | Type  | Description                          |
|:-----------------------|:------|:-------------------------------------|
| `report.queue.pending` | _int_ | Jobs queued but not yet executed.    |
| `report.queue.failed`  | _int_ | Jobs that exhausted their retries.   |
| `report.queue.delayed` | _int_ | Jobs scheduled for future execution. |

## Examples

**A weekly digest of the install**

```twig
Weekly snapshot of {{ report.craft.systemName }}

Craft {{ report.craft.version }} ({{ report.craft.edition }})
PHP {{ report.system.php }} on {{ report.system.os }}
Database: {{ report.system.db }}

{% if report.craft.update.available %}
Craft update available: {{ report.craft.update.latest }}
{% endif %}
```

**List Craft and every plugin with its available update**

```twig
- Craft {{ report.craft.version }} {{ report.craft.update.available ? "→ #{report.craft.update.latest}" }}
{% for plugin in report.plugins %}
- {{ plugin.name }} {{ plugin.version }} {{ plugin.update.available ? "→ #{plugin.update.latest}" }}
{% endfor %}
```

**Warn only when a critical update lands**

```twig
{% set critical = report.craft.update.critical %}
{% for handle, plugin in report.plugins %}
    {% if plugin.update.critical %}{% set critical = true %}{% endif %}
{% endfor %}

{% if not critical %}
    {% skipMessage "No critical updates at this time." %}
{% endif %}

A critical update is available. Review the dashboard as soon as possible.
```

**Alert when the queue is stuck**

```twig
{% if report.queue.failed == 0 %}
    {% skipMessage "Queue is healthy." %}
{% endif %}

⚠️ {{ report.queue.failed }} failed job(s) in the queue on {{ report.craft.systemName }}.
```

**Alert when the system goes offline**

```twig
{% if report.craft.live %}
    {% skipMessage "System is live." %}
{% endif %}

⚠️ {{ report.craft.systemName }} is currently offline.
```
