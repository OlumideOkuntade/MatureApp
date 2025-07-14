<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Services\UserManager;
use App\Services\CustomerManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserManager::class, function ($app) {
        return new UserManager();
        });

        $this->app->bind(CustomerManager::class, function ($app) {
        return new CustomerManager();  
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       //
      
    }
}
