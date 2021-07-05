# How it Works

## 1. Create a notification trigger

Before you can configure any individual messages, you must first determine what will trigger them. [Configuring the message trigger](/how-it-works/create-message-trigger/) is the first, and arguably most important, step.

## 2. Add notification message(s)

Once you have a message trigger in place as a foundation, you can then add as many individual messages as you'd like to be sent out in response to the trigger...

<img class="dropshadow" :src="$withBase('/images/notification-architecture.png')" alt="" style="max-width:500px; margin-top:10px">

## 3. Configure each message

For each message, you will be able to specify the following message settings:

| Setting | Explanation
|:--------|:------------
| [**Type**](/how-it-works/select-message-type/)              | What type of message? (ie: email, SMS)
| [**Recipients**](/how-it-works/specify-message-recipients/) | Who will the message be sent to?
| [**Template**](/how-it-works/specify-twig-template/)        | Specify a Twig template to generate the message body.
