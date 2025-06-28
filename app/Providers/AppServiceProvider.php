<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       //
        Gate::define('cashier', function(User $user){
            return $user->admin->userGroup->name === 'Cashier';
        });
        Gate::define('storeManager', function(User $user){
            return $user->admin->userGroup->name === 'Store Manager';
        });
        Gate::define('admin', function(User $user){
            return $user->admin->userGroup->name === 'Admin';
        });
 
 
    }
}
