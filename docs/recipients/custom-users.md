# Custom Users

Compiling a set of custom Users is fairly straightforward. First, you will organize the recipient User IDs into a single array. Second, you'll output it as a JSON-encoded string.

## Example

```twig
{# Compile an array of User IDs #}
{% set userIds = craft.users
    .admin()
    .ids()
%}

{# Output the JSON encoded array #}
{{ userIds|json_encode }}
```

:::tip User Queries
Read more about working with [User Queries](https://craftcms.com/docs/3.x/users.html#querying-users).
:::

Let's break it down into two separate parts...

## Part 1

You will generate an **array of User IDs**. It's a very straightforward goal, within countless ways to achieve it. How you choose to build this array is entirely up to you.

For the purpose of this example, we'll simply retrieve the User IDs of all system admins.

```twig
{# Compile an array of User IDs #}
{% set userIds = craft.users
    .admin()
    .ids()
%}
```

## Part 2

Since this is a Twig template, we need to **output** something. In order for everything to work properly, you can simply output the JSON-encoded string of your custom array.

```twig
{# Output the JSON encoded array #}
{{ userIds|json_encode }}
```

And that's it! With this snippet in place, you can collect Users in any manner you please.

## Automatic Variables

With just one exception, you can use [automatic variables](/messages/variables/) to help compile an array of recipients.

:::tip Exception
For obvious reasons, you cannot use the `recipient` variable to generate the recipients. The `recipient` variable will only be available in the [message template](/messages/edit-template/), since it gets injected _immediately_ before each message template is parsed.
:::
