<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
        // We're using an old version of MySQL so we need to set the default string length
        Schema::defaultStringLength(191);

        // Add a blade formatter that will output html properly
        Blade::directive('html', function ($expression) {
            return "<?= html_entity_decode($expression) ?>";
        });

        // Add a blade formatter for a boolean attribute
        Blade::directive('boolean', function ($expression) {
            return "<?= $expression ? trans('common.yes') : trans('common.no'); ?>";
        });
    }

    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
