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
    // Materialize CSS
   .copy('node_modules/materialize-css/dist/css/materialize.min.css', 'public/utils/css/materialize.min.css')
   .copy('node_modules/materialize-css/dist/js/materialize.min.js', 'public/utils/js/materialize.min.js')
   .copyDirectory('node_modules/materialize-css/dist/fonts', 'public/utils/fonts')
   // Normalize.css
   .styles('node_modules/normalize.css/normalize.css', 'public/utils/css/normalize.min.css')
   // Typicons.font
   .styles('node_modules/typicons.font/src/font/typicons.css', 'public/utils/css/typicons.min.css')
   .copy('node_modules/typicons.font/src/font/typicons.eot', 'public/utils/css/typicons.eot')
   .copy('node_modules/typicons.font/src/font/typicons.svg', 'public/utils/css/typicons.svg')
   .copy('node_modules/typicons.font/src/font/typicons.ttf', 'public/utils/css/typicons.ttf')
   .copy('node_modules/typicons.font/src/font/typicons.woff', 'public/utils/css/typicons.woff')
