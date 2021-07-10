# Set Message Recipients

<img class="dropshadow" :src="$withBase('/images/06-select-recipients.png')" alt="" style="max-width:400px; margin-top:10px">

### f) Dynamic Recipients

They can specify a list of email addresses...

```twig
{% set recipients = [
    'alice@example.com',
    'bob@example.com',
    'charlie@example.com',
] %}
```

And/or we can extract email addresses from existing users...

```twig
{% set users = craft.user.all() %}
```
