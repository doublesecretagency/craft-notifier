let mix = require('laravel-mix');

// Set paths
const src  = 'web/assets/src';
const dist = 'web/assets/dist';

// Run Mix
mix

    .vue({version: 3})

    // Webpack config
    .webpackConfig({
        module: {
            rules: [
                {test: /\\.vue$/, loader: 'vue-loader'}
            ]
        }
    })

    // Compile all JavaScript
    .js(`${src}/js/notification.js`, `${dist}/js`)

    // Disable build notifications
    .disableNotifications()
;
