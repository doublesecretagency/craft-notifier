---
description: For security purposes, all message templates are parsed in a secure Twig sandbox with limited functionality. This sandbox can be customized to fit your needs, or disabled entirely in rare cases.
---

# Twig Sandbox

:::warning Secure Sandbox
For security purposes, all [message templates](/messages/templating) are parsed in a secure **Twig sandbox** with limited functionality. This sandbox can be customized to fit your needs, or disabled entirely in rare cases.
:::

Under the hood, Notifier relies on the [nystudio107/craft-twig-sandbox](https://github.com/nystudio107/craft-twig-sandbox) package to provide a secure Twig environment.

To get a good understanding of how the sandbox works, please consult the [default blacklist](https://github.com/nystudio107/craft-twig-sandbox/blob/v5/src/twig/BlacklistSecurityPolicy.php) and
[default whitelist](https://github.com/nystudio107/craft-twig-sandbox/blob/v5/src/twig/WhitelistSecurityPolicy.php).

## Customizing the Twig Sandbox

To configure the sandbox, start by creating a `config/notifier-sandbox.php` file.

Within the context of that file, you can specify which Twig tags, filters, functions, methods, or properties should be allowed or disallowed. You can choose to add, remove, or replace the default list of Twig specs.

For example, here's how to **permit the `include` tag** without making any other changes to the existing default blacklist:

```php
// config/notifier-sandbox.php

use doublesecretagency\notifier\models\Sandbox;

return [
    'list' => Sandbox::BLACKLIST, // Use the default blacklist,
    'mode' => Sandbox::REMOVE,    // but remove the `include` tag.
    'twig' => [
        'tags' => ['include']
    ]
];
```

The example above uses the [default blacklist](https://github.com/nystudio107/craft-twig-sandbox/blob/v5/src/twig/BlacklistSecurityPolicy.php), but removes the `include` tag from it. In other words, we're marking the `include` tag as safe, and allowing it to be used in message templates.

## Config Parameters

When configuring the sandbox, it's important to keep in mind three things:

- Are you using the blacklist or the whitelist?
- Do you want your new Twig specs to be added to, removed from, or completely replace the default list?
- Which Twig tags, filters, functions, methods, or properties are you specifying?

```php
return [
    'list' => $list, // Which list are we using?
    'mode' => $mode, // How are we altering the list?
    'twig' => $twig  // What changes are we making?
];
```

### `'list'`

_string_ - Defaults to `Sandbox::BLACKLIST`.

Select which list to enable and modify:

- `Sandbox::BLACKLIST` - The default [blacklist](https://github.com/nystudio107/craft-twig-sandbox/blob/v5/src/twig/BlacklistSecurityPolicy.php).
- `Sandbox::WHITELIST` - The default [whitelist](https://github.com/nystudio107/craft-twig-sandbox/blob/v5/src/twig/WhitelistSecurityPolicy.php).

### `'mode'`

_string_ - Defaults to `Sandbox::ADD`.

Select how the supplied Twig specifications should be handled:

- `Sandbox::ADD` - Add the Twig specs to the list.
- `Sandbox::REMOVE` - Remove the Twig specs from the list.
- `Sandbox::REPLACE` - Replace the entire list with the Twig specs.
- `Sandbox::DISABLE` - Completely [disable](#disable-sandbox-completely) the sandbox. _(not recommended)_

### `'twig'`

_array_ - Defaults to `[]`.

Specify which Twig tags, filters, functions, methods, or properties will be added, removed, or replaced.

Within the context of the `twig` parameter, you can specify the following Twig types:

| Types        | Description                       |
|:-------------|-----------------------------------|
| `tags`       | Craft and native Twig tags.       |
| `filters`    | Craft and native Twig filters.    |
| `functions`  | Craft and native Twig functions.  |
| `methods`    | Craft and native Twig methods.    |
| `properties` | Craft and native Twig properties. |

Each type takes the form of a nested array:

```php
use doublesecretagency\notifier\models\Sandbox;

return [
    'list' => Sandbox::WHITELIST, // Use the default whitelist, and
    'mode' => Sandbox::ADD,       // add these tags, filters, and functions.
    'twig' => [
        'tags' => [
            'extends',
            'include'
        ],
        'filters' => [
            'json_decode', 
            'json_encode'
        ],
        'functions' => [
            'ceil',
            'floor'
        ],
    ]
];
```

## Disable Sandbox Completely

It is also possible to disable the Twig sandbox entirely, and rely on Craft's native Twig functionality.

```php
use doublesecretagency\notifier\models\Sandbox;

return [
    'mode' => Sandbox::DISABLE
];
```

:::danger WARNING - Possible Security Risks!
When disabling or reconfiguring the Twig sandbox, be aware of **who has permission to edit Notifications**. Ensure that Notification editors are trusted system users, otherwise you may be opening up a security loophole for bad actors.

Within the Craft control panel, you can also manage who has access to the Notifier plugin by managing their individual User (or Group) permission settings.
:::
