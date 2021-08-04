module.exports = {

    markdown: {
        anchor: { level: [2, 3] },
        extendMarkdown(md) {
            let markup = require('vuepress-theme-craftdocs/markup');
            md.use(markup);
        },
    },

    base: '/notifier/',
    title: 'Notifier plugin for Craft CMS',
    plugins: [
        [
            'vuepress-plugin-clean-urls',
            {
                normalSuffix: '/',
                indexSuffix: '/',
                notFoundPath: '/404.html',
            },
        ],
    ],
    theme: 'craftdocs',
    themeConfig: {
        codeLanguages: {
            php: 'PHP',
            twig: 'Twig',
            html: 'HTML',
            js: 'JavaScript',
        },
        logo: '/images/icon.svg',
        searchMaxSuggestions: 10,
        nav: [
            {text: 'Getting Started️', link: '/getting-started/'},
            {
                text: 'How It Works',
                items: [
                    {text: 'Overview', link: '/how-it-works/'},
                    {text: 'Triggers', link: '/triggers/'},
                    {text: 'Messages', link: '/messages/'},
                    {text: 'Recipients', link: '/recipients/'},
                ]
            },
            {
                text: 'Guides',
                items: [
                    {text: 'Notification Logs', link: '/guides/logs/'},
                ]
            },
        ],
        sidebar: {
            // Getting Started
            '/getting-started/': [
                '',
            ],
            // How it Works
            '/how-it-works/': [
                '',
                'managing-notifications',
            ],
            // Triggers
            '/triggers/': [
                '',
                'on-entry-save',
            ],
            // Messages
            '/messages/': [
                '',
                'set-type',
                'set-template',
                'edit-template',
                'variables',
                'skip',
            ],
            // Recipients
            '/recipients/': [
                '',
                'custom-users',
                'custom-emails',
            ],
            // Guides
            '/guides/': [
                'logs',
            ],
        }
    }
};
