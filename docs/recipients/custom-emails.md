# Custom Email Addresses

```twig
{# Compile an array of email addresses #}
{% set emailAddresses = [
    "john@example.com",
    "jane@example.com"
] %}

{# Output the JSON encoded array #}
{{ emailAddresses|json_encode }}
```
