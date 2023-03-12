const mix = require('laravel-mix');

mix.setPublicPath('./public')

mix.babel([
  'resources/makeup/js/jquery-3.2.1.min.js',
  'resources/makeup/js/jquery.modal.min.js',
  'resources/makeup/js/jquery.rating-2.0.js',
  'resources/makeup/js/bootstrap-datepicker.min.js',
  'resources/makeup/js/bootstrap-datepicker.ru.min.js',
  'resources/makeup/js/script.js',
], './public/js/all.js');

mix.styles([
  'resources/makeup/css/style.css',
], './public/css/all.css');

mix.copy('resources/makeup/js/ads.js', './public/js/ads.js');

mix
  .copyDirectory('resources/makeup/img', './public/img')

mix.version();
