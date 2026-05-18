import { defineConfig } from 'vitepress';

const metaUrl = 'https://plugins.doublesecretagency.com/notifier/';
const metaTitle = 'Notifier plugin for Craft CMS';
const metaDescription = 'Send custom Twig messages when Craft events are triggered.';
const metaImage = 'https://plugins.doublesecretagency.com/notifier/images/meta/notifier.png';

// https://vitepress.dev/reference/site-config
export default defineConfig({

  title: "Notifier plugin",
  description: "Send custom Twig messages when Craft events are triggered.",

  head: [
    ['meta', {'name': 'og:type', 'content': 'website'}],
    ['meta', {'name': 'og:url', 'content': metaUrl}],
    ['meta', {'name': 'og:title', 'content': metaTitle}],
    ['meta', {'name': 'og:description', 'content': metaDescription}],
    ['meta', {'name': 'og:image', 'content': metaImage}],
    ['meta', {'name': 'twitter:card', 'content': 'summary_large_image'}],
    ['meta', {'name': 'twitter:url', 'content': metaUrl}],
    ['meta', {'name': 'twitter:title', 'content': metaTitle}],
    ['meta', {'name': 'twitter:description', 'content': metaDescription}],
    ['meta', {'name': 'twitter:image', 'content': metaImage}],
  ],

  base: '/notifier/',
  cleanUrls: true,

  themeConfig: {

    logo: '/images/icon.svg',
    search: {provider: 'local'},

    // https://vitepress.dev/reference/default-theme-config
    nav: [

      {text: 'Getting Started', link: '/getting-started/'},
      {
        text: 'Events',
        activeMatch: '/events/',
        items: [
          {
            items: [
              {text: 'Overview',        link: '/events/'},
              {text: 'Manual Sending',  link: '/events/manually-send'},
              {text: 'All Event Types', link: '/events/types/'},
            ]
          },
          {
            items: [
              {text: 'Entries',          link: '/events/types/entries/'},
              {text: 'Assets',           link: '/events/types/assets/'},
              {text: 'Users',            link: '/events/types/users/'},
            ]
          },
          {
            items: [
              {text: 'Craft Commerce',   link: '/events/types/craft-commerce/'},
              {text: 'Digital Products', link: '/events/types/digital-products/'},
              {text: 'Solspace Calendar', link: '/events/types/solspace-calendar/'},
            ]
          },
        ]
      },
      {
        text: 'Messages',
        activeMatch: '/messages/',
        items: [
          {
            items: [
              {text: 'Overview',          link: '/messages/'},
              {text: 'All Message Types', link: '/messages/types/'},
            ]
          },
          {
            items: [
              {text: 'Email',              link: '/messages/types/email'},
              {text: 'SMS (Text Message)', link: '/messages/types/sms-text'},
              {text: 'Announcement',       link: '/messages/types/announcement'},
              {text: 'Flash Message',      link: '/messages/types/flash'},
              {text: 'Pushover',           link: '/messages/types/pushover'},
              {text: 'ntfy',               link: '/messages/types/ntfy'},
              {text: 'Slack',              link: '/messages/types/slack'},
              {text: 'Bluesky',            link: '/messages/types/bluesky'},
            ]
          },
          {
            items: [
              {text: 'Message Templating',     link: '/messages/templating'},
              {text: 'Special Variables',      link: '/messages/variables'},
              {text: 'Skip Sending a Message', link: '/messages/skip'},
              {text: 'Optional Queue',         link: '/messages/queue'},
              {text: 'Twig Sandbox',           link: '/messages/twig-sandbox'},
            ]
          },
        ]
      },
      {
        text: 'Recipients',
        activeMatch: '/recipients/',
        items: [
          {
            items: [
              {text: 'Overview',            link: '/recipients/'},
              {text: 'All Recipient Types', link: '/recipients/types/'},
            ]
          },
          {
            items: [
              {text: 'Current User',       link: '/recipients/types/current-user'},
              {text: 'All Users',          link: '/recipients/types/all-users'},
              {text: 'All Admins',         link: '/recipients/types/all-admins'},
              {text: 'Selected Groups',    link: '/recipients/types/selected-groups'},
              {text: 'Selected Users',     link: '/recipients/types/selected-users'},
              {text: 'Dynamic Recipients', link: '/recipients/types/dynamic-recipients'},
            ]
          },
          {
            items: [
              {text: 'ntfy Topics',       link: '/recipients/types/ntfy-topics'},
              {text: 'Slack Channels',    link: '/recipients/types/slack-channels'},
              {text: 'Bluesky Accounts',  link: '/recipients/types/bluesky-accounts'},
            ]
          },
        ]
      },
      {
        text: 'More',
        items: [
          {text: 'Elements',     link: '/elements'},
          {text: 'Testing',      link: '/testing'},
          {text: 'Logging',      link: '/logging'},
          {text: 'Translations', link: '/translations'}
        ]
      },
      // {
      //   text: 'Examples',
      //   items: [
      //     {
      //       items: [
      //         {text: 'When a User registers, send a "welcome" email', link: '/examples/users/when-user-registers-send-welcome-email'},
      //       ]
      //     },
      //     {
      //       items: [
      //         {text: 'When an Entry is created, email all Admins',     link: '/examples/entries/when-entry-created-email-admins'},
      //         {text: 'When an Entry is updated, post CP announcement', link: '/examples/entries/when-entry-updated-post-announcement'},
      //       ]
      //     },
      //     {
      //       items: [
      //         {text: 'When an Asset is uploaded, send an SMS (text message)', link: '/examples/assets/when-asset-uploaded-send-sms-text'},
      //       ]
      //     },
      //   ]
      // },
    ],

    sidebar: {

      // // Examples of User Events
      // '/examples/users/': [
      //   {
      //     text: 'User Events',
      //     items: [
      //       {text: 'When a User registers, send a "welcome" email', link: '/examples/users/when-user-registers-send-welcome-email'},
      //     ]
      //   }
      // ],
      // // Examples of Entry Events
      // '/examples/entries/': [
      //   {
      //     text: 'Entry Events',
      //     items: [
      //       {text: 'When an Entry is created, email all Admins',     link: '/examples/entries/when-entry-created-email-admins'},
      //       {text: 'When an Entry is updated, post CP announcement', link: '/examples/entries/when-entry-updated-post-announcement'},
      //     ]
      //   }
      // ],
      // // Examples of Asset Events
      // '/examples/assets/': [
      //   {
      //     text: 'Asset Events',
      //     items: [
      //       {text: 'When an Asset is uploaded, send an SMS (text message)', link: '/examples/assets/when-asset-uploaded-send-sms-text'},
      //     ]
      //   }
      // ],

      // Getting Started
      '/getting-started/': [
        {
          text: 'Getting Started',
          items: [
            {text: 'Overview',        link: '/getting-started/',
              items: [
                {text: 'Install via Plugin Store', link: '/getting-started/#installation-via-plugin-store'},
                {text: 'Install via CLI',          link: '/getting-started/#installation-via-console-commands'}
              ]
            },
            {text: 'Settings Page',    link: '/getting-started/settings'},
            {text: 'PHP Config File',  link: '/getting-started/config'},
            {text: 'User Permissions', link: '/getting-started/permissions'},
            {text: 'Integrations',     link: '/getting-started/integrations/',
              items: [
                {text: 'Twilio',   link: '/getting-started/integrations/twilio'},
                {text: 'Pushover', link: '/getting-started/integrations/pushover'},
                {text: 'ntfy',     link: '/getting-started/integrations/ntfy'},
                {text: 'Slack',    link: '/getting-started/integrations/slack'},
                {text: 'Bluesky',  link: '/getting-started/integrations/bluesky'},
              ]
            },
          ]
        }
      ],

      // Events
      '/events/': [
        {
          text: 'Events',
          items: [
            {text: 'Overview',        link: '/events/'},
            {text: 'Manual Sending',  link: '/events/manually-send'},
            {text: 'All Event Types', link: '/events/types/',
              items: [
                {text: 'Entries', link: '/events/types/entries/', collapsed: true,
                  items: [
                    {text: 'Entry is saved',      link: '/events/types/entries/entry-saved-per-site'},
                    {text: 'Entry is propagated', link: '/events/types/entries/entry-saved-and-propagated'},
                    {text: 'Entry is deleted',    link: '/events/types/entries/entry-deleted'},
                    {text: 'Entry is restored',   link: '/events/types/entries/entry-restored'},
                  ]
                },
                {text: 'Assets', link: '/events/types/assets/', collapsed: true,
                  items: [
                    {text: 'New file is uploaded', link: '/events/types/assets/file-uploaded'},
                    {text: 'Asset is moved',       link: '/events/types/assets/asset-moved'},
                    {text: 'Asset is updated',     link: '/events/types/assets/asset-updated'},
                    {text: 'Asset is deleted',     link: '/events/types/assets/asset-deleted'},
                    {text: 'Asset is restored',    link: '/events/types/assets/asset-restored'},
                  ]
                },
                {text: 'Users', link: '/events/types/users/', collapsed: true,
                  items: [
                    {text: 'New user is created',          link: '/events/types/users/new-user-created'},
                    {text: 'User is activated',            link: '/events/types/users/user-activated'},
                    {text: 'User is updated',              link: '/events/types/users/user-updated'},
                    {text: 'User is assigned to groups',   link: '/events/types/users/user-assigned-to-groups'},
                    {text: 'User is deleted',              link: '/events/types/users/user-deleted'},
                    {text: 'User is restored',             link: '/events/types/users/user-restored'},
                  ]
                },
                {text: 'Craft Commerce', link: '/events/types/craft-commerce/', collapsed: true,
                  items: [
                    {text: 'Order is completed',  link: '/events/types/craft-commerce/order-completed'},
                    {text: 'Order is fully paid', link: '/events/types/craft-commerce/order-fully-paid'},
                    {text: 'Product is saved',    link: '/events/types/craft-commerce/product-saved'},
                    {text: 'Product is deleted',  link: '/events/types/craft-commerce/product-deleted'},
                    {text: 'Product is restored', link: '/events/types/craft-commerce/product-restored'},
                  ]
                },
                {text: 'Digital Products', link: '/events/types/digital-products/', collapsed: true,
                  items: [
                    {text: 'Product is saved',    link: '/events/types/digital-products/product-saved'},
                    {text: 'Product is deleted',  link: '/events/types/digital-products/product-deleted'},
                    {text: 'Product is restored', link: '/events/types/digital-products/product-restored'},
                    {text: 'License is saved',    link: '/events/types/digital-products/license-saved'},
                    {text: 'License is deleted',  link: '/events/types/digital-products/license-deleted'},
                    {text: 'License is restored', link: '/events/types/digital-products/license-restored'},
                  ]
                },
                {text: 'Solspace Calendar', link: '/events/types/solspace-calendar/', collapsed: true,
                  items: [
                    {text: 'Event is saved',    link: '/events/types/solspace-calendar/event-saved'},
                    {text: 'Event is deleted',  link: '/events/types/solspace-calendar/event-deleted'},
                    {text: 'Event is restored', link: '/events/types/solspace-calendar/event-restored'},
                  ]
                },
              ]
            },
          ]
        }
      ],
      // Messages
      '/messages/': [
        {
          text: 'Messages',
          items: [
            {text: 'Overview',               link: '/messages/'},
            {text: 'All Message Types',      link: '/messages/types/',
              items: [
                {text: 'Email',              link: '/messages/types/email'},
                {text: 'SMS (Text Message)', link: '/messages/types/sms-text'},
                {text: 'Announcement',       link: '/messages/types/announcement'},
                {text: 'Flash Message',      link: '/messages/types/flash'},
                {text: 'Pushover',           link: '/messages/types/pushover'},
                {text: 'ntfy',               link: '/messages/types/ntfy'},
                {text: 'Slack',              link: '/messages/types/slack'},
                {text: 'Bluesky',            link: '/messages/types/bluesky'},
              ]
            },
            {text: 'Message Templating',     link: '/messages/templating'},
            {text: 'Special Variables',      link: '/messages/variables'},
            {text: 'Skip Sending a Message', link: '/messages/skip'},
            {text: 'Optional Queue',         link: '/messages/queue'},
            {text: 'Twig Sandbox',           link: '/messages/twig-sandbox'},
          ]
        }
      ],
      // Recipients
      '/recipients/': [
        {
          text: 'Recipients',
          items: [
            {text: 'Overview',            link: '/recipients/'},
            {text: 'All Recipient Types', link: '/recipients/types/',
              items: [
                {text: 'Current User',       link: '/recipients/types/current-user'},
                {text: 'All Users',          link: '/recipients/types/all-users'},
                {text: 'All Admins',         link: '/recipients/types/all-admins'},
                {text: 'Selected Groups',    link: '/recipients/types/selected-groups'},
                {text: 'Selected Users',     link: '/recipients/types/selected-users'},
                {text: 'Dynamic Recipients', link: '/recipients/types/dynamic-recipients'},
                {text: 'ntfy Topics',        link: '/recipients/types/ntfy-topics'},
                {text: 'Slack Channels',     link: '/recipients/types/slack-channels'},
                {text: 'Bluesky Accounts',   link: '/recipients/types/bluesky-accounts'},
              ]
            }
          ]
        }
      ],

      // More
      '/': [
        {
          text: 'More',
          items: [
            {text: 'Elements',     link: '/elements'},
            {text: 'Testing',      link: '/testing'},
            {text: 'Logging',      link: '/logging'},
            {text: 'Translations', link: '/translations'}
          ]
        }
      ]

    },

    aside: false, // Hide right-hand sidebar for page anchors

    socialLinks: [
      {
        icon: {
          svg: `
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" aria-hidden="true">
    <title>Plugin Store</title>
    <!--! Font Awesome Pro 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
    <path d="M96 0C78.3 0 64 14.3 64 32v96h64V32c0-17.7-14.3-32-32-32zM288 0c-17.7 0-32 14.3-32 32v96h64V32c0-17.7-14.3-32-32-32zM32 160c-17.7 0-32 14.3-32 32s14.3 32 32 32v32c0 77.4 55 142 128 156.8V480c0 17.7 14.3 32 32 32s32-14.3 32-32V412.8C297 398 352 333.4 352 256V224c17.7 0 32-14.3 32-32s-14.3-32-32-32H32z"/>
</svg>`
        },
        link: 'https://plugins.craftcms.com/notifier',
        ariaLabel: 'Plugin Store'
      },
      {
        icon: 'github',
        link: 'https://github.com/doublesecretagency/craft-notifier'
      }
    ],

    docFooter: {
      prev: false,
      next: false
    },

    footer: {
      copyright: 'Copyright © Double Secret Agency'
    },

  }
})
