# Setting the Template

:::warning Automatic Variables
A select set of variables will be [automatically available](/messages/variables/) within the context of your template.
:::

## All Messages

### Message Template

Select which Twig template to use for the outgoing message.

<img class="dropshadow" :src="$withBase('/images/messages/message-template.png')" alt="" style="max-width:800px; margin-top:2px; margin-bottom:4px;">

Your template is a standard Twig template, you can use any normal Twig you'd like. Additionally, a set of [automatic variables](/messages/variables/) will be available within the context of your template.

## Email Messages

In addition to the template, email messages also include a dynamic **email subject**.

### Email Subject

For email messages, you will also be able to specify a dynamic **subject** line. The exact same [automatic variables](/messages/variables/) are available within the context of your subject line.

<img class="dropshadow" :src="$withBase('/images/messages/email-subject.png')" alt="" style="max-width:800px; margin-top:2px; margin-bottom:4px;">

There are two ways for a subject to be parsed...

#### 1. Short `{object}` syntax (similar to dynamic Entry titles)

The `object` will be mapped to the element which triggered the notification.

```twig
New Article: {title}
```

#### 2. Normal Twig, relying on automatic variables

All standard Twig tags are allowed. You also have access to a set of [automatic variables](/messages/variables/).

```twig
New Article: {{ entry.title }}
```
