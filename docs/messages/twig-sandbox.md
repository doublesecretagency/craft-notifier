---
description:
---

# Twig Sandbox

:::warning Secure Sandbox
For security purposes, all [message templates](/messages/templating) are parsed in a secure **sandbox mode** with limited functionality.
:::

Please consult the complete list of [default values](https://github.com/doublesecretagency/craft-notifier/blob/v2-dev/src/enums/TwigSandbox.php) on Github.

## Adjust the Sandbox Configuration
If necessary, you can manually configure the sandbox by editing the [PHP Config File](/getting-started/config#twigsandbox).

Add a `twigSandbox` parameter to the `config/notifier.php` file:

```php EXAMPLE
'twigSandbox' => [

    // Add to the default allowed list
    'allow' => [
        ...
    ],
    
    // Remove from the default allowed list
    'disallow' => [
        ...
    ],
    
    // Replace the default allowed list
    'override' => [
        ...
    ],
    
]
```

| Action     | Behavior                               |
|:-----------|----------------------------------------|
| `allow`    | Adds to the default allowed list.      |
| `disallow` | Removes from the default allowed list. |
| `override` | Replaces the default allowed list.     |

Within each of those nested arrays, you can specify the following Twig types:

| Types        | Description                       |
|:-------------|-----------------------------------|
| `tags`       | Craft and native Twig tags.       |
| `filters`    | Craft and native Twig filters.    |
| `functions`  | Craft and native Twig functions.  |
| `methods`    | Craft and native Twig methods.    |
| `properties` | Craft and native Twig properties. |

:::tip Defaults
See the complete list of [default values](https://github.com/doublesecretagency/craft-notifier/blob/v2-dev/src/enums/TwigSandbox.php) on Github.
:::

In this way, you can easily allow additional Twig:

```php
// Permit the `do` tag
'allow' => [
    'tags' => ['do']
]
```

Or disallow Twig from the default list:

```php
// Blocks the `macro` tag
'disallow' => [
    'tags' => ['macro']
]
```

To disallow **all values** of a given Twig type, override it with an empty array:

```php
// No tags allowed
'override' => [
    'tags' => []
]
```

Omitted types will fall back to their respective default values.

:::warning Twig Sandbox Extension
For further information, including how to structure  `methods` and `properties`, please consult the [official Twig docs](https://twig.symfony.com/doc/3.x/api.html#sandbox-extension).
:::

## Disable Sandbox Completely

It is also possible to disable the Twig sandbox entirely, and rely on Craft's native Twig functionality.

```php
'twigSandbox' => false
```

:::danger WARNING - Possible Security Risks!
When disabling or reconfiguring the Twig sandbox, be aware of **who has permission to edit Notifications**. Ensure that Notification editors are trusted system users, otherwise you may be opening up a security loophole for bad actors.

You can always manage who has access to the Notifier plugin by managing their individual User (or Group) permission settings.
:::
