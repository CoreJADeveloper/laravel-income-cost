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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

mix.js(['resources/js/app.js', 'resources/js/script.js'], 'public/js/app.js');
mix.sass('resources/sass/app.scss', 'public/css/app.css');
// mix.styles(['public/css/app.css', 'resources/css/bootstrap-datepicker.min.css'], 'public/css/app.css');
