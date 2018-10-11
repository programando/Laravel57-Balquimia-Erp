<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('APP_NAME',         config('_app.APP_NAME'));
        View::share('Browser_Title',    config('_app.APP_NAME'));
        View::share('Page_Description', config('_app.APP_DESCRIPTION'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
