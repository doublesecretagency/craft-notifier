import { defineConfig } from 'vitepress';
import { fileURLToPath } from 'node:url';
import { dirname, resolve } from 'node:path';
import { existsSync, statSync } from 'node:fs';

// Docs source root (one level up from .vitepress/)
const docsRoot = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const base = '/notifier/';

// Dev-only plugin mirroring the production nginx canonicalization.
// A no-trailing-slash directory URL gets a real 301 to its trailing-slash form.
// Flat clean-URL pages (logging -> logging.md) are served as-is, never redirected.
const trailingSlashRedirect = {
  name: 'notifier-docs-trailing-slash',
  apply: 'serve',
  configureServer(server) {
    server.middlewares.use((req, res, next) => {
      const [path, query = ''] = (req.url || '/').split('?');

      // If it has an extension or already ends in a slash, hand off
      if (path.endsWith('/') || /\.[^/]+$/.test(path)) {
        return next();
      }

      // If it's outside the docs base, hand off
      if (!path.startsWith(base)) {
        return next();
      }

      // Get the path relative to the docs root
      const rel = path.slice(base.length);
      if (!rel) {
        return next();
      }

      // If a flat page exists, serve it (no redirect)
      if (existsSync(resolve(docsRoot, `${rel}.md`))) {
        return next();
      }

      // If a real directory page exists, 301 to the trailing-slash form
      const dir = resolve(docsRoot, rel);
      if (existsSync(dir) && statSync(dir).isDirectory() && existsSync(resolve(dir, 'index.md'))) {
        res.statusCode = 301;
        res.setHeader('Location', `${path}/${query ? `?${query}` : ''}`);
        res.end();
        return;
      }

      // Otherwise hand off (VitePress renders its 404)
      return next();
    });
  },
};

const metaUrl = 'https://plugins.doublesecretagency.com/notifier/';
const metaTitle = 'Notifier plugin for Craft CMS';
const metaDescription = 'First-class Notifications for Craft CMS.';
const metaImage = 'https://plugins.doublesecretagency.com/notifier/images/meta/notifier-v3.1.png';

