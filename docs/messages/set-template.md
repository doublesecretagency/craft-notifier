# Setting the Template

Depending on which [message type](/messages/set-type/) has been selected, additional options may be available.

:::tip All Types
All message types require a **message template**.
:::

### Message Template

Specify the Twig template which powers your message.

<img class="dropshadow" :src="$withBase('/images/messages/message-template.png')" alt="" style="max-width:800px; margin-top:2px; margin-bottom:4px;">

Your template is a standard Twig template, you can use any normal Twig you'd like. Additionally, your template can take advantage of the [automatic variables](/messages/variables/) available within that context.

## Email Messages

In addition to the template, email messages also include a dynamic **email subject**.

### Email Subject

For email messages, you will be able to specify a dynamic subject line. Within the context of your subject, the same [automatic variables](/messages/variables/) are available.

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
