const mix = require('laravel-mix');

   mix.js(['resources/js/app.js',
        ], 'public/js/Vue-App.js' );

  mix.scripts([
      'resources/js/vendors/js/toastr.min.js',
    ], 'public/js/app-custom.js'    ) ;// Archivo de salida JS

   mix.styles ([
        'resources/css/app.css',
        'resources/js/vendors/css/toastr.min.css',
       ], 'public/css/Vue-App.css') ;     // Archivo de salida CSS

    mix.browserSync({
      proxy: 'http://laravel57-balquimia-erp.local/',
      open: false,
      //browser : 'Google Chrome',
    });
    mix.disableNotifications();

   /*mix.scripts([
      'resources/assets/js/vendors/toastr.js',
    ], 'public/js/app.js'    ) ;// Archivo de salida JS

    */
