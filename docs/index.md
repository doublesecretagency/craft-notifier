---
# meta:
# - property: og:type
#   content: website
# - property: og:url
#   content: https://plugins.doublesecretagency.com/notifier/
# - property: og:title
#   content: Notifier plugin for Craft CMS
# - property: og:description
#   content: Send custom Twig messages when Craft events are triggered.
# - property: og:image
#   content: https://plugins.doublesecretagency.com/notifier/images/meta/notifier.png
# - property: twitter:card
#   content: summary_large_image
# - property: twitter:url
#   content: https://plugins.doublesecretagency.com/notifier/
# - property: twitter:title
#   content: Notifier plugin for Craft CMS
# - property: twitter:description
#   content: Send custom Twig messages when Craft events are triggered.
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
      text: Events
      link: /events/
    - theme: alt
      text: Messages
      link: /messages/
    - theme: alt
      text: Recipients
      link: /recipients/

features:
  - icon: ⚙️
    title: Triggered by System Events
    details: Choose which Craft events will send Notifications. Each Notification can be configured independently.
  - icon: ％
    title: Customized Twig Messages
    details: Create custom messages based on your own Twig logic. Messages can use special variables about the recipient and affected element.
  - icon: 📭
    title: Variety of Recipients
    details: When sending a message to multiple users, each recipient will receive their own personalized copy of the Twig message. 
---
