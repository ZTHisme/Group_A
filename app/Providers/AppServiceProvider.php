<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Dao Registration
        $this->app->bind('App\Contracts\Dao\Employee\EmployeeDaoInterface', 'App\Dao\Employee\EmployeeDao');

        // Business logic registration
        $this->app->bind('App\Contracts\Services\Employee\EmployeeServicesInterface', 'App\Services\Employee\EmployeeService');
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
