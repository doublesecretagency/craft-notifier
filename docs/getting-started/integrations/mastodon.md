---
description: Connect to Mastodon by creating an access token for each account. Notifier posts from each account using its instance URL and token.
---

# Configuring Mastodon

If using [Mastodon](https://joinmastodon.org) to publish posts, you'll first need an **access token** for each account you want to post from.

### Create an access token

1. Log into the account on its Mastodon instance.
2. Open **Preferences → Development → New application**.
3. Give the application a name, and grant it the `write:statuses` scope.
4. Save, then open the application and copy **Your access token**.

<img class="dropshadow" src="/images/getting-started/integrations/mastodon-application.png" alt="Screenshot of the Mastodon application" style="width:848px; margin-top:10px">

:::warning Protect the Access Token
Anyone who knows the access token can post as the account. Treat it like an API key. Keep it in a `.env` variable so the secret never ends up in your project config.
:::

### Configure Notifier

First, store each access token in your `.env` file:

```dotenv
MASTODON_ACCESSTOKEN="..."
# ... add all relevant access tokens
```

Then in the Craft control panel, go to **Settings → Plugins → Notifier → Mastodon** to:

- Add one or more accounts with a friendly label (e.g. `@mycompany@mastodon.social`).
- In the **Instance URL** field, enter the account's instance (e.g. `https://mastodon.social`).
- In the **Access Token** field, reference the `.env` variable (e.g. `$MASTODON_ACCESSTOKEN`).
- Hit the **Test** button next to each account to verify its credentials.

<img class="dropshadow" src="/images/settings/settings-mastodon.png" alt="Screenshot of the Mastodon settings sub-page" style="width:1044px; margin-top:20px; margin-bottom:30px">

### Sending from multiple Mastodon accounts

Each account needs its own token. Add a separate row in **Settings → Mastodon** for each account, pairing its instance URL with the matching token. Accounts on different instances are fully supported.

A single notification can simultaneously post from multiple accounts, or you can set up separate notifications which post from different accounts.
