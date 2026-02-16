<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Page;

class DynamicPageRouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Register services if needed
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // Register dynamic routes for pages
        $this->addDynamicRoutes();
    }

    /**
     * Add dynamic routes for pages
     */
    private function addDynamicRoutes()
    {
        // Fetch all active pages
        $pages = Page::where('status', 1)->get();  // You can filter this as needed

        // Loop through each page and create a dynamic route
        foreach ($pages as $page) {
            Route::get("/page/{$page->slug}", [\App\Http\Controllers\frontend\HomeController::class, 'dynamicPage'])
                ->name('frontend.' . $page->slug);
            //Log::info('Route added for: /page/' . $page->slug);
        }
    }
}

