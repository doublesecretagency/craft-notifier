let mix = require('laravel-mix');

// Set paths
const src  = 'web/assets/src';
const dist = 'web/assets/dist';

// Run Mix
mix

    // .vue({version: 3})
    //
    // // Webpack config
    // .webpackConfig({
    //     module: {
    //         rules: [
    //             {test: /\\.vue$/, loader: 'vue-loader'}
    //         ]
    //     }
    // })

    // Compile all JavaScript
    .js(`${src}/js/log.js`, `${dist}/js`)

    // Compile all Sass
    .sass(`${src}/sass/log.scss`, `${dist}/css`)

    // Disable build notifications
    .disableNotifications()
;
