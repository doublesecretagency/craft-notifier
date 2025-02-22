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

You can manually configure the sandbox by editing the [PHP Config File](/getting-started/config#twigsandbox).

For example, here's how to **permit the `include` tag** without making any other changes to the existing default blacklist...

```php
// config/notifier.php
return [
    'twigSandboxMode' => 'except',  // Exception mode
    'twigSandboxBlacklist' => [     // Use the default blacklist,
        'tags' => ['include']       // but allow the `include` tag
    ]
];
```

The example above uses the [default blacklist](https://github.com/nystudio107/craft-twig-sandbox/blob/v5/src/twig/BlacklistSecurityPolicy.php), but removes the `include` tag from it. In other words, we're marking the `include` tag as safe, and allowing it to be used in message templates.

## Config Parameters

There are three config parameters for customizing the Twig sandbox, but you will never need more than two at the same time. Do not use the blacklist and whitelist together, **choose one or the other**.

### `twigSandboxMode`

_string_ - Defaults to `append`.

Determines how the supplied Twig specifications should be handled.

- `append` - Add the Twig specs to the list.
- `except` - Remove the Twig specs from the list.
- `override` - Replace the entire list with the Twig specs.
- `disabled` - Completely [disable](#disable-sandbox-completely) the sandbox. _(not recommended)_

:::warning Don't use the Blacklist and Whitelist simultaneously
Either the blacklist or the whitelist can be used, but **not both**.

If both (or neither) lists are specified, the blacklist will take precedence.
:::

### `twigSandboxBlacklist`

_array_ - Defaults to an empty array.

Enables and modifies the [default blacklist](https://github.com/nystudio107/craft-twig-sandbox/blob/v5/src/twig/BlacklistSecurityPolicy.php).

### `twigSandboxWhitelist`

_array_ - Defaults to an empty array.

Enables and modifies the [default whitelist](https://github.com/nystudio107/craft-twig-sandbox/blob/v5/src/twig/WhitelistSecurityPolicy.php).

## How to Configure the Sandbox

When configuring the sandbox, it's important to keep in mind three things:
 - Are you altering the blacklist or the whitelist?
 - Which Twig tags, filters, functions, methods, or properties are you specifying?
 - Do you want your new Twig specs to be appended to, excluded from, or completely override the default list?

```php
return [
    'twigSandboxMode' => $mode,             // How are we altering the list?
    'twigSandbox{Blacklist|Whitelist}' => [ // Which list are we altering?
        $twigSpecs                          // What changes are we making?
    ]
];
```

Whether you choose the blacklist or the whitelist, you can specify the following Twig types:

| Types        | Description                       |
|:-------------|-----------------------------------|
| `tags`       | Craft and native Twig tags.       |
| `filters`    | Craft and native Twig filters.    |
| `functions`  | Craft and native Twig functions.  |
| `methods`    | Craft and native Twig methods.    |
| `properties` | Craft and native Twig properties. |

Each type takes the form of a nested array:

```php
return [
    'twigSandboxMode' => 'append',
    'twigSandboxWhitelist' => [     // Use the default whitelist, and
        'tags' => [                 // add these tags, filters, and functions
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
'twigSandboxMode' => 'disabled'
```

:::danger WARNING - Possible Security Risks!
When disabling or reconfiguring the Twig sandbox, be aware of **who has permission to edit Notifications**. Ensure that Notification editors are trusted system users, otherwise you may be opening up a security loophole for bad actors.

Within the Craft control panel, you can also manage who has access to the Notifier plugin by managing their individual User (or Group) [permission settings](https://craftcms.com/docs/5.x/system/user-management.html#permissions).
:::
