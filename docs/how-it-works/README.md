# How it Works

## 1. Configure an event trigger

Before you can configure any individual messages, you must first determine what will trigger them. [Add an event trigger](/how-it-works/add-an-event-trigger/) to determine when your message(s) will be sent.

<img class="dropshadow" :src="$withBase('/images/notification-architecture.png')" alt="" style="max-width:500px; margin-top:10px">

## 2. Configure each message

For each message, you will be able to specify the following message settings:

| Setting | Explanation
|:--------|:------------
| [**Type**](/how-it-works/set-message-type/)             | What type of message? (ie: email, SMS)
| [**Template**](/how-it-works/set-message-template/)     | Which Twig template generates the message body?
| [**Recipients**](/how-it-works/set-message-recipients/) | Who will the message be sent to?
