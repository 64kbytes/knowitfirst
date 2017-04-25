<?php

namespace Baytree\KnowItFirst;

use Illuminate\Support\ServiceProvider;

class KnowItFirstServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        require __DIR__ . '/../vendor/autoload.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // register package events
        $this->app->register('Baytree\KnowItFirst\EventServiceProvider');
    }
}
