<?php

namespace CrasyHorse\Testing\Laravel\Providers;

use Illuminate\Support\ServiceProvider;

class PhpUnitFixtureLaravelServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/fixture.php', 'fixture');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/fixture.php' => config_path('fixture.php'),
            ], 'fixture:config');
        }
    }
}
