const mix = require('laravel-mix');
const webpack = require('webpack');

mix.disableNotifications();

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .webpackConfig({
        plugins: [
            new webpack.DefinePlugin({
                __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: false,
                __VUE_OPTIONS_API__: true,
                __VUE_PROD_DEVTOOLS__: false,
            }),
        ],
    })
    .sass('resources/sass/app.scss', 'public/css')
    .version();

// Global Style
mix.sass('resources/sass/globalStyle/style.scss', 'public/css');

// Home
// mix.sass('resources/sass/home/home.scss', 'public/css');
