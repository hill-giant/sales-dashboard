const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/dashboard.js', 'public/js')
    .js('resources/js/daterange.js', 'public/js')
    .styles(['node_modules/daterangepicker/daterangepicker.css'], 'public/css/app.css')
    .sass('resources/sass/app-sass.scss', 'public/css')
    .combine(['public/css/app-sass.css','public/css/app.css'], 'public/css/app.css')
    .sourceMaps();
