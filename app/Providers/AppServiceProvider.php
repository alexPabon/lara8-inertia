<?php

namespace App\Providers;

use App\Models\Module;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Support\ServiceProvider;
use MongoDB\Driver\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share([
            'locale' => function () {
                return app()->getLocale();
            },
            'language' => function () {
                return translations(
                    resource_path('lang/' . app()->getLocale() . '.json')
                );
            },            
        ]);

        Paginator::useTailwind();

    }
}
