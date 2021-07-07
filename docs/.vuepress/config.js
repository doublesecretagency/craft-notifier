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
                    {text: 'Create a Message Trigger', link: '/how-it-works/create-message-trigger/'},
                    {text: 'Select a Message Type', link: '/how-it-works/select-message-type/'},
                    {text: 'Specify Message Recipients', link: '/how-it-works/specify-message-recipients/'},
                    {text: 'Specify Twig Template', link: '/how-it-works/specify-twig-template/'},
                    {text: 'Editing a Twig Template', link: '/how-it-works/editing-twig-template/'},
                    {text: 'Managing Existing Notifications', link: '/how-it-works/managing-existing-notifications/'},
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
                'create-message-trigger',
                'select-message-type',
                'specify-message-recipients',
                'specify-twig-template',
                'editing-twig-template',
                'managing-existing-notifications',
            ],

        }
    }
};
