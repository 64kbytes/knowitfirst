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
        //require __DIR__ . '/../vendor/autoload.php';

        $this->publishes([
            __DIR__ . '/config' => config_path('knowitfirst'),
        ]);
        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        require __DIR__ . '/../../slack/src/SlackServiceProvider.php';

        // publish config
        //$this->mergeConfigFrom( __DIR__ . '/config/base.php', 'providers' );


        // register package dependency  
        $this->app->register('Baytree\Slack\SlackServiceProvider');

        // register package events
        $this->app->register('Baytree\KnowItFirst\EventServiceProvider');
    }
}
