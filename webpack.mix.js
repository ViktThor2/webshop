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
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();


mix.scripts([
  'node_modules/admin-lte/plugins/jquery/jquery.js',
  'node_modules/admin-lte/plugins/bootstrap/js/bootstrap.js',
  'node_modules/admin-lte/plugins/popper/umd/popper.js',
  'node_modules/admin-lte/plugins/select2/js/select2.js',
  'node_modules/admin-lte/plugins/select2/js/i18n/hu.js',
  'node_modules/admin-lte/plugins/sweetalert2/sweetalert2.min.js',
  'node_modules/datatables.net/js/jquery.dataTables.min.js',
  'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js',
  'node_modules/admin-lte/dist/js/adminlte.js',
], 'public/js/admin.js')
 .sass('resources/sass/admin.scss', 'public/css');


 