# How it Works

<img class="dropshadow" :src="$withBase('/images/overview/manage-notifications.png')" alt="">

## 1. Configure an event trigger

Before you can configure any individual messages, you must first determine what will trigger them. Add an [event trigger](/triggers/) to determine when your message(s) will be sent.

:::warning Beta
While the plugin is still in beta, only a single trigger is available:
- **When an Entry is saved**

More triggers will become available by the official 1.0 release.
:::

## 2. Configure each message

For each message, you will be able to specify the following message settings:

| Setting | Explanation
|:--------|:------------
| [**Type**](/messages/set-type/)         | What type of message? (ie: email, SMS)
| [**Template**](/messages/set-template/) | Which Twig template generates the message body?
| [**Recipients**](/recipients/)          | Who will the message be sent to?
