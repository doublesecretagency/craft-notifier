---
description: Set up Instagram by converting to a Business or Creator account and linking it to a Facebook Page, then follow the Facebook guide. Instagram reuses the Facebook Page Access Token.
---

# Configuring Instagram

<!--@include: @/getting-started/integrations/_facebook-instagram-shared-setup.md-->

If using [Instagram](https://instagram.com) to publish posts, you'll need an Instagram Business or Creator account linked to a Facebook Page.

Instagram has no posting API of its own. It runs through the same Meta app and Page Access Token as [Facebook](/getting-started/integrations/facebook).

## Synergy with Facebook

Instagram uses the Facebook Meta app and Page Access Token. If you are adding Instagram:
1. First, complete the two requirements below in the Instagram setup guide.
2. When you're done, go to the [Facebook setup guide](/getting-started/integrations/facebook) and finish the process.

## Get started with Instagram

### Convert your Instagram account to Business or Creator

:::warning Business/Creator account required
Already using a Business or Creator account? Skip ahead to "Link the account to a Facebook Page".
:::

1. Open [instagram.com](https://instagram.com) in your browser and log in.
2. Click **More** in the bottom-left corner, then click **Settings**.
3. Find the **Account type and tools** section, then click **Switch to professional account**.
4. Select **Business** or **Creator**, then click **Next**.
5. Click **Next** through the intro screens, then choose a **category** that fits your account.
6. Work through the remaining prompts to finish the switch.

### Link the account to a Facebook Page

[//]: # (<img class="dropshadow" src="/images/getting-started/integrations/instagram-link.png" alt="Screenshot of the modal for connecting Facebook to Instagram" style="width:607px; margin-top:17px; margin-bottom:27px">)

The Instagram account **must** be connected to a Facebook Page.

1. Sign in at [business.facebook.com](https://business.facebook.com).
2. If you manage more than one Page, select the correct **Page** from the dropdown in the top-left corner.
3. Click the **Settings** gear icon in the bottom-left corner.
4. In the left sidebar, under **Accounts**, click **Instagram accounts**.
5. Click the **Add** button, then click **Confirm**.
6. Log in with your Instagram username and password to finish linking.

### Next, follow the Facebook guide

With those two prerequisites in place, follow the complete [Facebook setup guide](/getting-started/integrations/facebook) from start to finish. Pay close attention to instructions marked _**"If also setting up Instagram"**_, as they are critical to get Instagram working properly.

Once you've established the Facebook **Page ID** and **Page Access Token**, save them to your `.env` file and reference them on the **Settings → Instagram** page.

<img class="dropshadow" src="/images/settings/settings-instagram.png" alt="Screenshot of the Instagram settings sub-page" style="width:1044px; margin-top:22px">
