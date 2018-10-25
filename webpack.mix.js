const mix = require('laravel-mix');

   mix.js(['resources/js/app.js',
        ], 'public/js/Vue-App.js' );

   mix.styles ([
        'resources/css/app.css',
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
