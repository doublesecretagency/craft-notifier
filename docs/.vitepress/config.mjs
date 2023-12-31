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
              {text: 'Skip Sending a Message', link: '/messages/skip-message'}
            ]
          },
          {
            items: [
              {text: 'Recipients',          link: '/recipients/'},
              {text: 'All Recipient Types', link: '/recipients/types'},
              {text: 'Dynamic Recipients',  link: '/recipients/dynamic'},
              {text: 'Users as Recipients', link: '/recipients/users'}
            ]
          }
        ]
      },
      {
        text: 'More',
        items: [
          {text: 'Elements', link: '/elements'},
          {text: 'Queue',    link: '/queue'},
          {text: 'Logging',  link: '/logging'}
        ]
      },
      {
        text: 'Examples',
        items: [
          {
            items: [
              {text: 'When a User registers, send a "welcome" email', link: '/examples/users/when-user-registers-send-welcome-email'},
            ]
          },
          {
            items: [
              {text: 'When an Entry is created, email all Admins',     link: '/examples/entries/when-entry-created-email-admins'},
              {text: 'When an Entry is updated, post CP announcement', link: '/examples/entries/when-entry-updated-post-announcement'},
            ]
          },
          {
            items: [
              {text: 'When an Asset is uploaded, send an SMS (text message)', link: '/examples/assets/when-asset-uploaded-send-sms-text'},
            ]
          },
        ]
      },
    ],

    sidebar: {

      // Examples of User Events
      '/examples/users/': [
        {
          text: 'User Events',
          items: [
            {text: 'When a User registers, send a "welcome" email', link: '/examples/users/when-user-registers-send-welcome-email'},
          ]
        }
      ],
      // Examples of Entry Events
      '/examples/entries/': [
        {
          text: 'Entry Events',
          items: [
            {text: 'When an Entry is created, email all Admins',     link: '/examples/entries/when-entry-created-email-admins'},
            {text: 'When an Entry is updated, post CP announcement', link: '/examples/entries/when-entry-updated-post-announcement'},
          ]
        }
      ],
      // Examples of Asset Events
      '/examples/assets/': [
        {
          text: 'Asset Events',
          items: [
            {text: 'When an Asset is uploaded, send an SMS (text message)', link: '/examples/assets/when-asset-uploaded-send-sms-text'},
          ]
        }
      ],

      // Getting Started
      '/getting-started/': [
        {
          text: 'Getting Started',
          items: [
            {text: 'Overview', link: '/getting-started/',
              items: [
                {text: 'Install via Plugin Store', link: '/getting-started/#installation-via-plugin-store'},
                {text: 'Install via CLI',          link: '/getting-started/#installation-via-console-commands'}
              ]
            },
            {text: 'Twilio',   link: '/getting-started/twilio'},
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
            {text: 'Message Types',          link: '/messages/types/',
              items: [
                {text: 'Email',              link: '/messages/types/email'},
                {text: 'SMS (Text Message)', link: '/messages/types/sms-text'},
                {text: 'Announcement',       link: '/messages/types/announcement'},
                {text: 'Flash Message',      link: '/messages/types/flash'},
              ]
            },
            {text: 'Templating',             link: '/messages/templating'},
            {text: 'Special Variables',      link: '/messages/variables'},
            {text: 'Skip Sending a Message', link: '/messages/skip-message'}
          ]
        }
      ],
      // Recipients
      '/recipients/': [
        {
          text: 'Recipients',
          items: [
            {text: 'Overview',            link: '/recipients/'},
            {text: 'All Recipient Types', link: '/recipients/types'},
            {text: 'Dynamic Recipients',  link: '/recipients/dynamic'},
            {text: 'Users as Recipients', link: '/recipients/users'}
          ]
        }
      ],

      // More
      '/': [
        {
          text: 'More',
          items: [
            {text: 'Elements', link: '/elements'},
            {text: 'Queue',    link: '/queue'},
            {text: 'Logging',  link: '/logging'}
          ]
        }
      ]

    },

    aside: false, // Hide right-hand sidebar for page anchors

    socialLinks: [
      {
        icon: 'github',
        link: 'https://github.com/doublesecretagency/craft-notifier'
      },
      {
        icon: {
          svg: '<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 54 54"><title>Plugin Store</title><path d="M47.813 0H5.625A5.6 5.6 0 0 0 0 5.625v42.188a5.6 5.6 0 0 0 5.625 5.625h42.188c3.062 0 5.625-2.5 5.625-5.625V5.625A5.6 5.6 0 0 0 47.813 0M26.625 32.563c1.75 0 3.625-.688 5.438-2.313l2.5 2.875c-2.625 2.125-5.625 3.313-8.625 3.313-5.938 0-9.688-3.938-8.813-9.5s5.938-9.5 11.875-9.5c2.875 0 5.563 1.125 7.438 3.187l-3.5 2.875c-1-1.312-2.688-2.187-4.563-2.187-3.562 0-6.312 2.312-6.875 5.625-.5 3.312 1.5 5.625 5.125 5.625" fill="#e5422b"/></svg>'
        },
        link: 'https://plugins.craftcms.com/notifier',
        ariaLabel: 'Plugin Store'
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
