# Setting the Template

<img class="dropshadow" :src="$withBase('/images/messages/set-template.png')" alt="" style="max-width:600px; margin-top:10px">

## Message Template

Select which Twig template to use for the outgoing message. A select set of variables will be [automatically available](/messages/variables/) within the context of your template.

## Message Subject

For email messages, you will also be able to specify a dynamic **subject** line. The exact same [automatic variables](/messages/variables/) are available within the context of your subject line.

:::tip Email Only
The subject line is only relevant for [email](/messages/set-type/#email) messages.
:::
