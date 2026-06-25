---
description: Connect to LinkedIn by creating an app, then authorizing the account.
---

# Configuring LinkedIn

If using [LinkedIn](https://linkedin.com) to publish posts, you'll first need to create a **LinkedIn app**, then connect each account you want to post from.

:::warning Refresh the Connection (every 60 days)
Unlike other social media, LinkedIn requires you to generate a fresh token on a regular basis. LinkedIn access tokens expire about every 60 days, so you may occasionally need to reconnect.
:::

## Get started with LinkedIn

### Register as a LinkedIn developer

:::warning App required
Already created a LinkedIn app? Skip ahead to ["Register the redirect URL"](#register-the-redirect-url).
:::

Go to the [LinkedIn Developer Portal](https://www.linkedin.com/developers/apps) and sign in with the LinkedIn account you want to manage the app from. Any account can create an app, but you'll need to be an **admin of a LinkedIn Page** to finish setup.

<img class="dropshadow" src="/images/getting-started/integrations/linkedin-create-app.png" alt="Screenshot of the &quot;Ready to create your first app?&quot; screen on the LinkedIn Developer Portal" style="width:375px; margin-top:17px">

### Create a LinkedIn app

1. Click **Create app**.
2. Enter an **App name**. This is shown during authorization, so name it something recognizable to your employees (like your company name).
3. Under **LinkedIn Page**, search for and select a Page you administer. Every app must be tied to a Page.
4. Upload an **App logo** (like your company logo, to align with the **App name**). 
5. Accept the **legal agreement**.
6. Click **Create app**.

:::warning A LinkedIn Page is required
LinkedIn won't let an app exist without an associated Page, and you must be an admin of that Page. Personal profiles don't count. If you don't have a Page yet, create one first, then come back.
:::

### Verify the app

LinkedIn needs to confirm that you really do manage the Page you picked.

1. Open the app's **Settings** tab.
2. Next to the associated Page, click **Verify**.
3. Click the **Generate URL** button to generate a URL.
4. Copy the URL.
5. If you are an authorized admin of the LinkedIn Page, open the URL in a new tab of your browser.
6. Click **Verify** to confirm.

### Add the products

Products are how LinkedIn grants the permissions Notifier needs.

1. Open the **Products** tab.
2. Find **Share on LinkedIn** and click **Request access**.
3. Find **Sign In with LinkedIn using OpenID Connect** and click **Request access**.

Together, they let Notifier post to your member profile.

<img class="dropshadow" src="/images/getting-started/integrations/linkedin-added-products.png" alt="Screenshot of the Products tab in a LinkedIn app" style="width:746px; margin-top:17px">

### Copy your app credentials

1. Open the app's **Auth** tab.
2. Under **Application credentials**, copy both:
    - **Client ID**
    - **Primary Client Secret**
3. Store them in your `.env` file:

```dotenv
LINKEDIN_CLIENT_ID="..."
LINKEDIN_CLIENT_SECRET="..."
```

:::warning Protect your credentials
Anyone with these two values can post as your app. Keep each in a `.env` variable so the secrets never end up in your project config.
:::

### Register the redirect URL

When connecting, LinkedIn will need to ping a **callback URL** on your website.

[//]: # (<img class="dropshadow" src="/images/getting-started/integrations/linkedin-callback.png" alt="Screenshot of the redirect URL shown on the Notifier LinkedIn settings page" style="width:685px; margin-top:17px">)

1. _In the Craft control panel,_ go to **Settings → Plugins → Notifier → LinkedIn**.
2. **Copy the redirect URL** shown at the top of the page.
3. _In the LinkedIn app,_ open the **Auth** tab.
4. Scroll to **OAuth 2.0 settings**.
5. Find **Authorized redirect URLs for your app**, and click **Add redirect URL**.
6. Paste the URL you just copied from Craft. 
7. Click the **Update** button to save.

### Connect Notifier to LinkedIn

1. _In the Craft control panel,_ go to **Settings → Plugins → Notifier → LinkedIn**.
2. Set the **Client ID** field to its `.env` reference (e.g. `$LINKEDIN_CLIENT_ID`).
3. Set the **Client Secret** field to its `.env` reference (e.g. `$LINKEDIN_CLIENT_SECRET`).
4. Click **Save**.

<img class="dropshadow" src="/images/settings/settings-linkedin.png" alt="Screenshot of the LinkedIn settings sub-page" style="width:1044px; margin-top:22px; margin-bottom:30px">

5. After saving, click **Connect to LinkedIn**.
6. You'll be sent to LinkedIn to approve the app. Log in and click **Allow**.
7. You'll then be returned to the settings page, with a newly established connection.

Each connection will be available on the **Recipients** tab when configuring a notification.

:::tip Reconnecting
LinkedIn access tokens expire after about 60 days. When a connection is getting close, its status on the settings page changes to **Reconnect needed**. Click **Connect to LinkedIn** again to refresh it, no other setup required.
:::
