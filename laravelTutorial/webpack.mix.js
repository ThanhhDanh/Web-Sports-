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

mix.sass('resources/sass/global/style.scss', 'public/css');

// Error
mix.sass('resources/sass/error/error.scss', 'public/css');

// User
mix.sass('resources/sass/user/login.scss', 'public/css');
mix.sass('resources/sass/user/register.scss', 'public/css');
mix.sass('resources/sass/user/user.scss', 'public/css');
mix.sass('resources/sass/user/management-users.scss', 'public/css');
mix.js('resources/js/login.js', 'public/js');
mix.js('resources/js/register.js', 'public/js');
mix.js('resources/js/management-user.js', 'public/js');

//Products
mix.sass('resources/sass/products/products.scss', 'public/css');
mix.sass('resources/sass/products/create-product.scss', 'public/css');
mix.sass('resources/sass/products/detail-product.scss', 'public/css');
mix.sass('resources/sass/products/accessories.scss', 'public/css');
mix.js('resources/js/product.js', 'public/js');
mix.js('resources/js/accessories.js', 'public/js');

// Categories
mix.sass('resources/sass/categories/categories.scss', 'public/css');
mix.sass('resources/sass/categories/detail-category.scss', 'public/css');
mix.js('resources/js/category.js', 'public/js');

//Dashboard
mix.js('resources/js/dashboard.js', 'public/js');

// Invoices
mix.sass('resources/sass/invoices/invoices.scss', 'public/css');
mix.sass('resources/sass/invoices/create-invoice.scss', 'public/css');
mix.sass('resources/sass/invoices/detail-invoice.scss', 'public/css');
mix.js('resources/js/invoice.js', 'public/js');

// Discounts
mix.sass('resources/sass/discounts/discounts.scss', 'public/css');
mix.js('resources/js/discount.js', 'public/js');

// Events
mix.sass('resources/sass/events/events.scss', 'public/css');
mix.sass('resources/sass/events/create-event.scss', 'public/css');
mix.sass('resources/sass/events/detail-event.scss', 'public/css');
mix.js('resources/js/event.js', 'public/js');

//Comments
mix.sass('resources/sass/comments/comments.scss', 'public/css');
mix.js('resources/js/comment.js', 'public/js');

//Tailwind
mix.postCss('resources/css/main.css', 'public/css', [require('tailwindcss'), require('autoprefixer')]);
