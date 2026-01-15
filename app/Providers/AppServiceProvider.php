<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        // Fix asset URL inconsistency for Hostinger/Live environments
        if (!app()->isLocal()) {
            config(['app.asset_url' => url('/public')]);
        }
    }
}
