<?php

namespace Alikazemayni\EasyPermission\Providers;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__ . "/../Http/Controllers" => app_path('Http/Controllers/YourController.php')
        ],'publish-controller');
    }

    public function register()
    {

    }

}