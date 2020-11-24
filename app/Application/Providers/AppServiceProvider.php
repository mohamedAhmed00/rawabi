<?php
namespace App\Application\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $settings = getSiteSettings();
        view()->share([
            'settings' => $settings
        ]);
        if (!empty($settings['tax'])){
            config(['cart.tax' => $settings['tax']]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
