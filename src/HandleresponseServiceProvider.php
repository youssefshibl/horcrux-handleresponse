<?php

namespace Horcrux\Handleresponse;

use Illuminate\Support\ServiceProvider;

class HandleresponseServiceProvider  extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //dd('25');
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__ . './Config/horcruxresponse.php' => config_path('horcruxresponse.php'),
            ], 'config');
        }
    }
}
