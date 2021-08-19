<img align="left" src="https://plugins.doublesecretagency.com/notifier/images/icon.svg" alt="Plugin icon">

# Notifier plugin for Craft CMS (beta)

**Send custom Twig messages when Craft events get triggered.**

---

**Want to share new posts with your audience? Need to get notified when something changes?**

The Notifier plugin allows you to create messages which will be sent out whenever certain triggers are activated. Configure a notification trigger, then add as many outgoing messages as you wish. Each message can be sent to a specific group of recipients, and message templates can be easily managed via Twig.

**Whenever a trigger is activated, all corresponding messages will be sent out.**

Setting up a new notification is a breeze...

### Step 1

**Add a [trigger](https://plugins.doublesecretagency.com/notifier/triggers/)**. This ties directly to an event in Craft. (While in beta, the only available trigger is "on save Entry".)

### Step 2

**Add a [message](https://plugins.doublesecretagency.com/notifier/messages/)**. You can assign one or more messages for each trigger. (While in beta, only email messages are available.)

<img src="https://raw.githubusercontent.com/doublesecretagency/craft-notifier/077cc2f124442f1b6e95f3c2d25a47da33ab0373/docs/.vuepress/public/images/manage-notifications.png" alt="Screenshot of page to manage notifications">

> **Beta Soft Launch:**
>
> While in beta, this plugin is shy of just a few key features. Before the 1.0 official release, we will add:
> - Support for more event triggers.
> - Support for text/SMS messages.

---

## How to Install the Plugin

### Installation via Plugin Store

See the complete instructions for [installing via the plugin store...](https://plugins.doublesecretagency.com/notifier/getting-started/#installation-via-plugin-store)

### Installation via Console Commands

To install the **Notifier** plugin via the console, follow these steps:

1. Open your terminal and go to your Craft project:

```sh
cd /path/to/project
```

2. Then tell Composer to load the plugin:

```sh
composer require doublesecretagency/craft-notifier
```

3. Then tell Craft to install the plugin:

```sh
./craft plugin/install notifier
```

> Alternatively, you can visit the **Settings > Plugins** page to finish the installation.

---

## Further Reading

If you haven't already, flip through the [complete plugin documentation](https://plugins.doublesecretagency.com/notifier/).

And if you have any remaining questions, feel free to [reach out to us](https://www.doublesecretagency.com/contact) (via Discord is preferred).

**On behalf of Double Secret Agency, thanks for checking out our plugin!** 🍺

<p align="center">
    <img width="130" src="https://www.doublesecretagency.com/resources/images/dsa-transparent.png" alt="Logo for Double Secret Agency">
</p>
