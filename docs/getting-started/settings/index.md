---
description: Configure Notifier in the control panel or via a PHP config file.
---

# Settings

Notifier can be configured from two places:
 - The [control panel](/getting-started/settings/control-panel) for everyday setup.
 - A [PHP config file](/getting-started/settings/php-config) for environment-aware overrides.

## How they interact

Values in `config/notifier.php` always take precedence over anything saved in the control panel.

Many control panel fields also accept an `$ENV_VAR` reference, so you can keep secrets in `.env` without needing the PHP config file at all.

## Where each setting lives

Most settings can be configured in either place. The exceptions:

**Control panel only:**
- Slack webhooks (per-channel)
- ntfy topics (per-topic)
- Bluesky accounts (per-account)

**PHP config file only:**
- `testToPhoneNumber` (Twilio test recipient)

## [Control Panel](/getting-started/settings/control-panel)

Notifier's settings page within the Craft control panel, where you can set general behavior and integration credentials.

## [PHP Config File](/getting-started/settings/php-config)

A `config/notifier.php` file in your project, where you declare settings in PHP with support for environment variables and per-environment overrides.
