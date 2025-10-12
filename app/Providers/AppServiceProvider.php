<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Logo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share current logo with all views
        View::composer('*', function ($view) {
            $currentLogo = Logo::getCurrentLogo();
            $view->with('currentLogo', $currentLogo);
        });
    }
}
