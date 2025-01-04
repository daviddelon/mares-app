<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
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
        Model::preventLazyLoading();
        // This can help prevent unexpected errors during local development when attempting to set an attribute that has not been added to the model's fillable array
        Model::preventSilentlyDiscardingAttributes();
        //
    }
}
