<?php

namespace Dulshan\SimpleTenant;

use Illuminate\Support\ServiceProvider;

class SimpleTenantServiceProvider extends ServiceProvider
{
    public function boot()
    {
        include(__DIR__."/Helper/SimpleTenantHelper.php");
        
        // $this->loadRoutesFrom(__DIR__ . '/routes.php');

        
    }

    public function register()
    {
    }
}
