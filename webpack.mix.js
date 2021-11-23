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

 mix.js('resources/assets/js/app.js', 'public/js')
 .sass('resources/sass/app.scss', 'public/css')
 .postCss('resources/assets/css/app.css', 'public/css')
 .postCss('resources/assets/css/custom.css', 'public/css')
 .postCss('resources/assets/css/layout.css', 'public/css')
 .postCss('resources/assets/css/menu.css', 'public/css')
 .postCss('resources/assets/css/tailwind.css', 'public/css')
 .sourceMaps();