// https://vitepress.dev/reference/site-config
export default defineConfig({

  title: "Notifier plugin",
  description: "First-class Notifications for Craft CMS.",

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
  srcExclude: ['**/_*.md', '_*.md'],

  vite: {
    plugins: [trailingSlashRedirect],
  },

  themeConfig: {

    logo: '/images/icon.svg',
    search: {provider: 'local'},

    // https://vitepress.dev/reference/default-theme-config
    nav: [

      {
        component: 'NestedNavMenu',
        props: {
          text: 'Getting Started',
          activeMatch: '/getting-started/',
          items: [
            {text: 'Overview',         link: '/getting-started/'},
            {divider: true},
            {text: 'Installation',     link: '/getting-started/installation'},
            {text: 'Settings',         link: '/getting-started/settings/'},
            {text: 'User Permissions', link: '/getting-started/permissions'},
            {divider: true},
            {text: 'All Integrations', link: '/getting-started/integrations/'},
            {text: 'Push Notifications', items: [
              {text: 'Twilio',   link: '/getting-started/integrations/twilio'},
              {text: 'Pushover', link: '/getting-started/integrations/pushover'},
              {text: 'ntfy',     link: '/getting-started/integrations/ntfy'},
            ]},
            {text: 'Chat Platforms', items: [
              {text: 'Slack',   link: '/getting-started/integrations/slack'},
              {text: 'Discord', link: '/getting-started/integrations/discord'},
            ]},
            {text: 'Social Media', items: [
              {text: 'Facebook',    link: '/getting-started/integrations/facebook'},
              {text: 'Instagram',   link: '/getting-started/integrations/instagram'},
              {text: 'X (Twitter)', link: '/getting-started/integrations/x-twitter'},
              {text: 'Bluesky',  link: '/getting-started/integrations/bluesky'},
              {text: 'Mastodon', link: '/getting-started/integrations/mastodon'},
              {text: 'LinkedIn', link: '/getting-started/integrations/linkedin'},
            ]},
            {text: 'Internet of Things', items: [
              {text: 'MQTT', link: '/getting-started/integrations/mqtt'},
            ]},
            {divider: true},
            {text: 'Run the Schedule', link: '/getting-started/run-the-schedule'},
          ],
        },
      },
      {
        component: 'NestedNavMenu',
        props: {
          text: 'Events',
          activeMatch: '/events/',
          items: [
            {text: 'Overview',          link: '/events/'},
            {divider: true},
            {text: 'All Event Types',   link: '/events/types/'},
            {text: 'Native Elements', items: [
              {text: 'Entries', link: '/events/types/entries/'},
              {text: 'Assets',  link: '/events/types/assets/'},
              {text: 'Users',   link: '/events/types/users/'},
            ]},
            {text: 'Plugin Elements', items: [
              {text: 'Formie',            link: '/events/types/formie/'},
              {text: 'Craft Commerce',    link: '/events/types/craft-commerce/'},
              {text: 'Digital Products',  link: '/events/types/digital-products/'},
              {text: 'Solspace Calendar', link: '/events/types/solspace-calendar/'},
            ]},
            {text: 'Other Data Sources', items: [
              {text: 'RSS/JSON Feed',   link: '/events/types/feed/'},
              {text: 'System Snapshot', link: '/events/types/system-snapshot/'},
              {text: 'Dynamic Data',    link: '/events/types/dynamic-data/'},
            ]},
            {divider: true},
            {text: 'Manual Sending',    link: '/events/manual-sending'},
            {text: 'Scheduled Sending', link: '/events/scheduled-sending'},
          ],
        },
      },
      {
        component: 'NestedNavMenu',
        props: {
          text: 'Messages',
          activeMatch: '/messages/',
          items: [
            {text: 'Overview',          link: '/messages/'},
            {divider: true},
            {text: 'All Message Types', link: '/messages/types/'},
            {text: 'Native Pings', items: [
              {text: 'Email',         link: '/messages/types/email'},
              {text: 'Announcement',  link: '/messages/types/announcement'},
              {text: 'Flash Message', link: '/messages/types/flash'},
            ]},
            {text: 'Push Notifications', items: [
              {text: 'SMS (Text Message)', link: '/messages/types/sms-text'},
              {text: 'Pushover',           link: '/messages/types/pushover'},
              {text: 'ntfy',               link: '/messages/types/ntfy'},
            ]},
            {text: 'Chat Platforms', items: [
              {text: 'Slack',   link: '/messages/types/slack'},
              {text: 'Discord', link: '/messages/types/discord'},
            ]},
            {text: 'Social Media', items: [
              {text: 'Facebook',    link: '/messages/types/facebook'},
              {text: 'Instagram',   link: '/messages/types/instagram'},
              {text: 'X (Twitter)', link: '/messages/types/x-twitter'},
              {text: 'Bluesky',  link: '/messages/types/bluesky'},
              {text: 'Mastodon', link: '/messages/types/mastodon'},
              {text: 'LinkedIn', link: '/messages/types/linkedin'},
            ]},
            {text: 'Internet of Things', items: [
              {text: 'MQTT', link: '/messages/types/mqtt'},
            ]},
            {divider: true},
            {text: 'Message Templating',     link: '/messages/templating'},
            {text: 'Special Variables',      link: '/messages/variables/'},
            {text: 'Image Attachments',      link: '/messages/media'},
            {text: 'Skip Sending a Message', link: '/messages/skip'},
            {text: 'Optional Queue',         link: '/messages/queue'},
            {text: 'Twig Sandbox',           link: '/messages/twig-sandbox'},
          ],
        },
      },
      {
        component: 'NestedNavMenu',
        props: {
          text: 'Recipients',
          activeMatch: '/recipients/',
          items: [
            {text: 'Overview',            link: '/recipients/'},
            {divider: true},
            {text: 'All Recipient Types', link: '/recipients/types/'},
            {text: 'Native Users', items: [
              {text: 'Current User',       link: '/recipients/types/current-user'},
              {text: 'All Users',          link: '/recipients/types/all-users'},
              {text: 'All Admins',         link: '/recipients/types/all-admins'},
              {text: 'Selected Groups',    link: '/recipients/types/selected-groups'},
              {text: 'Selected Users',     link: '/recipients/types/selected-users'},
              {text: 'Dynamic Recipients', link: '/recipients/types/dynamic-recipients'},
            ]},
            {text: 'Push Notifications', items: [
              {text: 'ntfy Topics', link: '/recipients/types/ntfy-topics'},
            ]},
            {text: 'Chat Platforms', items: [
              {text: 'Slack Channels',   link: '/recipients/types/slack-channels'},
              {text: 'Discord Channels', link: '/recipients/types/discord-channels'},
            ]},
            {text: 'Social Media', items: [
              {text: 'Facebook Pages',      link: '/recipients/types/facebook-pages'},
              {text: 'Instagram Accounts',  link: '/recipients/types/instagram-accounts'},
              {text: 'X (Twitter) Accounts', link: '/recipients/types/x-twitter-accounts'},
              {text: 'Bluesky Accounts',  link: '/recipients/types/bluesky-accounts'},
              {text: 'Mastodon Accounts', link: '/recipients/types/mastodon-accounts'},
              {text: 'LinkedIn Accounts', link: '/recipients/types/linkedin-accounts'},
            ]},
            {text: 'Internet of Things', items: [
              {text: 'MQTT Topics', link: '/recipients/types/mqtt-topics'},
            ]},
          ],
        },
      },
      {
        text: 'More',
        items: [
          {text: 'Notification Elements', link: '/elements'},
          {text: 'Custom Fields',         link: '/custom-fields'},
          {text: 'Testing Notifications', link: '/testing'},
          {text: 'Notification Log',      link: '/logging'},
          {text: 'Translations',          link: '/translations'}
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
            {text: 'Overview', link: '/getting-started/'},
          ]
        },
        {
          items: [
            {text: 'Installation', link: '/getting-started/installation'},
            {text: 'Settings', link: '/getting-started/settings/'},
            {text: 'User Permissions', link: '/getting-started/permissions'},
          ]
        },
        {
          items: [
            {text: 'All Integrations', link: '/getting-started/integrations/',
              items: [
                {text: 'Push Notifications', collapsed: true,
                  items: [
                    {text: 'Twilio',   link: '/getting-started/integrations/twilio'},
                    {text: 'Pushover', link: '/getting-started/integrations/pushover'},
                    {text: 'ntfy',     link: '/getting-started/integrations/ntfy'},
                  ]
                },
                {text: 'Chat Platforms', collapsed: true,
                  items: [
                    {text: 'Slack',   link: '/getting-started/integrations/slack'},
                    {text: 'Discord', link: '/getting-started/integrations/discord'},
                  ]
                },
                {text: 'Social Media', collapsed: true,
                  items: [
                    {text: 'Facebook',    link: '/getting-started/integrations/facebook'},
                    {text: 'Instagram',   link: '/getting-started/integrations/instagram'},
                    {text: 'X (Twitter)', link: '/getting-started/integrations/x-twitter'},
                    {text: 'Bluesky',  link: '/getting-started/integrations/bluesky'},
                    {text: 'Mastodon', link: '/getting-started/integrations/mastodon'},
                    {text: 'LinkedIn', link: '/getting-started/integrations/linkedin'},
                  ]
                },
                {text: 'Internet of Things', collapsed: true,
                  items: [
                    {text: 'MQTT', link: '/getting-started/integrations/mqtt'},
                  ]
                },
              ]
            },
          ]
        },
        {
          items: [
            {text: 'Run the Schedule', link: '/getting-started/run-the-schedule'},
          ]
        }
      ],

      // Events
      '/events/': [
        {
          text: 'Events',
          items: [
            {text: 'Overview',          link: '/events/'},
          ]
        },
        {
          items: [
            {text: 'All Event Types',   link: '/events/types/',
              items: [
                {text: 'Entries', link: '/events/types/entries/', collapsed: true,
                  items: [
                    {text: 'Pending to Live',           link: '/events/types/entries/pending-to-live'},
                    {text: 'Entry is saved',            link: '/events/types/entries/entry-saved-per-site'},
                    {text: 'Entry is propagated',       link: '/events/types/entries/entry-saved-and-propagated'},
                    {text: 'Entry is deleted',          link: '/events/types/entries/entry-deleted'},
                    {text: 'Entry is restored',         link: '/events/types/entries/entry-restored'},
                    {text: 'Scheduled date is reached', link: '/events/types/entries/date-reached'},
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
                {text: 'Formie',          link: '/events/types/formie/'},
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
                {text: 'RSS/JSON Feed',   link: '/events/types/feed/'},
                {text: 'System Snapshot', link: '/events/types/system-snapshot/'},
                {text: 'Dynamic Data',    link: '/events/types/dynamic-data/'},
              ]
            },
          ]
        },
        {
          items: [
            {text: 'Manual Sending',    link: '/events/manual-sending'},
            {text: 'Scheduled Sending', link: '/events/scheduled-sending'},
          ]
        }
      ],
      // Messages
      '/messages/': [
        {
          text: 'Messages',
          items: [
            {text: 'Overview',               link: '/messages/'},
          ]
        },
        {
          items: [
            {text: 'All Message Types',      link: '/messages/types/',
              items: [
                {text: 'Native Pings', collapsed: true,
                  items: [
                    {text: 'Email',              link: '/messages/types/email'},
                    {text: 'Announcement',       link: '/messages/types/announcement'},
                    {text: 'Flash Message',      link: '/messages/types/flash'},
                  ]
                },
                {text: 'Push Notifications', collapsed: true,
                  items: [
                    {text: 'SMS (Text Message)', link: '/messages/types/sms-text'},
                    {text: 'Pushover',           link: '/messages/types/pushover'},
                    {text: 'ntfy',               link: '/messages/types/ntfy'},
                  ]
                },
                {text: 'Chat Platforms', collapsed: true,
                  items: [
                    {text: 'Slack',              link: '/messages/types/slack'},
                    {text: 'Discord',            link: '/messages/types/discord'},
                  ]
                },
                {text: 'Social Media', collapsed: true,
                  items: [
                    {text: 'Facebook',           link: '/messages/types/facebook'},
                    {text: 'Instagram',          link: '/messages/types/instagram'},
                    {text: 'X (Twitter)',        link: '/messages/types/x-twitter'},
                    {text: 'Bluesky',            link: '/messages/types/bluesky'},
                    {text: 'Mastodon',           link: '/messages/types/mastodon'},
                    {text: 'LinkedIn',           link: '/messages/types/linkedin'},
                  ]
                },
                {text: 'Internet of Things', collapsed: true,
                  items: [
                    {text: 'MQTT',               link: '/messages/types/mqtt'},
                  ]
                },
              ]
            },
          ]
        },
        {
          items: [
            {text: 'Message Templating',     link: '/messages/templating'},
            {text: 'Special Variables',      link: '/messages/variables/', collapsed: true,
              items: [
                {text: 'Element Events',     link: '/messages/variables/element-events'},
                {text: 'Formie Submissions', link: '/messages/variables/formie-submissions'},
                {text: 'RSS/JSON Feed',      link: '/messages/variables/rss-json-feed'},
                {text: 'System Snapshot',    link: '/messages/variables/system-snapshot'},
                {text: 'Dynamic Data',       link: '/messages/variables/dynamic-data'},
              ]
            },
            {text: 'Image Attachments',      link: '/messages/media'},
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
          ]
        },
        {
          items: [
            {text: 'All Recipient Types', link: '/recipients/types/',
              items: [
                {text: 'Native Users', collapsed: true,
                  items: [
                    {text: 'Current User',       link: '/recipients/types/current-user'},
                    {text: 'All Users',          link: '/recipients/types/all-users'},
                    {text: 'All Admins',         link: '/recipients/types/all-admins'},
                    {text: 'Selected Groups',    link: '/recipients/types/selected-groups'},
                    {text: 'Selected Users',     link: '/recipients/types/selected-users'},
                    {text: 'Dynamic Recipients', link: '/recipients/types/dynamic-recipients'},
                  ]
                },
                {text: 'Push Notifications', collapsed: true,
                  items: [
                    {text: 'ntfy Topics', link: '/recipients/types/ntfy-topics'},
                  ]
                },
                {text: 'Chat Platforms', collapsed: true,
                  items: [
                    {text: 'Slack Channels',   link: '/recipients/types/slack-channels'},
                    {text: 'Discord Channels', link: '/recipients/types/discord-channels'},
                  ]
                },
                {text: 'Social Media', collapsed: true,
                  items: [
                    {text: 'Facebook Pages',       link: '/recipients/types/facebook-pages'},
                    {text: 'Instagram Accounts',   link: '/recipients/types/instagram-accounts'},
                    {text: 'X (Twitter) Accounts', link: '/recipients/types/x-twitter-accounts'},
                    {text: 'Bluesky Accounts',  link: '/recipients/types/bluesky-accounts'},
                    {text: 'Mastodon Accounts', link: '/recipients/types/mastodon-accounts'},
                    {text: 'LinkedIn Accounts', link: '/recipients/types/linkedin-accounts'},
                  ]
                },
                {text: 'Internet of Things', collapsed: true,
                  items: [
                    {text: 'MQTT Topics', link: '/recipients/types/mqtt-topics'},
                  ]
                },
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
            {text: 'Notification Elements', link: '/elements'},
            {text: 'Custom Fields',         link: '/custom-fields'},
            {text: 'Testing Notifications', link: '/testing'},
            {text: 'Notification Log',      link: '/logging'},
            {text: 'Translations',          link: '/translations'}
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
