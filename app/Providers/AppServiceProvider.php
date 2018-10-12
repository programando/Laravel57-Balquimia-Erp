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
        view::share('APP_NAME',         'BALQUIMIA');
        view::share('Browser_Title',    config('_app.APP_NAME'));
        view::share('Page_Description', config('_app.APP_DESCRIPTION'));
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
