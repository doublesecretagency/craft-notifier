# Custom Email Addresses

Compiling a set of custom email addresses is fairly straightforward. First, you will organize the recipient email addresses into a single array. Second, you'll output it as a JSON-encoded string. 

## Example

```twig
{# Compile an array of email addresses #}
{% set emailAddresses = [
    "john@example.com",
    "jane@example.com"
] %}

{# Output the JSON encoded array #}
{{ emailAddresses|json_encode }}
```

Let's break it down into two separate parts...

## Part 1

You will generate an **array of email addresses**. It's a very straightforward goal, within countless ways to achieve it. How you choose to build this array is entirely up to you.

For the purpose of this example, we'll simply hard-code a collection of email addresses.

```twig
{# Compile an array of email addresses #}
{% set emailAddresses = [
    "john@example.com",
    "jane@example.com"
] %}
```

## Part 2

Since this is a Twig template, we need to **output** something. In order for everything to work properly, you can simply output the JSON-encoded string of your custom array.

```twig
{# Output the JSON encoded array #}
{{ emailAddresses|json_encode }}
```

And that's it! With this snippet in place, you can collect email addresses in any manner you please.

## Automatic Variables

With just one exception, you can use [automatic variables](/messages/variables/) to help compile an array of recipients.

:::tip Exception
For obvious reasons, you cannot use the `recipient` variable to generate the recipients. The `recipient` variable will only be available in the [message template](/messages/edit-template/), since it gets injected _immediately_ before each message template is parsed.
:::
