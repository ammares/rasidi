const mix = require('laravel-mix')

mix.styles([
  'public/css/core.css',
  'public/css/base/core/menu/menu-types/vertical-menu.css',
  'public/css/base/core/colors/palette-gradient.css',
  'public/vendors/css/pickers/flatpickr/flatpickr.min.css',
  'public/css/base/plugins/forms/pickers/form-flat-pickr.css',
  'public/vendors/toastr/toastr.min.css',
  'public/css/overrides.css',
  'public/css/custom.css',
], 'public/css/app.css')
  .scripts([
    'public/vendors/toastr/toastr.min.js',
    'public/vendors/bootbox/bootbox.min.js',
    'public/vendors/bootbox/bootbox.locales.js',
    'public/vendors/js/pickers/flatpickr/flatpickr.min.js',
    'public/js/custom.js',
  ], 'public/js/app.js');

if (mix.inProduction()) {
  mix.version()
}