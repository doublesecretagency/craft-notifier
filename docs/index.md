---
# meta:
# - property: og:type
#   content: website
# - property: og:url
#   content: https://plugins.doublesecretagency.com/notifier/
# - property: og:title
#   content: Notifier plugin for Craft CMS
# - property: og:description
#   content: Send custom Twig messages when Craft events get triggered.
# - property: og:image
#   content: https://plugins.doublesecretagency.com/notifier/images/meta/notifier.png
# - property: twitter:card
#   content: summary_large_image
# - property: twitter:url
#   content: https://plugins.doublesecretagency.com/notifier/
# - property: twitter:title
#   content: Notifier plugin for Craft CMS
# - property: twitter:description
#   content: Send custom Twig messages when Craft events get triggered.
# - property: twitter:image
#   content: https://plugins.doublesecretagency.com/notifier/images/meta/notifier.png

# https://vitepress.dev/reference/default-theme-home-page
layout: home

hero:
  name: "Notifier"
  text: "plugin for Craft CMS"
  tagline: "Send custom Twig messages when Craft events are triggered."
  image:
    src: /images/meta/notifier.png
    alt: Notifier plugin for Craft CMS
  actions:
    - theme: brand
      text: Get Started →
      link: /getting-started/
    - theme: alt
      text: Examples
      link: /examples/

features:
  - icon: ✍️
    title: Triggers
    details: Send out a message every time an event is triggered &#40;ie, "on Entry save"&#41;.
  - icon: ✉️
    title: Messages
    details: Customize messages using simple Twig templates and pre-defined variables.
  - icon: 🙋‍♀️
    title: Recipients
    details: Send emails to selected recipients, with more message formats coming soon!
---

<div style="margin: 20px auto 0; max-width: 1152px;">
    <p style="font-weight: bold">Want to share new posts with your audience? Need to get notified when something changes?</p>
    <p style="margin-top: 10px;">The Notifier plugin allows you to create messages which will be sent out whenever certain triggers are activated. Configure a notification trigger, then add as many outgoing messages as you wish. Each message can be sent to a specific group of recipients, and message templates can be easily managed via Twig.</p>
</div>
