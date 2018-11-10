<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BalquimiaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Helpers/Users.php';
        require_once app_path() . '/Helpers/Images.php';
        require_once app_path() . '/Helpers/Folders.php';
        require_once app_path() . '/Helpers/Strings.php';

    }
}
