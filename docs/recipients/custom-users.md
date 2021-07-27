# Custom Users

```twig
{# Compile an array of User IDs #}
{% set userIds = craft.users
    .admin()
    .ids()
%}

{# Output the JSON encoded array #}
{{ userIds|json_encode }}
```
