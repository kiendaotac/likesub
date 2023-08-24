<?php

namespace App\Providers;

use App\Models\Service;
use Illuminate\Support\Facades\View;
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

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $services = Service::query()->whereNull('parent_id')->with('children')->get();
        View::composer('components.partials.sidebar', function (\Illuminate\View\View $view) use ($services) {
            $view->with('services', $services);
        });
    }
}
