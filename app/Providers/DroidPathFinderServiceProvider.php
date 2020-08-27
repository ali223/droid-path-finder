<?php

namespace App\Providers;

use App\Services\DroidPathFinder;
use Illuminate\Support\ServiceProvider;

class DroidPathFinderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DroidPathFinder::class, function ($app) {
            return new DroidPathFinder(config('services.rebel_alliance.api_url'));
        });
    }
}
