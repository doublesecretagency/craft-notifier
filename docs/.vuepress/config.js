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
                    {text: 'Add an Event Trigger', link: '/how-it-works/add-an-event-trigger/'},
                    {text: 'Set Message Type', link: '/how-it-works/set-message-type/'},
                    {text: 'Set Message Template', link: '/how-it-works/set-message-template/'},
                    {text: 'Set Message Recipients', link: '/how-it-works/set-message-recipients/'},
                    {text: 'Managing Existing Notifications', link: '/how-it-works/managing-existing-notifications/'},
                    {text: 'Editing a Twig Template', link: '/how-it-works/editing-twig-template/'},
                ]
            },
            {
                text: 'Guides',
                items: [
                    {text: 'TBD', link: '/tbd/'},
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
                'add-an-event-trigger',
                'set-message-type',
                'set-message-template',
                'set-message-recipients',
                'managing-existing-notifications',
                'editing-twig-template',
            ],

        }
    }
};
