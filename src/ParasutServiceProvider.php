<?php

namespace TarfinLabs\Parasut;

use Illuminate\Support\ServiceProvider;

class ParasutServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishConfigs();
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigs();

        $this->app->singleton('parasut', fn($app) => new Parasut());
    }

    /**
     * Merge the configs.
     */
    protected function mergeConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/parasut.php', 'parasut');
    }

    /**
     * Publish the configs.
     */
    protected function publishConfigs(): void
    {
        $this->publishes([
            __DIR__.'/../config/parasut.php' => config_path('parasut.php'),
        ], 'config');
    }
}
