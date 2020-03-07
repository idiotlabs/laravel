let mix = require('laravel-mix');

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
   .postCss('resources/css/main.css', 'public/css', [
       require('tailwindcss'),
   ])
    // .copy('node_modules/lightgallery.js/dist/css/lightgallery.css', 'public/css')
    .copy('node_modules/photoswipe/dist/photoswipe.css', 'public/css')
    .copy('node_modules/photoswipe/dist/default-skin/default-skin.css', 'public/css')
   .sass('resources/sass/app.scss', 'public/css');