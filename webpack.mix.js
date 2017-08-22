let mix = require('laravel-mix')

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

mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/utils/js/jquery.min.js')
   .copy('node_modules/materialize-css/dist/css/materialize.min.css', 'public/utils/css/materialize.min.css')
   .copy('node_modules/materialize-css/dist/js/materialize.min.js', 'public/utils/js/materialize.min.js')
   .copyDirectory('node_modules/materialize-css/dist/fonts', 'public/utils/fonts')
