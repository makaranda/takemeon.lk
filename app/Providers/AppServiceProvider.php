<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\VisitorsCount;
use App\Observers\VisitorCountObserver;

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
        //VisitorsCount::observe(VisitorCountObserver::class);
        //\Log::info('VisitorCountObserver successfully registered.');
    }
}
