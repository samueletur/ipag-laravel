<?php

namespace Samueletur\IpagLaravel\Providers;

use Illuminate\Support\ServiceProvider;

class IpagServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/ipag.php', 'ipag');

        $this->app->singleton('ipag', function () {
            return new \Samueletur\IpagLaravel\Ipag();
        });

        $this->app->alias('ipag', \Samueletur\IpagLaralvel\Ipag::class);
    }
}
