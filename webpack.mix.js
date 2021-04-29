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

mix.css('resources/css/bootstrap.css', 'public/css/all.css', []);
mix.css('resources/css/animate.css', 'public/css/all.css', []);
mix.css('resources/css/plugins/dataTables/datatables.min.css', 'public/css/all.css', []);
mix.css('resources/css/plugins/summernote/summernote-bs4.css', 'public/css/all.css', []);
mix.css('resources/css/plugins/dropzone/dropzone.css', 'public/css/all.css', []);
mix.css('resources/css/plugins/blueimp/css/blueimp-gallery.css', 'public/css/all.css', []);
mix.css('resources/css/plugins/sweetalert/sweetalert.css', 'public/css/all.css', []);
mix.css('resources/css/plugins/datapicker/datepicker3.css', 'public/css/all.css', []);
mix.css('resources/css/plugins/select2/select2.min.css', 'public/css/all.css', []);
mix.css('resources/css/plugins/select2/select2-bootstrap4.min.css', 'public/css/all.css', []);
mix.css('resources/font-awesome/css/font-awesome.css', 'public/css', []);
mix.css('resources/css/style.css', 'public/css', []);
mix.css('resources/css/custom.css', 'public/css', []);
