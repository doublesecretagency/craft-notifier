# Specify a Twig Template


<img class="dropshadow" :src="$withBase('/images/00-set-template.png')" alt="" style="max-width:400px; margin-top:10px">

## Available Twig Variables

Each template will have access to the entire `$event` object.

Additionally, `entry` will be an alias of `$event->sender` when triggered by an Entry event.

## Email Subject

For email messages, you will also be able to specify a dynamic **subject** line.
