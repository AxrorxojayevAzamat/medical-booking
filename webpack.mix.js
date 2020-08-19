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

mix.js([
        'resources/js/functions.js',
        'resources/js/bootstrap-datepicker.js',
        'resources/js/markerclusterer.js',
        ],
         'public/js/app.js')
   .js(['resources/js/jquery-2.2.4.min.js',
        'resources/js/common_scripts.min.js',
        'resources/js/baguetteBox.min.js',
        'public/vendor/select2/js/select2.min.js',
        ],
         'public/js/main.js')
    .sass(
        'resources/sass/app.scss', 'public/css/app')
    .version();
