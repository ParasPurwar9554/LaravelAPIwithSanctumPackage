<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ParasService;

class ParasServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Bind a class to the service container
        $this->app->bind(ParasService::class, function ($app) {
            return new ParasService(); // Initialize with any dependencies if required
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
