<?php

namespace Alikazemayni\EasyPermission\Providers;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__ . "/../Http/Controllers/Publish/" => app_path('Http/Controllers/'),
            __DIR__ . "/../Http/Requests/" => app_path('Http/Requests/'),
            __DIR__ . "/../Models/" => app_path('Models/'),
        ],'publish-permissions-file');
        $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }

    public function register()
    {

    }

}