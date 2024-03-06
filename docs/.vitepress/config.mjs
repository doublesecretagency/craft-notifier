import { defineConfig } from 'vitepress';

// https://vitepress.dev/reference/site-config
export default defineConfig({

  title: "Notifier plugin",
  description: "Send custom Twig messages when Craft events get triggered.",

  base: '/notifier/',
  cleanUrls: true,

  themeConfig: {

    logo: '/images/icon.svg',
    search: {provider: 'local'},

    // https://vitepress.dev/reference/default-theme-config
    nav: [

      {text: 'Getting Started', link: '/getting-started/'},
      {
        text: 'How It Works',
        items: [
          {
            items: [
              {text: 'Events',          link: '/events/'},
              {text: 'All Event Types', link: '/events/types/'},
            ]
          },
          {
            items: [
              {text: 'Messages',               link: '/messages/'},
              {text: 'All Message Types',      link: '/messages/types/'},
              {text: 'Message Templating',     link: '/messages/templating'},
              {text: 'Special Variables',      link: '/messages/variables'},
              {text: 'Skip Sending a Message', link: '/messages/skip-message'},
              {text: 'Optional Queue',         link: '/messages/queue'},
              {text: 'Twig Sandbox',           link: '/messages/twig-sandbox'},
            ]
          },
          {
            items: [
              {text: 'Recipients',          link: '/recipients/'},
              {text: 'All Recipient Types', link: '/recipients/types/'}
            ]
          }
        ]
      },
      {
        text: 'More',
        items: [
          {text: 'Elements', link: '/elements'},
          {text: 'Logging',  link: '/logging'}
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
            {text: 'Twilio',          link: '/getting-started/twilio'},
            {text: 'Settings Page',   link: '/getting-started/settings'},
            {text: 'PHP Config File', link: '/getting-started/config'},
          ]
        }
      ],

      // Events
      '/events/': [
        {
          text: 'Events',
          items: [
            {text: 'Overview',        link: '/events/'},
            {text: 'All Event Types', link: '/events/types/',
              items: [
                {text: 'Users',   link: '/events/types/users'},
                {text: 'Entries', link: '/events/types/entries'},
                {text: 'Assets',  link: '/events/types/assets'},
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
              ]
            },
            {text: 'Message Templating',     link: '/messages/templating'},
            {text: 'Special Variables',      link: '/messages/variables'},
            {text: 'Skip Sending a Message', link: '/messages/skip-message'},
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
            {text: 'Elements', link: '/elements'},
            {text: 'Logging',  link: '/logging'}
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
