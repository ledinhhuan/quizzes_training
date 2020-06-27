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

mix.sass('resources/assets/material/scss/material-kit.scss', 'public/assets/css')
    .sass('resources/assets/material/scss/material-dashboard.scss', 'public/assets/css').version();

mix.copyDirectory('resources/assets/material/js', 'public/assets/js')
    .copyDirectory('resources/assets/material/img', 'public/assets/img')
    .copyDirectory('resources/assets/material/css', 'public/assets/css');