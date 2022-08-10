const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
.vue()
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
    ]);

// mix.browserSync('127.0.0.1:8000');
mix.browserSync('192.168.128.195:8000');
mix.disableNotifications();

const path = require('path');
mix.alias({
    ziggy: path.resolve('vendor/tightenco/ziggy/dist'),
});
